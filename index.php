<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Home";

include "includes/templates/navbar.php";
include "includes/templates/header.php";


	
if(isset($_SESSION['User']))
{
	 
	
	 echo "<div class='container'>";
	  
	   
$sql = "SELECT * FROM items ORDER BY ItemID DESC";
	   
	   $result = mysqli_query($conn, $sql);
	   $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
	   $count = mysqli_num_rows($result);
				
  if ($count > 0) {
	  
foreach($rows as $row)
	
	if(($row['User_ID'] == $_SESSION['UserID']) or (($row['User_ID'] != $_SESSION['UserID']) and $row['ItemApproval'] = 1))
		
{
	
	echo '<div class="col-sm-6 col-md-3">';
			echo '<div class="thumbnail item-box">';
				echo '<span class="price-tag">' . $row['ItemPrice'] . '$'. '</span>';
	if($row['ItemApproval'] == 0) {echo "<span class='not-approved'>Waiting Approval</span>";}
	else {echo "<span class='approved'>Approved</span>";}
				echo '<div class="caption">';
					echo "<h3>";
				echo "<a href=item.php?itemid=";
				echo $row['ItemID'];
				echo "&itemname=";
				echo $row['ItemName'];
				echo ">";
				echo $row['ItemName'];
				echo "</a></h3>";
				echo '<p>' . $row['ItemDescription'] . '</p>';
				echo "<p class='item-date'>" . $row['ItemDate'] . '</p>';
				echo '</div>';
			echo '</div>';
	echo '</div>';
	
}


echo "</div>";
	  
}
	   else
		   
	   {
		   
	  echo "<div class='container'>";
	  echo "<div class='alert alert-danger'>There Are No Items To Show</div>";
	  echo "<div>";
		   
  	   }

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