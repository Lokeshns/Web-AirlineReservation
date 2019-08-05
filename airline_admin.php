<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<style>
		input[type=text],input[type=date],select,input[type=time],input[type=number]{
			width: 100%;
			padding: 10px;
			margin: 15px 50px;
			box-sizing: border-box;
			border-color: 2px solid black;
		}
	</style>
	<script>
		function req(){
			document.getElementById("fno").required = true;
			if(document.getElementById("fffrom").value==document.getElementById("ffto").value){
				alert("TO CHANGE FROM OR TO");
			}
		}
	</script>
</head>
<body>
<form action="airline_admin.php" method="POST">
	<button name="logout" style="margin-left:90%;"><a style='text-decoration:none;padding: 8px 15px;width:100px;float:right;border-radius: 20px;border:2px solid white;cursor: pointer;'><i>Logout</i></a></button>
	<h3 style='float:right;margin-right:180px;margin-top:-30px;'>Hello <?php echo $_SESSION['name']; ?></h3>
</form>
<h2>Add a new flight,Don't need to fill this fields</h2>
<form action="airline_details.php" method="POST">
<table style='margin-left:550px;margin-top:120px;'>
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
	<td><input type="text" id="fno" name="fno" placeholder="Enter Flight Number..."></td>
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
</table>
	<td><div><button type="submit" onclick="req()" name="details" style="cursor:pointer;width:200px;margin-left:520px;margin-top:80px;padding:10px;border:2px solid black;border-radius:10px;background-color:silver;">Flight Details</button></div><br></td>
	<td><div style="margin-top:-50px;"><br><button type="submit" name="new_add" style="cursor:pointer;width:200px;margin-left:850px;padding:10px;border:2px solid black;border-radius:10px;background-color:silver;">New Flight Add</button></div></td>
</form>
</body>
<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header("location: airline_login.html");
	}
?>