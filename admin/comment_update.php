<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Update Comment";



if($_SERVER["REQUEST_METHOD"] == "POST")
	
 {

	include "includes/templates/header.php";
	include "includes/templates/navbar.php";
	 
	echo "<div class='container'>";
	 
	 echo "<h1 class='edit text-center'>Update Comment</h1>";
	
	$commentid = $_POST['commentid'];
	$comment = $_POST['comment'];
	$status = $_POST['status'];
	$member = $_POST['member'];
	$item = $_POST['item'];
	 
	 
	$form_errors = array();
	 
	 if(empty($comment))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Item Name Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(empty($status))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Status Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(empty($member))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Member Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(empty($item))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Item Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 

	 
			if(empty($form_errors))
				
			{
				
				$sql = "UPDATE comments SET CommentContent = '$comment', CommentStatus = '$status', User_ID = '$member', Item_ID = '$item' WHERE CommentID = ".$commentid;
				
				
				if(mysqli_query($conn, $sql))
				{
					$update_message_success = "<span class='message-success alert alert-success'>Record Updated Successfully</span>";

					
					redirect_comments($update_message_success);
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}



			}
	 
	 		else 
				
				{
					foreach($form_errors as $error)
						
						 {
							 redirect_comment_edit($error, 5);
						 }		
				}
		
		
 } 

else
	
		 {
	
			 include "includes/templates/header.php";
		 
			 $comment_update_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($comment_update_error);
			 
		 }
	 
 
	echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/