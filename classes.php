<?php 
/*
Author: Oluwasegun Arheyun, Kalio Tamunotonye, Motunrayo Ogunyemi
Program: Skinsol Skincare 
Date: 24th December, 2021
*/


// Including constant
include_once("constants.php");

// Start MyProduct Class Diagram

// create class
	class MyProduct {

		// create variables/properties/attributes
		public $product_name;
		public $product_price;
		public $product_info;
		public $product_image;
		public $dbcon; //database coonection handler

		// create method/functions/operations

		function __construct() {
			$this->dbcon = new MySqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

			if ($this->dbcon->connect_error) {
				die("Connection failed".$this->dbcon->connect_error)."<br>";
			}
			// else {
			// 	echo "Connection Successful";
			// }
		}


		function getProductById($id) {
			$sql = "SELECT * FROM products WHERE product_id='$id'";
			$details=[];
			$result = $this->dbcon->query($sql);
			
			if ($this->dbcon->affected_rows > 0) {
					$details=$result->fetch_assoc();
			}
			return $details;
		}


		function getProduct() {
			$sql = "SELECT * FROM products ORDER BY rand()";

			$result = $this->dbcon->query($sql);
			$rows = array();
			if ($this->dbcon->affected_rows > 0) {
				while($row = $result->fetch_array()) {
					$rows[] = $row;
				}
				return $rows;
			}
			else {
				return $rows;
			}
		}



		function getLimitedProduct() {
			$sql = "SELECT * FROM products ORDER BY rand() LIMIT 6";

			$result = $this->dbcon->query($sql);
			$rows = array();
			if ($this->dbcon->affected_rows > 0) {
				while($row = $result->fetch_array()) {
					$rows[] = $row;
				}
				return $rows;
			}
			else {
				return $rows;
			}
		}




		function searchProduct($searchdata) {
			$sql = "SELECT * FROM products WHERE product_name LIKE '%$searchdata%'";
			// var_dump($sql);
			
			$result = $this->dbcon->query($sql);
			$rows = array();
			if($this->dbcon->affected_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$rows[] = $row;
				}
				return $rows;
			}
			return $rows;
		}



		public function uploadImage($product_name, $product_price, $product_info, $product_image) {
		
		// first define variables
		$file_name = $_FILES['product_image']['name'];
		$file_type = $_FILES['product_image']['type'];
		$file_tmp_name = $_FILES['product_image']['tmp_name'];
		$file_error = $_FILES['product_image']['error'];
		$file_size = $_FILES['product_image']['size'];

		// validate
		$error = array();

		if ($file_error > 0) {
			$error[] = "You are yet to upload a file";
		}

		if ($file_size > 2097512) {
			$error[] = "Max file size is 2MB";
		}

		$extensions = array("jpeg", "jpg", "png", "svg");

		$file_ext = explode(".", $file_name);

		$file_ext = end($file_ext);

		if (!in_array(strtolower($file_ext), $extensions)) {
			$error[] = $file_ext." file format not supported!";
		}
		if (!empty($error)) {
			foreach ($error as $key => $value) {
				return "<div class='alert alert-danger'>$value</div>";
			}
		}
		
		$folder = "uploads/";

		$newfilename = time().rand().".".$file_ext;

		$destination = $folder.$newfilename;

		if(move_uploaded_file($file_tmp_name, $destination)) {

			$sql = "INSERT INTO products(product_name, product_price, product_info, product_image) VALUES('$product_name', '$product_price', '$product_info', '$newfilename')";
			// var_dump($sql);
			$result = $this->dbcon->query($sql);
			 if($this->dbcon->affected_rows == 1) {
			 	// echo "<p>Product added successfuly</p>";
			 	// return true;
			 }
			 else {
			 	echo "could not be added".$this->dbcon->error;
			 	// return false;
			 }
		}
	}



		// update equipment
		public function updateProduct($product_name, $product_price, $product_info, $product_image) {


			// first define variables
		$file_name = $_FILES['product_image']['name'];
		$file_type = $_FILES['product_image']['type'];
		$file_tmp_name = $_FILES['product_image']['tmp_name'];
		$file_error = $_FILES['product_image']['error'];
		$file_size = $_FILES['product_image']['size'];

		// validate
		$error = array();

		if ($file_error > 0) {
			$error[] = "You are yet to upload a file";
		}

		if ($file_size > 2097512) {
			$error[] = "Max file size is 2MB";
		}

		$extensions = array("jpeg", "jpg", "png", "svg");

		$file_ext = explode(".", $file_name);

		$file_ext = end($file_ext);

		if (!in_array(strtolower($file_ext), $extensions)) {
			$error[] = $file_ext." file format not supported!";
		}
		if (!empty($error)) {
			foreach ($error as $key => $value) {
				return "<div class='alert alert-danger'>$value</div>";
			}
		}
		
		$folder = "uploads/";

		$newfilename = time().rand().".".$file_ext;

		$destination = $folder.$newfilename;

		if(move_uploaded_file($file_tmp_name, $destination)) {

			// write the query
			$sql = "UPDATE equipments SET product_name='$product_name', product_price='$product_price', product_info='$product_info', product_image='$newfilename' WHERE product_name='$product_name'";

			// run the query
			$result =$this->dbcon->query($sql);

			$output = array();
			if ($this->dbcon->affected_rows==1) {
				$output['success'] = "Equipment details was successfully updated";
			} 
			elseif ($this->dbcon->affected_rows==0) {
				$output['success'] = "No changes made!";
			}
			else {
				$output['error'] = "An error occured!".$this->dbcon->error;
			}
			return $output;
			}
		}

}


