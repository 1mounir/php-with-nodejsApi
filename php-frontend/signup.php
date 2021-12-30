
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
include('about.php');
<div class="container">
  <h2>Add User</h2>
  <fieldset>
  <form method="post" action="adduser.php">
    <div class="form-group">
      <label for="usr">First Name:</label>
      <input type="text" class="form-control" name="firstname" id="firstname" value=<?php echo $first_name;?>>
    </div>
	 <div class="form-group">
      <label for="usr">Last Name:</label>
      <input type="text" class="form-control" name="lastname" id="lastname" value=<?php echo $last_name;?>>
    </div>
	 <div class="form-group">
      <label for="usr">Email:</label>
      <input type="text" class="form-control" name="email" id="email" value=<?php echo $email;?>>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" name="password" class="form-control" id="password" value=<?php $password;?>>
    </div>

	 <div class="form-group">
      <label for="Phone">Phone:</label>
      <input type="text" name="phone" class="form-control" id="phone" value=<?php echo $phone;?>>
    </div>
	 <div class="form-group">
      <label for="usr">Role:</label>
      <input type="text" class="form-control" name="role" id="role" value=<?php echo $role;?>>
    </div>
	<div class="form-group">
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="comments" name="comments" value=<?php echo $comments;?> ></textarea>
</div>
<input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
  </fieldset>
  <?php
 
  if(isset($_POST["submit"])){
	  
	  $first_name= $_POST['firstname'];
	  $last_name= $_POST['lastname'];
	  $email= $_POST['email'];
	  $password= $_POST['password'];
	  echo $_POST['password'];
	  $phone= $_POST['phone'];
	  $role= $_POST['role'];
	  $comments= $_POST['comments'];
	  
	  
	  
	  if(isset($_GET['uid'])){
		  $data = array(
		  "id" => $_GET[uid],
	  "first_name" => $first_name,
      "last_name" => $last_name,
      "email" => $email,
      "password" => $password,
      "phone" => $phone,
      "role" => $role,
      "comments" => $comments);
	  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
	  }
	  else{
		   // data
	  $data = array(
	  "first_name" => $first_name,
      "last_name" => $last_name,
      "email" => $email,
      "password" => $password,
      "phone" => $phone,
      "role" => $role,
      "comments" => $comments);
	  
	  }
	  
	  // start API code
	  
	  $api_url='http://localhost:5000/user';
	  $curl = curl_init($api_url);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	 // curl_setopt($curl, CURLOPT_POST, true);
	  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	  
	  $curl_response = curl_exec($curl);
	  
	  if($curl_response == false)
	  {
		  echo 'Erro. API is not runnig';
		  
	  }
	  else
	  {
		  echo '<span style="color:green">User Created</sapn>';
	  }
	  curl_close($curl);		  
	
  }
  
  ?>
</div>

    </tbody>
  </table>
  </div>
</div>
</div>

</body>
</html>

