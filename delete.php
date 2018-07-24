<?php
session_start ();
require "include/config.php";

?>
<?php

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

		
	$delete = "DELETE FROM `book_author` where ISBN='".$_GET['id']."'";

	
	
	$result1= mysqli_query($conn, $delete);
	
	if ($result1) {
	$deleteBook = "DELETE FROM `book` where ISBN='".$_GET['id']."'";
	$result2= mysqli_query($conn, $deleteBook);
		
	}


	header("location: view1.php");	
		




?>

