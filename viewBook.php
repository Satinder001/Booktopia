<?PHP  
session_start ();
	require_once "include/utils.php";
	require_once "include/auth.php";
	require "include/config.php";?>


<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	
	
	<link rel="stylesheet" type="text/css" href="css/book.css" />
</head>

<body>


<?php include "header.php" ; ?>

		
		
		
		<div id="search"> 
		<form action="view1.php" method="GET">
			<input class="search_txt" type="text" name="query" />
			<input class="search_btn" type="submit" value="Search" />
		</form>
</div>
		
					

<?php
		
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


	
	$query = isset($_GET['id']) ? mysqli_real_escape_string ($conn, $_GET['id']) :  "";
	
$query ="SELECT book.ISBN, book.title, book.description, book.category,book.edition, book.publishdate,book.price,book.image,book.rating,book.keyword_id, 
publisher.publisher_name, author.author_id, author.first_name, 
author.last_name, author.bio FROM `author` 
JOIN book_author ON author.author_id= book_author.author_id 
join book on book.ISBN=book_author.ISBN 
join publisher on publisher.publisher_id = book.publisher_id 
join keyword on keyword.keyword_id = book.keyword_id
WHERE book.ISBN Like '$query' ";

	
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
			
	
			<div id="buttons">
			<form id="update_button" action="update.php?id=<?php echo ($array['ISBN']);?>" method="post">
			
			<input class="Dbtn" name="update" type="submit" value="Edit">
			</form>
			<form id="delete_button" action="delete.php?id=<?php echo ($array['ISBN']);?>" method="post">
			<input class="Dbtn" name="delete" type="submit" value="Delete">
			</form>
			
			</div>
</div>	

<?php
	}}
	
?>

		
		
</body>
</html>
	
	




