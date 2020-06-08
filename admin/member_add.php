<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Add Member";



if(isset($_SESSION['Username']))
	
   {
	   
	   include "includes/templates/header.php";
	   include "includes/templates/navbar.php";   
	  
				
    ?>
				
				<!-- Starting The Adding Form -->
		
	<h1 class="edit text-center">Add Member</h1>
	
	
	
	<div class="container">
		<form class="form-horizontal" action="member_insert.php" method="post" enctype="multipart/form-data">
		
		
		<!-- Starting The Username Field -->
		
		<div class="form-group">
		
			<label class="col-sm-2 col-md-4 control-label">Username</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="username" autocomplete="off"  placeholder="Enter Your Username Here" required>
				<span class="asterisk">*</span>
			</div>
		
			</div>
			
			<!-- Starting The Password Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Password</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="password" name="password" placeholder="Enter Your Password Here" required>
				<span class="asterisk">*</span>
				<i class="fa fa-eye show-pass"></i>
			</div>
			
		</div>
		
		
			
			<!-- Starting The Email Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Email</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="email" name="email" auto-complete="off" placeholder="Enter Your Valid E-Mail Here" required>
				<span class="asterisk">*</span>
			</div>
			
			
		</div>
		
		
			<!-- Starting The Fullname Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Full Name</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="fullname" auto-complete="off" required placeholder="Enter Your Full Name Which Will Be Appeared At The Site">
				<span class="asterisk">*</span>
			</div>
			
		</div>
	 	
	 	<!-- Starting The Image Field -->
	 	
				<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Profile Picture</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="file" name="image" required>
				<span class="asterisk">*</span>
			</div>
			
		</div>
		
			<!-- Starting The Submit Button -->
		
		<div class="form-group">
			
			<div class="col-sm-4 col-sm-offset-2 col-md-offset-4 col-md-6">
			<input type="submit" class="btn btn-success form-control" value="Add Member">
			</div>
			
		</div>
		
			
			
		</form>
	</div>
				
	
<?php
	   
						
	   
   } else
	
	{
		
		$member_add = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
		redirect_home($member_add);
		
		
	}

include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/