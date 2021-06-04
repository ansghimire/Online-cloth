<?php 
include '_partials/_dbconnect.php';
?>
 
<?php 

  if(isset($_GET['token'])){
	$validator = $_GET['token'];

	 // compaare $validator with dbtoken
	 $sql_tempdata = "SELECT * from `signup` WHERE `token` = '$validator'";

     $result = mysqli_query($con_tempData, $sql_tempdata);

     // if(!$result){
     // 	echo "Unable to fetch";
     // 	exit();
     // }

     $num=mysqli_num_rows($result);

     if($num > 0){
          $row=mysqli_fetch_assoc($result);
          $name=$row['username'];
          $email=$row['email'];
          $password=$row['password']; 

           
          // fetch from clothecom db register table to check the num of rows
            $fquery = "SELECT * FROM `register` WHERE email = '$email'";
            $fres= mysqli_query($con_clothEcom, $fquery);
         
            $num = mysqli_num_rows($fres);

               if($num == 0){
		            	// Insert into clothecom db register table
		     	    $insertQuery = "INSERT INTO `register` ( `username`,`nickname`, `email`, `password`) VALUES ('$name','$name','$email', '$password')";
		     	    $res = mysqli_query($con_clothEcom, $insertQuery);

		     	  // delete token form the database
		     	    $del = "DELETE FROM `signup` WHERE `signup`.`token` = '$validator'";
			    	$delQuery = mysqli_query($con_tempData, $del);
			    	 //redirect into login page 
	    	         header("Location:login.php?log=you can login");

				    	// if(!$delQuery){
				    	// 	echo "Unable to delete";
				    	// }
	            }else{
	            	header("Location: signin.php?reg=Email is already registered");
	            }
       	  

	     }else{
	     	echo "TOken didn't match";
	     	header("Location: signin.php?tok=token didn't match");
	     }

	
}else{
	header("Location: signin.php?tok=token not match");
}

?>