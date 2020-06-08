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

// Redirecting The User To The 'Profile' Page

function redirect_profile($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To Your Profile Page After $time Seconds</div>";
	

	header("refresh: $time; url=profile.php");
	exit();

}

// Redirecting The User To The 'Editing Profile' Page

function redirect_profile_edit($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Edit Page You Came From After $time Seconds</div>";
	
	/* 
	* The First Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_profile_edit = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_profile_edit");
	exit();
	
	/* 
	* The Second Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	/*
	header("refresh: $time; url= profile_edit.php");
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
	You'll Be Redirected To The Edit Page You Came From After $time Seconds</div>";
	
	/* 
	* The First Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	$previous_item_edit = $_SERVER['HTTP_REFERER'];
	header("refresh: $time; url=$previous_item_edit");
	exit();
	
	/* 
	* The Second Way Of Redirecting The User To The Previous Page Which He Came From
	* (The Previous Page Of The Current Page)
	*/
	
	/*
	header("refresh: $time; url= profile_edit.php");
	exit();
	*/
}

// Redirecting The User To The 'Home' Page

function redirect_home($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Homepage After $time Seconds</div>";
	

	header("refresh: $time; url=index.php");
	exit();

}

// Redirecting The User To The 'Login' Page

function redirect_login($message, $time = 3)
{
	echo $message;
	echo "</br>";
	echo "</br>";
	echo "<div class='message-redirect alert alert-success'>
	You'll Be Redirected To The Login After $time Seconds</div>";
	
	/* 
	* Here We Will NOT Use '$_SERVER['HTTP_REFERER'] Because The Previous Page Which We Will Be Redirected Into 
	* Is Not The Homepage
	*/

	header("refresh: $time; url=login.php");
	exit();
	
}