<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>PAYMENT</title>
	<style>
		input[type=text],input[type=number],label,input[type=date]{
			width: 100%;
			padding: 10px;
			margin: auto;
			box-sizing: border-box;
			margin-left:300px;
			margin-top: 10px;
		}
	</style>
</head>
<body>
<form action="airline_payment.php" method="POST">
<button name="logout" style="margin-left:90%;"><a style='text-decoration:none;padding: 8px 15px;width:100px;float:right;background-color: lightgrey;border-radius: 20px;border:2px solid white;cursor: pointer;'><i>Logout</i></a></button>
<h3 style='float:right;margin-right:180px;margin-top:-30px;'>Hello <?php echo $_SESSION['name']; ?></h3>
</form>
<h1>PAYMENT</h1>
</body>
<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header("location: airline_login.html");
	}
	if(isset($_POST['book'])){
		$fno= $_POST['fno'];
		$fclass= $_POST['fclass'];
		$fname= $_POST['fname'];
		$ffrom= $_POST['ffrom'];
		$fto= $_POST['fto'];
		$seats = $_POST['seats'];
		$total = $_POST['total'];
		$date = $_POST['t_date'];
		$p_name=  (array) $_POST['name'];
		$p_age=  (array) $_POST['age'];
		$p_photo=  (array) $_POST['image_upload'];
		$p_passport_number=  (array) $_POST['passport_number'];
		$p_aadhar_card=  (array) $_POST['aadhar'];
		$p_pan_card=  (array) $_POST['pan_card'];
		$p_voter_id=  (array) $_POST['voter_id'];
		$p_drive_license=  (array) $_POST['drive_lice'];
		
		$sql= "SELECT *FROM reg_log_user WHERE name='$_SESSION[name]'";
		$result= mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result) > 0) {
			while($row= mysqli_fetch_assoc($result)){
			if($row){
				$u_name= $row['name'];
				$u_email= $row['email'];
				$u_phone= $row['phone'];
			}
		  }
		}
		
			
			for($num=0;$num<$seats;$num++){
			$p_name[$num]= $p_name[$num];
			$p_age[$num]= $p_age[$num];
			$p_photo[$num]= $p_photo[$num];
			$p_passport_number[$num]= $p_passport_number[$num];
			$p_aadhar_card[$num]= $p_aadhar_card[$num];
			$p_pan_card[$num]= $p_pan_card[$num];
			$p_voter_id[$num]= $p_voter_id[$num];
			$p_drive_license[$num]= $p_drive_license[$num];
			$query= "INSERT INTO flight_passenger(p_name,p_age,p_photo,p_passport_number,p_aadhar_card,p_pan_card,p_voter_id,p_drive_license,u_name,u_email,u_phone,date) VALUES ('$p_name[$num]','$p_age[$num]','$p_photo[$num]','$p_passport_number[$num]','$p_aadhar_card[$num]','$p_pan_card[$num]','$p_voter_id[$num]','$p_drive_license[$num]','$u_name','$u_email','$u_phone','$date')";
			$result= mysqli_query($conn,$query);
			}
			echo '<form action="airline_ticket.php" method="POST">';
		echo '<table style="margin-top:150px;">';
		echo '<tr>';
			echo '<td><label for="accnum" style="border:none;"><b>Account Number</b></label></td>';
			echo '<td><input type="text" name="accnum" required></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td><label for="expdate" style="border:none;"><b>Expire Date</b></label></td>';
			echo '<td><input type="date" name="expdate" required ></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td><label for="cvv" style="border:none;"><b>CVV</b></label></td>';
			echo '<td><input type="number" name="cvv" required></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td><label for="amount" style="border:none;"><b>Amount</b></label></td>';?>
			<td><input type="number" name="amount" required value="<?php echo $total; ?>" id="amount"></td><?php
		echo '</tr>';
		echo "<input type='hidden' value='$fno' name='fno'>";
		echo "<input type='hidden' value='$fclass' name='fclass'>";
		echo "<input type='hidden' value='$fname' name='fname'>";
		echo "<input type='hidden' value='$ffrom' name='ffrom'>";
		echo "<input type='hidden' value='$fto' name='fto'>";
		echo "<input type='hidden' value='$seats' name='seats'>";
		echo "<input type='hidden' value='$total' name='total'>";?>
		<input type="hidden" name="t_date" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
		<?php
		echo '</table>';
		echo '<div>';
			echo '<button type="submit" name="pay" style="width:150px;padding:10px;margin-left:1080px;margin-top:100px;">Pay</button>';
		echo '</div>';
	echo '</form>';
	}/*
	if(isset($_POST['add'])){
		$accnum= $_POST['accnum'];
		$expdate= $_POST['expdate'];
		$cvv = $_POST['cvv'];
		$amount = $_POST['amount'];
		
		$sql= "SELECT *FROM account WHERE acc_num='$accnum' AND exp_date='$expdate' AND cvv='$cvv'";
		$result= mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result) == 0) {
			$query= "INSERT INTO account(acc_num,exp_date,cvv,amount) VALUES ('$accnum','$expdate','$cvv','$amount')";
			$result= mysqli_query($conn,$query);
		}
		else{
			$row= mysqli_fetch_assoc($result);
			$query= "UPDATE account SET amount+='$amount' WHERE acc_num='$row[acc_num]' AND exp_date='$row[exp_date]' AND cvv='$row[cvv]'";
			$result= mysqli_query($conn,$query);
		}
	}
	if(isset($_POST['yes']) OR isset($_POST['add'])){
		$ffrom= $_POST['ffrom'];
		$fto= $_POST['fto'];
		$seats = $_POST['seats'];
		$total = $_POST['total'];
		echo "<input type='hidden' value='$ffrom' name='ffrom'>";
		echo "<input type='hidden' value='$fto' name='fto'>";
		echo "<input type='hidden' value='$seats' name='seats'>";
		echo "<input type='hidden' value='$total' name='total'>";
	echo '<form action="airline_ticket.php" method="POST">';
		echo '<table style="margin-top:150px;">';
		echo '<tr>';
			echo '<td><label for="accnum" style="border:none;"><b>Account Number</b></label></td>';
			echo '<td><input type="text" name="accnum" required></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td><label for="expdate" style="border:none;"><b>Expire Date</b></label></td>';
			echo '<td><input type="date" name="expdate" required ></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td><label for="cvv" style="border:none;"><b>CVV</b></label></td>';
			echo '<td><input type="number" name="cvv" required></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td><label for="amount" style="border:none;"><b>Amount</b></label></td>';
			echo '<td><input type="number" name="amount" required value="<?php echo $total; ?>" id="amount"></td>';
		echo '</tr>';
		echo "<input type='hidden' value='$ffrom' name='ffrom'>";
		echo "<input type='hidden' value='$fto' name='fto'>";
		echo "<input type='hidden' value='$seats' name='seats'>";
		echo "<input type='hidden' value='$total' name='total'>";
		echo '</table>';
		echo '<div>';
			echo '<button type="submit" name="pay" style="width:150px;padding:10px;margin-left:1080px;margin-top:100px;">Pay</button>';
		echo '</div>';
	echo '</form>';
	}*/
?>