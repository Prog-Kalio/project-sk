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
			<h5>COMPLAINTS</h5>
		</div>

		<div id="custrw">
			<div id="custrw2">
				<div id="custrw2c1">
					<?php 
						if(isset($_SESSION['cust_email'], $_SESSION['cust_image'])) {
							$paycust = new MyPayingCustomers;
							$payingcustomers = $paycust->getPayingCustomers();
					?>
					<img src="<?php echo $_SESSION['cust_image']; ?>" />
			
					<h5><?php echo $_SESSION['cust_phone']; ?></h5>
					<?php 
						} else {
					$abbreviatedmail = explode("@", $_SESSION['cust_email']);
					?>
					<img src="images/avatar.jpg">
					<h5><?php echo $status." ".$abbreviatedmail[0]; ?></h5>
					<?php 
						}
					?>
				</div>
				<div id="custrw2c2">
		          <a href="customers_dashboard.php">Dashboard</a>
		        </div>
		        <div id="custrw2c3">
		          <a href="cart.php">My Cart</a>
		        </div>
		        <div id="custrw2c4">
		          <a href="orders.php">Orders</a>
		        </div>
		        <div id="custrw2c5">
		          <a href="details.php">Shipping Details</a>
		        </div>
		        <div id="custrw2c6">
		          <a href="products.php">Products</a>
		        </div>
		        <div id="custrw2c7">
		          <a href="complaints.php">Complaints</a>
		        </div>
		        <div id="custrw2c8">
		          <a href="logout.php">Logout</a>
		        </div>
			</div>

			<div id="custrw3">
				<div id="custrw3c1">
					<p><b>If you have any compaints, please fill the form below!!!</b></p>
					<div id="div-NewUser" class="col-md-5">
            
              <form id="form-newUser" action="" method="post" class="form-group" name="NewUser-Form" enctype="multipart/form-data">
                
                <label>Firstname</label>
                <input type="text" name="comp_firstname" class="form-control"> 
                <label>Lastname</label>
                <input type="text" name="comp_lastname" class="form-control">
                <label>Phone Number</label>
                <input type="text" name="comp_phone" class="form-control">
                <label>Email Address</label>
                <input type="email" name="comp_email" class="form-control">
                <label>Complaint</label>
                <textarea id="comp_address" name="comp_address" class="form-control" rows="3"></textarea>
                <label>File</label>
                <input type="file" name="comp_image" class="form-control">
                <small>Images only (png, jpg, jpeg, gif) with max-size: 2MB</small><br>
                <input type="submit" id="cust_signup_btn" class="btn btn-block btn-dark" name="cust_signup_btn" value="SEND">
              </form>
				</div>
			</div>
		</div>
	</div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>