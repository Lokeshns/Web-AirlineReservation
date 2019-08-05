<?php
	include('config.php');
	
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		
		$sql = "SELECT name FROM reg_log_user WHERE email = '$email' AND password = '$pass'";
		$result = mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				if($row["name"] == 'Lokesh N S'){
					$_SESSION['name'] = $row["name"];
					header("location: airline_details.php");
				}
				else{
					$_SESSION['name'] = $row["name"];
					header("location: airline_main.php");
				}
		}
		else{
			echo '<script> alert("Invalid Email and Password"); </script>';
		}
	}
?>