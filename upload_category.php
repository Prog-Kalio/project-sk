<?php
include_once("classes.php");	
include_once("header.php");	
?>

		<!-- Menu Row  -->
			<div class="row">

				
				<div class="col-md-2 offset-md-2 card card-body alert alert-dark mt-5">
					<h4>ADD SKINSOL CATEGORIES</h4><br>
					<?php 
						if (isset($_REQUEST['category_add_btn']) && $_REQUEST['category_add_btn'] =='Add Category') {
							
							if (empty($_REQUEST['category_name'])) {
								$error = "Please fill category";
							}
						
								$objequip = new MyCategory;
								$output = $objequip->addcategory($_REQUEST['category_name']);

								if(!empty($output)) {
								 	echo "<div class='alert alert-success'>Category added successfully!</div>";
								 	
								 	}
							
						}
					?>
		
			<form name="retailers_login_form" action="" method="post" class="form-group">
				<label>Name of Category</label>
				<input type="text" name="category_name" class="form-control">
				<br>
				<input type="submit" name="category_add_btn" class="btn btn-block btn-dark" value="Add Category">
			</form>
		</div>
	</div>

			





<?php  
include_once("whatsapp.php");
include_once("footer.php");
?>