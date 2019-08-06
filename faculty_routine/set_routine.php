<?php
	include ('include/dbcon.php');
	session_start();
	$email = $_SESSION['email'];
	$qry = $mysqli->query("SELECT * from faculty WHERE email = '$email'");
	$user = $qry->fetch_assoc();
	
	if(!isset($_SESSION['email']))
	{
	    header('location:index.php');
	}
	else
	{
		if($_SESSION['hash'] != $user['hash']){
			header('location:index.php');
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Write Routine</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="image/logo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container p-4">
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

		<div class="row">
			<div class="col-md-5">
				Faculty Name : <b><?php echo $user['name']; ?></b><br>
				Faculty ID : <b><?php echo $user['rvce_id']; ?></b><br>
			</div>
			<div class="col-md-6">
				
			</div>
			<div class="col-md-1">
				<a href="./include/logout.php" class="btn btn-danger">LOGOUT</a>
			</div>
		</div>
		<br>
		<ul class="nav nav-pills nav-justified">
		    <li class="nav-item">
		      <a class="nav-link" href="routine.php">My Routine</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link active" href="set_routine.php">Set Routine</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="viewreport.php">View My Report</a>
		</ul><br>

		<div class="row text-secondary">
			<div class="col-md-12 shadow-sm p-4 mb-4 bg-light" style="border-radius: 10px;">
				<form action="set_routine.php" method="POST" id="regform">
					Subject Name : <input type="text" name="name" class="form-control" placeholder="Subject Name"><br>
					Subject Code : <input type="text" name="code" class="form-control" placeholder="Suject Code"><br>
					Semester : <select name="sem" class="form-control">
					  <option value="1">Semester I</option>
					  <option value="2">Semester II</option>
					  <option value="3">Semester III</option>
					  <option value="4">Semester IV</option>
					  <option value="5">Semester V</option>
					  <option value="6">Semester VI</option>
					</select><br>
					Section : <select name="section" class="form-control">
					  <option value="A">A</option>
					  <option value="B">B</option>
					  <option value="Elective">Elective</option>
					</select><br>
					Type of Class : <select name="type" class="form-control">
					  <option value="Theory">Theory</option>
					  <option value="Lab">Lab</option>
					</select><br>
					Start Time : <select name="start_time" class="form-control">
					  <option value="9:00">9:00</option>
					  <option value="10:00">10:00</option>
					  <option value="11:30">11:30</option>
					  <option value="12:30">12:30</option>
					  <option value="2:15">2:15</option>
					  <option value="3:15">3:15</option>
					</select><br>
					End Time : <select name="end_time" class="form-control">
					  <option value="10:00">10:00</option>
					  <option value="11:00">11:00</option>
					  <option value="12:30">12:30</option>
					  <option value="1:30">1:30</option>
					  <option value="3:15">3:15</option>
					  <option value="4:15">4:15</option>
					</select><br>
					Day : <select name="day" class="form-control">
					  <option value="Mon">Monday</option>
					  <option value="Tue">Tuesday</option>
					  <option value="Wed">Wednesday</option>
					  <option value="Thu">Thrusday</option>
					  <option value="Fri">Friday</option>
					</select><br>
					Room Number : <input type="text" name="room_no" class="form-control" placeholder="Room Number"><br>
					Class Strenght : 	<input type="text" name="total" class="form-control" placeholder="Class Strength"><br>
					<input type="submit" name="submit" id="submit" value ="Add Class" class="btn btn-primary btn-block">
				</form>

				<?php

					if(isset($_POST['submit'])){
						$name = $mysqli->escape_string($_POST['name']);
						$code = $mysqli->escape_string($_POST['code']);
						$sem = $mysqli->escape_string($_POST['sem']);
						$section = $mysqli->escape_string($_POST['section']);
						$type = $mysqli->escape_string($_POST['type']);
						$start_time = $mysqli->escape_string($_POST['start_time']);
						$end_time = $mysqli->escape_string($_POST['end_time']);
						$day = $mysqli->escape_string($_POST['day']);
						$room_no = $mysqli->escape_string($_POST['room_no']);
						$total = $mysqli->escape_string($_POST['total']);
						$email = $_SESSION['email'];
						

						if($name == '' || $code == '' || $sem == '' || $type == '' || $start_time == '' || $end_time == '' || $room_no == '' || $total == '')
						{
							?><br>
							<p class="text-danger">Please Fill all the fields !!</p>
							<?php
						}
						else
						{
							$qry = $mysqli->query("SELECT * from subject WHERE code = '$code' AND type = '$type' AND email <> '$email'");
							$qry1 = $mysqli->query("SELECT * from subject WHERE day = '$day' AND ( start_time = '$start_time' OR end_time = '$end_time') AND sem = '$sem'");
							$qry2 = $mysqli->query("SELECT * from subject WHERE day = '$day' AND ( start_time = '$start_time' OR end_time = '$end_time') AND email = '$email'");

							if($qry->num_rows > 0){
								?><br>
								<p class="text-danger">Subject is already assigned to some Faculty !!</p>
								<?php 
							}
							else if($qry1->num_rows > 0){
								?><br>
								<p class="text-danger">Time slot already assigned to some Faculty !!</p>
								<?php 
							}
							else if($qry2->num_rows > 0){
								?><br>
								<p class="text-danger">Time slot already assigned to you for some other class !!</p>
								<?php 
							}
							else
							{

								$qry = "INSERT INTO subject(name,code,sem,section,type,start_time,end_time,day,room_no,total,email) VALUES ('$name','$code','$sem','$section','$type','$start_time','$end_time','$day','$room_no','$total','$email')";

								if($mysqli->query($qry)){
									?>	<br>
										<p class="text-success">Class Successfully Registered !!</p>
									<?php 
								}
								else
								{
									?><br>
									<p class="text-danger">Error in Registering !!</p>
									<?php 
								}
							}
						}
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>