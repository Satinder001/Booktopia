


<header>

<div id="logo"><img src="img/logo.png" alt="logo" ></div>

<nav>
<ul>
	<li><a href="view1.php">Delete</a></li>
	  <li><a href="view1.php">Update</a></li>
	   <li><a href="InsertBook.php">Insert</a></li>
  <li><a href="view.php">Home</a></li>
 

  
</ul>
</nav>

<div id="login">
<?php 
// For log in and log out user
		if(is_logged_in()){ ?>
			<!----<p><?php //echo htmlentities(logged_in_user()); ?></p>   ---->
			<form id="status" action="logout.php" method="POST">
				<button class="logout-btn">Log out</button>
			</form>
	
		<?php } else {
			header('Location: login.php');
			
		} ?>
			
		
</div>

</header>