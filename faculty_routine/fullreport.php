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

	$id = $_GET['id'];

	$qry1 = $mysqli->query("SELECT * from report WHERE id = '$id'");
	$user1 = $qry1->fetch_assoc();

	if($_SESSION['email'] != $user1['email']){
		header('location:routine.php');
	}

	$sub_id = $user1['sub_id'];

	$qry2 = $mysqli->query("SELECT * from subject WHERE id = '$sub_id'");
	$user2 = $qry2->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Full Report</title>
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
		      <a class="nav-link" href="set_routine.php">Set Routine</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="viewreport.php">View My Report</a>
		    </li>
		</ul><br>

		<div class="row p-4">
			<div class="col-md-12">
				<form action="report.php?id=<?php echo $id?>" method="POST" id="regform">
					<table class="table table-bordered">
					    <tr>
					    	<td colspan="6" class="text-center bg-light"><strong>View Class Report</strong></td>
					    </tr>
					    <tr>
					    	<td class="text-center"><strong>Semester</strong></td>
					    	<td class="text-center"><strong><?php echo $user2['sem']?></strong></td>
					    	<td class="text-center"><strong>Subject Code</strong></td>
					    	<td class="text-center"><strong><?php echo $user1['code']?></strong></td>
					    	<td class="text-center"><strong>Section</strong></td>
					    	<td class="text-center"><strong><?php echo $user2['section']?></strong></td>
					    </tr>
					    <tr>
					    	<td class="text-center"><strong>Room Number</strong></td>
					    	<td class="text-center"><strong><?php echo $user2['room_no']?></strong></td>
					    	<td class="text-center"><strong>Subject Name</strong></td>
					    	<td colspan="3" class="text-center"><strong><?php echo $user2['name']?></strong></td>
					    </tr>
					     <tr>
					    	<td class="text-center"><strong>Class Strength</strong></td>
					    	<td class="text-center"><strong><?php echo $user2['total']?></strong></td>
					    	<td class="text-center"><strong>Present</strong></td>
					    	<td class="text-center"><strong><?php echo $user1['present']?></strong></td>
					    	<td class="text-center"><strong>Date</strong></td>
					    	<td class="text-center"><strong><?php echo $user1['date']?></strong></td>
					    </tr>
					    <tr>
					    	<td colspan="2" class="text-center"><strong>Syllabus Decided to cover</strong></td>
					    	<td colspan="4"><?php echo $user1['decided']?></td>
					    </tr>
					    <tr>
					    	<td colspan="2" class="text-center"><strong>Syllabus Covered Today</strong></td>
					    	<td colspan="4"><?php echo $user1['covered']?></textarea></td>
					    </tr>
					    <tr>
					    	<td colspan="2" class="text-center"><strong>Notes</strong></td>
					    	<td colspan="4"><?php echo $user1['notes']?></textarea></td>
					    </tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>