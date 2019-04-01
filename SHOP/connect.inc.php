<?php 
	$database='shop';
	$username='root';
	$server = 'localhost';
	$err='couldn\'t connect to database';
	$conn=new mysqli('localhost','root','',$database) or die('coonection problem to server');
	mysqli_select_db($conn,$database) or die ($err);	
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	} 
	//echo "Connected successfully";
	//echo 'connected !'
?>
