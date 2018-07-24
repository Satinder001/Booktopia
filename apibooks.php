<?php
require "include/config.php";
?>

<?php
		
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? mysqli_real_escape_string ($conn, $_GET['query']) :  "";


$query ="SELECT book.ISBN, book.title, book.category,book.edition, book.publishdate,book.price,book.image,book.rating,book.keyword_id, 
publisher.publisher_name, author.author_id, author.first_name, author.total_books, 
author.last_name, author.bio FROM `author` 
JOIN book_author ON author.author_id= book_author.author_id 
join book on book.ISBN=book_author.ISBN 
join publisher on publisher.publisher_id = book.publisher_id 
join keyword on keyword.keyword_id = book.keyword_id
WHERE keyword.k1 like '$query' or keyword.k2 like '$query' or keyword.k3 like '$query' or keyword.k4 like '$query' or keyword.k5 like '$query'
OR book.ISBN Like '$query' OR book.title like '$query' OR book.category like '$query' OR author.last_name like '$query' OR publisher.publisher_name like '$query'";

	
	$stmt  = mysqli_prepare($conn,$query);

	mysqli_stmt_execute($stmt);
					
		$result = mysqli_stmt_get_result($stmt);
			
		foreach($result as $row ){
		
			$json[] = [      
							"ISBN" => $row['ISBN'],
						"title"=> $row['title'],
						"image"=> $row['image'],
						"rating"=> $row['rating'],
						"author"=> array (
						"firstname"=> $row['first_name'],
						"lastname"=> $row['last_name'],
						"TotalBooks"=> $row['total_books'],
						"Bio"=> $row['bio'],
						),
						"publisher"=> $row['publisher_name'],
						
						
						];
				
					}
			
					echo json_encode($json,JSON_FORCE_OBJECT);

					
			
	
	
	
	
	
		
	
?>