// End MyProduct Class Diagram



// Start My Customers Class Diagram

// create class
	class MyCustomers {

		// create variables/properties/attributes
		public $cust_phone;
		public $cust_email;
		public $cust_password;
		public $dbcon; //database connection handler


		//create method/function/operation
		function __construct() {
			$this->dbcon = new MySqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

			if ($this->dbcon->connect_error){
				die("Connection failed".$this->dbcon->connect_error)."<br>";
			}
			// else {
			// 	echo "Connection successful";
			// }
		}



		function addCustomers($cust_phone, $cust_email, $cust_password) {

		// encrypt password
		$encr_pswd = md5($cust_password);

		$sql = "INSERT INTO customers(cust_phone, cust_email, cust_password) VALUES('$cust_phone', '$cust_email', '$encr_pswd')";

		// check result
		$result = $this->dbcon->query($sql);

			if ($this->dbcon->affected_rows == 1) {
				// instead of returning true, let's create session since we want to proceed to dashboard
				// so create session variables
					
					$_SESSION['cust_id'] = $this->dbcon->insert_id;
					$_SESSION['cust_phone'] = $cust_phone;
					$_SESSION['cust_email'] = $cust_email;
				
					// to go a step further, add a special key to authenticate who is in session.
					$_SESSION['skinsol'] = "2021+Skins@_||";

				// next is to redirect to dashboard
				return true;
			}
			else {
				return "Contact could not be added <br>";
			}

		}


		// check if email address exists
		function checkemailaddress($cust_email) {

			// write query
			$sql = "SELECT cust_email FROM customers WHERE cust_email='$cust_email'";
			 // run the query
			$result = $this->dbcon->query($sql);
			if ($this->dbcon->affected_rows == 1) {
				return false;
			}
			else {
				return false;
			}
		}


		// Get all Users information
		function getCustomers() {
			$sql = "SELECT * FROM customers";

			$result = $this->dbcon->query($sql);
			$rows = array();

			if ($this->dbcon->affected_rows > 0) {
				while ($row = $result->fetch_array()) {
					$rows[] = $row;
				}
				return $rows;
			}
			else {
				return $rows;
			}
			
		}


		function login($cust_email, $cust_password) {

			$encr_pswd = md5($cust_password);
			$sql = "SELECT cust_email FROM customers WHERE cust_email='$cust_email' AND cust_password='$cust_password'";
			$result = $this->dbcon->query($sql);
			
			if ($result->num_rows==1) {
				return true;
			} 
			else {
				return false;
			}
			
		}


	}

// End  MyCustomers Class Diagram




