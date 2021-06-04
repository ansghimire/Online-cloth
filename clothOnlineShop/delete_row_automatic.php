<?php
$con = mysqli_connect('localhost','root', '', 'tempdata');


// to delete from signuptable 

 $sql = "SELECT * FROM `signup`";
 $result = mysqli_query($con, $sql);
 // $url = "http://localhost/clothEcommerce/";

while($row = mysqli_fetch_assoc($result))

 {
	 	$email_ToBeDelete_Id = $row['user_id'];

	 	$expire = $row['expire'];
	    $current = time();

	    $gap = $expire - $current;
	    // echo $gap;

	    if($gap  <= 0){

	    	$del = "DELETE FROM `signup` WHERE `signup`.`user_id` = $email_ToBeDelete_Id";
	    	$delQuery = mysqli_query($con, $del);
	

	    }else{
	    	echo "Error deleting the error";
	    }


 }


// to delete form reset table
 $reset_sql = "SELECT * FROM `reset`";
 $reset_result = mysqli_query($con, $reset_sql);

 while($resetRow = mysqli_fetch_assoc($reset_result)) {

 	$id = $resetRow['reset_id'];
 	$exp = $resetRow['expire'];
 	$cur = time();

 	$difference = $exp -$cur;

 	if($difference <= 0){
 		$delete = "DELETE FROM `reset` WHERE `reset`.`reset_id` = $id";
	    	$deleteQuery = mysqli_query($con, $delete);
 	}else{
 		echo "Error deleting the error";
 	}

 }





?>

