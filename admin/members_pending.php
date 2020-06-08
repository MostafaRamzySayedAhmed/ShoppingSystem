<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Members";



if(isset($_SESSION['Username']))
	
 {

	include "includes/templates/header.php";
	include "includes/templates/navbar.php";
 
	 
	 /* 
	 
	 ** The First Way Of Displaying The Pending Members
	 ** This Way Depends On One Page For Displaying Both The Total Members & The Pending Members Depending On The    HTTP Request URL
	 
	 $query = "";
	 
	 if(isset($_GET['page']) && $_GET['page'] = 'pending')
	 
	 	{
		
			$query = "AND RegistrationStatus = 0";
		
		}
		
		$sql = "SELECT * FROM Users WHERE GroupID != 1 $query";
	 
	 
	 */
	 
	 // The Second Way

	 $sql = "SELECT * FROM Users WHERE GroupID != 1 AND RegistrationStatus = 0";
	 $result = mysqli_query($conn, $sql);
	 
	  
	 
?>
	 
	<div class='container'>
	<h1 class="text-center">Pending Members</h1>
	<div class="table-responsive">
	
		<table class="table table-bordered table-hover member-table">
		
		<thead>
			<tr>
				<th>#ID</th>
				<th>Profile Picture</th>
				<th>Username</th>
				<th>E-Mail</th>
				<th>Full Name</th>
				<th>Registration Date</th>
				<th>Controls</th>
			</tr>
		</thead>
		<tbody>
		    	
		    
			<?php
							while ($row = mysqli_fetch_assoc($result)) 
							
							{
								echo "<tr>";

									echo "<td>".  $row['UserID'] . "</td>";
								if(! empty($row['UserImage']))
	{ 
		echo "<td>". "<img src='uploads\user_image\\" . $row['UserImage'] ."'>". "</td>";
	} else { echo "<td>". "<img src='uploads\user_image\\" . 'no_image.png' ."'>". "</td>"; }
									echo "<td>" . $row['Username'] . "</td>";
									echo "<td>" . $row['Email'] . "</td>";
									echo "<td>" . $row['Fullname'] . "</td>";
									echo "<td>" . $row['Date'] ."</td>";
									echo "<td>
										<a href='member_edit.php?userid=" . $row['UserID'] . "' 
										class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>
										<a href='member_delete.php?userid=" . $row['UserID'] . "'
										class='btn btn-danger'><i class='fa fa-close'></i> Delete </a>";
										if ($row['RegistrationStatus'] == 0) {
											echo "<a 
													href='member_activate.php?userid=" . $row['UserID'] . "'
													class='btn btn-info activate'>
													<i class='fa fa-key'></i> Activate</a>";
										}
									echo "</td>";
								echo "</tr>";
							}
						?>
	 		
	 		
		</tbody> 
		</table>
	</div>
	
	<a href="member_add.php" class="new-member btn btn-success">
	<i class="members-plus fa fa-plus-square"></i>New Member</a>
	
	</div>
	
<?php
	   				
	   
   } else
	
	{
	
			 include "includes/templates/header.php";
		 
			 $members_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($members_error);
			 
	}

include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/