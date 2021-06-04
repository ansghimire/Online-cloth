<?php 
   include "_partials/_header.php";
   include "_partials/_dbconnect.php";
?>

<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/cart.css">

<?php  
// if logged in then only users can add to cart so for that it is condition 
   if(isset($_SESSION['username']) && $_SESSION['loggedin'] == true) {

  ?>
<section class="Cart">
		<div class="Cart__heading">
			    <li>
				    <h3>Shopping cart</h3>
				    <div>Price</div>
			   </li>


<?php 
       #inserting cart 
        if(isset($_POST['cart'])) {
        	$item_id = $_POST['id'];
			// echo $item_id."<br>";
			$user_id = $_SESSION['user_id'];
			// echo $_SESSION['user_id']."<br>";
			$cart_quantity = 1;
			$price = $_POST['price'];
			
			
           // checking user_id exist or not in cart table
		   $check_user_id = "SELECT * FROM `cart` WHERE `user_id`='$user_id' AND `item_id`='$item_id'";
		   $check_res = mysqli_query($con_clothEcom, $check_user_id);

		   if(!$check_res){
			   echo "unable to fetch";
		   }

		   $num = mysqli_num_rows($check_res);
		   if($num>0){
			//    echo "already inserted";
			
		   }else{
			   // if the cart of user is not inserted then insert 
			   $insert_into_cart = "INSERT INTO `cart`(`item_id`,`user_id`,`cart_quantity`,`cart_totalprice`) VALUES('$item_id','$user_id','$cart_quantity','$price')";
			   $insert_query = mysqli_query($con_clothEcom, $insert_into_cart);
			   if(!$insert_query){
				   echo "Unable to  insert";
			   }

		   }
		}
?>

<?php
// updating the quantity and price of the product
	if(isset($_POST['select'])){
				$user_id = $_SESSION['user_id'];
				$qty = $_POST['select'];
				$id = $_POST['select-id'];
				// fetching id if matches with db id
				// $fetch_data_id = "SELECT * FROM `cart` WHERE `cart_id`='$id' AND `user_id`='$user_id'";
				 $fetch_data_id = "SELECT item.item_price, cart.cart_quantity FROM `cart` JOIN `item` ON cart.item_id = item.item_id WHERE `cart_id`='$id' AND `user_id`='$user_id'";

				$run_query = mysqli_query($con_clothEcom, $fetch_data_id);
				if(!$run_query){
					echo "unable to run";
				}
				$num = mysqli_num_rows($run_query);
				if($num >=1){
					$row = mysqli_fetch_assoc($run_query);
					$totalPrice = $qty * $row['item_price'];

					$update = "UPDATE `cart` SET `cart_quantity`='$qty',`cart_totalprice` = '$totalPrice' WHERE `cart`.`cart_id` = '$id' AND `cart`.`user_id` = '$user_id'";
					$updateQuery = mysqli_query($con_clothEcom, $update);
					if(!$updateQuery){
						echo "unable to update";
					}
				}

		}
	?>
		


<?php




	## displaying cart
	$user_id = $_SESSION['user_id'];
	$fetching_cart = "SELECT cart.cart_id,item.item_name,item.item_qty, item.item_price, item.item_image, cart.cart_quantity FROM cart JOIN item ON cart.item_id = item.item_id WHERE user_id='$user_id'";
	
	$fetch_query = mysqli_query($con_clothEcom, $fetching_cart);

	if(!$fetch_query){
		echo "successfully run";
		exit();
	}
   
	$num_cart = mysqli_num_rows($fetch_query);
	
	if($num_cart >= 1){
		while($get_cartValue = mysqli_fetch_assoc($fetch_query)){
			echo '   <li class="product">
					                 	    <div class="left">
												   	<div class="Cart__heading--img">
											   		<img src="../admin_login/image/'.$get_cartValue['item_image'].'" class="item_img">
											   	</div>
									   	<div class="Cart__heading--details">
						                  <h3>'.$get_cartValue['item_name'].'</h3>

							                   <div class="product-info">';

                                            ?>
							                
                                                 <form action="addtocart.php" method="post">
                                               	   
							                     	 <label> QTY</label>
							                     	 <input type="hidden" name="select-id" value="<?php echo $get_cartValue['cart_id']?>">
							                        <select name="select" class="qty-select" onchange="this.form.submit()">


							                        <?php 
                                                      
							                         
							                        echo'<option value="'.$get_cartValue['cart_quantity'].'">'.$get_cartValue['cart_quantity'].'</option>';
													$qty_value = $get_cartValue['item_qty'];
													$qty = 1;
													while($qty_value > 0){
														echo '<option value="'.$qty.'">'.$qty.'</option>';
														$qty++;
														$qty_value--;
													}
							                        // echo'<option value="1" >1</option>
							                        // <option value="2">2</option>,<option value="3">3</option>,<option value="4">4</option>,<option value="5">5</option>,<option value="6">6</option>,<option value="7">7</option>,<option value="8">8</option>,<option value="9">9</option>,<option value="10">10</option>,<option value="11">11</option>,<option value="12">12</option>,<option value="13">13</option>,<option value="14">14</option>,<option value="15">15</option>,<option value="16">16</option>,<option value="17">17</option>,<option value="18">18</option>,<option value="19">19</option>,<option value="20">20</option>,<option value="21">21</option>,<option value="22">22</option>,<option value="23">23</option>,<option value="24">24</option>,<option value="25">25</option>,<option value="26">26</option>,<option value="27">27</option>,<option value="28">28</option>,<option value="29">29</option>,<option value="30">30</option>
							                   echo '</select>
                                               </form>';
                                               
                                                echo '<form action="deleteCart.php" method="POST">
                                                <input type="hidden" name="del" value="'.$get_cartValue['cart_id'].'">
							                    <button class="delete" name="delBtn">Delete</button>
							                    </form>
						                   </div>			   		
								   	</div>
								   </div>';



						   echo '<div class="right" id="price">
						   	'.$get_cartValue['item_price'].'
						   </div>
						   </li>';


		}

	}else{
		echo '<h1>No cart is added  &nbsp;<a href="index.php">Go For  shopping</a></h1>';
	}  
?>
	</div>

	<?php
// here the calculation of total price of all products and total quantity
   
		   $get_Item = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
		   $runItem_query = mysqli_query($con_clothEcom, $get_Item);
		   if(!$runItem_query){
		   	echo "unable to get the item";
		   }

		    $total_item = 0;
		    $total_price = 0;
           while($get = mysqli_fetch_assoc($runItem_query)){
           	      $total_item =$total_item +  $get['cart_quantity'];
           	      $total_price = $total_price + $get['cart_totalprice'];
                }

                   echo '<div class="Cart__priceInfo">
                                   <form action="shipping.php" method="post">	
									<input type="hidden" name="total_items" value="'.$total_item.'">
									<input type="hidden" name="total_value" value="'.$total_price.'">
									<div class="subtotal">
										SubTotal(<span id="item">'.$total_item.'</span> items): <span id="priceVal">'.$total_price.'</span>
									</div>
								  <button type="submit" class="checkout" name="checkout">Proceed To Checkout</button>
								</form>
								</div>
							</section>';							
?>

















                             
	<?php                             	
	}else{
	?><script>window.location.replace("index.php")</script><?php
	}

        
