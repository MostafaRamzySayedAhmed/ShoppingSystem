<?php

/* 
** ob_start(ob_gzhandler());
* ob_start(): Outbut Buffering => For Storing The Output Of The Script On The Server Other Than Headers, This Method Is Used To Avoid The Header Method Problems.
* ob_gzhandler(): For Compressing The Output Of The Script Before Sending It To The Server Other Than Headers,    This Callback Method Is Used To Gain Some Speed On Sending The Output To The Server Specially On Large-Sized Scripts Stored On Memory.
* Turning On The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/

session_start();

$title = "Login";

include "includes/templates/header.php";

/* Preventing The Login Page To Be Reviewed To The User That Has Recently Logged In
 By Directing Him To His Dashboard */

include "config.php";

// The Name Of The Session Of The User Must Be Different Than The Name Of The Session Of The Admin

if(isset($_SESSION['User']))
   {
	header('location: index.php');
	exit();
   }

// Checking If The User Is Accessing The Homepage By 'POST' Request Method

	if($_SERVER['REQUEST_METHOD'] == 'POST')
		
		{
			// This Part Will Be Executed If The Login Form Was Submitted
			
			if(isset($_POST['login']))
			{
				$username = $_POST['username'];
				$password = $_POST['password'];
				$sql = "SELECT UserID, Username, Password FROM Users WHERE Username = '{$username}' && Password = '{$password}'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$count = mysqli_num_rows($result);
				if($count > 0)
					{
						$_SESSION['User'] = $row['Username']; // Register Session Name
						$_SESSION['UserID'] = $row['UserID']; // Register Session ID
						header('location: index.php'); // Redirecting The User To The Index Page
						exit();
					}
				
				// This Part Will Be Executed If The Signup Form Was Submitted
				
			}else
			{
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$fullname = $_POST['fullname'];
				
				$form_errors = array();
				
				// Checking If The Username Filed Was Set
				
				if(isset($_POST['username']))
				{
					$filtered_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
					if(strlen($filtered_username) < 4)
					{
						$form_errors[] = "The Username Must Be Greater Than Four Characters";
					}
				}
				
				// Checking If There Is Matching Between The Two Input Passwords
				
				if(isset($_POST['password']) && $_POST['password2'])
				{
					if(empty($_POST['password']))
					{
						$form_errors[] = "The Password Can/'t Empty";
					}
					
					if($passwor !== $password2)
					{
						$form_errors[] = "The Passwords Must Be Matched";
					}
				}
				
				// Checking If The Email Field Was Set
				
				if(isset($_POST['email']))
				{
					$filtered_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
					
					if(filter_var($filtered_email, FILTER_VALIDATE_EMAIL) != true)
					{
						$form_errors[] = "This Email Is Not Valid";
					}
				}
				
				
				$image          = $_FILES['image']; /* Array ( [name] => Personal Photo.jpg [type] => image/jpeg 
										[tmp_name] => C:\xampp\tmp\phpCCB9.tmp [error] => 0 [size] => 57712 ) */
				$image_name     = $image['name']; /* Photo.jpg */
				$image_type     = $image['type']; /* image/jpeg */
				$image_tmp_name = $image['tmp_name']; /* C:\xampp\tmp\phpEFDB.tmp */
				$image_size     = $image['size']; /* 57712 */ // In Bytes

			 /* The Allowed Extensions Of Images That Are Going To Be Uploaded */
				 $image_extensions = array("jpg", "jpeg", "png", "gif");

				 $image_extension_eploded = explode('.', $image_name); /* jpg */
				 $image_extension_ended = end($image_extension_eploded);
				 $image_extension = strtolower($image_extension_ended);
				
	  if(empty($image_name))
		 {
			 echo '<div class="alert alert-danger">The Picture Field <strong>Can NOT Be Empty</strong></div>';
		 }
	  if(!empty($image_name) && !in_array($image_extension, $image_extensions))
		 {
			 echo '<div class="alert alert-danger">This Extension Is <strong>NOT Allowed</strong> - The Aloowed Extensions Are: jpg, jpeg, png, gif</div>';
		 }
	 if($image_size > 2097152)
		 {
			 echo '<div class="alert alert-danger">The Picture Size <strong>Can NOT Exceed 2MB</strong></div>';
		 }
				
			}
			
			
			$query = "SELECT Username FROM Users WHERE Username = '{$username}' ";
			$result = mysqli_query($conn, $query);
			$count = mysqli_num_rows($result);

			if($count > 0)
			  {
				 $form_errors[] = "This Username Is Already Existed, Please Select Another One";
			  }
			
			
			if(empty($form_errors))
				
			{
				
				/* Giving Random Name To The Image Name That Is Uploaded With For Avoiding Any Conflict That Can Occur On The Server Because Of The Same Names Of Images That Are Going To Be Uploaded */
				$image_name_random = rand(1, 1000000000). "_". $image_name;
				
				/* Moving The Image To This Defined Destination On The Server */
				move_uploaded_file($image_tmp_name, "uploads\user_image\\".$image_name_random);
				
				$sql = "INSERT INTO users (Username, Password, Email, Fullname, RegistrationStatus, Date, UserImage) VALUES ('$username', '$password', '$email', '$fullname', 0, now(), '$image_name_random')";
				
				
				if(mysqli_query($conn, $sql))
				{
					$message_success = "Record Inserted Successfully";

				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}	

			} 

		}

