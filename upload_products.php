<?php
include_once("classes.php");
include_once("header.php")

?>


<div class="col-md-4 offset-md-2">
					<h4>UPLOAD NEW PRODUCT</h4><br>
					<?php 
						if (isset($_REQUEST['product_btn']) && $_REQUEST['product_btn'] =='SUBMIT') {
							$errorfound = array();
							if (empty($_REQUEST['product_name'])) {
								$errorfound[] = "Name is required";
							}
							if (empty($_REQUEST['product_price'])) {
								$errorfound[] = "Price is required";
							}
							if (empty($_REQUEST['product_info'])) {
								$errorfound[] = "Info is required";
							}
							if(!empty($errorfound)) {
								echo "<ul class='alert alert-danger'>";
								foreach ($errorfound as $key => $value) {
									echo "<li>$value</li>";
								}
								echo "</ul>";
							}
						
								$objprod = new MyProduct;
								$output = $objprod->uploadImage($_REQUEST['product_name'], $_REQUEST['product_price'], $_REQUEST['product_info'], $_FILES['product_image']);

								if(empty($output)) {
								 	echo "<div class='alert alert-success'>Product added successfully!</div>";
								 	
								 	}
							
						}
					?>
					<form method="post" action="" name="product_form" class="form-group" enctype="multipart/form-data">
						<div>
							<label>Name:</label>
							<input type="text" name="product_name" class="form-control">
						</div>

						<div>
							<label>Price:</label>
							<input type="text" name="product_price" class="form-control">
						</div>

						<div>
							<label>Info:</label>
							<input type="text" name="product_info" class="form-control">
						</div>

						<div>
							<label>Image:</label>
							<input type="file" name="product_image" class="form-control">
							<small>Images only (png, jpg, jpeg, gif) with max-size: 2MB</small>
						</div><br>
						
						<div>
							<input type="submit" name="product_btn" value="SUBMIT" class="btn btn-block btn-secondary">
						</div>
						</form>
				</div>

<?php  
include_once("whatsapp.php");
include_once("footer.php");
?>