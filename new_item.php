<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "New Item";

include "includes/templates/navbar.php";
include "includes/templates/header.php";

if(isset($_SESSION['User']))
{

	
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	
 {
	 
	 
	$userid = $_SESSION['UserID'];
	 
	 
	echo "<div class='container'>";
	 
	
	$itemname = filter_var($_POST['itemname'], FILTER_SANITIZE_STRING);
	$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
	$price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
	$country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
	$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
	$category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
	$tags = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);
	 
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
			 $form_errors[] = 'The Item Name Field Can NOT Be Empty';
		 }
	 if(strlen($itemname) < 3 )
		 {
			 $form_errors[] = 'The Item Name Must Be At Least Four Characters';
		 }
	 if(empty($description))
		 {
			 $form_errors[] = 'The Description Field Can NOT Be Empty';
		 }
	 if(strlen($description) < 8)
		 {
			 $form_errors[] = 'The Item Description Must Be At Least Nine Characters';
		 }
	 if(empty($price))
		 {
			 $form_errors[] = 'The Price Field Can Not Be Empty';
		 }
	 if(empty($country))
		 {
			 $form_errors[] = 'The Country Field Can NOT Be Empty';
		 }
	 if(empty($status))
		 {
			 $form_errors[] = 'The Status Field Can NOT Be Empty';
		 }
	 if(empty($category))
		 {
			 $form_errors[] = 'The Category Field Can NOT Be Empty';
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
				
				$sql = "INSERT INTO items (ItemName, ItemDescription, ItemPrice, ItemDate, ItemCountry, ItemImage, ItemStatus, ItemRating, User_ID, Category_ID, ItemTags) VALUES ('$itemname', '$description', '$price', now(), '$country', '$image_name_random', '$status', '', '$userid', '$category', '$tags')";
				
				
				if(mysqli_query($conn, $sql))
				{
					$message_insert_success = "Record Inserted Successfully";

					
				} else {
					$message_insert_error = "Error: " . mysqli_error($conn);
				}



			}
	 
 
 } 
		

	echo "</div>";


?>

<div class="profile-ads">
<div class="container">
<h1 class="text-center">New Item</h1>
	<div class="panel panel-primary">
		<div class="panel-heading">New Item</div>
		<div class="panel-body">
		
		<div class="row">
		
			<div class="col-md-8">
				
				<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		
		<!-- Starting The ItemName Field -->
		
		<div class="form-group">
		
			<label class="col-sm-2 col-md-3 control-label">Item Name</label>
			<div class="col-sm-3 col-md-5">
				<input class="form-control live-item-name" type="text" name="itemname" placeholder="The Name Of The Item" pattern=".{4,}" title="The Item Name Must Be At Least Four Characters" required>
				<span class="asterisk">*</span>
			</div>
		
			</div>
			
			<!-- Starting The Description Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-3 control-label">Description</label>
			<div class="col-sm-3 col-md-5">
				<input class="form-control live-item-desc" type="text" name="description"
				placeholder="The Discription Of The Item" pattern=".{6,}" title="The Item Description Must Be At Least Nine Characters" required>
				<span class="asterisk">*</span>
			</div>
			
		</div>		
		
		<!-- Starting The Price Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-3 control-label">Price</label>
			<div class="col-sm-3 col-md-5">
				<input class="form-control live-item-price" type="text" name="price"
				placeholder="The Price Of The Item" required>
				<span class="asterisk">*</span>
			</div>
			
			
		</div>
				
			<!-- Starting The Country Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-3 control-label">Country</label>
			<div class="col-sm-3 col-md-5">
				<input class="form-control" type="text" name="country"
				placeholder="The Country Of The Item" required>
				<span class="asterisk">*</span>
			</div>
			
			
		</div>
		
		<!-- Starting The Status Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-3 control-label">Status</label>
			<div class="col-sm-3 col-md-5">
				<select class="form-control" name="status" required>
					<option value="">.....</option>
					<option value="1">New</option>
					<option value="2">Like New</option>
					<option value="3">Old</option>
					<option value="4">Very Old</option>
				</select>
			</div>
			
			
		</div>
		
		<!-- Starting The Categories Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-3 control-label">Category</label>
			<div class="col-sm-3 col-md-5">
				<select class="form-control" name="category" required>
					<option value="">.....</option>
					<?php
	   
	   					$sql = "SELECT * FROM categories";
	 					$result = mysqli_query($conn, $sql);
	   
	   					while ($row = mysqli_fetch_assoc($result))
							
							{
								echo "<option value=" . $row['CategoryID']. ">" . $row['CategoryName'] . "</option>";
							}
	   
					?>
				</select>
			</div>
			
			
		</div>
		
		<!-- Starting The Tags Field -->
				
		<div class="form-group">
			
			<label class="col-sm-2 col-md-3 control-label">Tags</label>
			<div class="col-sm-3 col-md-5">
			<input class="form-control" type="text" name="tags" placeholder="Seperate Your Tags With Comma (,)">
			</div>
			
		</div>
		
		<!-- Starting The Image Field -->
	 	
			<div class="form-group">
			
			<label class="col-sm-2 col-md-3 control-label">Item Picture</label>
			<div class="col-sm-3 col-md-5">
				<input class="form-control" type="file" name="image" required>
				<span class="asterisk">*</span>
			</div>
			
		    </div>
							
			<!-- Starting The Submit Button -->
		
		<div class="form-group">
			
			<div class="col-sm-3 col-sm-offset-2 col-md-offset-3 col-md-5">
			<input type="submit" class="btn btn-success form-control" value="New Item">
			</div>
			
		</div>
					
		</form>
				
			</div>
			

			<div class="col-md-4 live-preview">
				
				<div class="thumbnail item-box">
				<span class="price-tag">
					<span class="live-price">0</span>
				</span>
				<img class="img-responsive" src="img.png" alt="" />
				<div class="caption">
					<h3></h3>
					<p></p>
				</div>
			   </div>
				
			</div>
		</div>
		
		<?php
			
			if(! empty($form_errors))
					
					foreach($form_errors as $error)
		 			{
			 
			 			echo "<div class='alert alert-danger'>". $error ."</div>";
			 
		 			}
	
			if(isset($message_insert_success))
			{
				echo "<div class='alert alert-success'>". $message_insert_success . "</div>";
			}
				
	
		?>
	
		</div>
	</div>
</div>	
</div>


<?php 

}

else
	
{
	echo "<div class='alert alert-danger'>You Are Not Permited To Access This Page Directly</div>";
	
}
	include "includes/templates/fotter.php"; 

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/