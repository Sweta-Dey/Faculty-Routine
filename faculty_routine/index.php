<?php
	include ('include/dbcon.php');
	session_start();
	
	if(isset($_SESSION['email']))
	{
	    header('location:dashboard.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Faculty Online Routine Management</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="image/logo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body class="bg-light">
	<div class="container shadow p-4 mb-4 bg-white">
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

		<hr class="bg-primary">

		<div class="row text-secondary">
			<div class="col-md-6 p-4">
				<p>R.V. College of Engineering (RVCE) established in 1963 is one of the earliest self-financing engineering colleges in the country. The institution is run by Rashtreeya Sikshana Samithi Trust (RSST) a not for profit trust. The trust runs over 25 institutions and RVCE is the flagship institute under the trust. RVCE is today recognized as one of India’s leading technical institution.</p><br>

				<h2>Vision</h2><br>

				<p>Leadership in Quality Technical Education, Interdisciplinary Research & Innovation, with a Focus on Sustainable and Inclusive Technology</p>

				

				<h2>Quality Policy</h2>

				<p>Achieving Excellence in Technical Education, Research and Consulting through an Outcome Based Curriculum focusing on Continuous Improvement and Innovation by Benchmarking against the global Best Practices.</p>

				<h2>Core Values</h2>

				<p>Professionalism, Commitment, Integrity, Team Work, Innovation</p>

			</div>
			<div class="col-md-6 p-4">
				<form action="index.php" method="POST" id="regform" class=" shadow p-4 mb-4 bg-light" style="border-radius: 10px;">
					<input type="email" name="email" class="form-control" placeholder="Username/Email"><br>
					<input type="password" name="password" class="form-control" placeholder="Password"><br>
					<input type="submit" name="submit" id="submit" value ="Login" class="btn btn-success">
					<a href="register.php" class="btn btn-primary">Register</a>
				</form>

				<?php

					if(isset($_POST['submit'])){
						$email = $mysqli->escape_string($_POST['email']);
						$password = $mysqli->escape_string($_POST['password']);

						if($email == '' || $password == ''){
							?><br>
							<p class="text-danger">Please Fill all the fields !!</p>
							<?php
						}

						$qry = $mysqli->query("SELECT * from faculty WHERE email = '$email'");
			
						if($qry->num_rows > 0){

							$user = $qry->fetch_assoc();

							if(password_verify($password, $user['password'])){

								$_SESSION['name'] = $user['name'];
								$_SESSION['email'] = $user['email'];
								$_SESSION['mobile'] = $user['mobile'];
								$_SESSION['hash'] = $user['hash'];

								header("refresh:0; url=dashboard.php"); 
							}
							else
							{
							
								?><br>
								<p class="text-danger">Wrong Password !!</p>
								<?php 
							
							}
						}
						else
						{
						
							?><br>
							<p class="text-danger">Email Not Registered !!</p>
							<?php 
						
						}
					}
				?>

			<h2>Mission</h2>

				<ul>

					<li>To deliver outocme based Quality education, emphasizing on experiential learning with the state of the art infrastructure.</li>

					<li>To create a conducive environment for interdisciplinary research and innovation.

					To develop professionals through holistic education focusing on individual growth, discipline, integrity, ethics and social sensitivity.</li>

					<li>To nurture industry-institution collaboration leading to competency enhancement and entrepreneurship.</li>

					<li>To focus on technologies that are sustainable and inclusive, benefiting all sections of the society.</li>
				</ul>

			</div>
		</div>
	</div>

</body>
</html>