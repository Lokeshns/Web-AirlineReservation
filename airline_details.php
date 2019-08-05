<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Flight Details</title>
	<link rel="stylesheet" type="text/css" href="./airplane_details_css.css">
	<style>
	.flex-container {
		display: flex;
		flex-wrap: nowrap;
	}

	.flex-container > div {
		width: 150px;
		margin: 20px;
		text-align: center;
		line-height: 75px;
		font-size: 30px;
	}
</style>
	<script>
		function from_to_check(){
			if(document.getElementById("fffrom").value==document.getElementById("ffto").value){
				alert("TO CHANGE FROM OR TO");
			}
		}
		function dep_check(){
			var todaysDate = new Date();
			if(document.getElementById("ffddate").valueAsDate<todaysDate){
				alert("DEPARTURE DATE IS WRONG");
			}
		}
		function ret_check(){
			var todaysDate = document.getElementById("ffrdate").valueAsDate;
			if(document.getElementById("ffddate").valueAsDate>todaysDate){
				alert("RETURN DATE IS WRONG");
			}
		}
	</script>
</head>
<body>
<center style="margin-left:250px;">
	<form action="airline_details.php" method="POST">
		<a href="./airline_login.html" name="logout" style="text-decoration:none;padding: 8px 15px;width:100px;float:right;background-color: lightgrey;border-radius: 20px;border:2px solid white;cursor: pointer;margin-top:10px;"><i>Logout</i></a>
	</form>
		<h3 style="float:right;margin-right:30px;">Hello <?php echo $_SESSION['name']; ?></h3>
		<h2><i><b>Flight Details</b></i></h2>
