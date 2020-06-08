<?php

include "config.php";
		  
		  	  $sql = "SELECT * FROM categories WHERE CategoryParent = 0";
			  $result = mysqli_query($conn, $sql);
			  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		  
		      foreach($rows as $row)
				
			 {
				echo "<li>";
				echo "<a href=categories.php?catid=";
				echo $row['CategoryID'];
				echo "&catname=";
				echo $row['CategoryName'];
				echo ">";
				echo $row['CategoryName'];
				echo "</a></li>";
			 }

?>