<?php 

include_once("paystackclass.php");

$payobj = new Payment;
$output = $payobj->verifyPaystack($_REQUEST['reference']);

if ($output->data->status==='success') {
	$updatetrans = $payobj->updateTransactionDetails($_REQUEST['reference']);

	if ($updatetrans === true) {
		header("Location: details.php?successmsg=Transaction Successful");
		exit;
	}
}

?>