?>

<div class="container login-page">
	<h1 class="text-center">
		<span class="selected" data-class="login">Login</span> | 
		<span data-class="signup">Signup</span>
	</h1>
	
	<!-- Start The 'Login' Form -->
	
	<!-- Starting The Username Field -->
	
	<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<div class="input-container">
			<input 
				class="form-control" 
				type="text" 
				name="username" 
				autocomplete="off"
				placeholder="Type Your Username"
				required />
				<span class="asterisk">*</span>
		</div>
		
		<!-- Starting The Password Field -->
		
		<div class="input-container">
			<input 
				class="form-control" 
				type="password" 
				name="password" 
				autocomplete="off"
				placeholder="Type Your Password" 
				required />
				<span class="asterisk">*</span>
		</div>
		<input class="btn btn-primary btn-block" name="login" type="submit" value="Login" />
	</form>
	
	<!-- Starting The 'Signup' Form -->
	
	<form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
		
		<!-- Starting The Username Field -->
		
		<div class="input-container">
			<input 
				pattern={4,}
				title="The Username Must Be Greater Than Three Characters"
				class="form-control" 
				type="text" 
				name="username" 
				autocomplete="off"
				placeholder="Type Your Username" 
				required />
				<span class="asterisk">*</span>
		</div>
		
		<!-- Starting The Password Field -->
		
		<div class="input-container">
			<input 
				minlength={6}
				title="The Password Must Be Greater Than Five Characters" 
				class="form-control"
				type="password" 
				name="password" 
				autocomplete="off"
				placeholder="Type a Complex Password" 
				required />
				<span class="asterisk">*</span>
		</div>
		
		<!-- Starting The Confirming Password Field -->
		
		<div class="input-container">
			<input 
				minlength={6}
				title="The Password Must Be Greater Than Five Characters" 
				class="form-control" 
				type="password" 
				name="password2" 
				autocomplete="off"
				placeholder="Type Your Password Again" 
				required />
				<span class="asterisk">*</span>
		</div>
		
		<!-- Starting The Email Field -->
		
		<div class="input-container">
			<input 
				class="form-control" 
				type="email" 
				name="email" 
				placeholder="Type a Valid Email" required/>
				<span class="asterisk">*</span>
		</div>
		
		<!-- Starting The Fullname Field -->
		
		<div class="input-container">
			<input 
				class="form-control" 
				type="text" 
				name="fullname" 
				placeholder="Type Your Full Name"/>
		</div>
			
			<!-- Starting The Image Field -->
			
				<div class="input-container">
				<input class="form-control" type="file" name="image" required>
				<span class="asterisk">*</span>
				</div>
				
				<!-- Starting The Submit Field -->
				
		<input class="btn btn-success btn-block" name="signup" type="submit" value="Signup" />
	</form>
	
	
	<div class="the-errors text-center">
		<?php 

			if (!empty($form_errors)) {

				foreach ($form_errors as $error) {

					echo '<div class="msg error">' . $error . '</div>';

				}

			}

			if (isset($message_success)) {

				echo '<div class="msg success">' . $message_success . '</div>';

			}

		?>
	</div>
</div>

<?php 
	  include "includes/templates/fotter.php"; 

/*
** ob_end_flush();
* Cleaning The Output Buffer & Turning Off The Buffering Of The Output.
* This Is The Right Place To Invoke This Builtin Method.
*/