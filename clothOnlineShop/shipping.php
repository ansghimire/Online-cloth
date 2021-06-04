<?php  
// session_start();
?>


<link rel="stylesheet" type="text/css" href="css/main.css">
<style>
.shipping{
	grid-row: 2/span 1;
	grid-column: 1/-1;
}


.shipping-form{
	width: 25rem;
	margin: 0 auto;
}


</style>
<?php
include '_partials/_header.php';
if(isset($_SESSION['username'])) {
  if(isset($_POST['checkout'])){
  	   	
  	  // only shows when session is started
  	 
		  
		    include "_partials/_dbconnect.php";
		  	$total_items =  $_POST['total_items'];
		  	$total_value =  $_POST['total_value'];

?>
<section class="shipping">
    
	<div class="shipping__details">
	<div class="active">Signin</div>
	<div class="active">Shipping</div>
	<div class="">Place Order</div>
</div>
<div class="shipping-form">
     

	 <form action="shippingStore.php" method ="post" class="form">
	    <h1 class="heading-1">Fill Data Correctly</h1>
	         <input type="hidden" name="total_item" value="<?php echo $total_items?>">
	          <input type="hidden" name="total_value" value="<?php echo $total_value?>">

			<div class="form-label">
				<label>Phone Number</label>
				<input type="text" name="phoneNumber"  required>
			</div>

			<div class="form-label">
				<label>State Address</label>
				<input type="text" name="address"  required>
			</div>
			<div class="form-label">
				<label>City</label>
				<!-- <input type="text" name="city"  required> -->
				<select name="city" required>
					<option selected>Chitwan</option>
					<option value="Pokhara">pokhara</option>
					<option value="Kathmandu">kathmandu</option>
					<option value="Hetauda">hetauda</option>
					<option value="Gorkha">gorkha</option>
					<option value="Dhading">dhading</option>
				</select>
			</div>
			<div class="form-label">
				<label>Postal Code</label>
				<input type="text" name="postalCode"  required>
			</div>

		<button type="submit" name="continue" class="btn">Continue</button>
	</form>
</div>


</div>
</section>
<?php

    }else{
        header("Location:addtocart.php?cart_is_not_submitted");
    }
	  }else{
	  	header("Location:login.php?please_login");
	  }
  

?>
