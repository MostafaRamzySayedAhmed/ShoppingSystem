<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Profile";

include "includes/templates/navbar.php";
include "includes/templates/header.php";

if(isset($_SESSION['User']))
	
{
	
?>

<div class="container">
	<h1 class="text-center">Profile</h1>
</div>


<div class="profile-info">
	<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Basic Info</div>
		<div class="panel-body">
		<ul class='list-unstyled'>
<?php
	
	
	if(isset($_GET['userid']) && is_numeric($_GET['userid']))
		   
		   {

			   $userid = intval($_GET['userid']);

		   }
	   
	   else
		   
		   {
			   $userid = 0;
		   }
	
$sql1 = "SELECT * FROM users WHERE UserID = '{$userid}' LIMIT 1";   
$result1 = mysqli_query($conn, $sql1);
$rows1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
	
	
	
	foreach($rows1 as $row1)
		
	{
	
	if(! empty($row1['UserImage']))
	{
		
  echo "<img alt='Profile Picture' class='profile-image img-thumbnail img-circle' src='uploads\user_image\\" . $row1['UserImage'] ."'>";
		
	} 
	
else
		
	{ 
		echo "<img alt='Profile Picture' class='profile-image img-thumbnail img-circle' src='uploads\user_image\\" . 'no_image.png' ."'>";
	}

		echo '<ul class="list-unstyled">';
					echo "<li>";
						echo '<i class="fa fa-unlock-alt fa-fw"></i>';	
						echo '<span>Login Name</span> : '.$row1['Username'];
					echo "</li>";
					echo "<li>";
						echo '<i class="fa fa-envelope-o fa-fw"></i>';	
						echo '<span>Email</span> : '.$row1['Email'];
					echo "</li>";
					echo "<li>";
						echo '<i class="fa fa-user fa-fw"></i>';	
						echo '<span>Full Name</span> : '.$row1['Fullname'];
					echo "</li>";
					echo "<li>";
						echo '<i class="fa fa-calendar fa-fw"></i>';	
						echo '<span>Registered Date</span> : '.$row1['Date'];
					echo "<li>";
		echo '</ul>';
		
	}
	
?>	
		</ul>
		
<?php
		echo "<a href='profile_edit.php?userid=" . $row1['UserID'] . "' 
										class='edit-profile btn btn-success'><i class='fa fa-edit'></i> Edit</a>";
?>
		
		</div>
	</div>
</div>
</div>


<div id="profile-ads" class="profile-ads">
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Latest ADs</div>
		<div class="panel-body">
		
<?php
	
$sql2 = "SELECT * FROM items WHERE User_ID = '{$row1['UserID']}'";   
$result2 = mysqli_query($conn, $sql2);
$rows2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
if (! empty($rows2))
	
{
	

	foreach($rows2 as $row2)
		
	{
		echo '<div class="col-sm-6 col-md-3">';
			echo '<div class="thumbnail item-box">';
				echo '<span class="price-tag">' . $row2['ItemPrice'] . '</span>';
		if($row2['ItemApproval'] == 0) {echo "<span class='not-approved'>Waiting Approval</span>";}
		else {echo "<span class='approved'>Approved</span>";}
				echo '<div class="caption">';
					echo "<h3><a href='item.php?itemid=" . $row2['ItemID'] . "'>". $row2['ItemName'] ."</a></h3>";
					echo '<p>' . $row2['ItemDescription'] . '</p>';
					echo "<p class='date'>" . $row2['ItemDate'] . '</p>';
				echo '</div>';
			echo '</div>';
		echo '</div>';	
	}
	
}
	
else
	
{
	
	echo "<div class='text-center'>There Are No Items To Show, Create <a href='item_add'>New AD</a></div>";
	
}
	
?>	
	
		</div>
	</div>
</div>	
</div>


<div class="profile-comments">
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Latest Comments</div>
		<div class="panel-body">
		
<?php
	
$sql3 = "SELECT * FROM comments WHERE User_ID = '{$row1['UserID']}' AND CommentStatus = 1";   
$result3 = mysqli_query($conn, $sql3);
$rows3 = mysqli_fetch_all($result3,MYSQLI_ASSOC);

if (! empty($rows3))
	
{
		
	foreach($rows3 as $row3)
		
	{
		echo "<ul>";
		echo "<li>".$row3['CommentContent']."</li>";
		echo "</ul>";
	}
		
}
	
else
	
{
	
		echo "<div class='text-center'>There Are No Comments To Show</div>";
	
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
	
	header('location: login.php');
	exit();
	
}
	include "includes/templates/fotter.php"; 

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/