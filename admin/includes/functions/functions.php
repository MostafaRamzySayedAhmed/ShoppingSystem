<?php

// Showing 'Default' As Title For Pages Without The '$title' Variable

function get_title()
{	
	global $title;

	if(isset($title))
	{
		echo $title;
	}
	else
	{
		echo "Default";
	}
}

// Redirecting The User To The 'Login' Page

function redirect_home($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Homepage After $time Seconds</div>";
	
	/* 
	* Here We Will NOT Use '$_SERVER['HTTP_REFERER'] Because The Previous Page Which We Will Be Redirected Into 
	* Is Not The Homepage
	*/

	header("refresh: $time; url=index.php");
	exit();
	
}

// Redirecting The User To The 'Adding Member' Page

function redirect_member_add($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Add Page You Came From After $time Seconds</div>";
	
	/* 
	* The First Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_member_add = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_member_add");
	exit();
	
	/* 
	* The Second Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	/*
	header("refresh: $time; url= member_add.php");
	exit();
	*/
}

// Redirecting The User To The 'Editing Member' Page

function redirect_member_edit($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Edit Page You Came From After $time Seconds </div>";
	
	/* 
	* Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_member_edit = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_member_edit");
	exit();
	
}

// Redirecting The User To The 'Members' Page

function redirect_members($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Members Page After $time Seconds </div>";
	

	header("refresh: $time; url=members.php");
	exit();

}

// Redirecting The User To The 'Adding Category' Page

function redirect_category_add($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Add Page You Came From After $time Seconds </div>";
	
	/* 
	* The First Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_category_add = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_category_add");
	exit();
	
	/* 
	* The Second Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	/*
	header("refresh: $time; url= category_add.php");
	exit();
	*/
}

// Redirecting The User To The 'Editing Category' Page

function redirect_category_edit($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Edit Page You Came From After $time Seconds </div>";
	
	/* 
	* Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_category_edit = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_category_edit");
	exit();

}

// Redirecting The User To The 'Categories' Page

function redirect_categories($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Categories Page After $time Seconds </div>";
	

	header("refresh: $time; url=categories.php");
	exit();

}

// Redirecting The User To The 'Adding Item' Page

function redirect_item_add($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Add Page You Came From After $time Seconds </div>";
	
	/* 
	* The First Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_category_add = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_category_add");
	exit();
	
	/* 
	* The Second Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	/*
	header("refresh: $time; url= item_add.php");
	exit();
	*/
}

// Redirecting The User To The 'Editing Item' Page

function redirect_item_edit($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Edit Page You Came From After $time Seconds </div>";
	
	/* 
	* Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_item_edit = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_item_edit");
	exit();
	
}

// Redirecting The User To The 'Items' Page

function redirect_items($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Items Page After $time Seconds</div>";
	

	header("refresh: $time; url=items.php");
	exit();

}

// Redirecting The User To The 'Editing Comments' Page

function redirect_comment_edit($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Edit Page You Came From After $time Seconds</div>";
	
	/* 
	* Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_comment_edit = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_comment_edit");
	exit();
	
}

// Redirecting The User To The 'Comments' Page

function redirect_comments($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Comments Page After $time Seconds</div>";
	

	header("refresh: $time; url=comments.php");
	exit();

}