<?php
if(isset($_POST['new_add'])){
	?>
<form name="f1" action="airline_details.php" method="POST">
<table>
<tr>
	<td><label for="fname"><b>Flight Name</b></label></td>
	<td><select name="fname">
		<option value="JetAirways">Jet Airways</option>
		<option value="AirIndia">Air India</option>
		<option value="IndiGO">IndiGO</option>
		<option value="SpiceJet">SpiceJet</option>
		<option value="JetLite">JetLite</option>
	</select></td>
</tr>
<tr>
	<td><label for="fno"><b>Flight Number</b></label></td>
	<td><input type="text" name="fno" required placeholder="Enter Flight Number..."></td>
</tr>
<tr>
	<td><label for="ffrom"><b>From</b></label></td>
	<td><select name="ffrom" id="fffrom">
		<option value="New Delhi (DEL)">New Delhi (DEL)</option>
		<option value="Mumbai (BOM)">Mumbai (BOM)</option>
		<option value="Bangalore (BLR)">Bangalore (BLR)</option>
		<option value="Chennai (MAA)">Chennai (MAA)</option>
		</select></td>
</tr>
<tr>
	<td><label for="fto"><b>TO<b></label></td>
	<td><select name="fto" id="ffto">
		<option value="New Delhi (DEL)">New Delhi (DEL)</option>
		<option value="Mumbai (BOM)">Mumbai (BOM)</option>
		<option value="Bangalore (BLR)">Bangalore (BLR)</option>
		<option value="Chennai (MAA)">Chennai (MAA)</option>
		</select></td>
</tr>
<tr>
	<td><label for="fddate"><b>Departure Date</b></label></td>
	<td><input type="date" id="ffddate" name="fddate"  onclick="from_to_check()"></td>
</tr>
<tr>
	<td><label for="frdate"><b>Return Date</b></label></td>
	<td><input type="date" id="ffrdate" name="frdate" onclick="dep_check()"></td>
</tr>
<tr>
	<td><label for="stime"><b>Starting Time</b></label></td>
	<td><input type="time" id="stime" name="stime" onclick="ret_check()"></td>
</tr>
<tr>
	<td><label for="etime"><b>End Time</b></label></td>
	<td><input type="time" id="etime" name="etime"></td>
</tr>
<tr>
	<td><label for="frdate"><b>Duration Time</b></label></td>
	<td><input type="number" id="ffdtime" name="fdtime"></td>
</tr>
<tr>
	<td><label for="seats"><b>Seats</b></label></td>
	<td><input type="number" name="seats"  placeholder="Enter no of seats..."></td>
</tr>
<tr>
	<td><label for="economycost"><b>Cost for Economy</b></label></td>
	<td><input type="number" name="economycost"  placeholder="Enter cost for Economy Class..."></td>
<tr>
<tr>
	<td><label for="businesscost"><b>Cost for Business</b></label></td>
	<td><input type="number" name="businesscost"  placeholder="Enter cost for Business Class..."></td>
<tr>
<tr>
	<td><label for="firstcost"><b>Cost for First Class</b></label></td>
	<td><input type="number" name="firstcost"  placeholder="Enter cost for First Class..."></td>
<tr>
<tr>
  <td><label for="status"><b>Gender</b></label></td>
  <td><input type="radio" name="status" value="good" style="margin-left:50px;" checked>Good</td>
  <td><input type="radio" name="status" value="bad">Bad</td>
</tr>
	<!--<td><td><br><button type="submit" name="delete_flight" style="width:150px;margin-left:-280px;background-color:red;">Delete Flight</button></td>
	<td><td><br><button type="submit" name="update_flight" style="width:150px;margin-left:-116px;background-color:blue;">Update Flight</button></td>-->
</table>
<br><button type="submit" name="add_flight" style="width:150px;margin-left:130px;">Add Flight</button>
</form>
<?php
}
if(isset($_POST['details'])){
	$fname= $_POST['fname'];
	$fno= $_POST['fno'];
	$ffrom= $_POST['ffrom'];
	$fto= $_POST['fto'];
	$sql= "SELECT *FROM flight WHERE fname='$fname' AND fno='$fno' AND ffrom='$ffrom' AND fto='$fto'";
	$result= mysqli_query($conn,$sql);
		
	if(mysqli_num_rows($result) > 0) {
		while($row=mysqli_fetch_assoc($result)){
			?>
<form action="airline_details.php" method="POST">
<div style='border:2px solid black;margin-left:-250px;margin-top:40px;'>
<h3 style='margin-left:40px;margin-top:50px;'>Flight Name<span style="margin-left:80px;">Flight Number</span><span style="margin-left:100px;">From</span><span style="margin-left:160px;">To</span><span style="margin-left:130px;">Departure Date</span><span style="margin-left:80px;">Return Date</span><span style="margin-left:100px;">Duration</span></h3>
<div class="flex-container" style="margin-left:65px;margin-top:-30px;">
  <div><input type='text' value="<?php echo $row['fname']; ?>"></div>
  <div><input type='text' value="<?php echo $row['fno']; ?>"></div>
  <div><input type='text' value="<?php echo $row['ffrom']; ?>"></div>  
  <div><input type='text' value="<?php echo $row['fto']; ?>"></div>
  <div><input type='date' value="<?php echo $row['fddate']; ?>"></div>
  <div><input type='date' value="<?php echo $row['frdate']; ?>"></div>  
  <div><input type='number' value="<?php echo $row['fdtime']; ?>"></div>  
</div>
<h3 style='margin-top:-5px;'>Departure Time<span style="margin-left:70px;">Reached Time</span><span style="margin-left:100px;">Seats</span><span style="margin-left:110px;">EconomyCost</span><span style="margin-left:80px;">BusinessCost</span><span style="margin-left:80px;">FirstClassCost</span><span style="margin-left:100px;">Status</span></h3>
<div class="flex-container" style="margin-left:65px;margin-top:-25px;">
  <div><input type='time' value="<?php echo $row['stime']; ?>"></div>
  <div><input type='time' value="<?php echo $row['etime']; ?>"></div>
  <div><input type='number' value="<?php echo $row['seats']; ?>"></div>
  <div><input type='number' value="<?php echo $row['economycost']; ?>"></div>
  <div><input type='number' value="<?php echo $row['businesscost']; ?>"></div>  
  <div><input type='number' value="<?php echo $row['firstcost']; ?>"></div>
  <div><input type='text' value="<?php echo $row['status']; ?>"></div>
</div>
<button type=submit" name="update_flight" 
</div>
</form>
<?php
		}
	}
}
?>
</center>
</body>
</html>

	
<?php
	if(isset($_POST['logout'])){
		session_destroy();
	}
	$error = array();
	if(isset($_POST['add_flight'])){
		$fname=$_POST['fname'];
		$fno=$_POST['fno'];
		$ffrom=$_POST['ffrom'];
		$fto=$_POST['fto'];
		$fddate=$_POST['fddate'];
		$frdate=$_POST['frdate'];
		$stime=$_POST['stime'];
		$etime=$_POST['etime'];
		$fdtime=$_POST['fdtime'];
		$seats=$_POST['seats'];
		$economycost=$_POST['economycost'];
		$businesscost=$_POST['businesscost'];
		$firstcost=$_POST['firstcost'];
		
		if(empty($fddate)){ array_push($error, "Departure Date is Empty"); }
		if(empty($frdate)){ array_push($error, "Return Date is Empty"); }
		if(empty($fdtime)){ array_push($error, "Flight Duration is Empty"); }
		if(empty($stime)){ array_push($error, "Flight staring is Empty"); }
		if(empty($etime)){ array_push($error, "Flight ending is Empty"); }
		if(empty($seats)){ array_push($error, "Flight Seat is Empty"); }
		if(empty($economycost)){ array_push($error, "EconomyCost is Empty"); }
		if(empty($businesscost)){ array_push($error, "BusinessCost is Empty"); }
		if(empty($firstcost)){ array_push($error, "FirstClassCost is Empty"); }
		
		
		
		$sql= "SELECT *FROM flight WHERE fname='$fname' OR fno='$fno'";
		$result= mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result) > 0) {
			while($user= mysqli_fetch_assoc($result)){
			if($user){
				
				if($user['fno'] === $fno){
					array_push($error, "Flight Number is already exits");
				}
				if($user['fname'] == $fname && $user['ffrom'] == $ffrom && $user['fto'] == $fto && $user['fddate'] == $fddate && $user['frdate'] == $frdate && $user['stime'] == $stime && $user['etime'] == $etime){
					array_push($error, "Flight is already exits");
				}
				if($user['ffrom'] == $ffrom && $user['fto'] == $fto && $user['fddate'] == $fddate && $user['frdate'] == $frdate && $user['stime'] == $stime && $user['etime'] == $etime){
					array_push($error, "Flight is already exits");
				}
			}
			}
		}
		
		include('errors.php');
		if (empty($error)) {
			$query= "INSERT INTO flight(fname,fno,ffrom,fto,fddate,frdate,stime,etime,fdtime,seats,economycost,businesscost,firstcost) VALUES ('$fname','$fno','$ffrom','$fto','$fddate','$frdate','$stime','$etime','$fdtime','$seats','$economycost','$businesscost','$firstcost')";
			if ($conn->query($query) === TRUE){
				header('location: airline_main.html');
			}
		}
		else{
			echo "<script>alert('ERROR OCCUR,PLEASE SEE ERRORS IN BOTTOM');</script>";
		}
	}
	if(isset($_POST['delete_flight'])){
		$fname=$_POST['fname'];
		$fno=$_POST['fno'];
		
		$sql= "SELECT *FROM flight WHERE fname='$fname' AND fno='$fno'";
		$result= mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result) > 0) {
			while($user= mysqli_fetch_assoc($result)){
				$query= "DELETE FROM flight WHERE fname='$fname' AND fno='$fno'";
				if ($conn->query($query) === TRUE){
					header('location: airline_main.html');
				}
			}
		}
	}
	if(isset($_POST['update_flight'])){
		$fname=$_POST['fname'];
		$fno=$_POST['fno'];
		$ffrom=$_POST['ffrom'];
		$fto=$_POST['fto'];
		$fddate=$_POST['fddate'];
		$frdate=$_POST['frdate'];
		$stime=$_POST['stime'];
		$etime=$_POST['etime'];
		$fdtime=$_POST['fdtime'];
		$seats=$_POST['seats'];
		$economycost=$_POST['economycost'];
		$businesscost=$_POST['businesscost'];
		$firstcost=$_POST['firstcost'];
		
		if(empty($fddate)){ array_push($error, "Departure Date is Empty"); }
		if(empty($frdate)){ array_push($error, "Return Date is Empty"); }
		if(empty($fdtime)){ array_push($error, "Flight Duration is Empty"); }
		if(empty($stime)){ array_push($error, "Flight staring is Empty"); }
		if(empty($etime)){ array_push($error, "Flight ending is Empty"); }
		if(empty($seats)){ array_push($error, "Flight Seat is Empty"); }
		if(empty($economycost)){ array_push($error, "EconomyCost is Empty"); }
		if(empty($businesscost)){ array_push($error, "BusinessCost is Empty"); }
		if(empty($firstcost)){ array_push($error, "FirstClassCost is Empty"); }
		
		include('errors.php');
		if (empty($error)) {
			$query= "UPDATE flight SET fname='$fname',fno='$fno',ffrom='$ffrom',fto='$fto',fddate='$fddate',frdate='$frdate',stime='$stime',etime='$etime',fdtime='$fdtime',seats='$seats',economycost='$economycost',businesscost='$businesscost',firstcost='$firstcost' WHERE fname='$fname' AND fno='$fno'";
			if ($conn->query($query) === TRUE){
				header('location: airline_main.html');
			}
		}
		else{
			echo "<script>alert('ERROR OCCUR,PLEASE SEE ERRORS IN BOTTOM');</script>";
		}
	}
?>