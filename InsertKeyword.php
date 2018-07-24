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

	if ($_POST['publisherData'] == 0 ){
		
		$publisher = $_POST['publisher'];
		If (empty($publisher)){
			// Setting error message
					
				$_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";
				
				header("location: InsertPublisher.php");
			
		}
		
		else {
			
			$_SESSION['publisher'] = $_POST['publisher'];
			
		}
	
		
	}
		
		else {
				$publisher_id = $_POST['publisherData'];
				
				
			}
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Insert Keyword</title>
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
		
		
		<form id="book1" action="description.php" method="post">



		
		
		<h3>Enter Some Search Keyword</h3>
		<label>Keyword 1<label>
		<input type="text" name="k1"><br>
		<label>Keyword 2<label>
		<input type="text" name="k2"><br>
		<label>Keyword 3<label>
		<input type="text" name="k3"><br>
		<label>Keyword 4<label>
		<input type="text" name="k4"><br>
		<label>Keyword 5<label>
		<input type="text" name="k5"><br>
		
	
		
		<input name="submit" type="submit" value="Submit">
		<button id="reset"  type="reset" value="Reset">Reset</button>
	</body>
	</form>

	
	
</html>
