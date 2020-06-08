<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Add Item";



if(isset($_SESSION['Username']))
	
   {
	   
	   include "includes/templates/header.php";
	   include "includes/templates/navbar.php";
	  
				
    ?>
				
				<!-- Starting The Adding Form -->
		
	<h1 class="edit text-center">Add Item</h1>
	
	
	
	<div class="container">
		<form class="form-horizontal" action="item_insert.php" method="post" enctype="multipart/form-data">
		
		
		<!-- Starting The ItemName Field -->
		
		<div class="form-group">
		
			<label class="col-sm-2 col-md-4 control-label">Item Name</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="itemname" placeholder="The Name Of The Item" pattern=".{4,}" title="The Item Name Must Be At Least Four Characters" required>
				<span class="asterisk">*</span>
			</div>
		
			</div>
			
			<!-- Starting The Description Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Description</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="description"
				placeholder="The Discription Of The Item" pattern=".{9,}" title="The Item Description Must Be At Least Nine Characters" required>
				<span class="asterisk">*</span>
			</div>
			
		</div>
		
		
		<!-- Starting The Price Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Price</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="price"
				placeholder="The Price Of The Item" required>
				<span class="asterisk">*</span>
			</div>
			
			
		</div>
		
		
			<!-- Starting The Country Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Country</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="country"
				placeholder="The Country Of The Item" required>
				<span class="asterisk">*</span>
			</div>
			
			
		</div>
		
		<!-- Starting The Status Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Status</label>
			<div class="col-sm-4 col-md-6">
				<select class="form-control" name="status" required>
					<option value="">.....</option>
					<option value="1">New</option>
					<option value="2">Like New</option>
					<option value="3">Old</option>
					<option value="4">Very Old</option>
				</select>
			</div>
			
			
		</div>
		
		<!-- Starting The Members Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Member</label>
			<div class="col-sm-4 col-md-6">
				<select class="form-control" name="member" required>
					<option value="">.....</option>
					<?php
	   
	   					$sql = "SELECT * FROM Users WHERE GroupID != 1";
	 					$result = mysqli_query($conn, $sql);
	   
	   					while ($row = mysqli_fetch_assoc($result))
							
							{
								echo "<option value=" . $row['UserID']. ">" . $row['Username'] . "</option>";
							}
	   
					?>
				</select>
			</div>
			
			
		</div>
		
		
		<!-- Starting The Categories Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Category</label>
			<div class="col-sm-4 col-md-6">
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
			
			<label class="col-sm-2 col-md-4 control-label">Tags</label>
			<div class="col-sm-4 col-md-6">
			<input class="form-control" type="text" name="tags" placeholder="Seperate Your Tags With Comma (,)">
			</div>
			
		</div>
			
				<!-- Starting The Image Field -->
	 	
				<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Item Picture</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="file" name="image" required>
				<span class="asterisk">*</span>
			</div>
			
			   </div>
			
			<!-- Starting The Submit Button -->
		
		<div class="form-group">
			
			<div class="col-sm-4 col-sm-offset-2 col-md-offset-4 col-md-6">
			<input type="submit" class="btn btn-success form-control" value="New Item">
			</div>
			
		</div>
		
			
		</form>
	</div>
				
	
<?php
	   
						
	   
   } else
	
	{
		
		$item_add_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
		redirect_home($item_add_error);
		
		
	}

include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/