<?php
	include('config.php');
	$error = array();
	
	if(isset($_POST['register'])) {
		$name = $_POST['name'];
		$email  =  $_POST['email'];
		$pass =  $_POST['pass'];
		$pass1 = $_POST['pass1'];
		$gender = $_POST['gender'];
		$dob =  $_POST['dob'];
		$phone =  $_POST['phone'];
		$address = $_POST['address'];
		$state =  $_POST['state'];
		$city =  $_POST['city'];
		$country = $_POST['country'];
		
		if($pass == $pass1){
		$sql= "SELECT *FROM reg_log_user WHERE name='$name' OR email='$email' OR phone='$phone'";
		$result= mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result) > 0) {
			while($user= mysqli_fetch_assoc($result)){
			if($user){
				if($user['name'] === $name){
					array_push($error, "Passenger name is already exits");
				}
				if($user['email'] === $email){
					array_push($error, "Email is already exits");
				}
				if($user['phone'] === $phone){
					array_push($error, "Phone Number is already exits");
				}
			}
			}
		}
		
		include('errors.php');
		if (count($error) == 0) {
			$query= "INSERT INTO reg_log_user(name,email,password,gender,dob,phone,address,state,city,country) VALUES ('$name','$email','$pass','$gender','$dob','$phone','$address','$state','$city','$country')";
			if ($conn->query($query) === TRUE){
				header('location: airline_login.html');
			}
		}
		}
	}
?>