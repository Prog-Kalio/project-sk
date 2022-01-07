<?php
include_once("classes.php");
include_once("header.php")

?>
	
	
 <!------ Products One ----->
 <div class="container-fluid" style="background-color: #f5f5f5">
 	<div class="title-div mt-3 text-center"><h3>OUR PRODUCTS</h3></div>
    <div class="row" id="indxrw7">
          <?php 
            $objget = new MyProduct;
            $output = $objget->getProduct();
            if(!empty($output)) {
            foreach ($output as $key => $value) {
          
          ?>
          <div class="col-md-2 mt-2 indxrw7col" id="indxrw7col1" style="padding-top: 8px">
            <a href="product_details.php?product_id=<?php echo $value['product_id'];?>">
            <?php if(empty($value['product_image'])) { ?>
              <img class="card-img-top" src="images/logo12.png" class="img-fluid" alt="product" width="250" height="250"> 
              <?php } else { ?>
              <img class="card-img-top" src="uploads/<?php echo $value['product_image'] ?>" alt="products" width="250" height="250">
              <?php } ?>
              <p><b><?php echo $value['product_name']; ?></b></p>
              <p><span class="span-buy">N</span><?php echo number_format($value['product_price'], 2); ?></p>
            </a>
            </div>
            <?php 
                } 

              }
            ?>
    </div>


    <div class="row" id="indxrw7">
          <?php 
            $objget = new MyProduct;
            $output = $objget->getProduct();
            if(!empty($output)) {
            foreach ($output as $key => $value) {
          
          ?>
          <div class="col-md-2 mt-2 indxrw7col" id="indxrw7col1" style="padding-top: 8px">
            <a href="product_details.php?product_id=<?php echo $value['product_id'];?>">
            <?php if(empty($value['product_image'])) { ?>
              <img class="card-img-top" src="images/logo12.png" class="img-fluid" alt="product" width="250" height="250"> 
              <?php } else { ?>
              <img class="card-img-top" src="uploads/<?php echo $value['product_image'] ?>" alt="products" width="250" height="250">
              <?php } ?>
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



<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>