<?php session_start();
include_once("classes.php");
include_once("header.php");
if (!isset($_SESSION['mycart'])) {
  $_SESSION['mycart'] = time().rand(); 
}
?>


 <!------ Category & Banner ----->
 <div class="container-fluid" style="background-color: #f5f5f5">
    <div class="row" id="indxrw4">
      <div class="col-md-2 indxrw4col" id="indxrw4col1">
        <h6>CATEGORY</h6>
        <nav class="navbar bg-light">
            <ul class="navbar-nav">
                <?php 
                  $objcategory = new MyCategory;
                  $newcat = $objcategory->getCategory();
                  if(!empty($newcat)) {
                  foreach ($newcat as $key => $value) {
                  
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="category.php?category_id=<?php echo $value['category_id'];?>"><?php echo $value['category_name'] ?></a>
                </li>
                <?php 
                    } 
                  }
                ?>
              </ul>
          </nav>
      </div>

      <div class="col-md-8" id="banner">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">

          <div class="carousel-item active">
            <img src="images/banner1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="images/logo2.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="images/logo3.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="images/logo4.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>


    <div class="col-md-2 text-center animate__animated animate__backInDown">
      <h6>DELIVERIES</h6>
        <img src="images/delivery1.jpg" class="img-fluid" width="200" height="400">
    </div>

    </div>
 </div>


 <!------ About Us ----->
 <div class="container-fluid">
    <div class="row" id="indxrw5">
      <div class="col-md-8" id="r3c1">
        <h4>What we do best</h4>
        <p>
          At SKINSOL SKIN SCARE we produce and sell body cream and soap made with natural ingredient. No chemicals and no effect. Good for the whole family!
        </p>
        <p>
          Is your skin crying out for a remedy from dryness and irritation, green veins and stretch marks. Our super-protective glowing butter creams  are here for you!
        </p>
        <p>
          They are made using 100% nourishing butters and oils, all 100% organic.
          Products are getting sold out...hurry!
        </p>
      </div>

      <div class="col-md-4">
        <h4>Our Videos</h4>
          <iframe src="https://www.facebook.com/plugins/video.php?height=476&href=https%3A%2F%2Fweb.facebook.com%2FSkinsolskincare%2Fvideos%2F1954421638065219%2F&show_text=false&width=476&t=0" width="450" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true" class="mt-1 img-fluid" alt="advert videos"></iframe>
          <br>
      </div>
    </div>
 </div>


 <!------ Unique Selling Point ----->
 <div class="feature">
   <div class="container-fluid">
      <div class="row align-items-center" id="indxrw6">
          <div class="col-lg-3 col-md-6 feature-col">
              <div class="feature-content">
                <i class="fab fa-cc-mastercard"></i>
                  <h2>Secure Payment</h2>
                  <p>
                      Payments are very secure and compliant to PCI-DSS standard
                  </p>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 feature-col">
              <div class="feature-content">
                  <i class="fa fa-truck"></i>
                  <h2>Nationwide Delivery</h2>
                  <p>
                      We can deliver to anywhere within Nigeria
                  </p>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 feature-col">
              <div class="feature-content">
                  <i class="fa fa-sync-alt"></i>
                  <h2>10 Days Return</h2>
                  <p>
                      In the presence of a default,kindly return within stated duration
                  </p>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 feature-col">
              <div class="feature-content">
                  <i class="fa fa-comments"></i>
                  <h2>24/7 Support</h2>
                  <p>
                      We provide support on usage and any related issue you would want to discuss
                  </p>
              </div>
          </div>
      </div>
   </div>
  </div>


 <!------ Products One ----->
 <div class="container-fluid" style="background-color: #f5f5f5">
    <div class="row" id="indxrw7">
          <?php 
            $objget = new MyProduct;
            $output = $objget->getLimitedProduct();
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


 <!------ Referal ----->
 <div class="container-fluid" style="background-color: #f5f5f5">
    <div class="row" id="indxrw8">
      <div class="col-md-4 indxrw8col" id="indxrw8col1">
          <img src="images/customer1.jpg" alt="Image" class="img-fluid">
            <div class="review-text">
                <h5>Olanipekun Esther</h5>
                <p>
                    Moroccan herbal soap is the best soap,it works like magic it makes my skin smooth and soft, not only Moroccan herbal soap oh all Skinsol products is the best,I never regret using skinsol product...one love💕💕💕
                </p>
            </div>
        </div>

        <div class="col-md-4 indxrw8col" id="indxrw8col2">
          <img src="images/customer2.jpg" alt="Image" class="img-fluid">
            <div class="review-text">
                <h5>Ochuwa Amas</h5>
                <p>
                    Every skinsol skin care product is very effective.<br>I love it
                </p>
            </div>
        </div>

        <div class="col-md-4 indxrw8col" id="indxrw8col3">
          <img src="images/customer3.jpg" alt="Image" class="img-fluid">
            <div class="review-text">
                <h5>Awe Caroline Oluwanifemi</h5>
                <p>
                    Skinsol is just the best...I've known my skin to be a very hard skin. Anytime I changed cream, I'll be getting dark. But since I started using your products...<i>na yellow I dey yellow</i>, no bleaching at all<br>...loving my skin now
                </p>
            </div>
        </div>
      </div>
    </div>
   


 <!------ Products Two ----->
 <div class="container-fluid" style="background-color: #f5f5f5">
    <div class="row" id="indxrw9">
      <?php 
            $objget = new MyProduct;
            $output = $objget->getLimitedProduct();
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


 <!------ Advert Two ----->
 <div class="container-fluid" style="background-color: #f5f5f5">
    <div class="row" id="indxrw10">
      <div class="col-md-5 indxrw10col" id="indxrw10col1">
          <h6>NEWSLETTER</h6>
          <p>Subscribe to our newsletter for updates on our latest offers!</p>
          <form method="post" action="" class="form-group form-inline">
            <input type="email" name="user_email" id="user_email" placeholder="Enter your email address" class="form-control">&nbsp;
            <input type="submit" name="submit_btn" class="btn btn-dark" value="SUBMIT" class="form-control">
          </form>
      </div>

      <div class="col-md-3 indxrw10col" id="indxrw10col2">
          <h6>DOWNLOAD SKINSOL APP</h6>
          <p>Enjoy amazing weekend discounts!</p>
          <a href=""><img src="images/googleplay.png" class="img-fluid" width="100" height="55"></a> &nbsp;
          <a href=""><img src="images/appstore.png" class="img-fluid" width="100" height="55"></a>
      </div>

      <div class="col-md-4 text-right indxrw10col" id="indxrw10col3">
        <h5>DETTY DECEMBER</h5>
        <h6>MEGA SALES</h6>
        <p>Up to 20% off on all products</p>
      </div>

    </div>
 </div>



<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>