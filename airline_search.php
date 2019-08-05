<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Flight Search</title>
	<link rel="stylesheet" type="text/css" href="./airline_search_css.css">
	<script>
	</script>
</head>
<body>
<form action="airline_search.php" method="POST">
<button name="logout" style="margin-left:90%;"><a style='text-decoration:none;padding: 8px 15px;width:100px;float:right;background-color: lightgrey;border-radius: 20px;border:2px solid white;cursor: pointer;'><i>Logout</i></a></button>
<h3 style='float:right;margin-right:180px;margin-top:-30px;'>Hello <?php echo $_SESSION['name']; ?></h3>
</form>
<p></p>
<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header("location: airline_login.html");
	}
	if(isset($_POST['search'])) {
		
		$ffrom=$_POST['from'];
		$fto=$_POST['to'];
		$fddate=$_POST['ddate'];
		$frdate=$_POST['rdate'];
		$fclass=$_POST['fclass'];
		$seats=$_POST['seats'];
		
		$sql= "SELECT *FROM flight WHERE ffrom='$ffrom' AND fto='$fto' AND fddate='$fddate' AND frdate='$frdate'";
		$result= mysqli_query($conn,$sql);
		$temp = mysqli_num_rows($result);
		$count = $temp;
		if($temp > 0) {
			while($row= mysqli_fetch_assoc($result)){
			if($row['seats']>=$seats){
				$count--;
				echo "<form action='passenger_info.php' method='POST'>";
				echo "<div id='allpart'>";
				echo "<div>";
					if($row['fname'] == 'JetAirways'){
						echo "<img src='./images/jetairwayslogo.jpg' style='width:100px;height:100px;'>";
					}
					else if($row['fname'] == 'AirIndia'){
						echo "<img src='./images/airIndialogo.jpg' style='width:100px;height:100px;'>";
					}
					else if($row['fname'] == 'IndiGO'){
						echo "<img src='./images/indigologo.jpg' style='width:100px;height:100px;'>";
					}
					else if($row['fname'] == 'SpiceJet'){
						echo "<img src='./images/spicejetlogo.png' style='width:100px;height:100px;'>";
					}
					else if($row['fname'] == 'JetLite'){
						echo "<img src='./images/jetlitelogo.jpg' style='width:100px;height:100px;'>";
					}
					echo "<h3 style='margin-left:130px;margin-top:-65px;'>";
						echo "$row[fname]"; echo " | "; echo "$row[fno]";
					echo "</h3>";
				echo "</div>";
				echo "<div style='margin-left:20%;margin-right:20%;'>";
					echo "<h4 style='margin-top: 60px;'>";
						echo "$row[fddate]";
						echo "<span style='margin-left:355px;'>";
							echo "$row[frdate]";
						echo "</span>";
					echo "</h4>";
				echo "</div>";
				echo "<div>";
					echo "<img src='./images/aviation.png' style='margin-left:32%;margin-top:-77px;width:300px;height:150px;'>";
				echo "</div>";
				echo "<div style='margin-left:18%;'>";
					echo "<h4 style='margin-top: -40px;'>";
						echo "$row[ffrom]";
						echo "<span style='margin-left:310px;'>";
							echo "$row[fto]";
						echo "</span>";
					echo "</h4>";
				echo "</div>";
				echo "<div>";
					echo "<h4 style='margin-left:37%;'>";
						echo "Travelling Duration : ";
						echo "<b>"; echo "$row[fdtime]"; echo "</b>";
						echo " Hours";
					echo "</h4>";
				echo "</div>";
				echo "<div>";
					echo "<h4 style='margin-left:34%;'>";
						echo "Travelling Time : ";
						echo "<b>"; echo "$row[stime] "; echo " to "; echo "$row[etime]";echo "</b>";
					echo "</h4>";
				echo "</div>";
				echo "<div>";
					echo "<h3>";
						echo "Fare Details";
					echo "</h3>";
					echo "<hr>";
					echo "<h4 style='margin-left:100px;'>";
						echo "No of Passenger";
						echo "<span style='margin-left:30px;'>";
							echo "$fclass";
							echo " Class per passenger";
						echo "</span>";
						echo "<span style='margin-left:30px;'>";
							echo "Total Money";
						echo "</span>";
					echo "</h4>";
				echo "</div>";
				echo "<div>";
				  echo "<h3>";
					echo "<span style='margin-left:153px;'>"; echo "$seats"; echo "</span>";
					if($fclass == 'Economy'){
						echo "<span style='margin-left:153px;'>"; echo "$row[economycost]"; echo "</span>";
						$total = $row['economycost'] * $seats;
					}
					else if($fclass == 'Business'){
						echo "<span style='margin-left:153px;'>"; echo "$row[businesscost]"; echo "</span>";
						$total = $row['businesscost'] * $seats;
					}
					else{
						echo "<span style='margin-left:153px;'>"; echo "$row[firstcost]"; echo "</span>";
						$total = $row['firstcost'] * $seats;
					}
					echo "<span style='margin-left:139px;'>"; echo "$total"; echo "</span>";
				  echo "</h3>";
				  echo "<input type='hidden' value='$row[fno]' name='fno'>";
				  echo "<input type='hidden' value='$fclass' name='fclass'>";
				  echo "<input type='hidden' value='$row[fname]' name='fname'>";
				  echo "<input type='hidden' value='$row[ffrom]' name='ffrom'>";
		          echo "<input type='hidden' value='$row[fto]' name='fto'>";
				  echo "<input type='hidden' value='$seats' name='seats'>";
				  echo "<input type='hidden' value='$total' name='total'>";
				  
					echo "<button type='submit' name='insert' style='width:0px;height0px;background-color:white;border:2px solid white;margin-left:800px;'><a href='./passenger_info.php' title='Book'><img src='./images/btn.png' style='width:100px;height:100px;float:right;margin-right:10px;margin-top:-80px;'></a></button>";
				echo "</div>";
				echo "</div>";
				echo "</form>";
			}
		}
		}
		else{
			?><h2>Flights are not available</h2><?php
			$flag=1;
		}
		if($temp==$count && $flag!=1){
			?><h2>Flight seats are not available</h2><?php
		}
	}
?>
</body>
</html>