?>





















<!-- template for check if error occurs -->

<!-- <section class="Cart">
		<div class="Cart__heading">
			    <li>
				    <h3>Shopping cart</h3>
				    <div>Price</div>
			   </li>

                 <li class="product">
                 	    <div class="left">
					   	<div class="Cart__heading--img">
				   		<img src="image/product-4.jpg" class="item_img">
				   	</div>
				   	<div class="Cart__heading--details">
	                  <h3>pant</h3>

                   <div class="product-info">
                    	QTY
                    <select class="qty-select" value="1">
                      <option value="1" selected="">1</option>,<option value="2">2</option>,<option value="3">3</option>,<option value="4">4</option>,<option value="5">5</option>,<option value="6">6</option>,<option value="7">7</option>,<option value="8">8</option>,<option value="9">9</option>,<option value="10">10</option>,<option value="11">11</option>,<option value="12">12</option>,<option value="13">13</option>,<option value="14">14</option>,<option value="15">15</option>,<option value="16">16</option>,<option value="17">17</option>,<option value="18">18</option>,<option value="19">19</option>,<option value="20">20</option>,<option value="21">21</option>,<option value="22">22</option>,<option value="23">23</option>,<option value="24">24</option>,<option value="25">25</option>,<option value="26">26</option>,<option value="27">27</option>,<option value="28">28</option>,<option value="29">29</option>,<option value="30">30</option>
                    </select>
                    <form action="deleteCart.php" method="POST">
                                                <input type="hidden" name="del" id="d'.$get_cartValue['cart_id'].'">
							                    <button class="del">Delete</button>
						 </form>
                   </div>			   		
			   	</div>
			   </div>


			   <div class="right">
			   	3000
			   </div>
			   </li>

			    



		</div>
		
		<div class="Cart__priceInfo">
			<div class="subtotal">
				SubTotal(8 items): $480
			</div>
		  <button class="checkout">Proceed To Checkout</button>
		
		</div>

		



</section> -->




