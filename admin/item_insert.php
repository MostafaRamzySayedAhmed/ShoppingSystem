<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Insert Item";



if($_SERVER["REQUEST_METHOD"] == "POST")
	
 {

	include "includes/templates/header.php";
	include "includes/templates/navbar.php";
	 
	echo "<div class='container'>";
	 
	echo "<h1 class='edit text-center'>New Item</h1>";
	
	$itemname = $_POST['itemname'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$country = $_POST['country'];
	$status = $_POST['status'];
	$member = $_POST['member'];
	$category = $_POST['category'];
	$tags = $_POST['tags'];
	 
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
	 
	 if(empty($itemname))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Item Name Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(strlen($itemname) < 3)
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Item Name Must Be At Least<strong>Four Characters</strong></div>';
		 }
	 if(empty($description))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Description Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(strlen($description) < 8)
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Item Description Must Be At Least <strong>Nine Characters</strong></div>';
		 }
	 if(empty($price))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Price Field <strong>Can Not Be Empty</strong></div>';
		 }
	 if(empty($country))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Country Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(empty($status))
		 {
			 $form_errors[] = 'The Status Field Can NOT Be Empty';
		 }
	 if(empty($member))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Member Field <strong>Can NOT Be Empty</strong></div>';
		 }
	 if(empty($category))
		 {
			 $form_errors[] = '<div class="message-error alert alert-danger">The Category Field <strong>Can NOT Be Empty</strong></div>';
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
	 
	 
			if(empty($form_errors))
				
			{
				
				/* Giving Random Name To The Image Name That Is Uploaded With For Avoiding Any Conflict That Can Occur On The Server Because Of The Same Names Of Images That Are Going To Be Uploaded */
				$image_name_random = rand(1, 1000000000). "_". $image_name;
				
				/* Moving The Image To This Defined Destination On The Server */
				move_uploaded_file($image_tmp_name, "uploads\item_image\\".$image_name_random);
				
				$sql = "INSERT INTO items (ItemName, ItemDescription, ItemPrice, ItemDate, ItemCountry, ItemImage, ItemStatus, ItemRating, User_ID, Category_ID, ItemTags) VALUES ('$itemname', '$description', '$price', now(), '$country', '$image_name_random', '$status', '', '$member', '$category', '$tags')";
				
				
				if(mysqli_query($conn, $sql))
				{
					$insert_message_success = "<span class='message-success alert alert-success'>Record Inserted Successfully</span>";

					
					redirect_items($insert_message_success);
					
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}



			} else
				
				{
					
					foreach($form_errors as $error)
		 			{
			 
			 			redirect_item_add($error, 5);
			 
		 			}
				}
		
		
 }

else
	
		 {
	
			 include "includes/templates/header.php";
		 
			 $item_insert_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($item_insert_error);
			 
		 }
	 
 
	echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/