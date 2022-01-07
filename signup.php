<?php session_start();
include_once("classes.php");
include_once("header.php")

?>
	    <div class="title-div my-3 text-center">
         <h3>SIGNUP PAGE</h3>
      </div>

      <div id="sgnrw">
          <div id="sgnrw1c1" class="animate__animated animate__slideInLeft animate__slower 2s">
            <h5>Skin Goal?</h5>
            <img src="images/skin2.jfif" alt="skin problems" width="280" height="200">
          </div>

          
          <!-- Customers signup form -->
          <div id="sgnrw1c2" class="animate__animated animate__fadeInDownBig animate__slower 2s">
            <!-- PHP Signup for customers -->
            <?php  

            if (isset($_POST['cust_signup_btn']) && $_POST['cust_signup_btn'] == 'Sign Up') {

              // next we validate the fields, but first let's open an array to store all received feedback or errors

              $errors = array();

              if (empty($_POST['cust_phone'])) {
                $errors[] = "Phone Number is required!";
              }

              if (empty($_POST['cust_email'])) {
                $errors[] = "Email Address is required!";
              }

              if (empty($_POST['cust_password'])) {
                $errors[] = "Password is required!";
              }

              if(empty($errors)) {
                $objuser = new MyCustomers;

                // check if email address exists
                      if ($objuser->checkEmailAddress($_POST['cust_email']) == true) {
                        echo "<div class='alert alert-danger'>Email Address already taken!</div>";
                      }
                      else {
                        // register
                $new_User = $objuser->addCustomers($_POST['cust_phone'], $_POST['cust_email'], $_POST['cust_password']);

                  // so create session variables
                  $_SESSION['cust_phone'] = $_POST['cust_phone'];
                  $_SESSION['cust_email'] = $_POST['cust_email'];
    
                  // // to go a step further, add a special key to authenticate who is in session.
                  $_SESSION['skinsol'] = "2021+Skins@_||";

                header("Location: customers_dashboard.php?msg=Successfuly logged in");
                exit;
                }
              }

              // next we alert the errors found

              if (!empty($errors)) {

                echo "<ul class='alert alert-danger'>";
                      foreach ($errors as $key => $value) {
                        echo "<li>$value</li>";
                          }
                        echo "</ul>";
              }

            }

            ?>
            
              <form id="form-newUser" action="" method="post" class="form-group" name="NewUser-Form">
        
                
                <label>Phone Number</label>
                <input type="text" name="cust_phone" class="form-control">
                <label>Email Address</label>
                <input type="email" name="cust_email" class="form-control">
                <label>Password</label>
                <input type="password" name="cust_password" class="form-control">
                <br>
                <input type="submit" id="cust_signup_btn" class="btn btn-block btn-dark" name="cust_signup_btn" value="Sign Up">
              </form>
        </div>
        
        <div id="sgnrw1c3" class="animate__animated animate__slideInRight animate__slower 2s">
          <h5>Let's make it happen</h5>
          <img src="images/skin1.jpg" alt="skin problems" width="280" height="200">
        </div>

    </div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>          