<?php


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "mobileapps";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}


function check_login($con)
{

	if(isset($_SESSION['data_id']))
	{

		$id = $_SESSION['data_id'];
		$query = "select * from data where data_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	//header("Location: inputdata.php");
	die;

}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}