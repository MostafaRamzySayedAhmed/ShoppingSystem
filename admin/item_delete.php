<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Delete Item";



if(isset($_SESSION['Username']))
	
   {
	   
	   
	   include "includes/templates/header.php";
	   include "includes/templates/navbar.php";
	   
	   echo "<div class='container'>";
	   
	   echo "<h1 class='edit text-center'>Delete Item</h1>";
	   
	   
	   // Checking If Get Request catid Is Numeric & Getting The Integer Value Out Of It

	   			if(isset($_GET['itemid']) && is_numeric($_GET['itemid']))
					
					{
						$itemid = intval($_GET['itemid']);
					}
	   			else
					{
						$itemid = 0;
					}

				// Selecting All Data Depending On This ID

				$sql = "SELECT * FROM items WHERE ItemID = '{$itemid}' LIMIT 1";
	   
	   			$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);
	   
				if($count > 0)
					
				{

					$stmt = "DELETE FROM items WHERE ItemID = '{$itemid}' LIMIT 1";

					mysqli_query($conn, $stmt);

					$item_delete_success = "<span class='message-success alert alert-success'>Record Deleted Successfully</span>";
					
					redirect_items($item_delete_success);


				} 
	   
	   			else 
				
				{

					$item_delete_error = "<span class='message-error alert alert-danger'>This ID Is NOT Existed</span>";
					
				    redirect_home($item_delete_error, 5);

				}
	   
   }

else
	
		{
	
			 include "includes/templates/header.php";
		 
			 $item_delete_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($item_delete_error);
			 
		 }
	
	echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/