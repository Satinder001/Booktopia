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

if(isset($_POST['submit'])) {
	

	
		$k1 = $_POST['k1'];
		$k2 = $_POST['k2'];
		$k3 = $_POST['k3'];
		$k4 = $_POST['k4'];
		$k5 = $_POST['k5'];


	if (empty($k1) || empty($k2) || empty($k3) ){
				
				// Setting error message
						
					$_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";
					
					header("location: InsertKeyword.php");
		
			}


else {
	
	$_SESSION['k1'] = $_POST['k1'];
	$_SESSION['k2'] = $_POST['k2'];
	$_SESSION['k3'] = $_POST['k3'];
	$_SESSION['k4'] = $_POST['k4'];
	$_SESSION['k5'] = $_POST['k5'];
	
	
}			
	
}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Insert Description</title>
	<link rel="stylesheet" type="text/css" href="css/InsertBook.css" />
	<link rel="stylesheet" type="text/css" href="css/book.css" />
</head>

<body>

<?php include "header.php" ; ?>
<?php
	
		
		
		 if (!empty($_SESSION['error'])) {
		 echo $_SESSION['error'];
		 unset($_SESSION['error']);
		 }
 ?>
		
		
		<form id="book1" action="InsertAll.php" method="post">
		<h3>Enter description of the book </h3>

		<textarea rows="20" cols="60" name="description"></textarea>

		
		<input name="submit" type="submit" value="Submit">
		<button id="reset"  type="reset" value="Reset">Reset</button>
		
	</body>
	</form>

	
	
</html>
