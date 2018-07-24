<?php
session_start ();
require "include/config.php";

?>
<?php

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


	if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			
			$sql = mysqli_query($conn, "SELECT * FROM `book` where ISBN='" . $_GET["code"] . "'");
			
			while ($row = $sql->fetch_assoc()){
				
			echo $row['title'];
			
	
		}
	
	
		}
	
	
	
	
	
	
	
	
		break;
		
		
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
	
	
	
	
}
}
?>









<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/book.css" />
		<title>Search Books</title>
	
	</head>
	<body>
	<div id="search"> 
		<form action="search.php" method="GET">
			<input type="text" name="query" />
			<input type="submit" value="Search" />
		</form>
	
	</div>



<?php
		
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? mysqli_real_escape_string ($conn, $_GET['query']) :  "";



//	$query="SELECT * FROM book WHERE ISBN= '$Book_id' ";
//SELECT author.author_id, author.first_name, author.last_name, gender FROM `author` JOIN book_author ON author.author_id= book_author.author_id WHERE book_author.ISBN='1241476874';
/*$query1="SELECT book.title, book.category,book.edition, book.publishdate,book.price,book.image,book.rating 
publisher.publisher_name, author.author_id, author.first_name, 
author.last_name, author.gender FROM `author` 
JOIN book_author ON author.author_id= book_author.author_id 
join book on book.ISBN=book_author.ISBN 
join publisher on publisher.publisher_id = book.publisher_id 
WHERE book.ISBN='$query' ";
*/

//$query="SELECT * FROM book WHERE ISBN Like '$query' OR title like '$query' OR category like '$query'";

$query4="SELECT keyword_id FROM `keyword` 
		WHERE k1 like '$query' or 	
		k2 like '$query' or 
		k3 like '$query' or 
		k4 like '$query' or 
		k5 like '$query' ";
/*SELECT book.title, book.category,book.edition, book.publishdate, keyword.keyword_id  FROM book join keyword ON  book.keyword_id=keyword.keyword_id WHERE k1 like 'satelite' or k2 like 'satelite' or k3 like 'satelite' or k4 like 'satelite' or k5 like 'satelite' ;	
*/
$query ="SELECT book.ISBN, book.title, book.description, book.category,book.edition, book.publishdate,book.price,book.image,book.rating,book.keyword_id, 
publisher.publisher_name, author.author_id, author.first_name, 
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
	
	while ($row = mysqli_fetch_assoc($result)){
		
	
		$json =  json_encode($row); 
		

		
		


if ($json !=NULL) {
	
   $array =(json_decode($json, true));
  

	
?>	 
	<div id="container">
		
			<div id="image">  <a href =""><img src="<?php echo ($array['image']);?>" onerror="this.src='images/default1.png'"></a><br>
			</div>
			
			<div id="detail">
			<a href =""><label id="title"><?php echo ($array['title']);?></label></a><br>
			
			<label>Description <?php echo ($array['description']);?></label><br>
			
			</div>
			<div id="product">
			<strong>Book Detail - </strong><br>
			<label><strong>ISBN         :</strong><?php echo ($array['ISBN']);?></label><br>
			<label><strong>Category     :</strong><?php echo ($array['category']);?></label><br>
			<label><strong>Author       :</strong><?php echo ($array['first_name']);?> <?php echo ($array['last_name']);?></label><br>
			<label><strong>Publisher    :</strong><?php echo ($array['publisher_name']);?></label><br>
			<label><strong>Publish Date :</strong><?php echo ($array['publishdate']);?></label><br>
			
			
			
			
			<label><strong>Rating :</strong> <?php echo ($array['rating']);?></label><br>
			<span class="price">A$ <?php echo ($array['price']);?></span><br>
			
			</div>
			
	
			
			
			
</div>	

<?php
	}}
	
?>
 
</body>

</html>


