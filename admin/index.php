<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Login";

include "includes/templates/header.php";

/* Preventing The Login Page To Be Reviewed To The User That Has Recently Logged In
 By Directing Him To His Dashboard */


include "config.php";


if(isset($_SESSION['Username']))
   {
	header('location: dashboard.php');
	exit();
   }


// Checking If The User Is Accessing The Dashboard By 'POST' Request Method

	if($_SERVER['REQUEST_METHOD'] == 'POST')
		
		{
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT UserID, Username, Password FROM Users WHERE Username = '{$username}' && Password = '{$password}' && GroupID = 1 LIMIT 1";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if($count > 0)
				{
					$_SESSION['Username'] = $username; // Register Session Name
			        $_SESSION['ID'] = $row['UserID']; // Register Session ID
					header('location: dashboard.php'); // Redirecting The User To The Dashboard Page
					exit();
				}

		}

?>	

<form class="login" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
	<input class="form-control" type="text" name="username" placeholder="Username">
	<input class="form-control" type="password" name="password" placeholder="Password">
	<input class="btn btn-block" type="submit" value="Login">
</form>


<?php 
	  include "includes/templates/fotter.php"; 

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/