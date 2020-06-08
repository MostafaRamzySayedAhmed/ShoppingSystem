<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Categories";


include "includes/templates/header.php";
include "includes/templates/navbar.php";


if(isset($_SESSION['Username']))
	
 {

	
	 
	 $sort = "ASC";
	 $sorting = array("ASC", "DESC");
	 
	 if(isset($_GET['sort']) && in_array($_GET['sort'], $sorting))
	 {
		 $sort = $_GET['sort'];
	 }
	 else
	 {
		 $sort = "ASC";
	 }
 		 
   	 $sql = "SELECT * FROM categories WHERE CategoryParent = 0 ORDER BY CategoryOrder $sort";
	 $result = mysqli_query($conn, $sql);
	 
	 ?>
  				    
  				    
  		<div class="container categories">
  			<h1 class="text-center">Categories</h1>
  			<div class="panel panel-default">
  				<div class="panel-heading">
					<i class="fa fa-edit"></i>Categories
  				<div class="option pull-right">
							<i class="fa fa-sort"></i> Ordering: [
							<a class="<?php if ($sort == 'ASC') { echo 'active'; } ?>" href="?sort=ASC">ASC</a> | 
							<a class="<?php if ($sort == 'DESC') { echo 'active'; } ?>" href="?sort=DESC">DESC</a> ]
							<i class="fa fa-eye"></i> View: [
							<span class="active" data-view="full">Full</span> |
							<span data-view="classic">Classic</span> ]
						</div>
  				</div>
  				<div class="panel-body">
  					<?php  
	 					
	 						while ($row = mysqli_fetch_assoc($result))
							{
								echo "<div class='category'>";
								echo "<div class='category-buttons pull-right'>";
								echo "<a href='category_edit.php?catid=" . $row['CategoryID'] . "' class='btn btn-primary'><i class='fa fa-edit'></i>Edit</a>";
								echo "<a href='category_delete.php?catid=" . $row['CategoryID'] . "' class='category-delete btn btn-danger'><i class='fa fa-close'></i>Delete</a>";
								echo "</div>";
								echo "<h3>". $row['CategoryName']. "</h3>";
								echo "<div class='full-view'>";
								echo "<p>";
									if($row['CategoryDescription'] == '')
										{echo "This Category Has No Description";} 
									else 
										{echo $row['CategoryDescription']; }
								echo "</p>";
									if($row['CategoryVisibility'] == 1) 
									{echo "<span class='category-hidden'>Hidden</span>";}
									else {echo "<span class='category-visibile'>Visibile</span>";}
									if($row['CategoryADs'] == 1) 
									{echo "<span class='category-advertising-no'>ADs Disabled</span>";}
									else {echo "<span class='category-advertising-yes'>ADs Enabled</span>";}
									if($row['CategoryComments'] == 1) 
									{echo "<span class='category-comments-no'>Comments Disabled</span>";}
									else {echo "<span class='category-comments-yes'>Comments Enabled</span>";}
								
								
								// Getting Subcategories OF Main Categories
								
								$sql_subcategory = "SELECT * FROM categories WHERE CategoryParent =". $row['CategoryID'];
								$result_subcategory = mysqli_query($conn, $sql_subcategory);
								$rows_subcategory = mysqli_fetch_all($result_subcategory, MYSQLI_ASSOC);
									  
									  if(! empty($rows_subcategory))
									  {
										 echo "<div class='sub-categories'>";
										 echo "<h4>Sub-Categories</h4>";
								      	 echo "<ul class='list-unstyled'>";
									  	 foreach($rows_subcategory as $row_subcategory)

											 {
												echo "<li class='show'>";
												 	?>
												 	
	<?php echo "<span style='color: #FFF; background-color: #000; padding: 3px ; border-radius: 5px'>". $row_subcategory['CategoryName']. "</span>"; ?>
										
										<?php
												 
										if($row['CategoryDescription'] == '')
										{echo "<span class='subcategory-description'>This Sub-Category Has No Description</span>";} 
									    else 
										{echo "<span class='subcategory-description'>". $row_subcategory['CategoryDescription'] ."</span>"; }
										
									if($row_subcategory['CategoryVisibility'] == 1) 
									{echo "<span class='subcategory-hidden'>Hidden</span>";}
									else {echo "<span class='subcategory-visibile'>Visibile</span>";}
									if($row_subcategory['CategoryADs'] == 1) 
									{echo "<span class='subcategory-advertising-no'>ADs Disabled</span>";}
									else {echo "<span class='subcategory-advertising-yes'>ADs Enabled</span>";}
									if($row_subcategory['CategoryComments'] == 1) 
									{echo "<span class='subcategory-comments-no'>Comments Disabled</span>";}
									else {echo "<span class='subcategory-comments-yes'>Comments Enabled</span>";}
												 
										?>
										
	<a class='confirm' href="category_edit.php?catid= <?php echo $row_subcategory['CategoryID'] ?> ">Edit</a>
	<a class='confirm subcategory-delete' href="category_delete.php?catid= <?php echo $row_subcategory['CategoryID'] ?> ">Delete</a>
											 		
												 	<?php
												echo "</li>";
											 }
								
									  	 echo "</ul>";
										 echo "</div>";
									  }
								  
								echo "</div>";
								echo "<hr>";
								echo "</div>";
								
							}
	 		
					?>
					
					
  				</div>
				
					
				
  			</div>
  			
  					<a href="category_add.php" class="btn btn-success new-category">
					<i class="fa fa-plus-square"></i>New Category</a>
					   
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