<?php session_start();
include_once("header.php");
include_once("classes.php");

?>



		<!-- Row 12 Product Details -->
		<div class="container-fluid">
			<div class="inb-div"><h5>PRODUCT DETAILS</h5></div>
			<div class="row cnt-row" id="equp-row">
				<?php $product_id=$_GET['product_id'];
				$objprofile = new MyProduct;
				$value = $objprofile->getProductById($product_id);
				if(!empty($value)) {
				
				?>
				<div class="col-md-5">
					<div class="main-gallery-div" style="padding: 15px;">
						<?php if(empty($value['product_image'])) { ?>
						<img src="images/product1.jpeg" class="img-fluid main-galleryimg" alt="<?php echo $value['product_name'];?>">
						<?php } else { ?>
						<img src="uploads/<?php echo $value['product_image'] ?>" class="img-fluid" width="400" height="250">
						<?php } ?>
					</div>
					
					
				</div>

				<div class="col-md-4 equip-col" id="equip-col2">
					<h3><?php echo $value['product_name']; ?></h3><br>
					<h6><span class="span-buy">N</span><?php echo number_format($value['product_price'], 2); ?></h6><br>
                    	
                    <div>
                    	<?php 
                    		if(isset($_POST['btn-buy1']) &&  $_POST['btn-buy1']=='ADD TO CART') {
                    			if(empty($_POST['quantity'])) {
                    				echo "<div class='alert alert-danger'>Quantity must carry a value from 1 and above (No decimals also)</div>";
                    			}
                    			else {
                    				$objcart = new MyCart;
                    				$equip_name = $_POST['product_name'];
                    				$equip_price = $_POST['product_price'];
                    				$quantity = $_POST['quantity'];
                    				$session_id = $_SESSION['mycart'];
									$newcart = $objcart->addToCart($_POST['product_name'], $_POST['quantity'], $_POST['product_price'], $session_id);
									
									// to go a step further, add a special key to authenticate who is in session.
									$_SESSION['skinsol'] = "2021+Skins@_||";
									if(isset($_SESSION['cust_email'])) {
										header("Location: cart.php?msg=Welcome back");
									}
									else {
									header("Location: login.php?msg=Successfuly added to cart");
									exit;
									}
                    			}
                    		}
                    	?>
                    	<form name="cartform" method="post" action="" class="form-group">
                    		<input type="hidden" name="product_name" value="<?php echo $value['product_name'] ?>">
                    		<label>Qty: </label>
                    		<input type="number" name="quantity" id="qty" size="2px" style="text-align:center">
                    		<input type="hidden" name="product_price" value="<?php echo $value['product_price'] ?>">
                    		<br><br>
                    		<input type="submit" class="btn btn-success" name="btn-buy1" value="ADD TO CART">
                    	</form>
                    	
                    </div><br>
					
					<br><br>
					<h5>FEATURES:</h5>
					<p>
						<?php echo $value['product_info'] ?>
					</p>
				</div>

				<?php 
					 

				}
			?>
			</div>
		</div>

		

<?php include_once("whatsapp.php") ?>
<?php include_once("footer.php") ?>
