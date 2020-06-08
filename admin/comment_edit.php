<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Edit Comment";



if(isset($_SESSION['Username']))
	
   {
	   
	   include "includes/templates/header.php";
	   include "includes/templates/navbar.php";
	   
	   echo "<div class='container'>";
	   echo "<h1 class='edit text-center'>Edit Comment</h1>";
	   
	   
	   if(isset($_GET['commentid']) && is_numeric($_GET['commentid']))
		   
		   {

			   $commentid = intval($_GET['commentid']);

		   }
	   
	   else
		   
		   {
			   $commentid = 0;
		   }
	   
	   
	   $sql = "SELECT * FROM comments WHERE CommentID = '{$commentid}' LIMIT 1";
	   
	   $result = mysqli_query($conn, $sql);
	   $row = mysqli_fetch_assoc($result);
	   $count = mysqli_num_rows($result);
   
				
  if ($count > 0) { ?>
				
				<!-- Starting The Editing Form -->

	
	
			<div class="container">
		<form class="form-horizontal" action="comment_update.php" method="post">
		
		
		<!-- Starting The Comment Content Field -->
		
		<div class="form-group">
		
		<input type="hidden" name="commentid" value="<?php echo $commentid; ?>">
		
			<label class="col-sm-2 col-md-4 control-label">Comment</label>
			<div class="col-sm-4 col-md-6">
				<input class="form-control" type="text" name="comment" placeholder="The Content Of The Comment"
				value="<?php echo $row['CommentContent']; ?>" required>
				<span class="asterisk">*</span>
			</div>
		
			</div>
			
			
			<!-- Starting The Status Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Status</label>
			<div class="col-sm-4 col-md-6">
				<select class="form-control" name="status">
					<option value="0" <?php if($row['CommentStatus'] == 0) echo "selected"; ?>>Spammed</option>
					<option value="1" <?php if($row['CommentStatus'] == 1) echo "selected"; ?>>Approved</option>
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
		
		
		<!-- Starting The Items Field -->
		
		<div class="form-group">
			
			<label class="col-sm-2 col-md-4 control-label">Item</label>
			<div class="col-sm-4 col-md-6">
				<select class="form-control" name="item">
					<?php
	   
	   					$sql3 = "SELECT * FROM items";
	 					$result3 = mysqli_query($conn, $sql3);
	   
	   					while ($row3 = mysqli_fetch_assoc($result3))
							
						{
						 echo "<option value=";   
					     echo $row3['ItemID'];
						      if($row['Item_ID'] == $row3['ItemID']) {echo 'selected'; }
						 echo ">";
						 echo $row3['ItemName'];
						 echo "</option>";
						}
	   
					?>
				</select>
			</div>
			
			
		</div>
			
				
			
			<!-- Starting The Submit Button -->
		
		<div class="form-group">
			
			<div class="col-sm-4 col-sm-offset-2 col-md-offset-4 col-md-6">
			<input type="submit" class="btn btn-success form-control" value="Submit">
			</div>
			
		</div>
		
			
		</form>
	</div>
				
	
<?php
				   
	}
	   
	   else 
	   
	   		{

				echo "<div class='container'>";

				$comment_edit_error = '<div class="alert alert-danger">Theres No Such ID</div>';

				redirect_home($comment_edit_error);

				echo "</div>";

			}
		
   
} 

else
	
	{
	
			 include "includes/templates/header.php";
		 
			 $comment_edit_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($comment_edit_error);
			 
	}

echo "</div>";
include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/