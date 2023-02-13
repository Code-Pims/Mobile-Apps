 <?php 
	
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($password) && !is_numeric($email))
		{

			//read from database
			$query = "select * from user where email = '$email' limit 1";
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
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="images/dashboard.css">
	<title>MOBILE APPS (Artificial)</title>
 
</head>
<style type="text/css">

	/* mobile size max-width:450px*/

	body {user-select: none;
  background-repeat: no-repeat;
  position: relative;
  background-image: url(Images/Background.jpg);
  background-size: 360px 740px;
	visibility: collapse;
}

	#MobileSize {
  margin-left: auto; 
  margin-right: auto;
	text-align: center;
	}

	.Sign {color: white; 
		font-size: 50px; margin-top: 18%;
		background-color: #00ff0080;
	font-family: 'Montserrat Subrayada', sans-serif;
cursor: none;}

	#text1 {font-style: bold;height: 25px; width: 75%; border-radius: 5px;padding: 4px; text-align: c; border: solid thin #aaa; text-align: center;	}

	#text2 {margin-top:2% ;font-style: bold;height: 25px; width: 75%; border-radius: 5px;padding: 4px; text-align: c; border: solid thin #aaa; text-align: center;	}

 #Login{
  padding: 10px;
  font-size: 20px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #04AA6D;
  border: none;
  width: 60%;
  margin: 20px;
  border-radius: 15px;
   font-family: 'Fredoka One', cursive;
}

 #Login:hover {background-color: #3e8e41}

 #Login:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

.register a{
	color: black;
}

.Signbtn {font-style: bold;height: 25px; border-radius: 5px;padding: 4px; text-align: c; border: solid thin #aaa; text-align: center;

}

/*   max-width: 800px
*/
@media only screen and (max-width:416px) {
		body {
			visibility: visible;
		}
	}
	 
</style>

<body>

	<div class="header" id="myHeader">
		<button class="tablink" onclick="openTable('SIGNIN', this, 'green')" id="defaultOpen">SIGN IN</button>
<button class="tablink" onclick="openTable('SIGNUP', this, 'red')">SIGN UP</button>
</div><br><br>

<center>

	<div id="MobileSize">
	<form method="post">
<div class="container">

<div id="SIGNIN" class="tabcontent">
<div><h3 style="margin-top: -8%;">Welcome Back!</h3></div>

	<div class="firstBox">
			 <input id="text1" type="text" placeholder="Enter Email" name="email" required><br>
   <label for="email"><b>Email</b></label><br>
      <!--username:-->

<input id="text2" type="password" placeholder="Enter password" name="password" required><br>
      <label for="password"><b>Password</b></label><br><br>

<input type="checkbox" value="RememberPwd" >
<label for="RememberPwd"> Remember password</label>
<label style="margin-left: 10%;"><a style="color: red;" href="#">Forgot password?</a></label>
<br>
       <!--Password:-->
      <button id="Login" type="submit">LOGIN</button><br><br>

<div><label>--------------------  Or Sign in with  --------------------</label></div><br>
<div><button style="width:30%;"><i class="glyphicon glyphicon-envelope" style='font-size:16px; color: red ; margin:6px;'></i><a href="#">Google</a></button>
	<button style="margin-left:20%; width:30%;"><i class='fab fa-facebook-f' style='font-size:18px; color: blue; margin:5px;'></i><a href="#">Facebook</a></button></div>

    </div>
  </div>
     </form> 

	



<div id="SIGNUP" class="tabcontent">
	<h3 style="margin-top: -8%;" class="Signupbtn">Create an Account</h3>
	<div class="secondBox">

		<form method="post" class="forminput" action="process.php">
		<input style="width: 95%;" type="text" name="firstname" placeholder="Firstname"required>
		<br>
		<input style="width: 95%;" type="text" name="lastname" placeholder="Lastname" required>
		<br>
		<i class="glyphicon glyphicon-envelope" style="background: green; padding:5px 15px; opacity: 0.7;"></i><input type="email" name="email" placeholder="Email" required>
		<br>
		<i class="fa fa-user icon" style="background: green; padding:5px 15px; opacity: 0.7;"></i><input type="text" name="username" placeholder="Username" required>
		<br>
		<i class="fa fa-key icon" style="background: green; padding:5px 15px; opacity: 0.7;"></i><input type="password" name="password" placeholder="Password" required>
		<br><br>
		<input type="submit" class="Sbmt" name="save" value="SUBMIT" style="width: 90%; cursor: pointer;">


	</form>
	 </div>

		
		</div>

</div>

 </div> 

</center>


   <script>
    function myFunction() {
		 alert("Login successfully!");  
         alert(true);
    }
    </script>


    <script>
function openTable(TableName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(TableName).style.display = "block";
  elmnt.style.backgroundColor = color;

}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>