<?php
session_start ();
require "include/config.php";
require "include/auth.php";

?>


<?php



$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if(isset($_POST['submit'])){
	
		$isbn = $_POST['ISBN'];
		$title = $_POST['title'];
		$image =  $_POST['image'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$edition = $_POST['edition'];
		$publish_date = $_POST['publish_date'];
		$rating = $_POST['rating'];
		$price = $_POST['price'];
		
		
		if ($image==NULL){
			$UpdateBook = "UPDATE `book` SET `ISBN`= '".$isbn."', `title`='".$title."', `category`='".$category."', `description`='".$description."',`edition`='".$edition."', `publishdate`='".$publish_date."', `price`='".$price."', `Rating`='".$rating."' WHERE book.ISBN='".$_GET['alter']."'";
		mysqli_query($conn, $UpdateBook);
			
			header('Location: viewBook.php?id='.$isbn.'');
			
		}
		else {
		$UpdateBook = "UPDATE `book` SET `ISBN`= '".$isbn."', `title`='".$title."', `category`='".$category."', `description`='".$description."',`edition`='".$edition."', `publishdate`='".$publish_date."', `price`='".$price."', `image`='images/".$image."', `Rating`='".$rating."' WHERE book.ISBN='".$_GET['alter']."'";
		mysqli_query($conn, $UpdateBook);
			
			header('Location: viewBook.php?id='.$isbn.'');
		}
			
}






else {

?>



<?php 
$book= "Select * from book where ISBN='".$_GET['id']."'";
$stmt  = mysqli_prepare($conn,$book);

	mysqli_stmt_execute($stmt);
	
	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_assoc($result)){
	

?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/book.css">
	<link rel="stylesheet" type="text/css" href="css/InsertBook.css">
		<title>Search Books</title>
	
	</head>



<body>
<?php include "header.php" ; ?>

<form id="book1" action="update.php?alter=<?php echo ($row['ISBN']);?>" method="post">
		<h3>Enter Book Detail</h3>
		<label>ISBN<label>
		<input type="text" name="ISBN" value="<?php echo ($row['ISBN']);?>"><br>
		<label>Title<label>
		<input type="text" name="title" value="<?php echo ($row['title']);?>"><br>
		<label>Category<label>
		<input type="text" name="category" value="<?php echo ($row['category']);?>"><br>
		<label>Description<label>
		<input type="text" name="description" value="<?php echo ($row['description']);?>"><br>
		<label>Edition<label>
		<input type="text" name="edition" value="<?php echo ($row['edition']);?>"><br>
		<label>Publish Date<label>
		<input type="date" name="publish_date" value="<?php echo ($row['publishdate']);?>"><br>
		<label>Rating<label>
		<select name="rating" selected=<?php echo ($row['rating']);?>>
			<option value="<?php echo ($row['Rating']);?>"><?php echo ($row['Rating']);?></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select><br>
		
		
		<label>Image<label>
		<input type="file" name="image" value="<?php echo ($row['image']);?>"><br>
		<label>Price<label>
		<input type="text" name="price" value="<?php echo ($row['price']);?>"><br>
		
		<input name="submit" type="submit" value="Update">
	
	
	<?php
}}		
	?>
	
	</body>
	</html>