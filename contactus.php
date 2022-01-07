<?php
include_once("header.php")

?>
	
	<div class="title-div my-3 text-center"><h3>CONTACT US</h3></div>

    <div class="row">

        <div class="col-md-3 r10c" id="r10c1"></div>
        <div class="col-md-6 r10c" id="r10c2">
          <h5>Send us a note!</h5>
          <form action="" method="post" class="form-group">
            <input type="name" name="fname" id="cont-fname" placeholder="Fullname" class="form-control" required><br>
            <input type="email" name="email" id="cont-email" placeholder="Email Address" class="form-control" required><br>
            <input type="text" name="phone" id="cont-phone" placeholder="Phone Number" class="form-control" required><br>
            <textarea id="cont-message" placeholder="Enter your message" rows="5" class="form-control"></textarea><br>
            <input type="file" name="file" id="cont-file" placeholder="Choose file" class="form-control">
            <small>Images only (png, jpg, jpeg, gif) with max-size: 2MB</small><br><br>
            <input type="submit" class="btn btn-success btn-block" name="button" id="cont-btn" value="SUBMIT">
          </form>
        </div>
        <div class="col-md-3 r10c" id="r10c3"></div>

    </div>

<?php 
include_once("whatsapp.php");
include_once("footer.php")
?>