<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Montserrat+Alternates:wght@700&display=swap" rel="stylesheet">

	<title>REGISTER</title>
</head>

<style type="text/css">
	body {
		font-family: 'Fredoka One', cursive;
	}

	#MobileSize {
  border: 2px solid black;
  height: 600px;
  width: 340px;
  background-repeat: no-repeat;
  position: relative;
  margin-top: 5%;
  }

input[type=text], input[type=email], input[type=password] {
	font-size: 10px;
	color: black;
	width: 70%;
	padding: 5px;
	margin: 5px;
}

form {
	margin-top: 25%;
}
label {
	font-size: 12px;
}

</style>

<body>
<center>
<div id="MobileSize">
	<form method="post" action="process.php">
	<label>First Name:</label><br>
		<input type="text" name="firstname" >
		<br>
	<label>Last Name:</label><br>
		<input type="text" name="lastname" >
		<br>
	<label>Email:</label><br>
		<input type="email" name="email" required>
		<br>
	<label>Username:</label><br>
		<input type="text" name="username" required>
		<br>
	<label>Password:</label><br>
		<input type="password" name="password"  required>
		<br><br>
		<input type="submit" name="save" value="SUBMIT" style="font-size: 20px; color: red; width: 90%; cursor: pointer;">


	</form>
</div> </center>

</body>
</html>


