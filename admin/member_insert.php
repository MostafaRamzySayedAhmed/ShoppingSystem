<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Insert Member";



if($_SERVER["REQUEST_METHOD"] == "POST")
	
 {

	include "includes/templates/header.php";
	include "includes/templates/navbar.php";
	 
	echo "<div class='container'>";
	 
	echo "<h1 class='edit text-center'>New Member</h1>";
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hashed_password = sha1($password);
	$fullname = $_POST['fullname'];
	 
	$image          = $_FILES['image']; /* Array ( [name] => Personal Photo.jpg [type] => image/jpeg 
										[tmp_name] => C:\xampp\tmp\phpCCB9.tmp [error] => 0 [size] => 57712 ) */
	$image_name     = $image['name']; /* Photo.jpg */
	$image_type     = $image['type']; /* image/jpeg */
	$image_tmp_name = $image['tmp_name']; /* C:\xampp\tmp\phpEFDB.tmp */
	$image_size     = $image['size']; /* 57712 */ // In Bytes
	 
 /* The Allowed Extensions Of Images That Are Going To Be Uploaded */
	 $image_extensions = array("jpg", "jpeg", "png", "gif");
	 
	 $image_extension_eploded = explode('.', $image_name); /* jpg */
	 $image_extension_ended = end($image_extension_eploded);
	 $image_extension = strtolower($image_extension_ended);
	 
  $form_errors = array();
	 
	 if(empty($username))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Username Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(strlen($username) < 5)
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Username Field <strong>Can NOT Be Less Than 5 Characters</strong></div>';
		 }
	 if(strlen($username) > 25)
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Username Field <strong>Can NOT Be More Than 25 Characters</strong></div>';
		 }
	 if(empty($password))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Password Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(empty($email))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Email Field <strong>Can Not Be Empty</strong></div>';
		 }
	 if(empty($fullname))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Fullname Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(empty($image_name))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Picture Field <strong>Can NOT Be Empty</strong></div>';
		 }
	  if(!empty($image_name) && !in_array($image_extension, $image_extensions))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">This Extension Is <strong>NOT Allowed</strong> - The Aloowed Extensions Are: jpg, jpeg, png, gif</div>';
		 }
	 if($image_size > 2097152)
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Picture Size <strong>Can NOT Exceed 2MB</strong></div>';
		 }
	 
	 
	 /*
	 ** Checking If The Username The Trys To Add Is Already Existed Or Not
	 ** The Variables Are Named Like This To Avoid Any Conflict
	 ** Depending On The Number Of The Retrieved Rows Of The Result If It Equals 1, This Means That This Username 	Is Already Existed and As a Result an Error Message Will Be Displayed and The User Will Be Redirected To    The Add Page Depending On The 'redirect_member_add' Method Defined In The Functions File.
	 */
	 
	 
	 $query = "SELECT Username FROM Users WHERE Username = '{$username}' ";
	 $result = mysqli_query($conn, $query);
	 $count = mysqli_num_rows($result);
	 
	 if($count > 0)
	 {
		 $username_message_error = "<div class ='message-error alert alert-danger'>This Username Is Already Existed, Please Select Another One</div>";
		 
		 
		 redirect_member_add($username_message_error, 5);
		 
	 }
	 else
	 {
		 
	 
	 
			if(empty($form_errors))
			{
				/* Giving Random Name To The Image Name That Is Uploaded With For Avoiding Any Conflict That Can Occur On The Server Because Of The Same Names Of Images That Are Going To Be Uploaded */
				$image_name_random = rand(1, 1000000000). "_". $image_name;
				
				/* Moving The Image To This Defined Destination On The Server */
				move_uploaded_file($image_tmp_name, "uploads\user_image\\".$image_name_random);
				
				$sql = "INSERT INTO users (Username, Password, Email, Fullname, RegistrationStatus, Date, UserImage) VALUES ('$username', '$hashed_password', '$email', '$fullname', 1, now(), '$image_name_random')";
				
				
				if(mysqli_query($conn, $sql))
				{
					$insert_message_success = "<span class='message-success alert alert-success'>Record Inserted Successfully</span>";

					
					redirect_members($insert_message_success);
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}



					
					

			} else 
				
				{ 
					foreach($form_errors as $error)
				
					   {

							redirect_member_add($error, 5);

					   }
					
				}
		

 	  }
 
 }

else
	
		 {
	
			 include "includes/templates/header.php";
		 
			 $member_insert_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($member_insert_error);
			 
		 }
	 
 
	echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/