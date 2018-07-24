<?PHP  
session_start ();
	require_once "include/utils.php";
	require_once "include/auth.php";?>


<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/book.css" />
</head>

<body>
<?php include "header.php" ; ?>


<div id="main">	
	
		
			
			<?php
require "include/config.php";
?>

<?php
		
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? mysqli_real_escape_string ($conn, $_GET['query']) :  "";

?>


		<?php  if (empty($query))  {?>
			<div id="container">
				
			<div id="left">
			<h1>Manage books at one place</h1>
			<h4>Book Manager is a tool for managing the books in a systematic manner and helps the user to insert, delete and update book's detail<h4>
			
			<form id="btns">
			<input class="Ibtn" type="button" value="Insert" onclick="window.location.href='InsertBook.php'" />
			<input class="Dbtn" type="button" value="Edit/Delete" onclick="window.location.href='view1.php'" />
			
			</form>
			</div>
			
	
	<div id="sideimage">	<img class="img1"src="img/book11.png" alt="Smiley face" > </div>
			
			
			
			</div>
	<?php
	
		}
	
	?>		
		



</body>
</html>