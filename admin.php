<?php session_start();
include_once("header.php")

?>
	
	<div class="container-fluid">

		<div id="admnrw1">
			<h5>Admin Page</h5>
		</div>

		<div id="admnrw2">
			<div id="admnrw2c1">
				<a href="upload_products.php">Upload Products</a>
			</div>
			<div id="admnrw2c2">
				<a href="upload_category.php">View Products</a>
			</div>
			<div id="admnrw2c3">
				<a href="upload_products.php">Upload Category</a>
			</div>
			<div id="admnrw2c4">
				<a href="upload_category.php">View Category</a>
			</div>
			<div id="admnrw2c5">
				<a href="upload_products.php">View Clients</a>
			</div>
			<div id="admnrw2c6">
				<a href="upload_category.php">View Orders</a>
			</div>
			<div id="admnrw2c7">
				<a href="upload_products.php">View Complaints</a>
			</div>
			<div id="admnrw2c8">
				<a href="upload_category.php">Settings</a>
			</div>
		</div>
		
	</div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>