<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticket</title>
</head>
<body>
<form action="airline_add_amount.php" method="POST">
<button name="logout" style="margin-left:90%;"><a style='text-decoration:none;padding: 8px 15px;width:100px;float:right;background-color: lightgrey;border-radius: 20px;border:2px solid white;cursor: pointer;'><i>Logout</i></a></button>
<h3 style='float:right;margin-right:180px;margin-top:-30px;'>Hello <?php echo $_SESSION['name']; ?></h3>
</form>
<h1>Paid Successfully...</h1>
</body>
<?php
if(isset($_POST['logout']) || isset($_POST['logout1'])){
		session_destroy();
		if(isset($_POST['logout1'])){
			header("location: airline_home.html");	
		}
		else{
			header("location: airline_login.html");
		}
	}
if(isset($_POST['pay'])){
		$accnum= $_POST['accnum'];
		$expdate= $_POST['expdate'];
		$cvv = $_POST['cvv'];
		$amount = $_POST['total'];
		$fno= $_POST['fno'];
		$fclass= $_POST['fclass'];
		$fname= $_POST['fname'];
		$ffrom= $_POST['ffrom'];
		$fto= $_POST['fto'];
		$seats = $_POST['seats'];
		$total = $_POST['total'];
		$date = $_POST['t_date'];
		/*echo "<input type='hidden' value='$fno' name='fno'>";
		echo "<input type='hidden' value='$ffrom' name='ffrom'>";
		echo "<input type='hidden' value='$fto' name='fto'>";
		echo "<input type='hidden' value='$seats' name='seats'>";
		echo "<input type='hidden' value='$total' name='total'>";
		*/
		$query= "INSERT INTO account(name,acc_num,exp_date,cvv,amount,date) VALUES ('$_SESSION[name]','$accnum','$expdate','$cvv','$amount','$date')";
		$result= mysqli_query($conn,$query);
		
		$sql= "SELECT *FROM flight WHERE fno='$fno' AND ffrom='$ffrom' AND fto='$fto'";
		$result= mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result) > 0) {
			$row= mysqli_fetch_assoc($result);
				$row['seats']-=$seats;
				$temp=$row['seats'];
		}
		$query= "UPDATE flight SET seats='$row[seats]' WHERE fno='$fno' AND ffrom='$ffrom' AND fto='$fto'";
		$result= mysqli_query($conn,$query);
		?>
		<div style='margin-left:600px;'>
			<div>
				<h4>Flight Name	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fname; ?></h4>
			</div>
			<div>
				<h4>Flight Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fno; ?></h4>
			</div>
			<div>
				<h4>Boarding &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ffrom; echo '<--to-->'; echo $fto; ?></h4>
			</div>
			<div>
				<h4>Seat Class &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fclass; ?></h4>
			</div>
			<div>
				<h4>Passengers And Seat Number</h4>
			</div>
			<div>
				<h4><?php	
					$sql= "SELECT *FROM flight_passenger WHERE u_name='$_SESSION[name]' AND date='$date'";
					$result= mysqli_query($conn,$sql);
		
					if(mysqli_num_rows($result) > 0) {
						$i=1;
						while($row= mysqli_fetch_assoc($result)){							
							echo '<h4 style="text-indent:50px;">'; echo $row['p_name']; echo " <<<-------->>> "; echo $temp+$i; echo '</h4>';
							$i++;
						}
					}
					?>
			</div>
		</div>
		<form action="airline_ticket.php" method="POST">
		<button name="logout1" style="margin-left:45%;margin-top:150px;padding:10px;background-color:green;border-radius:50px;width:250px;"><a><i>Click Here With Final Touch</i></a></button>
		</form>
		<?php
	}
?>