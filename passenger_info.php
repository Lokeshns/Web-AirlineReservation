<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Passenger Info</title>
	<link rel="stylesheet" type="text/css" href="./passenger_info_css.css">
</head>
<body>
<center>
<h2>Passenger Information</h2>
</center>
<form action="passenger_info.php" method="POST">
<button name="logout" style="margin-left:90%;"><a style='text-decoration:none;padding: 8px 15px;width:100px;float:right;background-color: lightgrey;border-radius: 20px;border:2px solid white;cursor: pointer;'><i>Logout</i></a></button>
<h3 style='float:right;margin-right:180px;margin-top:-30px;'>Hello <?php echo $_SESSION['name']; ?></h3>
</form>

<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header("location: airline_login.html");
	}
	if(isset($_POST['insert'])){
		$fno= $_POST['fno'];
		$fclass= $_POST['fclass'];
		$fname= $_POST['fname'];
		$ffrom= $_POST['ffrom'];
		$fto= $_POST['fto'];
		$total= $_POST['total'];
		$seats= $_POST['seats'];
	for($i=0;$i<$seats;$i++){
	echo '<form action="airline_payment.php" method="POST">';
	 echo '<table>';
	 echo "<div><h2>PASSENGER"; echo $i+1; echo "</h2></div>";
	 echo '<tr>';
		 echo '<td>'; echo '<label for="name[]">'; echo '<b>'; echo 'Name'; echo '</b></label></td>';
		 echo '<td>'; echo '<input type="text" name="name[]" required placeholder="Enter Passenger Name...">'; echo '</td>';
	 echo '</tr>';
	 echo '<tr>';
		 echo '<td><label for="age[]"><b>';echo 'Age'; echo '</b></label></td>';
		 echo '<td><input type="number" max="80" name="age[]" required placeholder="Enter Passenger Age..."></td>';
	 echo '</tr>';
	 echo '<tr>';
		 echo '<td><label for="image_upload[]"><b>';echo 'Passport Size Photo'; echo '</b></label></td>';
		 echo '<td><input type="file" name="image_upload[]" onclick="fun()" placeholder="Tap"></td>';
	 echo '</tr>';
	 echo '<tr>';
		echo '<td><label for="passport_number[]"><b>'; echo 'Passport Number'; echo '</b></label></td>';
		 echo '<td><input type="text" name="passport_number[]" placeholder="Enter Passport Number..."></td><td><span style="margin-left:50px;color:red;">'; echo '*Optional'; echo '</span></td>';
	 echo '</tr>';
	 echo '<tr>';
		 echo '<td><label for="aadhar[]"><b>'; echo 'Aadhar Card'; echo '</b></label></td>';
		 echo '<td><input type="number" name="aadhar[]" required placeholder="Enter Aadhar Number..."></td>';
	 echo '</tr>';
	 echo '<tr>';
		 echo '<td><label for="pan_card[]"><b>'; echo 'Pan Card'; echo '</b></label></td>';
		 echo '<td><input type="text" name="pan_card[]" required placeholder="Enter Pan Card Number..."></td>';
	 echo '</tr>';
	 echo '<tr>';
		 echo '<td><label for="voter_id[]"><b>'; echo 'Voter ID'; echo '</b></label></td>';
		 echo '<td><input type="text" name="voter_id[]" placeholder="Enter Voter ID..."></td><td><span style="margin-left:50px;color:red;">'; echo '*Optional'; echo '</span></td>';
	 echo '</tr>';
	 echo '<tr>';
		 echo '<td><label for="drive_lice[]"><b>'; echo 'Driving license'; echo '</b></label></td>';
		 echo '<td><input type="text" name="drive_lice[]" placeholder="Enter Driving License..."></td><td><span style="margin-left:50px;color:red;">'; echo '*Optional'; echo '</span></td>';
	 echo '</tr>';
	 echo '<tr>';
	}
	echo "<input type='hidden' value='$fno' name='fno'>";
	echo "<input type='hidden' value='$fclass' name='fclass'>";
	echo "<input type='hidden' value='$fname' name='fname'>";
	echo "<input type='hidden' value='$ffrom' name='ffrom'>";
    echo "<input type='hidden' value='$fto' name='fto'>";
	echo "<input type='hidden' value='$seats' name='seats'>";
	echo "<input type='hidden' value='$total' name='total'>";?>
	<input type="hidden" name="t_date" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
	<?php
		echo '<td><button name="book" type="submit" style="width:0px;height0px;background-color:white;border:2px solid white;">'; echo '<img src="./images/flight-icon1.png" style="width:100px;height:100px;float:right;margin-right:-650px;">'; echo '</a></button></td>';
	 echo '</tr>';
	echo '</table>';
	echo '</form>';
	}
?>

</body>
</html>
