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

    $qry = "SELECT * FROM subject WHERE email = '$email' AND day = 'Mon' ORDER BY start_time DESC;";
    $res = $mysqli->query($qry) or die(error.__LINE__);
	$cnt = mysqli_num_rows($res);

	$qry1 = "SELECT * FROM subject WHERE email = '$email' AND day = 'Tue' ORDER BY start_time DESC;";
    $res1 = $mysqli->query($qry1) or die(error.__LINE__);
	$cnt1 = mysqli_num_rows($res1);

	$qry2 = "SELECT * FROM subject WHERE email = '$email' AND day = 'Wed' ORDER BY start_time DESC;";
    $res2 = $mysqli->query($qry2) or die(error.__LINE__);
	$cnt2 = mysqli_num_rows($res2);

	$qry3 = "SELECT * FROM subject WHERE email = '$email' AND day = 'Thu' ORDER BY start_time DESC;";
    $res3 = $mysqli->query($qry3) or die(error.__LINE__);
	$cnt3 = mysqli_num_rows($res3);

	$qry4 = "SELECT * FROM subject WHERE email = '$email' AND day = 'Fri' ORDER BY start_time DESC;";
    $res4 = $mysqli->query($qry4) or die(error.__LINE__);
	$cnt4 = mysqli_num_rows($res4);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Faculty Routine</title>
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
		      <a class="nav-link active" href="routine.php">My Routine</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="set_routine.php">Set Routine</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="viewreport.php">View My Report</a>
		    </li>
		</ul><br>

		<div class="row p-4">
			<table class="table table-bordered">
			    <tr>
			    	<td colspan="6" class="text-center bg-light"><strong>Monday</strong></td>
			    </tr>
			    <tr>
			    	<td class="text-center"><strong>Semester</strong></td>
			    	<td class="text-center"><strong>Subject Name</strong></td>
			    	<td class="text-center"><strong>Room Number</strong></td>
			    	<td class="text-center"><strong>Timing</strong></td>
			    	<td class="text-center"><strong>Write Report</strong></td>
			    </tr>
			    <tr>
			    	<?php
				      for($i=0;$i<$cnt;$i=$i+1)
				      {
				        $row = $res->fetch_assoc();
				        ?>
				      <tr>
				        <td class="text-center"><?php echo $row['sem'] ?></td>
				        <td class="text-center"><?php echo $row['name'] ?></td>
				        <td class="text-center"><?php echo $row['room_no'] ?></td>
				        <td class="text-center"><?php echo $row['start_time'] ?> - <?php echo $row['end_time'] ?></td>
				        <td class="text-center"><a href="report.php?id=<?php echo $row['id'] ?>"</a>Write Report</td>


				      </tr>
				      <?php
				        }
				    ?>
			    </tr>
			</table>
		</div>

		<div class="row p-4">
			<table class="table table-bordered">
			    <tr>
			    	<td colspan="6" class="text-center bg-light"><strong>Tuesday</strong></td>
			    </tr>
			    <tr>
			    	<td class="text-center"><strong>Semester</strong></td>
			    	<td class="text-center"><strong>Subject Name</strong></td>
			    	<td class="text-center"><strong>Room Number</strong></td>
			    	<td class="text-center"><strong>Timing</strong></td>
			    	<td class="text-center"><strong>Write Report</strong></td>
			    </tr>
			    <tr>
			    	<?php
				      for($i=0;$i<$cnt1;$i=$i+1)
				      {
				        $row1 = $res1->fetch_assoc();
				        ?>
				      <tr>
				        <td class="text-center"><?php echo $row1['sem'] ?></td>
				        <td class="text-center"><?php echo $row1['name'] ?></td>
				        <td class="text-center"><?php echo $row1['room_no'] ?></td>
				        <td class="text-center"><?php echo $row1['start_time'] ?> - <?php echo $row1['end_time'] ?></td>
				        <td class="text-center"><a href="report.php?id=<?php echo $row1['id'] ?>"</a>Write Report</td>


				      </tr>
				      <?php
				        }
				    ?>
			    </tr>
			</table>
		</div>

		<div class="row p-4">
			<table class="table table-bordered">
			    <tr>
			    	<td colspan="6" class="text-center bg-light"><strong>Wednesday</strong></td>
			    </tr>
			    <tr>
			    	<td class="text-center"><strong>Semester</strong></td>
			    	<td class="text-center"><strong>Subject Name</strong></td>
			    	<td class="text-center"><strong>Room Number</strong></td>
			    	<td class="text-center"><strong>Timing</strong></td>
			    	<td class="text-center"><strong>Write Report</strong></td>
			    </tr>
			    <tr>
			    	<?php
				      for($i=0;$i<$cnt2;$i=$i+1)
				      {
				        $row2 = $res2->fetch_assoc();
				        ?>
				      <tr>
				        <td class="text-center"><?php echo $row2['sem'] ?></td>
				        <td class="text-center"><?php echo $row2['name'] ?></td>
				        <td class="text-center"><?php echo $row2['room_no'] ?></td>
				        <td class="text-center"><?php echo $row2['start_time'] ?> - <?php echo $row2['end_time'] ?></td>
				        <td class="text-center"><a href="report.php?id=<?php echo $row2['id'] ?>"</a>Write Report</td>


				      </tr>
				      <?php
				        }
				    ?>
			    </tr>
			</table>
		</div>

		<div class="row p-4">
			<table class="table table-bordered">
			    <tr>
			    	<td colspan="6" class="text-center bg-light"><strong>Thrusday</strong></td>
			    </tr>
			    <tr>
			    	<td class="text-center"><strong>Semester</strong></td>
			    	<td class="text-center"><strong>Subject Name</strong></td>
			    	<td class="text-center"><strong>Room Number</strong></td>
			    	<td class="text-center"><strong>Timing</strong></td>
			    	<td class="text-center"><strong>Write Report</strong></td>
			    </tr>
			    <tr>
			    	<?php
				      for($i=0;$i<$cnt3;$i=$i+1)
				      {
				        $row3 = $res3->fetch_assoc();
				        ?>
				      <tr>
				        <td class="text-center"><?php echo $row3['sem'] ?></td>
				        <td class="text-center"><?php echo $row3['name'] ?></td>
				        <td class="text-center"><?php echo $row3['room_no'] ?></td>
				        <td class="text-center"><?php echo $row3['start_time'] ?> - <?php echo $row3['end_time'] ?></td>
				        <td class="text-center"><a href="report.php?id=<?php echo $row3['id'] ?>"</a>Write Report</td>


				      </tr>
				      <?php
				        }
				    ?>
			    </tr>
			</table>
		</div>

		<div class="row p-4">
			<table class="table table-bordered">
			    <tr>
			    	<td colspan="6" class="text-center bg-light"><strong>Friday</strong></td>
			    </tr>
			    <tr>
			    	<td class="text-center"><strong>Semester</strong></td>
			    	<td class="text-center"><strong>Subject Name</strong></td>
			    	<td class="text-center"><strong>Room Number</strong></td>
			    	<td class="text-center"><strong>Timing</strong></td>
			    	<td class="text-center"><strong>Write Report</strong></td>
			    </tr>
			    <tr>
			    	<?php
				      for($i=0;$i<$cnt4;$i=$i+1)
				      {
				        $row4 = $res4->fetch_assoc();
				        ?>
				      <tr>
				        <td class="text-center"><?php echo $row4['sem'] ?></td>
				        <td class="text-center"><?php echo $row4['name'] ?></td>
				        <td class="text-center"><?php echo $row4['room_no'] ?></td>
				        <td class="text-center"><?php echo $row4['start_time'] ?> - <?php echo $row4['end_time'] ?></td>
				        <td class="text-center"><a href="report.php?id=<?php echo $row4['id'] ?>"</a>Write Report</td>


				      </tr>
				      <?php
				        }
				    ?>
			    </tr>
			</table>
		</div>


	</div>
</body>
</html>