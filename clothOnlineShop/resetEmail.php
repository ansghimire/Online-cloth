<?php 
// include '_partials/_header.php';
include '_partials/_dbconnect.php';
include '_partials/links/links.php';
include '_partials/links/scriptLink.php';
 ?>


<?php 


if(isset($_POST['submit'])){
	$email =  $_POST['email'];



 // check email if exist or not in db
	$checkEmail = "SELECT * FROM `register` WHERE email = '$email'";
	$result = mysqli_query($con_clothEcom, $checkEmail);

    $num_rows= mysqli_num_rows($result);

    if($num_rows > 0){
      
      $token =  bin2hex(random_bytes(50));
      $token = password_hash($token, PASSWORD_DEFAULT);
      $expire = time()+500; // 5min = 5 * 60 = 300;


      
      // Delete the data if user again submit the same email
      $delete_resendMail = "DELETE FROM `reset` WHERE `reset`.`email` = '$email'";
      $delete_result = mysqli_query($con_tempData, $delete_resendMail);

      // INSERT INTO DATABASE OF TEMPDATA
      $insert = "INSERT INTO `reset`(`email`, `token`, `expire`)VALUES('$email', '$token','$expire')";

      $insert_result = mysqli_query($con_tempData, $insert);


      //SEND MAIL
     	$subject ="CLICK ON THIS LINK TO RESET YOUR PASSWORD";
  	    $header = "From: ansghimire321@gmail.com";
  	    $body = "click on this link to reset your password and we strongly recommend you to click to reset because token will be expired in 5 minute   <br>";
	                 	
        $body.= '<a href="http://localhost/clothOnlineShop/resetPassword.php?token='.$token.'"></a>';

                        if(mail($email, $subject, $body, $header)){

                              // $error = 'VISIT '.$email.'to reset your password';
					       	         
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Success ! </strong>VISIT '.$email.'to reset your password
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                          </div>';

					      
					       }else{
					       	  // $error="Email Send Failed";
					       	  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Sorry ! </strong>Email send failed
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                          </div>';

					       }   
    }else{
    	// echo "Sorry your email is not registered";
      header("Location: signin.php?emailerr=email is not registered");
    }


}


?>


<link rel="stylesheet" type="text/css" href="css/main.css">

<section class="form_section">
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])  ?>" method ="post" class="form">
			<h1 class="heading-1">ENTER YOUR EMAIL</h1>
			<div class="form-label">
				<label>Email</label>
				<input type="email" name="email"  required>
			</div>

		<button type="submit" class="btn" name="submit">Submit</button>
         
         <p class="text">Go to login page? <a href="./login.php">Click Here</a>

	</form>
</section>







