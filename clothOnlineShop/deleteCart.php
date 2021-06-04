<?php 
include "_partials/_dbconnect.php";
session_start();


if(isset($_POST['delBtn'])){
	$id =  $_POST['del'];
	$user_id = $_SESSION['user_id'];
	// echo $email;

	// DELETE FROM `cart` WHERE `cart`.`cart_id`= 9 AND `cart_email`='ansghimire321@gmail.com'

	$deleteCart = "DELETE FROM `cart` WHERE `cart`.`cart_id` = '$id' AND `user_id`= '$user_id'";
	$delQuery= mysqli_query($con_clothEcom, $deleteCart);
	if($delQuery){
		echo "success";
		header("Location:addtocart.php");
	}else{
		header("Location:addtocart.php?unabletodelete");
	}

	
}else{
?><script>
	window.location.replace("addtocart.php");
</script><?php
}
?>