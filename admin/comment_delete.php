<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Delete Comment";



if(isset($_SESSION['Username']))
	
   {
	   
	   
	   include "includes/templates/header.php";
	   include "includes/templates/navbar.php";
	   
	   echo "<div class='container'>";
	   
	   echo "<h1 class='edit text-center'>Delete Comment</h1>";
	   
	   // Check If Get Request catid Is Numeric & Get The Integer Value Of It

	   			if(isset($_GET['commentid']) && is_numeric($_GET['commentid']))
					
					{
						$commentid = intval($_GET['commentid']);
					}
	   			else
					{
						$commentid = 0;
					}

				// Select All Data Depend On This ID

				$sql = "SELECT * FROM comments WHERE CommentID = '{$commentid}' LIMIT 1";
	   
	   			$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);
	   
				if($count > 0)
					
				{

					$stmt = "DELETE FROM comments WHERE CommentID = '{$commentid}' LIMIT 1";

					mysqli_query($conn, $stmt);

					$comment_delete_success = "<span class='message-success alert alert-success'>Record Deleted Successfully</span>";
					
					redirect_comments($comment_delete_success);


				} 
	   
	   			else 
				
				{

					$comment_delete_error = "<span class='message-error alert alert-danger'>This ID Is NOT Existed</span>";
					
				    redirect_home($comment_delete_error, 5);

				}
	   
   }

else
	
		{
	
			 include "includes/templates/header.php";
		 
			 $comment_delete_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($comment_delete_error);
			 
		 }
	
	echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/