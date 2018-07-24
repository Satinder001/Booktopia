

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
	<title>Search Books</title>
</head>
<body>
<div class="content">
	<div id="search"> 
		<form action="search.php" method="GET">
			<input class="form-control" type="text" name="query" />
			<input class="form-control" type="submit" value="Search" />
		</form>
	
	</div>
	<div class="book-list">
	<?php
		require "include/config.php";
		
		
	?>

<?php
		
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? mysqli_real_escape_string ($conn, $_GET['query']) :  "";




$query ="SELECT book.ISBN, book.description, book.title, book.category,book.edition, book.publishdate,book.price,book.image,book.rating,book.keyword_id, 
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
		<div class="book-div">	
		
			<a href ="detail?query=<?php echo ($array['ISBN']);?>"><img src="<?php echo ($array['image']);?>" onerror="this.src='images/default1.png'" height="200" width="180"></a><br>
			
			<a href ="detail?query=<?php echo ($array['ISBN']);?>"><label id="title"><?php echo ($array['title']);?></label></a><br>
			<label>Category : <?php echo ($array['category']);?></label><br>
			<label>Rating : <?php echo ($array['rating']);?></label><br>
			<label>A$ <?php echo ($array['price']);?></label><br>
			<label></label><br>
	
		</div>
		<?php
			}}
	
		?>
		
</div>
</div>
</body>

</html>


