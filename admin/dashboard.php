<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Dashboard";

if(isset($_SESSION['Username']))
	
   {
	   
	    include "includes/templates/navbar.php";
	    include "includes/templates/header.php";
	   
	   // For Getting The Number Of The Total Members
	   
	   $sql1 = "SELECT * FROM users";
	   
	   $result1 = mysqli_query($conn, $sql1); 
   	   $count1 = mysqli_num_rows($result1);
	   
	   // For Getting The Number Of The Pending Members
	   
	   $sql2 = "SELECT * FROM users WHERE RegistrationStatus = 0";
	   
	   $result2 = mysqli_query($conn, $sql2); 
   	   $count2 = mysqli_num_rows($result2);
	   
	   // For Getting The Latest Registered Members
	   
	   $sql = "SELECT * FROM users ORDER BY UserID DESC LIMIT 5";
	   $result = mysqli_query($conn, $sql); 
   	     
	   
	   // For Getting The Number Of The Total Items
	   
	   $sql3 = "SELECT * FROM items";
	   
	   $result3 = mysqli_query($conn, $sql3); 
   	   $count3 = mysqli_num_rows($result3); 
	   
	   // For Getting The Latest Items
	   
	   $sql4 = "SELECT * FROM items ORDER BY ItemID DESC LIMIT 5";
	   $result4 = mysqli_query($conn, $sql4); 
	   
	   // For Getting The Latest Comments
	   
	   $sql5 = "SELECT * FROM comments ORDER BY CommentID DESC LIMIT 5";
	   $result5 = mysqli_query($conn, $sql5); 
	   $count4 = mysqli_num_rows($result5);

?>

				<h1 class="dashboard-heading">Dashboard</h1>
				
	<div class="dashboard-statics text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="statics total-members">
						
							<h3>Total Members</h3>
							<span><a href="members.php"><?php echo $count1 ?></a></span>
						
						</div>
					</div>
					<div class="col-md-3">
						<div class="statics pending-members">
					
						
							<h3>Pending Members</h3>
							<span><a href="members_pending.php"><?php echo $count2 ?></a></span>
						
						</div>
					</div>
					<div class="col-md-3">
						<div class="statics total-items">
					
							<h3>Total Items</h3>
							<span><a href="items.php"><?php echo $count3 ?></a></span>
						
						</div>
					</div>
					<div class="col-md-3">
						<div class="statics total-comments">
						
							<h3>Total Comments</h3>
							<span><a href="comments.php"><?php echo $count4 ?></a></span>
						
						</div>
					</div>
				</div>
		</div>		
	</div>
	<div class="latest">
	<div class="container">
						<div class="row">
						<div class="first-panel">
							<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-users"></i>
									<span>Latest Registered Users</span>
									<span class="toggle-info pull-right">
										<i class="fa fa-plus fa-lg"></i>
									</span>
								</div>
								<div class="panel-body">
								<ul class="list-unstyled">
									<span>
									<?php 
			 			while ($row = mysqli_fetch_assoc($result))
									{
echo 	"<li>"; 
echo	$row['Username'];
echo	"<a href='member_edit.php?userid=" . $row['UserID'] . "' class='btn btn-success pull-right'>";
echo	"<i class ='fa fa-edit'></i>Edit</a>";
										
								if ($row['RegistrationStatus'] == 0)
								{
									echo "<a 
										href='member_activate.php?userid=" . $row['UserID'] . "' 
										class='btn btn-info pull-right'>
										<i class='fa fa-key'></i> Activate</a>";
								}
										
echo	"</li>";
									}
										?>
									</span>
									</ul>
								</div>
							</div>
						</div>
						</div>
						
						<div class="second-panel">
							<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-tag"></i>
									<span>Latest Items</span>
									<span class="toggle-info pull-right">
										<i class="fa fa-plus fa-lg"></i>
									</span>
								</div>
									<div class="panel-body">
								<ul class="list-unstyled">
									<span>
									<?php 
			 			while ($row2 = mysqli_fetch_assoc($result4))
									{
echo 	"<li>"; 
echo	$row2['ItemName'];
echo	"<a href='item_edit.php?itemid=" . $row2['ItemID'] . "' class='btn btn-success pull-right'>";
echo	"<i class ='fa fa-edit'></i>Edit</a>";
										
						if ($row2['ItemApproval'] == 0)
								{
									echo "<a 
										href='item_approve.php?itemid=" . $row2['ItemID'] . "' 
										class='btn btn-info pull-right approve'>
										<i class='fa fa-check'></i>Approve</a>";
								}		
										
echo	"</li>";
									}
										?>
									</span>
									</ul>
								</div>
							</div>
						</div>
						</div>
						
					</div>
	</div>
	
	<!-- The Latest Comments -->
	
	<div class="container">
					
						<div class="row">
										
						<div class="third-panel">
							<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-tag"></i>
									<span>Latest Comments</span>
									<span class="toggle-info pull-right">
										<i class="fa fa-plus fa-lg"></i>
									</span>
								</div>
									<div class="panel-body">
									
							<?php /* Without Making The 'Edit & Approve' Buttons */ ?>
								
									<ul class="list-unstyled">
									<span>
									<?php 
			 			$sql = "SELECT comments.*, users.Username AS Member FROM comments INNER JOIN users ON users.UserID = comments.User_ID";
	 					$result = mysqli_query($conn, $sql);
	 
	 					$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	   
	   						foreach($rows as $row)
								{
									echo "<div class='comment-box'>";
										
									echo "<span class='comment-username'>". $row['Member']. "</span>";
									
									echo "<p class='comment-content'>". $row['CommentContent']. "</p>";
									
									echo "</div>";
								}
										?>
									</span>
									</ul>
									
									<?php
	   		/* 
			
			* Making The 'Edit & Approve' Buttons
			
								<ul class="list-unstyled">
									<span>
									<?php
	   
			 			$sql = "SELECT comments.*, users.Username AS Member FROM comments INNER JOIN users ON users.UserID = comments.User_ID";
	 					$result = mysqli_query($conn, $sql);
	 
	 					$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
	   
	   						foreach($rows as $row)
								
									{
echo 	"<li>";
echo    "<div class='comment-box'>";
echo	"<span class='comment-username'>" .$row['Member']. "</span>";;
echo    "<span class='comment-content'>" .$row['CommentContent']. "</span>";
echo	"<a href='comment_edit.php?commentid=" . $row['CommentID'] . "' class='btn btn-success pull-right'>";
echo	"<i class ='fa fa-edit'></i>Edit</a>";
										
						if ($row['CommentStatus'] == 0)
								{
									echo "<a 
										href='comment_approve.php?commentid=" . $row['CommentID'] . "' 
										class='btn btn-info pull-right approve'>
										<i class='fa fa-check'></i>Approve</a>";
								}		
echo    "</div>";										
echo	"</li>";
									}
										?>
									</span>
									</ul>
									
									<?php */ ?>
									
								</div>
							</div>
						</div>
						</div>
						
					</div>
	</div>
	</div>
<?php

	   
 } else
	
	{
		
		include "includes/templates/header.php";
		
		$member_dashboard_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
		redirect_home($member_dashboard_error);
		
		
	}

include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/