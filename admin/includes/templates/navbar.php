<?php

// Error Reporting

ini_set('display_errors', 'on'); // Making The  'display_errors' Setting To Be On For This Project
error_reporting(E_ALL); // For Displaying All Types Of Errors



if (isset($_SESSION['Username'])) {
	
include "config.php";


$sql = "SELECT * FROM Users WHERE UserID = ". $_SESSION['ID'];
$result = mysqli_query($conn, $sql);


echo  "<div class='container'>";
 
echo "<div class='upper-bar pull-right'>";

				 			
			$row = mysqli_fetch_assoc($result);
					
		  
	  		if(! empty($row['UserImage']))
	{
		
  echo "<img alt='Profile Picture' class='my-image img-thumbnail img-circle' src='uploads\user_image\\" . $row['UserImage'] ."'>";
		
	} 
	
else
		
	{ 
		echo "<img alt='Profile Picture' class='my-image img-thumbnail img-circle' src='uploads\user_image\\" . 'no_image.png' ."'>";
	}
	
	
	  		?>

				<div class="btn-group my-info">
					<span class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<?php echo $_SESSION['Username'] ?>
						<span class="caret"></span>
					</span>
					<ul class="dropdown-menu">
					    <li><a href="../index.php">Visit Shopping</a></li>
						<li><a href="member_edit.php?userid=<?php echo $_SESSION['ID'] ?>">Edit Profile</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>

				<?php

				} else {
			?>
			<a href="login.php" class="btn btn-primary login-signup pull-right">
				Login/Signup
			</a>
			
			<?php } ?>
			
	 
		</div>
  
</div>
 

 <nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php"></a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
       <li><a href="dashboard.php">Homepage</a></li>
       
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="categories.php">Categories</a></li>
		<li><a href="items.php">Items</a></li>
        <li><a href="members.php">Members</a></li>
        <li><a href="comments.php">Comments</a></li>
      </ul>

    </div>
  </div>
</nav>