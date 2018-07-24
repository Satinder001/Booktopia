<?php
session_start ();
	require_once "include/auth.php";
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
