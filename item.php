<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Show Item";

include "includes/templates/header.php";
include "includes/templates/navbar.php";



if(isset($_SESSION['User']))
	
{
	
	
/*

* if(isset($_SESSION['Username']))

* This Condition Is Not Needed Here Because This AD Of Item Will Be Displayed For All Users Whether They Are Registered Or Not	
 
*/
 
   
	   if(isset($_GET['itemid']) && is_numeric($_GET['itemid']))
		   
		   {

			   $itemid = intval($_GET['itemid']);

		   }
	   
	   else
		   
		   {
			   $itemid = 0;
		   }

	if(isset($_GET['itemname']) && is_string($_GET['itemname']))
		   
		   {

			   $itemname = $_GET['itemname'];

		   }
	   
	   else
		   
		   {
			   $itemname = "";
		   }

echo "<div class='container item-info'>";
echo "<h1 class='text-center'>$itemname</h1>";

	 $sql = "SELECT items.* , categories.CategoryName AS 'Category Name', users.Username AS Member FROM items INNER JOIN categories ON categories.CategoryID = items.Category_ID INNER JOIN users ON users.UserID = items.User_ID WHERE ItemID = '{$itemid}' AND ItemApproval = 1";
	 $result = mysqli_query($conn, $sql);
	 $count = mysqli_num_rows($result);

/* For Getting The Categories With CategoryComments Coulmn Value Equals 1 Which Means That Comments Are Disabled In These Categories */

	$sql2 = "SELECT CategoryID FROM categories WHERE CategoryComments = 1";
	$result2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_assoc($result2);

/*
	$rows2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

	foreach($rows2 as $row2)
	{
		
	}
*/

/* For Getting The Items That Are Related To The Categories With CategoryComments Coulmn Value Equals 1 Which Means That Comments Are Disabled For Items In These Categories */

	$sql3 = "SELECT * FROM items WHERE Category_ID =". $row2['CategoryID'];
	$result3 = mysqli_query($conn, $sql3);
	$row3 = mysqli_fetch_assoc($result3);

/* Checking If The ID Of The Item That IS Accessed Equals To Any Of The Items IDs That Are Related To The Categories That Comments Disabled In */

	if($itemid == $row3['ItemID'])
		{
			$comments_disabled = "<div class='alert alert-danger'>Cemments Are Disabled For This Item !</div>";
		}

/*
	$rows3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

	foreach($rows3 as $row3)
	{
		if($itemid == $row3['ItemID'])
		{
			$comments_disabled = "<div class='alert alert-danger'>Cemments Are Disabled For This Item !</div>";
		}
	}
*/

	 if($count > 0 )
	 {
		 $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		 foreach($rows as $row)
		 {
			 
			 echo "<div class='row'>";
			 echo "<div class='col-md-3'>";
			 
			 if(! empty($row['ItemImage']))
	{
		
  echo "<img alt='Item Picture' class='item-image img-thumbnail' src='uploads\item_image\\" . $row['ItemImage'] ."'>";
		
	} 
	
else
		
	{ 
		echo "<img alt='Item Picture' class='item-image img-thumbnail' src='uploads\item_image\\" . 'no_image.png' ."'>";
	}
			 
			 echo "</div>";
			 echo "<div class='col-md-9'>";
			 echo "<h2>". $row['ItemName']. "</h2>";
			 echo "<p>". $row['ItemDescription']. "</p>";
			 echo '<ul class="list-unstyled">';
					echo "<li>";
						echo '<i class="fa fa-money fa-fw"></i>';	
						echo '<span>Price</span> : '.$row['ItemPrice']. "$";
					echo "</li>";
					echo "<li>";
						echo '<i class="fa fa-building fa-fw"></i>';	
						echo '<span>Country</span> : '.$row['ItemCountry'];
					echo "</li>";
					echo "<li>";
						echo '<i class="fa fa-calendar fa-fw"></i>';	
						echo '<span>Added Date</span> : '.$row['ItemDate'];
					echo "</li>";
			 		echo '<li>';
			 			echo '<i class="fa fa-tags fa-fw"></i>';
			 			echo '<span>Price</span> : ';
			  /*
					echo '<a href="categories.php?catid=' . $row['Category_ID']. ' 
							&catname='.$row['Category Name'].' ">' . $row['Category Name'] . '</a>';
			*/	
					echo "<a href=categories.php?catid=";
					echo $row['Category_ID'];
					echo "&catname=";
					echo $row['Category Name'];
					echo ">";
					echo $row['Category Name'];
					echo "</a>";
			 
					echo '</li>';
			 		echo "<li>";
						echo '<i class="fa fa-user fa-fw"></i>';	
						echo '<span>User</span> : '. "<a href='profile.php?userid=" . $row['User_ID'] . "'>". $row['Member']. "</a>";
					echo "</li>";
			 
			 
			 
			 if($row['ItemStatus'] == 1)
				{
					echo "<li>";
					echo '<i class="fa fa-chain fa-fw"></i>';
					echo "<span>Status</span> : " . str_replace($row['ItemStatus'], "New", $row['ItemStatus']);
					echo "</li>";
				}
			 if($row['ItemStatus'] == 2)
				{
					echo "<li>";
					echo '<i class="fa fa-chain fa-fw"></i>';
					echo "<span>Status</span> : " . str_replace($row['ItemStatus'], "Like New", $row['ItemStatus']);
					echo "</li>";
				}
			 if($row['ItemStatus'] == 3)
				{
					echo "<li>";
					echo '<i class="fa fa-chain fa-fw"></i>';
					echo "<span>Status</span> : " . str_replace($row['ItemStatus'], "Old", $row['ItemStatus']);
					echo "</li>";
				}
			 if($row['ItemStatus'] == 4)
				{
					echo "<li>";
					echo '<i class="fa fa-chain fa-fw"></i>';
					echo "<span>Status</span> : " . str_replace($row['ItemStatus'], "Very Old", $row['ItemStatus']);
					echo "</li>";
				}
			 
			 
			 $tags = $row['ItemTags'];
			 $tags_without_spaces = str_replace(" ", "", $tags);
			 $tags_with_lowercase = strtolower($tags_without_spaces);
			 $tags_cleaned_array = explode(",", $tags_with_lowercase);

				 echo "<li class='tags-items'>";
				 echo "<i class='fa fa-user'></i>";
				 echo "<span>Tags</span>"; 
			 
			 foreach($tags_cleaned_array as $tag)
				 
			 {
				
				 echo "<a href=tags.php?tag=";
				 echo $tag;
				 echo ">";
				 echo strtoupper($tag);
				 echo "</a>"; 
			 }
			 
			 
		echo '</ul>';
			 echo "</div>";
			 echo "</div>";
			 
			 echo "<a href='item_edit.php?itemid=" . $row['ItemID'] . "' 
										class='edit-item btn btn-success'><i class='fa fa-edit'></i> Edit</a>";
			 
			 echo "<hr class='custom-hr'>";
			 
			 if(isset($_SESSION['User']))
	
			 {
				 
				 // Checking If Comments Are Disabled For The Item That Is Already Accessed
				 
	 			if(!isset($comments_disabled))
					
				{
					
			 echo "<div class='container'>";
			 echo "<div class='row'";
			 echo "<div class='col-md-offset-3'>";
			 echo "<div class='add-comment'>";
			 echo "<h2>Add Comment</h2>";
	?>
			<form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $row['ItemID'] ?>" method="POST">
	<?php			 
			 echo "<textarea name='comment' required></textarea>";
			 
			 echo "<input type='submit' class='col-md-offset-3 btn btn-primary' value='Add Comment'>";
			 echo "</form>";
				 
			 if($_SERVER["REQUEST_METHOD"] == "POST")
				 {
					$filtered_comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
					$user_comment = $_SESSION['UserID'];
					$item_comment = $row['ItemID'];
					 
					$sql_comment_insert = "INSERT INTO comments (CommentContent, CommentStatus, Date, Item_ID, User_ID) VALUES ('$filtered_comment', 0, now(), '$item_comment', '$user_comment')";
					 
					if(mysqli_query($conn, $sql_comment_insert))
				{
					echo "<div class='alert alert-success message'>Record Inserted Successfully</div>";
					
				} else {
					
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					
				}

					 
				 }
				 
			 echo "</div>";
			 echo "</div>";
			 echo "</div>";
			
			 
		 
			 }
				 else {echo $comments_disabled; }
			 }
			 
			 else
				 {
					 echo "Please Make a <a href='login.php'>Login</a> To Comment";
				 }
			 
			 
			 echo "<hr class='custom-hr'>";
			 
			 
			 $sql_comment_select = "SELECT comments.*, users.Username AS Member FROM comments INNER JOIN users ON users.UserID = comments.user_id WHERE Item_ID = '{$itemid}' AND CommentStatus = 1 ORDER BY CommentID DESC";
			 
			 $result_comment_select = mysqli_query($conn, $sql_comment_select);
			 $count_comment_select = mysqli_num_rows($result_comment_select);
			 $comments = mysqli_fetch_all($result_comment_select, MYSQLI_ASSOC);
			 
			 
			 echo "<div class='row'>";
			 
			 echo "<div class='col-md-12'>";
			 
			 
			 if($count_comment_select > 0)
			 {
				foreach($comments as $comment)
			 {	
				 echo "<div class='comment-box'>";
				 echo "<div class='row'>";
				 echo "<div class='col-md-2'>".
					 "<img src='img.png' class='img-responsive img-thumbnail center-block img-circle'>".
					 "<span>".$comment['Member'].
					 "</span></div>";
				 echo "<div class='col-md-10'><p class='lead'>".$comment['CommentContent']."</p></div>";
				 
				 echo "</div>";
				 echo "<hr class='custom-hr'>";
				 echo "</div>";
				 
				/* 
				 echo "<span class='col-md-3'>" .$comment['Member']. "</span>";
				 echo "<span class=' col-md-6'>" .$comment['CommentContent']. "</span>";
				*/
			 }
				 
			 } else
				 
			 {
				 echo "<div class='alert alert-danger'>There Are No Comments To Show For This Item</div>";
			 }
				 
			 
				 
			 
			 echo "</div>";
			 echo "</div>";
			 
		 }
		 
	 } else
		 
	 {
		 echo "<div class='alert alert-danger'>Theres No Such ID Or This Item Has Not Been Approved Yet</div>";
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