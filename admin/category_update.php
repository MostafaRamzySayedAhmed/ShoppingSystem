<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Update Category";



if($_SERVER["REQUEST_METHOD"] == "POST")
	
 {

	include "includes/templates/header.php";
	include "includes/templates/navbar.php";
	 
	echo "<div class='container'>";
	echo "<h1 class='text-center'>Update Category</h1>";
	
	$catid = $_POST['catid'];
	$categoryname = $_POST['categoryname'];
	$description = $_POST['description'];
	$order = $_POST['order'];
	$parent = $_POST['parent'];
	$visibility = $_POST['visibility'];
	$ads = $_POST['ads'];
	$comments = $_POST['comments'];
	 
	 if(empty($categoryname)){
		
		$categoryname_message_error = "<div class ='message-error alert alert-danger'>The Category Name Can NOT Be Empty</div>";
		 
		 
		 redirect_category_edit($categoryname_message_error, 5);
	}
	 
	 else 
		 
	 {
	 
	 /*
	 ** Checking If The CategoryName He Trys To Edit Is Already Existed Or Not
	 ** The Variables Are Named Like This To Avoid Any Conflict
	 ** Depending On The Number Of The Retrieved Rows Of The Result, If It Equals 1, This Means That This CategoryName Is Already Existed and As a Result an Error Message Will Be Displayed and The User Will Be Redirected To The Edit Page Depending On The 'redirect_category_edit' Method Defined In The Functions File.
	 */
		 
		    $sql = "UPDATE categories SET CategoryName = '$categoryname', CategoryDescription = '$description', CategoryOrder = '$order', CategoryParent = '$parent', CategoryVisibility = '$visibility', CategoryADs = '$ads', CategoryComments = '$comments' WHERE CategoryID = ".$catid;
			$result = mysqli_query($conn, $sql);
			
			$category_update_success = "<span class='message-success alert alert-success'>Record Updated Successfully</span>";
			
			redirect_categories($category_update_success);
	 
 	}
 }

else
	
		 {
	
			 include "includes/templates/header.php";
		 
			 $category_update_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($category_update_error);
			 
		 }

	echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/