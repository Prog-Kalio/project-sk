<?php session_start();
include_once("classes.php");
include_once("paystackclass.php");
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
			<h5>Customers Order</h5>
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
					<h6 class="text-center">My Orders</h6>
					<hr>
					<table class="table table-striped table-bordered" id="orderdiv">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Name of Equipment</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Total</th>
							
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
											<input type="hidden" name="product_price" value="<?php echo $value['prouduct_price'] ?>">
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
							      if (isset($_POST['submit']) && $_POST['submit'] == 'PAY') {
							        // create payment object
							        $payobj = new Payment;
							        $email= $_SESSION['cust_email'];
							        $paydue = $_POST['amount'];
							        // use initializePaystack method
							        $output = $payobj->initializePaystack($email, $paydue);
							        $redirecturl = $output->data->authorization_url;
							        $reference = $output->data->reference;

							        // insert transaction details & redirect to paystack
							        if (!empty($redirecturl)) {
							          $payobj->insertTransactionDetails($_SESSION['mycart'], $_POST['amount'], $reference);
							          header("Location: $redirecturl");
							          exit;
							        }
							      }
							    ?>
								<form method="post" action="" name="payform">
					        	<input type="hidden" name="email" value=" <?php echo $_SESSION['cust_email'] ?> ">
					        	<input type="hidden" name="amount" value=" <?php echo $paydue ?> ">
					        	<input type="submit" class="btn btn-success btn-block" name="submit" id="paybtn" value="PAY">
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
include_once("footer.php");

?>