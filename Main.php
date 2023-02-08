 <?php 
	
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			//read from database
			$query = "select * from user where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						
						header("Location: Page1.php");
						die;
					}
				}
			}
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Montserrat+Alternates:wght@700&display=swap" rel="stylesheet">
	<title>MOBILE APPS (Artificial)</title>

</head>
<style type="text/css">
	body {user-select: none;}


	#MobileSize {
  border: 2px solid black;
  height: 600px;
  width: 340px;
  background-repeat: no-repeat;
  position: relative;
  margin-top: 3%;
  background-image: url(Images/Background1.jpg);
  background-size: 350px 600px;
  back
	}

	.Sign {color: white; 
		font-size: 50px; margin-top: 18%;
		background-color: #00ff0080;
	font-family: 'Montserrat Subrayada', sans-serif;
cursor: none;}

	#text1 {margin-top:30% ;font-style: bold;height: 25px; border-radius: 5px;padding: 4px; text-align: c; border: solid thin #aaa; text-align: center;	}

	#text2 {margin-top:2% ;font-style: bold;height: 25px; border-radius: 5px;padding: 4px; text-align: c; border: solid thin #aaa; text-align: center;	}

button {
  padding: 10px 50px;
  font-size: 20px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #04AA6D;
  border: none;
  width: 60%;
  margin: 20px;
  margin-bottom: 55px;
  border-radius: 15px;
  box-shadow: 0 9px #999;
   font-family: 'Fredoka One', cursive;
}

button:hover {background-color: #3e8e41}

button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

.register a{
	color: black;

}
	
</style>

<body>
<center>
	<div id="MobileSize">
		<div class="Sign">
		<label><b>SIGN IN</b></label></div>
	<form method="post">

<div class="container">
	 <input id="text1" type="text" placeholder="Enter username" name="username" required><br>
   <label for="username"><b>Username</b></label><br>
      <!--username:-->

<input id="text2" type="password" placeholder="Enter password" name="password" required><br>
      <label for="password"><b>Password</b></label><br>
       <!--Password:-->
      <button type= "submit">LOGIN</button>
    </div> </form> 

			<div class="register">
			     	<a href="Signup.php">Create Account</a></div>

 </div> </center>


   <script>
    function myFunction() {
		 alert("Login successfully!");  
         alert(true);
    }
    </script>

</body>
</html>
