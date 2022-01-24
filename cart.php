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

		<div id="cartrw1">
			<h5>Customers Dashboard</h5>
		</div>

		<div id="cartrw">
			<div id="cartrw2">
				<div id="cartrw2c1">
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
				<div id="cartrw2c2">
		          <a href="customers_dashboard.php">Dashboard</a>
		        </div>
		        <div id="cartrw2c3">
		          <a href="cart.php">My Cart</a>
		        </div>
		        <div id="cartrw2c4">
		          <a href="orders.php">Orders</a>
		        </div>
		        <div id="cartrw2c5">
		          <a href="details.php">Shipping Details</a>
		        </div>
		        <div id="cartrw2c6">
		          <a href="products.php">Products</a>
		        </div>
		        <div id="cartrw2c7">
		          <a href="complaints.php">Complaints</a>
		        </div>
		        <div id="cartrw2c8">
		          <a href="logout.php">Logout</a>
		        </div>
			</div>

			<div id="cartrw3">
				<div id="cartrw3c1">
					<table class="table table-striped table-bordered" id="cartdiv">
				<thead>
					<tr>
						<th>S/N</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					
				</thead>

				<tbody>
					<?php
						if (isset($_SESSION['mycart'])) {
							 
						$objcart = new MyCart;
						$newcart = $objcart->getFromCart($session_id = $_SESSION['mycart']);

						if(!empty($newcart)) {
						
						$counter = 0;
						$paydue = 0;

						foreach ($newcart as $key => $value) {
						
					?>
					<tr>
						<td><?php echo ++$counter ?></td>
						<td><?php echo $value['product_name'] ?></td>
						<td> <div id="quantity"><?php echo $value['quantity'] ?></div>
							
							<div id="editquantity" style="display:none">
								<?php 
                    		if(isset($_POST['edit']) &&  $_POST['edit']=='EDIT') {
                    			if(empty($_POST['quantity']) || $_POST['quantity']<1) {
                    				echo "<div class='alert alert-danger'>Minimum = 1</div>";
                    			}
                    			else {
                    				$objcart = new MyCart;
                    				$equip_name = $_POST['product_name'];
                    				$equip_price = $_POST['product_price'];
                    				$quantity = $_POST['quantity'];
                    				$session_id = $_SESSION['mycart'];
									$newcart = $objcart->editCart($_POST['quantity'], $_POST['cart_id']);
									
									// to go a step further, add a special key to authenticate who is in session.
									$_SESSION['skinsol'] = "2021+Skins@_||";

									header("Location: cart.php?msg=Successfuly edited");
									exit;
		                    			}
		                    		}
		                    	?>
								<form name="cartform" method="post" action="" class="form-group">
									<input type="hidden" name="cart_id" value="<?php echo $value['cart_id'] ?>"><br>
									<input type="hidden" name="product_name" value="<?php echo $value['product_name'] ?>">
									<input type="text" name="quantity" id="qty" size="2px" style="text-align:center"><br>
									<input type="hidden" name="product_price" value="<?php echo $value['product_price'] ?>">
									<br>
									<input type="submit" class="btn btn-info btn-block" name="edit" value="EDIT">
								</form>
							</div>
						</td>
						<td><?php echo number_format($value['product_price'], 2) ?></td>
						<td><?php 
							$qty = $value['quantity'];
							$prc = $value['product_price'];
							$total = array();
							$total = $qty * $prc;
							$paydue+= $total;
							echo number_format($total, 2);
						?></td>
						<td>
							<div id="editlink">
							<span class="text-primary"><i class="fa fa-edit"></i></span>
							</div>
							
						</td>
						<td>
							<div class="deletelink">
							<span class="text-danger"><i class="fa fa-trash" id="deletelink"></i></span>
							</div>

							<div id="deleteitem" style="display:none">
							<?php 
	                    		if(isset($_POST['delete']) &&  $_POST['delete']=='DELETE') {
	                    			
	                    				$objcart = new MyCart;
	                    			
										$newcart = $objcart->deleteItemIncart($_POST['cart_id']);
										
										// to go a step further, add a special key to authenticate who is in session.
										$_SESSION['skinsol'] = "2021+Skins@_||";

										header("Location: cart.php?msg=Successfully deleted");
										exit;
	                    		}
	                    	?>
							<form name="cartform" method="post" action="" class="form-group">
								<input type="hidden" name="cart_id" value="<?php echo $value['cart_id'] ?>"><br>
								<input type="submit" class="btn btn-danger btn-block" name="delete" value="DELETE">
							</form>
						</div>
						</td>
					</tr>
					
					<?php 
								}	

							}
						}
					?>
					<tr>
						<td></td>
						<td>Payment Due</td>
						<td></td>
						<td></td>
						<td> <?php
							if(!empty($paydue)) {
							echo (number_format($paydue, 2));
							}
							else {
								echo "0";
							}
						?></td>
						<td>
							<?php 
	                    		if(isset($_POST['proceed']) &&  $_POST['proceed']=='PROCEED') {
	                    						
										// to go a step further, add a special key to authenticate who is in session.
										$_SESSION['skinsol'] = "2021+Skins@_||";

										header("Location: orders.php?msg=confirmed for payment");
										exit;
	                    		}
	                    	?>
							<form name="confirmation_form" method="post" action="" class="form-group">
								<input type="submit" class="btn btn-success btn-block" name="proceed" value="PROCEED">
							</form>
						</td>
						
					</tr> 
				</tbody>
			</table>
				</div>
			</div>
		</div>
	</div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>

