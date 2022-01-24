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
      <h5>Delivery Details</h5>
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
        <!-- PHP Signup for customers -->
            <?php  

            if (isset($_POST['cust_signup_btn']) && $_POST['cust_signup_btn'] == 'CONFIRM') {

              // next we validate the fields, but first let's open an array to store all received feedback or errors

              $errors = array();

              if (empty($_POST['cust_firstname'])) {
                $errors[] = "Firstname is required!";
              }
              if (empty($_POST['cust_lastname'])) {
                $errors[] = "Lastname is required!";
              }
              if (empty($_POST['cust_phone'])) {
                $errors[] = "Phone Number is required";
              }
              if (empty($_POST['cust_email'])) {
                $errors[] = "Email is required";
              }
              if (empty($_POST['cust_gender'])) {
                $errors[] = "Gender is required!";
              }
              if (empty($_POST['cust_address'])) {
                $errors[] = "Address is required!";
              }
              if (empty($_POST['terms'])) {
                $errors[] = "You are yet to agree to our Terms!";
              }

              else {
                $objuser = new MyPayingCustomers;

                if (isset($_SESSION['mycart'])) {
                  // register
                  $new_User = $objuser->addPayingCustomers($_POST['cust_firstname'], $_POST['cust_lastname'], $_POST['cust_phone'], $_POST['cust_email'], $_POST['cust_gender'], $_FILES['cust_image'], $_POST['cust_address']);

                  // so create session variables
                  $session_id = $_SESSION['mycart'];
                  $_SESSION['cust_firstname'] = $_POST['cust_firstname'];
                  $_SESSION['cust_lastname'] = $_POST['cust_lastname'];
                  $_SESSION['cust_phone'] = $_POST['cust_phone'];
                  $_SESSION['cust_email'] = $_POST['cust_email'];
                  $_SESSION['cust_gender'] = $_POST['cust_gender'];
                  $_SESSION['cust_image'] = $myfilename;
                  $_SESSION['cust_address'] = $_POST['cust_address'];
                  // to go a step further, add a special key to authenticate who is in session.
                  $_SESSION['skinsol'] = "2021+Skins@_||";

                header("Location: customers_dashboard.php?msg=Successfuly updated");
                exit;
                }
              }

              // next we alert the errors found

              

            }

            ?>

          <!-- Customers signup form -->
          <div id="div-NewUser" class="col-md-5">
            
              <form id="form-newUser" action="" method="post" class="form-group" name="NewUser-Form" enctype="multipart/form-data">
                
                <label>Firstname</label>
                <input type="text" name="cust_firstname" class="form-control mr-3"> 
                <label>Lastname</label>
                <input type="text" name="cust_lastname" class="form-control">
                <label>Phone Number</label>
                <input type="text" name="cust_phone" class="form-control">
                <label>Email Address</label>
                <input type="email" name="cust_email" class="form-control">
                <label>Select Gender</label>&nbsp;
                <input type="radio" name="cust_gender" value="male"> Male
                <input type="radio" name="cust_gender" value="female"> Female<br>
                <label>Profile Pics</label>
                <input type="file" name="cust_image" class="form-control">
                <small>Images only (png, jpg, jpeg, gif) with max-size: 2MB</small><br>
                <label>Mailing Address</label>
                <textarea id="cust_address" name="cust_address" class="form-control" rows="3"></textarea>
                <input type="checkbox" name="terms"> I agree to <a href="#" data-toggle="modal" data-target="#staticBackdrop">Terms & Conditions</a><br>
                <input type="submit" id="cust_signup_btn" class="btn btn-block btn-dark" name="cust_signup_btn" value="CONFIRM">
              </form>
            </div>
      </div>
       
    </div>
  </div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>