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

		$k1 = $_SESSION['k1'];
		$k2 = $_SESSION['k2'];
		$k3 = $_SESSION['k3'];
		$k4 = $_SESSION['k4'];
		$k5 = $_SESSION['k5'];
		
		
		$isbn = $_SESSION['ISBN'];
		$title = $_SESSION['title'];
		$image =  $_SESSION['image'];
		$category = $_SESSION['category'];
		$description = $_POST['description'];
		$edition = $_SESSION['edition'];
		$publish_date = $_SESSION['publish_date'];
		$rating = $_SESSION['rating'];
		$price = $_SESSION['price'];
		 
			
			
			if ( $_SESSION['author'] ==0) {
				
				$firstname = $_SESSION['firstname'];
				$lastname = $_SESSION['lastname'];
				$total_books = $_SESSION['total_books'];
				$bio = $_SESSION['bio'];
				
				$insertAuthor = "INSERT INTO `author` (`first_name`, `last_name`, `total_books`, `bio`) VALUES ('".$firstname."', '".$lastname."', '".$total_books."', '".$bio."')";
				mysqli_query($conn, $insertAuthor);
				
				$authorId = "SELECT author_id FROM `author` WHERE first_name = '".$firstname."' AND last_name = '".$lastname."'";
			
				$result3 = mysqli_query($conn, $authorId);
			
				while ($row3 = mysqli_fetch_array($result3))  {
				$author_id = $row3['author_id'];
				}
			
			}
			
			else {
				$author_id = $_SESSION['author'];
			}
			
			
			
		if ($_SESSION['publisherData'] == 0 ){
			$publisher = $_SESSION['publisher'];
		
		$insertPublisher = "INSERT INTO `publisher` (`publisher_name`, `password`) VALUES ('".$publisher."', NULL)";
		mysqli_query($conn, $insertPublisher);
		$publisherId ="SELECT publisher_id FROM `publisher` WHERE publisher_name='".$publisher."'";
		$result1= mysqli_query($conn, $publisherId);
		
		while ($row1 = mysqli_fetch_array($result1))  {
			$publisher_id = $row1['publisher_id'];
			
		}
		
		
		}
		
		else {
				$publisher_id = $_SESSION['publisherData'];
			}
		
		
		
		
		$insertKeyword = "INSERT INTO `keyword` (`k1`, `k2`, `k3`, `k4`, `k5`) VALUES ('".$k1."', '".$k2."', '".$k3."', '".$k4."', '".$k5."')";
	
		mysqli_query($conn, $insertKeyword);

		$keywordId = "SELECT keyword_id FROM `keyword` WHERE k1 = '".$k1."' AND k2 = '".$k2."' AND k3 = '".$k3."' AND k4 = '".$k4."' AND k5 = '".$k5."'";

		$result2 = mysqli_query($conn, $keywordId);
	
		while ($row2 = mysqli_fetch_array($result2))  {
		$keyword_id = $row2['keyword_id'];
		}

		
		$insertBook = "INSERT INTO `book` (`ISBN`, `title`, `description`,`category`, `edition`, `publisher_id`, `publishdate`, `price`, `image`, `Rating`, `keyword_id`) 
		VALUES ('".$isbn."', '".$title."', '".$description."', '".$category."', '".$edition."', '".$publisher_id."', '".$publish_date."', '".$price."', 'images/".$image."', '".$rating."', '".$keyword_id."')";
		
		mysqli_query($conn, $insertBook);
		
		$insertBookAuthor = "INSERT INTO `book_author` (`ISBN`, `author_id`) VALUES ('".$isbn."', '".$author_id."')";
		
			
			
			
		
		mysqli_query($conn, $insertBookAuthor);
		


header("location: view.php");


?>
	<?php include "header.php" ; ?>