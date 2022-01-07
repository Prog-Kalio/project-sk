<?php 
include_once("header.php");
include_once("classes.php");
?>


		<!-- Category Page -->
		<div class="container-fluid">
			<div class="row cnt-row" id="ctgrw">

				<div class="col-md-2 ctgrwcol" id="ctgrwcol1">
					<div class="btn-group-vertical btn-block" id="btn-category" role="group" aria-label="Button group with nested dropdown">
					  <button type="button" class="btn btn-dark"><b>CATEGORIES</b></button>
					  	<?php 
							$objcategory = new MyCategory;
							$newcat = $objcategory->getCategory();
							if(!empty($newcat)) {
							foreach ($newcat as $key => $value) {
							
						?>
					  <a href="category.php?category_id=<?php echo $value['category_id'];?>"><button type="button" class="btn btn-ctg"><?php echo $value['category_name'] ?></button></a>
					  <?php 
								} 

							}
					  ?>
					</div>
				</div>

			
				<?php 
				$objprofile = new MyCategory;
				$category_id = $_GET['category_id'];
				$output = $objprofile->getSpecificCategory($category_id);
				if(!empty($output)) {
				foreach ($output as $key => $value) {
				
				?>

				<div class="col-md-2 mt-5 ctgrwcol" id="ctgrwcol2">
					<a href="product_details.php?product_id=<?php echo $value['product_id'];?>">
					<?php if(empty($value['product_image'])) { ?>
					<img class="card-img-top" src="images/lab-5.png" class="img-fluid" alt="Product" width="250" height="250">	
					<?php } else { ?>
					<img class="card-img-top" src="uploads/<?php echo $value['product_image'] ?>" alt="equipments" width="250" height="250">
					<?php } ?>
					<br>
					<p><b><?php echo $value['product_name']; ?></b></p>
					<p><span class="span-buy">N</span><?php echo number_format($value['product_price'], 2); ?></p>
                	</a>
                	
				</div>

				<?php 
					} 

				}
			?>

		</div>
	</div>

<?php include_once("whatsapp.php") ?>
<?php include_once("footer.php") ?>
