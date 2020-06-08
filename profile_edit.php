<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Edit Profile";


if(isset($_SESSION['User']))
	
   {
	   
	   include "includes/templates/header.php";
	   include "includes/templates/navbar.php";
	   
	   echo "<div class='container'>";
	   echo "<h1 class='edit text-center'>Edit Profile</h1>";
	   
	   
	   if(isset($_GET['userid']) && is_numeric($_GET['userid']))
		   
		   {

			   $userid = intval($_GET['userid']);

		   }
	   
	   else
		   
		   {
			   $userid = 0;
		   }
	   
	   
	   $sql = "SELECT * FROM Users WHERE UserID = '{$userid}' LIMIT 1";
	   
	   $result = mysqli_query($conn, $sql);
	   $row = mysqli_fetch_assoc($result);
	   $count = mysqli_num_rows($result);
				
  if ($count > 0) { ?>
				
				<!-- Starting The Editing Form -->
	
	<div class="container">
		<form class="form-horizontal" action="profile_update.php" method="post" enctype="multipart/form-data">
		
		
		<input type="hidden" name="userid" value="<?php echo $userid; ?>">
		
		<!-- Starting The Username Field -->
		
		<div class="form-group">
		
			<label class="col-sm-2 col-md-4 control-label">Username</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="username" autocomplete="off" required value="<?php echo $row['Username'];?>">
				<span class="asterisk">*</span>
			</div>
		
			</div>
			
			<!-- Starting The Password Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Password</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="password" name="password" placeholder="Leave Blank If You Don't Want To Change It">
			</div>
			
		</div>
		
			<!-- Starting The Email Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Email</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="email" name="email" auto-complete="off" required value="<?php echo $row['Email'];?>">
				<span class="asterisk">*</span>
			</div>
			
			
		</div>		
		
			<!-- Starting The Fullname Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Full Name</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="fullname" auto-complete="off"
				value="<?php echo $row['Fullname'];?>">
				<span class="asterisk">*</span>
			</div>
			
		</div>
		
		<!-- Starting The Image Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Profile Picture</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="file" name="image"
				value="<?php echo $row['UserImage'];?>">
				<span class="asterisk">*</span>
			</div>
			
		</div>
			
			<!-- Starting The Submit Button -->
		
		<div class="form-group">
			
			<div class="col-sm-4 col-sm-offset-2 col-md-offset-4 col-md-6">
			<input type="submit" class="btn btn-success form-control" value="Submit">
			</div>
			
		</div>
		
			
			
		</form>
	</div>
				
	
<?php
				  }
	   
	   else 
	   
	   		{

				echo "<div class='container'>";

				$profile_edit_error = '<div class="alert alert-danger">Theres No Such ID</div>';

				redirect_login($profile_edit_error);

				echo "</div>";

			}
		
	   
} 

else
	
	{
	
			 include "includes/templates/header.php";
		 
			 $profile_edit_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_login($profile_edit_error);
			 
	}

echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/