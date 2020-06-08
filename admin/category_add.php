<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Add Category";



if(isset($_SESSION['Username']))
	
   {
	   
	   include "includes/templates/header.php";
	   include "includes/templates/navbar.php";
	   
	  
				
    ?>
				
				<!-- Starting The Adding Form -->
		
	<h1 class="edit text-center">Add Category</h1>
	
	
	
	<div class="container">
		<form class="form-horizontal" action="category_insert.php" method="post">
		
		
		<!-- Starting The CategoryName Field -->
		
		<div class="form-group">
		
			<label class="col-sm-2 col-md-4 control-label">Category Name</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="categoryname" autocomplete="off" placeholder="The Name Of The Category" required>
				<span class="asterisk">*</span>
			</div>
		
			</div>
			
			<!-- Starting The Description Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Description</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="description" placeholder="The Discription Of The Category">
			</div>
			
		</div>
		
		
			
			<!-- Starting The Order Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Order</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="order" placeholder="The Order Of The Category">
			</div>
			
			
		</div>
		
		<!-- Starting The Parent Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Parent !</label>
			<div class="col-sm-4 col-md-6">
				<select class="form-control" name="parent" required>
					<option value="0">None</option>
					<?php
	   
	   					$sql = "SELECT * FROM categories WHERE CategoryParent = 0";
	 					$result = mysqli_query($conn, $sql);
	   
	   					while ($row = mysqli_fetch_assoc($result))
							
							{
								echo "<option value=" . $row['CategoryID']. ">" . $row['CategoryName'] . "</option>";
							}
	   
					?>
				</select>
			</div>
			
			
		</div>
		
		
			<!-- Starting The Visiblity Field -->
			
				<div class="form-group form-group-lg">
			
			<label class="col-sm-2 col-md-4 control-label">Visible</label>
			<div class="col-sm-10 col-md-6">
				<div>
					<input type="radio" name="visibility" value="0" id="visible-yes" checked>
					<label for="visible-yes">Yes</label>
				</div>
					
				<div>
					<input type="radio" name="visibility" value="1" id="visible-no">
					<label for="visible-no">No</label>
				</div>
			</div>
			
				</div>
				
				<!-- Starting The ADs Field -->
			
				<div class="form-group form-group-lg">
			
			<label class="col-sm-2 col-md-4 control-label">Allow ADs</label>
			<div class="col-sm-10 col-md-6">
				<div>
					<input type="radio" name="ads" value="0" id="visible-yes" checked>
					<label for="visible-yes">Yes</label>
				</div>
					
				<div>
					<input type="radio" name="ads" value="1" id="visible-no">
					<label for="visible-no">No</label>
				</div>
			</div>
			
				</div>
				
				<!-- Starting The Comments Field -->
			
				<div class="form-group form-group-lg">
			
			<label class="col-sm-2 col-md-4 control-label">Allow Comments</label>
			<div class="col-sm-10 col-md-6">
				<div>
					<input type="radio" name="comments" value="0" id="visible-yes" checked>
					<label for="visible-yes">Yes</label>
				</div>
					
				<div>
					<input type="radio" name="comments" value="1" id="visible-no">
					<label for="visible-no">No</label>
				</div>
			</div>
			
				</div>
				
			
			<!-- Starting The Submit Button -->
		
		<div class="form-group">
			
			<div class="col-sm-4 col-sm-offset-2 col-md-offset-4 col-md-6">
			<input type="submit" class="btn btn-success form-control" value="Add Category">
			</div>
			
		</div>
		
			
			
		</form>
	</div>
				
	
<?php
	   
						
	   
   } else
	
	{
		
		$category_add_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
		redirect_home($category_add_error);
		
		
	}

include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/