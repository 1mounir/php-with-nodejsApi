


<!DOCTYPE html>
<html lang="en">
<head>
  <title>home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">
  <h3>Users</h3>
<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
		<th>email</th>
        <th>mobile</th>
		<th>role</th>
		<th>comments</th>
        <th>action</th>
      </tr>
    </thead>
    <tbody>
     <?php
	 session_start();
	 echo '<h1>'.$_SESSION["email"].'</h1>';
	 // set1 apply url
	 $api_url='http://localhost:5000/user';
	 
	 // set 2 
	 $curl=curl_init($api_url);
  
	 //set 3
	 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	 
	 $headers = array(
   
         'token:'.$_SESSION["token"],
		 'email:'.$_SESSION["email"],
         'Content-type: text/xml',
         'Access-Control-Allow-Origin: *'
   
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	 
	 // set4 
	 $curl_response=curl_exec($curl);
	 
	 if($curl_response == false ){
	 echo 'Error. API is not running';
	 }
	else
	 {    
		 $jsonArray= json_decode($curl_response,false);
		 if($jsonArray == null){
			 echo "my role is user, Don't have any permission";
		 }
else{ 

		 foreach($jsonArray->rows as $jsonObj){
			 echo '<tr>';
			 echo '<td>'.$jsonObj->id.'</td>';
			 echo '<td>'.$jsonObj->first_name.'</td>';
			 echo '<td>'.$jsonObj->last_name.'</td>';
			 echo '<td>'.$jsonObj->email.'</td>';
			 echo '<td>'.$jsonObj->phone.'</td>';
			 echo '<td>'.$jsonObj->role.'</td>';
			 echo '<td>'.$jsonObj->comments.'</td>';
			 
			echo '   <td class="text-end">
        
        <a href="adduser.php?uid='.$jsonObj->id.'" type="button" class="btn btn-light btn-small"><i class="bi bi-pencil"></i>
          Edit</a>
        <a href="home.php?uid='.$jsonObj->id.'" type="button" class="btn btn-light btn-small"><i class="bi bi-pencil"></i>
          delete</a>
      </td>';
		 echo '</tr>';}
		 } 
	 }
	 
	
	 ?>
    </tbody>
  </table>
  </div>
</div>
</div>

</body>
</html>
<?php

  // start API code
	 if(isset($_GET['uid'])){
		
		 
		 
	  $api_url='http://localhost:5000/user';
	  $curl = curl_init($api_url);
	  
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	 
	  
	  curl_setopt($curl, CURLOPT_POST, true);

	  $data =array(
	  "id" => $_GET['uid'],
	  "token" => $_SESSION["token"],
	  "email" => $_SESSION["email"]
	  );
	   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

	  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	  
	  $curl_response = curl_exec($curl);
	  
	  
	  
	  if($curl_response == false)
	  {
		  echo 'Erro. API is not runnig';
		  
	  }
	  else
	  {
	   header("Location: home.php");
	  }
	  curl_close($curl);		  
	
  }


?>