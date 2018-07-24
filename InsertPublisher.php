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
		if ( $_POST['author'] ==0) {
			
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$total_books = $_POST['total_books'];
		$bio = $_POST['bio'];

			if (empty($firstname) || empty($lastname) || empty($total_books)|| empty($bio)){
				
				// Setting error message
						
					$_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";
					
					header("location: InsertAuthor.php");
		
			}
			
			else {
			
			$_SESSION['firstname'] = $_POST['firstname'];
			$_SESSION['lastname'] = $_POST['lastname'];
			$_SESSION['total_books'] = $_POST['total_books'];
			$_SESSION['bio'] = $_POST['bio'];

			}
		}
		
		else 
		{
			 $_SESSION['author'] = $_POST['author'];
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

		<form id="book1" action="InsertKeyword.php" method="post">
<?php
	
		
		
		 if (!empty($_SESSION['error'])) {
		 echo $_SESSION['error'];
		 unset($_SESSION['error']);
		 }
 ?>




		<!----- for publisher ---->
		<h3>Enter Publisher Detail</h3>
		
		
		<label>Select Publisher<label>
		<select name="publisherData" onchange="showDiv(this)">
		<?php 
		$sql = mysqli_query($conn, "SELECT publisher_id, publisher_name FROM `publisher`");
			echo "<option value='0' >" 	   . "</option>";
		while ($row = $sql->fetch_assoc())
		
		{
		
			echo "<option value='".$row['publisher_id']."'>" . $row['publisher_name']  . "</option>";
		}
		
		?>
		</select>
		<br>
		<div id="Publisher_Input" >
		OR <br>
		
		
		<label>Publisher Name<label>
		<input type="text" name="publisher"><br>
	</div>
		<input name="submit" type="submit" value="Next">
		<button id="reset"  type="reset" value="Reset">Reset</button>
		
	</form>	
	</body>
	
<script>
// for publisher

var P_input = document.getElementById("Publisher_Input");
function showDiv(select){


if (select.value != 0) {
	 P_input.style.display = "none";	
}
else {
	 P_input.style.display = "";
}
	
}




</script>	
	
	
	
</html>
