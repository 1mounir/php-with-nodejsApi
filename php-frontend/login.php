<!DOCTYPE html>
<html lang="en">
<head>
  <title>login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Login && get token</h2>
 
  <form method="post" action="login.php">
   
	   <div class="form-group">
      <label for="email">Email:</label>
	  
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
 
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
	<input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
  <div>
  </br>
     <a href="adduser.php" class="btn btn-info" role="button">SignUp</a></div>
	 
</div>

  
</body>
</html>


<?php
 
  if(isset($_POST["submit"])){
	  
	 
	  $email= $_POST['email'];
	  $password= $_POST['password'];
	 
	  
	  
	  

	 // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
	  

		   // data
	  $data = array(
	 
      "email" => $email,
      "password" => $password,
  );
	  
	  
	  
	  // start API code
	  
	  $api_url='http://localhost:5000/login';
	  $curl = curl_init($api_url);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($curl, CURLOPT_POST, true);
	  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	  
	  $curl_response = curl_exec($curl);
	  
	  if($curl_response == false)
	  {
		  echo 'Erro. API is not runnig';
		  
	  }
	  
	  
	  else
	  {
		  $jsonArray= json_decode($curl_response,false);
		 
		      session_start(); 
		      $_SESSION["email"]=$jsonArray-> email;
			  $_SESSION["token"]=$jsonArray-> token;
			
			  
		//	  if($jsonArray-> role='admin'){
				  header('Location: home.php');
		//	  }
			  
			  
			  
		 }
			 
	  
	  curl_close($curl);		  
	
  }
  
  ?>












