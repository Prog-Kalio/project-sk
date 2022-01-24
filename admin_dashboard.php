<?php session_start();
include_once("classes.php");
include_once("header.php");
if(!isset($_SESSION['admin_email']) && ($_SESSION['skinsol'] = "2021+Skins@_||")) {
	header("Location: admin_login.php?msg=Please login");
}
else {
	$status="Welcome";
}

?>

	
	<div class="container-fluid">

		<div id="admrw1">
			<h5>Admin Dashboard</h5>
		</div>

		<div id="admrw">
			<div id="admrw2">
				<div id="admrw2c1">
					<?php 
						if(isset($_SESSION['admin_email'], $_SESSION['admin_image'])) {
							$paycust = new MyPayingCustomers;
							$payingcustomers = $paycust->getPayingCustomers();
					?>
					<img src="<?php echo $_SESSION['admin_image']; ?>" />
			
					<h5><?php echo $_SESSION['admin_phone']; ?></h5>
					<?php 
						} else {
					$abbreviatedmail = explode("@", $_SESSION['admin_email']);
					?>
					<img src="images/avatar.jpg">
					<h5><?php echo $status." ".$abbreviatedmail[0]; ?></h5>
					<?php 
						}
					?>
				</div>
				<div id="admrw2c2">
		          <a href="admin_dashboard.php">Dashboard</a>
		        </div>
		        <div id="admrw2c3">
		          <a href="upload_products.php">Upload Products</a>
		        </div>
		        <div id="admrw2c4">
		          <a href="view_products.php">View Products</a>
		        </div>
		        <div id="admrw2c5">
		          <a href="upload_category.php">Upload Category</a>
		        </div>
		        <div id="admrw2c6">
		          <a href="view_category.php">View Category</a>
		        </div>
		        <div id="admrw2c7">
		          <a href="view_clients.php">View Clients</a>
		        </div>
		        <div id="admrw2c8">
		          <a href="view_orders.php">View All Orders</a>
		        </div>
		        <div id="admrw2c9">
		          <a href="view_paid_orders.php">Successful Orders</a>
		        </div>
		        <div id="admrw2c10">
		          <a href="admin_settings.php">Settings</a>
		        </div>
		        <div id="admrw2c11">
		          <a href="logout.php">Logout</a>
		        </div>
			</div>

			<div id="admrw3">
				<div id="admrw3c1">
					<p><b>If you got here, then you are an Admin!!!</b></p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
		</div>
	</div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>