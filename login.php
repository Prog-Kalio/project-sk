
<?php session_start();
include_once("classes.php");
include_once("header.php")

?>
  
  <div class="title-div my-3 text-center"><h3>LOGIN PAGE</h3></div>


      <div id="lognrw">

          <div id="lognrw1c1" class="animate__animated animate__rotateInDownLeft animate__slower 2s"> 
            <img src="images/skin6.jpg" alt="skin problems" width="280" height="200">
          </div>

          <div id="lognrw1c2" class="animate__animated animate__zoomIn animate__slower 2s">

              <!-- PHP Login for customers -->
                <?php  

                    if (isset($_POST['cust_signin_btn']) && $_POST['cust_signin_btn']== 'Sign In') {

                      $formerrors = array();

                      if (empty($_POST['cust_email'])) {
                        $formerrors[] = "Email field is required";
                      }

                      if (empty($_POST['cust_password'])) {
                        $formerrors[]= "Password field is required";
                      }

                      if (!empty($formerrors)) {
                        echo "<ul class='alert alert-danger mt-2'>";
                        foreach ($formerrors as $key => $value) {
                          echo "<li>$value</li>";
                        }
                        echo "</ul>";
                      }
                      elseif (empty($formerrors)) {
                        $objlogin = new MyCustomers;
                        $_POST['cust_password'] = md5($_POST['cust_password']);

                        $output = $objlogin->login($_POST['cust_email'], $_POST['cust_password']); 
                        if (!$output) {
                          echo "<p class='alert alert-danger'>Invalid Login credentials</p>";
                        }
                        else {
                          // so create session variables
                          $_SESSION['cust_email'] = $_POST['cust_email'];
            
                          // // to go a step further, add a special key to authenticate who is in session.
                          $_SESSION['skinsol'] = "2021+Skins@_||";
                          header("Location: customers_dashboard.php");
                          exit;
                          
                        }
                      }

                    }

                ?>
              <!-- Customers login form -->
              <form name="form-ExtUser" action="" method="post" class="form-group">
                <label>Email Address</label>
                <input type="email" name="cust_email" class="form-control">
                <label>Password</label>
                <input type="password" name="cust_password" class="form-control"><br>
                <input type="submit" name="cust_signin_btn" class="btn btn-block btn-dark" value="Sign In">
              </form>
            </div>
          
        
        <div id="lognrw1c3" class="animate__animated animate__rotateInDownRight animate__slower 2s">
          <img src="images/skin5.jpg" alt="skin problems" width="280" height="200">
        </div>

    </div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>