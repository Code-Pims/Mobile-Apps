<?php
	include("connection.php");
	include("functions.php");

if(isset($_POST['save']))
{	 
	 $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $email = $_POST['email'];
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 $sql = "INSERT INTO user (firstname,lastname,email,username,password)
	 VALUES ('$firstname','$lastname','$email','$username','$password')";
	 if (mysqli_query($con, $sql)) {

		echo " Created Account Successfully!!";

		header("Refresh: 2; url=Loginform.php");
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($con);
	 }
	 mysqli_close($con);
}
?>