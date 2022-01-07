<?php session_start();
include_once("classes.php");
include_once("header.php");
if(!isset($_SESSION['cust_email']) && ($_SESSION['skinsol'] = "2021+Skins@_||")) {
	header("Location: login.php?msg=Please login");
}
else {
	$status="Welcome";
}

?>
	
	<div class="container-fluid">

		<div id="custrw1">
			<h5>Customers Dashboard</h5>
		</div>

		<div id="custrw">
			<div id="custrw2">
				<div id="custrw2c1">
					<?php 
						if(isset($_SESSION['cust_email'], $_SESSION['cust_image'])) {
					?>
					<img src="<?php echo $_SESSION['cust_image']; ?>" />
			
					<h5><?php echo $_SESSION['cust_phone']; ?></h5>
					<?php 
						} else {
					$abbreviatedmail = explode("@", $_SESSION['cust_email']);
					?>
					<img src="images/customer3.jpg">
					<h5><?php echo $status." ".$abbreviatedmail[0]; ?></h5>
					<?php 
						}
					?>
				</div>
				<div id="custrw2c2">
					<a href="cart.php">My Cart</a>
				</div>
				<div id="custrw2c3">
					<a href="orders.php">Orders</a>
				</div>
				<div id="custrw2c4">
					<a href="payment.php">Payment</a>
				</div>
				<div id="custrw2c5">
					<a href="complaints.php">Complaints</a>
				</div>
				<div id="custrw2c6">
					<a href="products.php">Products</a>
				</div>
				<div id="custrw2c7">
					<a href="upload_products.php">History</a>
				</div>
				<div id="custrw2c8">
					<a href="cust_settings.php">Settings</a>
				</div>
				<div id="custrw2c9">
					<a href="logout.php">Logout</a>
				</div>
			</div>

			<div id="custrw3">
				<div id="custrw3c1">
					<p><b>If you got here, then we are good to go!!!</b></p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
		</div>
	</div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>