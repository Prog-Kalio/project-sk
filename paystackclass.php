<?php 
	
	// include constants file
	include_once("constants.php");

	// begin class Payment

	class Payment {
		// member variables/properties/attributes
		public $amount;
		public $email;
		public $dbcon; //database connection handler

		// member methods/functions
		public function __construct() {
			$this->dbcon = new MySqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

			if ($this->dbcon->connect_error) {
				die("Connection failed".$this->dbcon->connect_error)."<br>";
			} 

			else {
				// echo "Connection successful <br>";
			}
		}


		// 1st leg: Initialize paystack transaction method 
		public function initializePaystack($email, $amount) {
			$url = "https://api.paystack.co/transaction/initialize";

			$reference = "SS".time().rand(); //SS we used here was from Skinsol Skincare
			$callbackurl = "http://localhost/skinsol/paystackcallback.php";

			$fields = [
		    'email' => $email,
		    'amount' => $amount * 100,
		    'reference' => $reference,
		    'callback_url' => $callbackurl
		  	];
		  	$fields_string = http_build_query($fields);

		  	$secretkey = "sk_test_90bf0075eb2edd535d218390dbbea8453017ecac";


		  	// step 1: Open connection, initialize curl session
		  	$ch = curl_init(); //ch is the curl session

		  	// step 2: set the url, number of POST vars, POST data
			  curl_setopt($ch,CURLOPT_URL, $url);
			  curl_setopt($ch,CURLOPT_POST, true);
			  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    "Authorization: Bearer $secretkey",
			    "Cache-Control: no-cache",
			  ));
			  
			  //So that curl_exec returns the contents of the cURL; rather than echoing it
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //we used this to ignore SSL certificate since our site is on local host. But for live projects, enable "true"
			  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 


			// step 3: execute curl
			 $response = curl_exec($ch);

			 // validate or check if there is anything inside it
			 if (curl_error($ch)) {
			 	echo curl_error($ch);
			 }


			 // step 4: close curl session
			 curl_close($ch);


			 // step 5: convert json to object
			 $result = json_decode($response);

			 return $result;
			 // header("Location: customer_dashboard.php?successmsg=Successfully paid");

		}


		// insert payment transaction details
		public function insertTransactionDetails($session_id, $amount, $reference) {
			$paymentmode = "paystack";
			$transstatus = "pending";
			$dueyear = date('Y-m-d');
			$datepaid = date('Y-m-d h:i:s');

			$sql = "INSERT INTO order_details(session_id, amount, transref, transstatus, dueyear, datepaid, paymentmode) VALUES('$session_id', '$amount', '$reference', '$transstatus', '$dueyear', '$datepaid', '$paymentmode')";

			$response = $this->dbcon->query($sql);
			if ($this->dbcon->affected_rows == 1) {
				return true;
				
			}
			else {
				return false;
			}
		}
		
		

		public function verifyPaystack($reference) {
			$url = "https://api.paystack.co/transaction/verify/".$reference;
			$secretkey = "sk_test_90bf0075eb2edd535d218390dbbea8453017ecac";

			// step 1: open connection
			$ch = curl_init();


			// step 2: set curl options
			  curl_setopt($ch,CURLOPT_URL, $url);
			  curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
			  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    "Authorization: Bearer $secretkey",
			    "Cache-Control: no-cache",
			  ));
			  
			  //So that curl_exec returns the contents of the cURL; rather than echoing it
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //we used this to ignore SSL certificate since our site is on local host. But for live projects, enable "true"
			  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 



			  // step 3: execute curl
			 $response = curl_exec($ch);

			 // validate or check if there is anything inside it
			 if (curl_error($ch)) {
			 	echo curl_error($ch);
			 }


			 // step 4: close curl session
			 curl_close($ch);


			 // step 5: convert json to object
			 $result = json_decode($response);

			 return $result;

		}



		// update payment transaction details
		public function updateTransactionDetails($reference) {

			$sql = "UPDATE order_details SET transstatus='completed' WHERE transref='$reference'";

			$result = $this->dbcon->query($sql);
			if ($this->dbcon->affected_rows == 1) {
				return true;
			}
			else {
				return false;
			}
		}


	}

	// end payment class
?>