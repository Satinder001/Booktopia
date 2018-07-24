<?php
session_start ();
require "include/config.php";
require_once "include/auth.php";
?>

<?php
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	
}


?>



<!DOCTYPE html>
<html>
<head>
	<title>Insert books</title>
	<link rel="stylesheet" type="text/css" href="css/InsertBook.css" />
	<link rel="stylesheet" type="text/css" href="css/book.css" />
</head>

<body>


<?php include "header.php" ; ?>


	
	
	 <!---- Initializing Session for errors --->
 
	<form id="book1" action="InsertAuthor.php" method="post">
	<?php
 if (!empty($_SESSION['error'])) {
 echo $_SESSION['error'];
 unset($_SESSION['error']);
 }
 ?>
		<h3>Enter Book Detail</h3>
		<label>ISBN<label>
		<input type="text" name="ISBN"><br>
		<label>Title<label>
		<input type="text" name="title"><br>
		<label>Category<label>
		<input type="text" name="category"><br>
		<label>Edition<label>
		<input type="text" name="edition"><br>
		
		<label>Publish Date<label>
		<input type="date" name="publish_date"><br>
		<label>Rating<label>
		<select name="rating" >
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select><br>
		
		
		<label>Image<label>
		<input type="file" name="image"><br>
		<label>Price<label>
		<input type="text" name="price"><br>
		
	<input name="submit" type="submit" value="Next">
	<button id="reset"  type="reset" value="Reset">Reset</button>
		
</body>

</html>
	