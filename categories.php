<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Items";


include "includes/templates/header.php";
include "includes/templates/navbar.php";


if(isset($_SESSION['User']))
	
   {


if(isset($_GET['catid']) && is_numeric($_GET['catid']))
		   
		   {

			   $catid = intval($_GET['catid']);

		   }
	   
	   else
		   
		   {
			   $catid = 0;
		   }

	if(isset($_GET['catname']) && is_string($_GET['catname']))
		   
		   {

			   $catname = $_GET['catname'];

		   }
	   
	   else
		   
		   {
			   $catname = "";
		   }
	   
	   
	   
	   echo "<div class='container'>";
	   echo "<h1 class='text-center'>$catname</h1>";
	   
	   
	   $sql = "SELECT * FROM items WHERE Category_ID = '{$catid}'";
	   
	   $result = mysqli_query($conn, $sql);
	   $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
	   $count = mysqli_num_rows($result);
				
  if ($count > 0) {
	  
foreach($rows as $row)
	
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
				echo "<p class='date'>" . $row['ItemDate'] . '</p>';
				echo '</div>';
			echo '</div>';
	echo '</div>';
	
}

echo "</div>";
echo "</div>";
	  
}
	   else
		   
	   {
		   
	  echo "<div class='container'>";
	  echo "<div class='alert alert-danger'>There Are No Items In This Category, 
	  Or This Category Is Not Existed</div>";
	  echo "<div>";
		   
  	   }





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