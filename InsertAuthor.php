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
			
			$isbn = $_POST['ISBN'];
			$title = $_POST['title'];
			$image =  $_POST['image'];
			$category = $_POST['category'];
			$edition = $_POST['edition'];
			$publish_date = $_POST['publish_date'];
			$rating = $_POST['rating'];
			$price = $_POST['price'];
			
			if  (empty($isbn) || empty($title) || empty($image) || empty($category) || empty($edition) || empty($publish_date) || empty($rating) || empty($price))
				{
					
					// Setting error message
					
				$_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";
				
				header("location: InsertBook.php");
					
					
						
				
				}
			else {
				
		$_SESSION['ISBN'] = $_POST['ISBN'];
		$_SESSION['title'] = $_POST['title'];
		$_SESSION['image'] =  $_POST['image'];
		$_SESSION['category'] = $_POST['category'];
		$_SESSION['edition'] = $_POST['edition'];
		$_SESSION['publish_date'] = $_POST['publish_date'];
		$_SESSION['rating'] = $_POST['rating'];
		$_SESSION['price'] = $_POST['price'];
				
			header("location: InsertAuthor.php");	
		
				
			}
			
			
			
		}


		
?>


<!DOCTYPE html>
<html>
<head>
	<title>Insert Author</title>
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
		

		<form id="book1" action="InsertPublisher.php" method="post">




<!----      for author      ---->
		
		
		
		<h3>Enter Author Detail</h3>
		
		<label>Select author<label>
		<select name="author" onchange="showDiv1(this)">
		<?php 
		$sql = mysqli_query($conn, "SELECT author_id, first_name, last_name FROM `author`");
				echo "<option value='0' >" 	   . "</option>";
		while ($row = $sql->fetch_assoc()){
			echo "<option value='".$row['author_id']."'>" . $row['first_name'] . $row['last_name']  . "</option>";
		}
		?>
		</select><br>
		<div id="authorDetail">
		OR <br>
		
		<label>First name<label>
		<input type="text" name="firstname"><br>
		<label>Last Name<label>
		<input type="text" name="lastname"><br>
		<label>Total Books<label>
		<input type="text" name="total_books"><br>
		<label>Bio<label>
		<input type="text" name="bio"><br>
		</div>
		
		<input name="submit" type="submit" value="Next">
		<button id="reset"  type="reset" value="Reset">Reset</button>
		
		
	</form>
	</body>

<script>
	
// for author

var A_input = document.getElementById("authorDetail");
function showDiv1(select){


if (select.value != 0) {
	 A_input.style.display = "none";	
}
else {
	 A_input.style.display = "";
}
	
}




</script>	
	
	
	
</html>
