<?php session_start();
include_once("header.php")

?>
	
	<div class="container-fluid">

		<div id="admnrw1">
			<h5>Admin Page</h5>
		</div>

		<div id="admnrw2">
			<div id="admnrw2c1">
				<a href="admin_login.php">Admin Login</a>
			</div>
			<div id="admnrw2c2">
				<a href="admin_signup.php">Admin Signup</a>
			</div>
		</div>
		
	</div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>