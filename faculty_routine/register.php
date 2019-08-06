<?php
	
	include ('include/dbcon.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Faculty</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="image/logo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
		  <div class="col-md-3 p-4">
		  	<img src="image/logo.png">
		  </div>
		  <div class="col-md-5 p-4">
		  	<center>
				<h3 class="text-primary">R V College of Engineering</h3>
				<p class="text-danger">Autonomous Institution affiliated to Visvesvaraya Technological University, Belagavi<br>
				Approved By AICTE, New Delhi, Accredited By NBA, New Delhi</p>
				</center>
		  </div>
		  <div class="col-md-3 p-4 d-flex justify-content-center">
		  	<h3 style="line-height: 50px; padding-top: 30px;" class="text-primary">Since 1983</h3>
		  </div>
		  <div class="col-md-1 p-4">
		  	<img src="image/anniversary-logo.jpg">
		  </div>
		</div>
		
		<div class="row text-secondary">
			<div class="col-md-12 shadow-sm p-4 mb-4 bg-light" style="border-radius: 10px;">
				<form action="register.php" method="POST" id="regform">
					<input type="text" name="name" class="form-control" placeholder="Full Name"><br>
					<input type="email" name="email" class="form-control" placeholder="Email"><br>
					<input type="text" name="mobile" class="form-control" placeholder="Mobile Number"><br>
					<input type="text" name="rvce_id" class="form-control" placeholder="Faculty ID."><br>
					<input type="password" name="password" class="form-control" placeholder="Password"><br>
					<input type="password" name="c_pass" class="form-control" placeholder="Confirm Password"><br>
					<input type="submit" name="submit" id="submit" value ="Register" class="btn btn-primary">
					<a href="index.php" class="btn btn-success">Login</a>
				</form>

				<?php

					if(isset($_POST['submit'])){
						$name = $mysqli->escape_string($_POST['name']);
						$email = $mysqli->escape_string($_POST['email']);
						$mobile = $mysqli->escape_string($_POST['mobile']);
						$rvce_id = $mysqli->escape_string($_POST['rvce_id']);
						$password = $mysqli->escape_string($_POST['password']);
						$c_pass = $mysqli->escape_string($_POST['c_pass']);

						if($name == '' || $email == '' || $mobile == '' || $rvce_id == '' || $password == '' || $c_pass == ''){
							?><br>
							<p class="text-danger">Please Fill all the fields !!</p>
							<?php
						}

						$qry = $mysqli->query("SELECT * from faculty WHERE email = '$email'");
						$qry1 = $mysqli->query("SELECT * from faculty WHERE rvce_id = '$rvce_id'");

						if($qry->num_rows > 0){
							?><br>
							<p class="text-danger">Email already Registered with another account !!</p>
							<?php 
						}
						else if($qry1->num_rows > 0){
							?><br>
							<p class="text-danger">RVCE ID already Registered with another account !!</p>
							<?php 
						}
						else if($password != $c_pass){
							?><br>
							<p class="text-danger">Password Doesn't Matched !!</p>
							<?php 
						}
						else
						{
							$pass = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
							$hash = $mysqli->escape_string(md5(rand(0,10000)));

							$qry = "INSERT INTO faculty(name,email,mobile,rvce_id,password,hash) VALUES ('$name','$email','$mobile','$rvce_id','$pass','$hash')";

							if($mysqli->query($qry)){
								?>	<br>
									<p class="text-success">Faculty Successfully Registered !!</p>
								<?php 
								header("refresh:1; url=index.php"); 
							}
							else
							{
								?><br>
								<p class="text-danger">Error in Registering !!</p>
								<?php 
							}
						}
					}
				?>
			</div>
		</div>
	</div>

</body>
</html>