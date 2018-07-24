<?php
session_start ();
	require_once "include/config.php";
	require_once "include/utils.php";
	require_once "include/auth.php";
?>

<?php

	$Username = get_or_default($_POST,'username','');
	$Password = get_or_default ($_POST,'password','');
	
		if ($Username and $Password){
			$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME)
			or die("Failed to connect to MySQL: " . mysql_error()); 
	
			$query = "SELECT user_id, name, password FROM User WHERE name=?";

			$stmt = mysqli_prepare($conn, $query);
			mysqli_stmt_bind_param($stmt, "s", $Username);

		// If the execution works properly
		if(mysqli_stmt_execute($stmt))
		{
			// Get the results
			$result = mysqli_stmt_get_result($stmt);

			// Grab the first row
			$row = mysqli_fetch_array($result);

			// If it exists
			if($row) {
				// Get the stored password
				$db_password = $row['password'];

				// Re-hash the password using the same parameters that we used to make the DB one
				// See lecture notes on password safety for details
				$hashed_supplied = crypt($Password, $db_password);

				// Check whether the DB password is the same as the supplied password
				// In PHP5.6 or newer, use hash_equals instead
				if($db_password === $hashed_supplied)
				{
					
					login($Username);
					
					$row['user_id']=$_SESSION['user_id'];
					
					header('Location: view.php');
					
					exit;
				}
				else {
					echo "invalid login";
				}
			}
		}

		mysqli_stmt_close($stmt);
	}
?>


<!DOCTYPE html>
<html>
  <head>  
    <title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/InsertBook.css" />
    <link rel="stylesheet" type="text/css" href="css/book.css" />
  </head>



  <body>
    <div id="login_page">

      <form id="login_form" method="post" action="login.php">
        <h2>Please sign in</h2>
        <input name="username" id="username" type="text" placeholder="Username" ><br>
        <input name="password" id="password" type="password"  placeholder="Password"><br>
        <button class="Dbtn"name="Submit" id="submit" type="submit">Sign in</button>
      </form>

    </div>

    

  </body>
</html>




