<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Edit Item";


if(isset($_SESSION['User']))
	
   {
	   
	   include "includes/templates/header.php";
	   include "includes/templates/navbar.php";
	   
	   echo "<div class='container'>";
	   echo "<h1 class='edit text-center'>Edit Item</h1>";
	   
	   
	   if(isset($_GET['itemid']) && is_numeric($_GET['itemid']))
		   
		   {

			   $itemid = intval($_GET['itemid']);

		   }
	   
	   else
		   
		   {
			   $itemid = 0;
		   }
	   
	   
	   $sql = "SELECT * FROM items WHERE ItemID = '{$itemid}' LIMIT 1";
	   
	   $result = mysqli_query($conn, $sql);
	   $row = mysqli_fetch_assoc($result);
	   $count = mysqli_num_rows($result);
   
				
  if ($count > 0) { ?>
				
				<!-- Starting The Editing Form -->
	
			<div class="container">
		<form class="form-horizontal" action="item_update.php" method="post" enctype="multipart/form-data">
				
		<!-- Starting The ItemName Field -->
		
		<div class="form-group">
		
		<input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
		
			<label class="col-sm-2 col-md-4 control-label">Item Name</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="itemname" placeholder="The Name Of The Item"
				value="<?php echo $row['ItemName']; ?>" required>
				<span class="asterisk">*</span>
			</div>
		
			</div>
			
			<!-- Starting The Description Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Description</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="description"
				value="<?php echo $row['ItemDescription']; ?>"
				placeholder="The Discription Of The Item" required>
				<span class="asterisk">*</span>
			</div>
			
		</div>
				
		<!-- Starting The Price Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Price</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="price"
				placeholder="The Price Of The Item" value="<?php echo $row['ItemPrice']; ?>" required>
				<span class="asterisk">*</span>
			</div>
			
			
		</div>
			
			<!-- Starting The Country Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Country</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="country"
				placeholder="The Country Of The Item" value="<?php echo $row['ItemCountry']; ?>" required>
				<span class="asterisk">*</span>
			</div>
			
			
		</div>
		
		<!-- Starting The Status Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Status</label>
			<div class="col-sm-4 col-md-6">
				<select class="form-control" name="status">
					<option value="1" <?php if($row['ItemStatus'] == 1) echo "selected"; ?>>New</option>
					<option value="2" <?php if($row['ItemStatus'] == 2) echo "selected"; ?>>Like New</option>
					<option value="3" <?php if($row['ItemStatus'] == 3) echo "selected"; ?>>Old</option>
					<option value="4" <?php if($row['ItemStatus'] == 4) echo "selected"; ?>>Very Old</option>
				</select>
			</div>
			
			
		</div>
		
		<!-- Starting The Members Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Member</label>
			<div class="col-sm-4 col-md-6">
				<select class="form-control" name="member">
					<?php
	   
	   					$sql2 = "SELECT * FROM Users WHERE GroupID != 1";
	 					$result2 = mysqli_query($conn, $sql2);
	   
	   					while ($row2 = mysqli_fetch_assoc($result2))
							
						{
						 echo "<option value=";   
					     echo $row2['UserID'];
						      if($row['User_ID'] == $row2['UserID']) {echo 'selected'; }
						 echo ">";
						 echo $row2['Username'];
						 echo "</option>";
						}
	   
					?>
				</select>
			</div>
			
			
		</div>
				
		<!-- Starting The Categories Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Category</label>
			<div class="col-sm-4 col-md-6">
				<select class="form-control" name="category">
					<?php
	   
	   					$sql3 = "SELECT * FROM categories";
	 					$result3 = mysqli_query($conn, $sql3);
	   
	   					while ($row3 = mysqli_fetch_assoc($result3))
							
						{
						 echo "<option value=";   
					     echo $row3['CategoryID'];
						      if($row['Category_ID'] == $row3['CategoryID']) {echo 'selected'; }
						 echo ">";
						 echo $row3['CategoryName'];
						 echo "</option>";
						}
	   
					?>
				</select>
			</div>
			
			
		</div>
		
		<!-- Starting The Tags Field -->
				
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Tags</label>
			<div class="col-sm-4 col-md-6">
			<input class="form-control" type="text" name="tags" placeholder="Seperate Your Tags With Comma (,)"
			value="<?php echo $row['ItemTags']; ?>">
			</div>
			
		</div>
		
		<!-- Starting The Image Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Item Picture</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="file" name="image"
				value="<?php echo $row['ItemImage'];?>">
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
		
<?php
				   
 }
	   
else 
	   
	{

		echo "<div class='container'>";

		$item_edit_error = '<div class="alert alert-danger">Theres No Such ID</div>';

		redirect_login($item_edit_error);

		echo "</div>";

	}  

}

else
	
	{
	
			 include "includes/templates/header.php";
		 
			 $item_edit_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_login($item_edit_error);
			 
	}

echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/