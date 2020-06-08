<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Comments";



if(isset($_SESSION['Username']))
	
 {

	include "includes/templates/header.php";
	include "includes/templates/navbar.php";
 
	 
	 $sql = "SELECT comments.* , items.ItemName AS 'Item Name', users.Username AS Member FROM comments INNER JOIN items ON items.ItemID = comments.Item_ID INNER JOIN users ON users.UserID = comments.User_ID ORDER BY CommentID DESC";
	 $result = mysqli_query($conn, $sql);
	 
	  
	 
?>
	 
	<div class='container'>
	<h1 class="text-center">Comments</h1>
	
	<div class="table-responsive">
	
		<table class="table table-bordered table-hover comment-table">
		
		<thead>
			<tr>
				<th>#ID</th>
				<th>Comments</th>
				<th>Date</th>
				<th>Member</th>
				<th>Item</th>
				<th>Controls</th>
			</tr>
		</thead>
		<tbody>
		    	
		    
			<?php
							while ($row = mysqli_fetch_assoc($result)) 
							
							{
								echo "<tr>";

									echo "<td>".  $row['CommentID'] . "</td>";
									echo "<td>" . $row['CommentContent'] . "</td>";
									echo "<td>" . $row['Date'] . "</td>";
									echo "<td>" . $row['Member'] . "</td>";
									echo "<td>" . $row['Item Name'] ."</td>";
									echo "<td>
										<a href='comment_edit.php?commentid=" . $row['CommentID'] . "' 
										class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>
										<a href='comment_delete.php?commentid=" . $row['CommentID'] . "'
										class='comment-delete btn btn-danger'><i class='fa fa-close'></i> Delete</a>";
									if ($row['CommentStatus'] == 0) {
											echo "<a 
													href='comment_approve.php?commentid=" . $row['CommentID'] . "' 
													class='btn btn-info approve'>
													<i class='fa fa-check'></i>Approve</a>";
										}
									echo "</td>";
								echo "</tr>";
							}
						?>
	 		
	 		
		</tbody> 
		</table>
	</div>
	
	
	</div>
	
<?php
	   				
	   
   } else
	
	{
	
			 include "includes/templates/header.php";
		 
			 $comments_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($comments_error);
			 
	}

include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/