// Start My Category Class Diagram

	class MyCategory {

		public $category_name;
		public $dbcon; //database connection handler


		//create method/function/operation
		function __construct() {
			$this->dbcon = new MySqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

			if ($this->dbcon->connect_error){
				die("Connection failed".$this->dbcon->connect_error)."<br>";
			}
			// else {
			// 	echo "Connection successful";
			// }
		}



		function addCategory($category_name) {

		$sql = "INSERT INTO category(category_name) VALUES('$category_name')";

		// check result
		$result = $this->dbcon->query($sql);

			if ($this->dbcon->affected_rows == 1) {
				return true;
			}
			else {
				return false;
			}

		}



		// Get all Categories
		function getSpecificCategory($category_id) {
			$sql = "SELECT products.* FROM products JOIN category ON category.category_id=products.category_id WHERE products.category_id LIKE '$category_id' ORDER BY rand()";


			$result = $this->dbcon->query($sql);
			$rows = array();

			if ($this->dbcon->affected_rows > 0) {
				while ($row = $result->fetch_array()) {
					$rows[] = $row;
				}
				return $rows;
			}
			else {
				return $rows;
			}
			
		}



		// Get all Users information
		function getCategory() {
			$sql = "SELECT * FROM category";

			$result = $this->dbcon->query($sql);
			$rows = array();

			if ($this->dbcon->affected_rows > 0) {
				while ($row = $result->fetch_array()) {
					$rows[] = $row;
				}
				return $rows;
			}
			else {
				return $rows;
			}
			
		}



		// Get all categories and equipment information
		function getAllCategory() {
			$sql = "SELECT category.category_id, category.category_name, products.product_name FROM category JOIN products ON category.category_id=products.category_id ORDER BY category.category_id";

			$result = $this->dbcon->query($sql);
			$rows = array();

			if ($this->dbcon->affected_rows > 0) {
				while ($row = $result->fetch_array()) {
					$rows[] = $row;
				}
				return $rows;
			}
			else {
				return $rows;
			}
			
		}

	}

// End MyCategory class diagram



// Start My Cart Class Diagram

	class MyCart {

		public $product_name;
		public $quantity;
		public $product_price;
		public $session_id; 
		public $dbcon; //database connection handler


		//create method/function/operation
		function __construct() {
			$this->dbcon = new MySqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

			if ($this->dbcon->connect_error){
				die("Connection failed".$this->dbcon->connect_error)."<br>";
			}
			// else {
			// 	echo "Connection successful";
			// }
		}



		function addToCart($product_name, $quantity, $product_price, $session_id) {
			
		$sql = "INSERT INTO cart(product_name, quantity, product_price, session_id) VALUES('$product_name', '$quantity', '$product_price', '$session_id')";

		// check result
		$result = $this->dbcon->query($sql);

			if ($this->dbcon->affected_rows == 1) {
				return true;
			}
			else {
				return false;
			}

		}


		// Get all Users information
		function getFromCart($session_id) {
			$sql = "SELECT * FROM cart WHERE session_id = '$session_id'";

			$result = $this->dbcon->query($sql);
			$rows = array();

			if ($this->dbcon->affected_rows > 0) {
				while ($row = $result->fetch_array()) {
					$rows[] = $row;
				}
				return $rows;
			}
			else {
				return $rows;
			}
			
		}



		public function editCart($quantity, $cart_id) {
			// write the query
			$sql = "UPDATE cart SET quantity='$quantity' WHERE cart_id='$cart_id'";

			// run the query
			$result =$this->dbcon->query($sql);

			$output = array();
			if ($this->dbcon->affected_rows==1) {
				$output['success'] = "Quantity was successfully updated";
			} 
			elseif ($this->dbcon->affected_rows==0) {
				$output['success'] = "No changes made!";
			}
			else {
				$output['error'] = "An error occured!".$this->dbcon->error;
			}
			
		}

		//  ?


		public function deleteItemIncart($cart_id) {
			// write the query
			$sql = "DELETE FROM `cart` WHERE cart.cart_id='$cart_id'";
			var_dump($sql);
			// run the query
			$result =$this->dbcon->query($sql);

			$output = array();
			if ($this->dbcon->affected_rows==1) {
				$output['success'] = "Equipment was successfully deleted";
			} 
			elseif ($this->dbcon->affected_rows==0) {
				$output['success'] = "No changes made!";
			}
			else {
				$output['error'] = "An error occured!".$this->dbcon->error;
			}
			
		}

	}

