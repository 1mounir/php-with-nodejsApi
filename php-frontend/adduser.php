<?php
session_start(); 
            $first_name= '';
			$last_name='';
			$email= '';
			$phone='';
			$role='';
			$comments='';
if(isset($_GET['uid'])){
	     
$id=$_GET['uid'];
 // set1 apply url
	 $api_url='http://localhost:5000/user/'.$id;
	 
	 // set 2 
	 $curl=curl_init($api_url);
	 
	 //set 3
	 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
	 $data =array(
	  "id" => $_GET['uid']
	  );
	  	  	 $headers = array(
   
         'token:'.$_SESSION["token"],
		 'email:'.$_SESSION["email"],
         'Content-type: text/xml',
         'Access-Control-Allow-Origin: *'
   
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	  
	//  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
	 // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	 // set4 
	 $curl_response=curl_exec($curl);
	 
	 if($curl_response == false ){
		 
	 echo 'Error. API is not running';
	 
	 }
	else
	 {    
 

		 $jsonA= json_decode($curl_response,false);
          foreach($jsonA->rows as $jsonO){
		 
		    $first_name=$jsonO->first_name;
			$last_name=$jsonO->last_name;
			$email=$jsonO->email;
			$phone=$jsonO->phone;
			$role=$jsonO->role;
			$comments=$jsonO->comments;	
		
}

	
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Usermaneger</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">
  <h2>Add User/update</h2>
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
      <input type="email" class="form-control" name="email" id="email" value=<?php echo $email;?>>
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
      "comments" => $comments
	  );
	 if(isset($_SESSION['token']) && !empty($_SESSION['token'])){
			  array_push($data,(object)['token' =>$_SESSION["token"]]);
			  }
	  
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

