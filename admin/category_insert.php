<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Insert Category";



if($_SERVER["REQUEST_METHOD"] == "POST")
	
 {

	include "includes/templates/header.php";
	include "includes/templates/navbar.php";
	 
	echo "<div class='container'>";
	 
	 echo "<h1 class='edit text-center'>New Category</h1>";
	
	$categoryname = $_POST['categoryname'];
	$description = $_POST['description'];
	$order = $_POST['order'];
	$parent = $_POST['parent'];
	$visibility = $_POST['visibility'];
	$ads = $_POST['ads'];
	$comments = $_POST['comments'];
	 
	 
	 
	if(empty($categoryname)){
		
		$categoryname_message_error = "<div class ='message-error alert alert-danger'>The Category Name Can NOT Be Empty</div>";
		 
		 
		 redirect_category_add($categoryname_message_error, 5);
	}
	 
	 else {
	 
	 /*
	 ** Checking If The CategoryName He Trys To Add Is Already Existed Or Not
	 ** The Variables Are Named Like This To Avoid Any Conflict
	 ** Depending On The Number Of The Retrieved Rows Of The Result If It Equals 1, This Means That This CategoryName Is Already Existed and As a Result an Error Message Will Be Displayed and The User Will Be Redirected To The Add Page Depending On The 'redirect_category_add' Method Defined In The Functions File.
	 */
	 
	 
	 $query_insert = "SELECT CategoryName FROM categories WHERE CategoryName = '{$categoryname}' ";
	 $result_insert = mysqli_query($conn, $query_insert);
	 $count_insert = mysqli_num_rows($result_insert);
	 
	 if($count_insert == 1)
	 {
		 $categoryname_message_error = "<div class ='message-error alert alert-danger'>This Category Name Is Already Existed, Please Select Another One</div>";
		 
		 
		 redirect_category_add($categoryname_message_error, 5);
		 
	 }
		 
	 else
		 
	 {
		 
	 
	 
			
				$sql = "INSERT INTO categories (CategoryName, CategoryDescription, CategoryOrder, CategoryParent, CategoryVisibility, CategoryADs, CategoryComments) VALUES ('$categoryname', '$description', '$order', '$parent', '$visibility', '$ads', '$comments')";
		 
		 
				if(mysqli_query($conn, $sql))
				{
					$categoryname_message_success = "<span class='message-success alert alert-success'>Record Inserted Successfully</span>";

					
					redirect_categories($categoryname_message_success);
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}


					
			

 	  }

 }
	 
 }

else
	
		 {
	
			 include "includes/templates/header.php";
		 
			 $category_insert_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($category_insert_error);
			 
		 }
	 
 
	echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/