// End MyCart class Diagram



// // Start AllDetails Class Diagram

// // create class
// 	class AllDetails {

// 		// create variables/properties/attributes
// 		public $cust_firstname;
// 		public $cust_lastname;
// 		public $cust_phone;
// 		public $cust_email;
// 		public $cust_password;
// 		public $cust_gender;
// 		public $cust_address;
// 		public $dbcon; //database connection handler


// 		//create method/function/operation
// 		function __construct() {
// 			$this->dbcon = new MySqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

// 			if ($this->dbcon->connect_error){
// 				die("Connection failed".$this->dbcon->connect_error)."<br>";
// 			}
// 			// else {
// 			// 	echo "Connection successful";
// 			// }
// 		}


// 		function signCustomers($cust_firstname, $cust_phone, $cust_email) {

// 		$sql = "INSERT INTO customers(cust_firstname, cust_phone, cust_email) VALUES('$cust_firstname', '$cust_phone', '$cust_email')";

// 		// check result
// 		$result = $this->dbcon->query($sql);

// 			if ($this->dbcon->affected_rows == 1) {
// 				return true;
// 			}
// 			else {
// 				return "Contact could not be added <br>";
// 			}

// 		}



// 		function addCustomers($cust_firstname, $cust_lastname, $cust_phone, $cust_email, $cust_password, $cust_gender, $cust_address) {

// 		// encrypt password
// 		$encr_pswd = md5($cust_password);

// 		$sql = "INSERT INTO customers(cust_firstname, cust_lastname, cust_phone, cust_email, cust_password, cust_gender, cust_address) VALUES('$cust_firstname', '$cust_lastname', '$cust_phone', '$cust_email', '$encr_pswd', '$cust_gender', '$cust_address')";

// 		// check result
// 		$result = $this->dbcon->query($sql);

// 			if ($this->dbcon->affected_rows == 1) {
// 				// instead of returning true, let's create session since we want to proceed to dashboard
// 				// so create session variables
					
// 					// $_SESSION['cust_id'] = $this->dbcon->insert_id;
// 					// $_SESSION['cust_firstname'] = $cust_firstname;
// 					// $_SESSION['cust_lastname'] = $cust_lastname;
// 					// $_SESSION['cust_phone'] = $cust_phone;
// 					// $_SESSION['cust_email'] = $cust_email;
// 					// $_SESSION['cust_gender'] = $cust_gender;
// 					// $_SESSION['cust_address'] = $cust_address;
// 					// // to go a step further, add a special key to authenticate who is in session.
// 					// $_SESSION['mem'] = "@@Exec_2090%";

// 				// next is to redirect to dashboard
// 				return true;
// 			}
// 			else {
// 				return "Contact could not be added <br>";
// 			}

// 		}


// 		// check if email address exists
// 		function checkemailaddress($cust_email) {

// 			// write query
// 			$sql = "SELECT cust_email FROM customers WHERE cust_email='$cust_email'";
// 			 // run the query
// 			$result = $this->dbcon->query($sql);
// 			if ($this->dbcon->affected_rows == 1) {
// 				return false;
// 			}
// 			else {
// 				return false;
// 			}
// 		}


// 		// Get all Users information
// 		function getCustomers() {
// 			$sql = "SELECT * FROM customers";

// 			$result = $this->dbcon->query($sql);
// 			$rows = array();

// 			if ($this->dbcon->affected_rows > 0) {
// 				while ($row = $result->fetch_array()) {
// 					$rows[] = $row;
// 				}
// 				return $rows;
// 			}
// 			else {
// 				return $rows;
// 			}
			
// 		}


// 		function login($cust_email, $cust_password) {

// 			$encr_pswd = md5($cust_password);
// 			$sql = "SELECT cust_email FROM customers WHERE cust_email='$cust_email' AND cust_password='$cust_password'";
// 			$result = $this->dbcon->query($sql);
			
// 			if ($result->num_rows==1) {
// 				return true;
// 			} 
// 			else {
// 				return false;
// 			}
			
// 		}


// 	}

// // End  AllDetails Class Diagram


?>