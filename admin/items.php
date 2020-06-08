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



if(isset($_SESSION['Username']))
	
 {

	include "includes/templates/header.php";
	include "includes/templates/navbar.php";
	 
	 
	 $sql = "SELECT items.* , categories.CategoryName AS 'Category Name', users.Username AS Member FROM items INNER JOIN categories ON categories.CategoryID = items.Category_ID INNER JOIN users ON users.UserID = items.User_ID ORDER BY ItemID DESC";
	 $result = mysqli_query($conn, $sql);
	 
	  
	 
?>
	 
	<div class='container'>
	<h1 class="text-center">Items</h1>
	
	<div class="table-responsive">
	
		<table class="table table-bordered table-hover item-table">
		
		<thead>
			<tr>
				<th>#ID</th>
				<th>Item Picture</th>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Date Added</th>
				<th>Category</th>
				<th>Member</th>
				<th>Controls</th>
			</tr>
		</thead>
		<tbody>
		    	
		    
			<?php
							while ($row = mysqli_fetch_assoc($result)) 
							
							{
								echo "<tr>";

									echo "<td>".  $row['ItemID'] . "</td>";
								if(! empty($row['ItemImage']))
	{ 
		echo "<td>". "<img src='uploads\item_image\\" . $row['ItemImage'] ."'>". "</td>";
	} else { echo "<td>". "<img src='uploads\item_image\\" . 'no_image.png' ."'>". "</td>"; }
									echo "<td>" . $row['ItemName'] . "</td>";
									echo "<td>" . $row['ItemDescription'] . "</td>";
									echo "<td>" . $row['ItemPrice'] . "</td>";
									echo "<td>" . $row['ItemDate'] ."</td>";
									echo "<td>" . $row['Category Name'] ."</td>";
									echo "<td>" . $row['Member'] ."</td>";
									echo "<td>
										<a href='item_edit.php?itemid=" . $row['ItemID'] . "' 
										class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>
										<a href='item_delete.php?itemid=" . $row['ItemID'] . "'
										class='item-delete btn btn-danger'><i class='fa fa-close'></i> Delete</a>";
									if ($row['ItemApproval'] == 0) {
											echo "<a 
													href='item_approve.php?itemid=" . $row['ItemID'] . "' 
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
	
	<a href="item_add.php" class="new-member btn btn-success">
	<i class="members-plus fa fa-plus-square"></i>New Item</a>
	
	</div>
	
<?php
	   				
	   
   } else
	
	{
	
			 include "includes/templates/header.php";
		 
			 $items_error = "<span class='message-error alert alert-danger'>You Are Not Permited To Access This Page Directly</span>";
			 
			 redirect_home($items_error);
			 
	}

include "includes/templates/fotter.php";

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/