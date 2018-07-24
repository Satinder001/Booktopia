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
<div class="content">



		<div id="search"> 
		
		<form action="view1.php" method="GET">
			<input class="search_txt" type="text" name="query" />
			<input class="search_btn" type="submit" value="Search" />
		</form>
</div>	
</div>	
	
		
		
			
			<?php
require "include/config.php";
?>

<?php
		
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? mysqli_real_escape_string ($conn, $_GET['query']) :  "";


if ($query ==NULL) {
	?><div id="txt"><H2>Please search a book into the search box<H2></div>
	<?PHP
}




?>


		



<?php
	if ($query !=NULL) {	

$query ="SELECT book.ISBN, book.title, book.category,book.edition, book.publishdate,book.price,book.image,book.rating,book.keyword_id, 
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
	<form id= "book">
		
			
			<a href ="viewBook?id=<?php echo ($array['ISBN']);?>"><img src="<?php echo ($array['image']);?>" onerror="this.src='images/default1.png'" height="200" width="180"></a><br>
			
			<a href ="viewBook?id=<?php echo ($array['ISBN']);?>"><label id="title"><?php echo ($array['title']);?></label></a><br>
		
			<label>ISBN <?php echo ($array['ISBN']);?></label><br>
			<label>Category : <?php echo ($array['category']);?></label><br>
			<label>Rating : <?php echo ($array['rating']);?></label><br>
			<label>Price $ <?php echo ($array['price']);?></label><br>
			<label></label><br>
	
	</form>

<?php
	}
	
	

	
	}
	}
	
	
?>

			
		
		
		
	</div>	
	<?php include "footer.php";?>
</body>
</html>