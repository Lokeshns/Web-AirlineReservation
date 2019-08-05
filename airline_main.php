<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Flight Reservation</title>
	<link rel="stylesheet" type="text/css" href="./airline_main_css.css">
	<script>
		function oneway(){
			if(document.getElementById("wone").checked==true){
				document.getElementById("rrdate").disabled=true;
			}
		}
		function twoway(){
			if(document.getElementById("wtwo").checked==true){
				document.getElementById("rrdate").disabled=false;
			}
		}
		function from_to_check(){
			if(document.getElementById("gfrom").value==document.getElementById("gto").value){
				alert("TO CHANGE FROM OR TO");
			}
		}
		function dep_check(){
			var todaysDate = new Date();
			if(document.getElementById("dddate").valueAsDate<todaysDate){
				alert("DEPARTURE DATE IS WRONG");
			}
		}
		function ret_check(){
			var todaysDate = document.getElementById("rrdate").valueAsDate;
			if(document.getElementById("wtwo").checked==true){
			if(document.getElementById("dddate").valueAsDate>todaysDate){
				alert("RETURN DATE IS WRONG");
			}
			}
		}
	</script>
</head>
<body style="margin-top:60px;">
<nav>
<table>
<form action="airline_main.php" method="POST">
<tr>
	<td><a href="airline_home.html" style="text-decoration:none; margin-left:10px;" ><img src='./images/flight-icon.png' style='width:100px;height:100px;'><h2 style="margin-top:-60px;"><i>Flight Ticket Reservation</a></i></h2></td>
	<td><h2 style="margin-left:250px;">Hello <?php echo $_SESSION['name']; ?></h2></td>
	<td><a><button name="logout" style="margin-left:-50px;"><i>Logout</i></button></a></td>
</tr>
</form>
</table>
</nav>
<content>
<div>
<table>
<form action="airline_search.php" method="POST">
<tr>
	<td><label for="from" style="border:none;"><b>FROM</b></label></td>
	<td><select name="from" id="gfrom">
		<option value="New Delhi (DEL)">New Delhi (DEL)</option>
		<option value="Mumbai (BOM)">Mumbai (BOM)</option>
		<option value="Bangalore (BLR)">Bangalore (BLR)</option>
		<option value="Chennai (MAA)">Chennai (MAA)</option>
		</select></td>
</tr>
<tr>
	<td><label for="to" style="border:none;"><b>TO<b></label></td>
	<td><select name="to" id="gto">
		<option value="New Delhi (DEL)">New Delhi (DEL)</option>
		<option value="Mumbai (BOM)">Mumbai (BOM)</option>
		<option value="Bangalore (BLR)">Bangalore (BLR)</option>
		<option value="Chennai (MAA)">Chennai (MAA)</option>
		</select></td>
</tr>
<tr>
	<td><label for="ddate" style="border:none;"><b>DEPARTURE DATE</b></label></td>
	<td><input type="date" name="ddate" required id="dddate" onclick="from_to_check()"></td>
</tr>
<tr>
	<td><label for="rdate" style="border:none;"><b>RETURN DATE</b></label></td>
	<td><input type="date" name="rdate" required id="rrdate" onclick="dep_check()"></td>
</tr>
<tr>
	<td><br><label for="rount" style="border:none;"></label></td>
	<td><input type="radio" name="rount" value="oneway" style="margin-left: -150px;" onclick="oneway()" id="wone"><b>ONE WAY</b></td>
	<td><input type="radio" name="rount" value="round" style="margin-left: -350px;" checked onclick="twoway()" id="wtwo"><b>ROUND</b></td>
</tr>
<tr>
	<td><select name="seats" style="width:150px; margin-left: 250px;" onclick="ret_check()">
		<option value="" selected disabled hidden>Select Seats</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		</select></td>
		
	<td><select name="fclass"style="width:150px; margin-left:90px;">
		<option value="" selected disabled hidden>Select Class</option>
		<option value="Economy">Economy</option>
		<option value="Business">Business</option>
		<option value="First Class">First Class</option>
		</select></td>
</tr>
<tr>
	<td><br><button type="submit" name="search" id="s1" onclick="datecheck()">Search Flight</button></td>
</tr>
</form>
</table>
<br><br>
</div>
</content>
</body>
</html>


<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header("location: airline_login.html");
	}
?>