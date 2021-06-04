<?php
    require "_partials/_header.php";
    require "_partials/_dbconnect.php";
   
?>

<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/placeorder.css">
<?php 
if(isset($_SESSION['username']) && $_SESSION['loggedin'] == true){

?>
<section class="placeorder">
  <div class="shipping__details">
	<div class="active">Signin</div>
	<div class="active">Shipping</div>
	<div class="active">Place Order</div>
</div>



<?php 

 echo '<div class="shipping__heading">
			<div class="order-content">
				<div class="shipping__info">
					<h1>Shipping</h1>
					<p class="text">'.$_SESSION['username'] .',&nbsp;'. $_SESSION['phone'] .',&nbsp;'.$_SESSION['address'].',&nbsp; '.$_SESSION['city'].',&nbsp;'.$_SESSION['postalCode'].'</p>    	
				</div>
		  ';

?>
<div class="shipping__info">
			<h1>Payment</h1>
			<p class="text">Stripe</p>    	
		</div>

		<div class="shipping__info">
			<ul class="shop_head">
				
			   <li>
				    <h3>Shopping cart</h3>
				    <div>Price</div>
			   </li>



<?php 
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];

// for getting all the item_id list and quantity
$item_id = new ArrayObject(array());
$purchase_qty = new ArrayObject(array());



  $fetch_cart = "SELECT cart.cart_id, item.item_id, item.item_name, item.item_price, item.item_image, cart.cart_quantity,cart.cart_totalprice FROM cart JOIN item ON cart.item_id = item.item_id WHERE user_id='$user_id'";
  $fetch_query = mysqli_query($con_clothEcom, $fetch_cart);

  if(!$fetch_query){
  	echo "unable to fetch";
      exit();
  }
   $totalPrice = 0;

   
  while($row = mysqli_fetch_assoc($fetch_query)) {
  	$totalPrice = $totalPrice + $row['cart_totalprice'];
	$item_id->append($row['item_id']);
	$purchase_qty->append($row['cart_quantity']);
	
	
  	$price = $row['cart_totalprice'] / $row['cart_quantity'];

  	echo '<li class="product">
					                 	    <div class="left">
												   	<div class="Cart__heading--img">
											   		<img src="../admin_login/image/'.$row['item_image'].'" class="item_img">
											   	</div>
									   	<div class="Cart__heading--details">
						                  <h3>'.$row['item_name'].'</h3>

							                   <div class="product-info">		  
							                     	 <span>QTY :&nbsp </span> 
							                     	<span>'.$row['cart_quantity'].'</span>
							                     	
						                       </div>			   		
								   	</div>
								   </div><div class="right" id="price">RS
						   	    '.$price.'               
						   </div>
						   </li>';
	$price = 0;					   
  }
   $_SESSION['item_id'] = $item_id;
   $_SESSION['purchase_qty'] = $purchase_qty;
?>

     </ul>
		</div>


	  </div>	

		<div class="orderSummary">
			<h1 class="order-heading">Order Summary</h1>

<?php 
$totalPrice_with_tax= $totalPrice + 100 + 50;
echo'<div class="order-items">
				<span>Items </span>
				<span>RS '.$totalPrice.'</span>
			</div>
			<div class="order-items">
				<span> Shipping</span>
				<span>RS 100</span>
			</div>
			<div class="order-items">
				<span> Tax</span>
				<span>RS 50</span>
			</div>
           <div class="order-items">
				<span class="red"> Order Total</span>
				<span class="red">RS'.$totalPrice_with_tax.'</span>
			</div>';
	    ?>

	    <!-- payment -->
	    <?php 
       require("config.php");
         ?>

			<form action="payment.php" method="post">
				<input type="hidden" name="totalPrice_cost" value="<?php echo $totalPrice_with_tax; ?>">
    <script
        src="https://checkout.stripe.com/checkout.js"
        class="stripe-button"
        data-key="<?php echo $publishableKey?>"
        data-amount="<?php echo $totalPrice_with_tax*100; ?>"
        data-name="Unique shopping"
        data-descript="description of items"
        data-image="https://seeklogo.com/images/U/unique-logo-9DC80C57B7-seeklogo.com.png"
        data-currency="INR"
        data-email="<?php echo $_SESSION['email']; ?>"
    >


		    </script>


		</form>

		</div>
</div>		
</section>	
<?php 


}else{
	header("Location:login.php?please_sign_in");
}
?>



















<!-- template -->
<!-- <div class="shipping__heading">
	<div class="order-content">
		<div class="shipping__info">
			<h1>Shipping</h1>
			<p class="text">Anish Ghimire,&nbsp; 9845976936,&nbsp;jayamangala,&nbsp; ratnanagar,&nbsp;123</p>    	
		</div> -->
		<!-- <div class="shipping__info">
			<h1>Payment</h1>
			<p class="text">Stripe</p>    	
		</div>


		<div class="shipping__info">
			<ul>
				
			   <li>
				    <h3>Shopping cart</h3>
				    <div>Price</div>
			   </li> -->
			<!-- <li class="product">
					                 	    <div class="left">
												   	<div class="Cart__heading--img">
											   		<img src="../admin_login/image/91402ead8f2689857bef678d4c2f1ac9mfLeUh5BOG3wXrNuMqYa.jpg" class="item_img">
											   	</div>
									   	<div class="Cart__heading--details">
						                  <h3>Black Grunch Pant</h3>

							                   <div class="product-info">		  
							                     	 <span>QTY :&nbsp </span> 
							                     	<span>1</span>
							                     	
						                       </div>			   		
								   	</div>
								   </div><div class="right" id="price">
						   	3000
						   </div>
						   </li> -->



             <!--      </ul>
		</div>


	  </div>	

		<div class="orderSummary">
			<h1 class="order-heading">Order Summary</h1> -->
			<!-- <div class="order-items">
				<span>Items </span>
				<span>$100</span>
			</div>
			<div class="order-items">
				<span> Shipping</span>
				<span>$10</span>
			</div>
			<div class="order-items">
				<span> Tax</span>
				<span>$15</span>
			</div>
           <div class="order-items">
				<span class="red"> Order Total</span>
				<span class="red">$125</span>
			</div>
			<button>Payout</button>

		</div>
</div>		



</section>
 -->