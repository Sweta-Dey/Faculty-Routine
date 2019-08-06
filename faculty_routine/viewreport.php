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

	$qry1 = $mysqli->query("SELECT * from report WHERE email = '$email'");
	$cnt = mysqli_num_rows($qry1);

?>
<!DOCTYPE html>
<html>
<head>
	<title>View Report</title>
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
		      <a class="nav-link active" href="viewreport.php">View My Report</a>
		</ul><br>

		
		<div class="row">
			<div class="col-md-12">
					<table class="table table-bordered">
					    <tr>
					    	<td class="text-center"><strong>Subject</strong></td>
					    	<td class="text-center"><strong>Date</strong></td>
					    	<td class="text-center"><strong>View Full Report</strong></td>
					    </tr>
					    <tr>
					    	<?php
						      for($i=0;$i<$cnt;$i=$i+1)
						      {
						        $row = $qry1->fetch_assoc();
						        ?>
						      <tr>
						        <td class="text-center"><?php echo $row['code'] ?></td>
						        <td class="text-center"><?php echo $row['date'] ?></td>
						        <td class="text-center"><a href="fullreport.php?id=<?php echo $row['id'] ?>">View Full Report</a></td>
						      </tr>
						      <?php
						        }
						    ?>
					    </tr>
					</table>
			</div>
		</div>
	</div>
</body>
</html>