<?php 
session_start();
include "_partials/_function.php";
include "_partials/_dbconnect.php";


# price should not be greater than 10 thousand

if(isset($_POST['stripeToken'])){
	
	if($_POST['stripeEmail'] == $_SESSION['email']){
			require("config.php");
		//Disabe ssl for make working in localhost
		\Stripe\Stripe::setVerifySslCerts(false);
		$token = $_POST['stripeToken'];
	   $total = $_POST['totalPrice_cost'];
	    $email =$_SESSION['email'];
        $user_id = $_SESSION['user_id'];
        $phone = $_SESSION['phone'];
        $address = $_SESSION['address'];
        $city =  $_SESSION['city'];
        $postalCode = $_SESSION['postalCode'];
        // $confirmation_code = confirmation(40);
        $header = "From: ansghimire321@gmail.com";
        $subject ="YOUR Confirmation CODE OF ORDERS";
        $item_id = $_SESSION['item_id'];
        $purchase_quantity = $_SESSION['purchase_qty'];



		$data = \Stripe\Charge::create(array(
				   "amount"=>$total,
				   "currency"=>"INR",
				   "description"=>"Shopping a fashonable",
				    "source"=>$token,			    	
				));

   if($data){

   	    // insert into orderdetails
        $insert_into_order = "INSERT INTO `orderdetails` (`confirmation_code`,`user_id`,`phone`,`address`,`city`,`postalcode`,`total_price`,`date`)VALUES('$token','$user_id','$phone','$address','$city','$postalCode','$total',current_timestamp())";
         
         $insert_query = mysqli_query($con_clothEcom, $insert_into_order);
         if(!$insert_query){
             echo "unable to run";
             exit();
         }
         // delete from cart
          $delete_cart = "DELETE FROM `cart` WHERE user_id = $user_id";
          $delete_query = mysqli_query($con_clothEcom,$delete_cart);
          if(!$delete_query){
              echo "unable to delete";
              exit();
          }
          // selecting item_id and updating item_qty after paying with card
          $i = 0;
          while($i < count($item_id)){
                $select_item = "SELECT * FROM `item` WHERE `item_id` = '$item_id[$i]'";
                $query = mysqli_query($con_clothEcom, $select_item);
                $row = mysqli_fetch_assoc($query);
                $item_qty = $row['item_qty'] - $purchase_quantity[$i];
                $update_qty = "UPDATE `item` SET `item_qty` = '$item_qty' WHERE `item_id` = '$item_id[$i]'";
                $update_query = mysqli_query($con_clothEcom, $update_qty);
                $i++;
          }


         $body = "CONFIRMATION CODE = ".$token;
        // sending message with confirmation code in mail
        if(mail($email, $subject, $body, $header)){
           header("Location:index.php?pay=successfully_complete_payment");
         }else{
             echo "unable to send mail";
         }


   }else{
   	   echo "Unable to purchase";
   	   header("Location:addtocart.php");
   }

		

	}else{
		header("Location:login.php?login_to_purchase");
	}
	
}else{
	header("Location:addtocart.php");
}



?>