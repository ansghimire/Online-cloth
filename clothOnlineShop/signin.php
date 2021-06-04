<?php include '_partials/_dbconnect.php'; ?>
<?php include '_partials/_header.php'; ?>
<?php include '_partials/_function.php'; ?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <!-- JavaScript and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  

<?php  
$error = '';
$success = '';



  if(isset($_POST['submit'])){


  	//storing the value in the variable
  	
  	$name  = $_POST['fullname'];
  	$name = test_input($con_tempData, $name);

  	$email = $_POST['email'];
    $email = test_input($con_tempData, $email);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  	$password = $_POST['password'];
  	$password = test_input($con_tempData, $password);



  	$cpassword = $_POST['password2'];
  	$cpassword = test_input($con_tempData, $cpassword);

  	$subject ="CLICK ON THIS LINK TO ACTIVATE YOUR ACCOUNT";
  	$header = "From: ansghimire321@gmail.com";



    
	 if(empty($name) && empty($email) && empty($password) && empty($cpassword)){
	    	exit();
	    }


     //validate email

	  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	  	 header("Location:/signin.php?Email is not valid");
	  	 exit();
	  }

     if($password != $cpassword){
     	  $error ="password do not match"; 
         
     }elseif($password == $cpassword){

                                        // for recaptcha

		    // $captcha=$_POST['g-recaptcha-response'];
		    // $secretkey= "6LcQnr4ZAAAAABpoHvJeCTotW3jf1hwA6iNgtmUj";

		  	// $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($secretkey).'&response='.urldecode($captcha).'';

		  	// $response = file_get_contents($url);
		  	// $responsekey= json_decode($response, TRUE);
		  	// // print_r($responsekey);

			//  if($responsekey['success']){
			  		$password = password_hash($password, PASSWORD_DEFAULT);

				         $token = bin2hex(random_bytes(50));
				         $token = $token . date("U");
				         $token = password_hash($token, PASSWORD_DEFAULT);     
				         $expire = date("U")+300;   // 60sec * 5min = 300sec
				         $current = date("U"); // current

				         // delete  signup table if already exist email
				           $Email_Exist_signup = "SELECT *  FROM `signup` WHERE `email` = '$email'";
				           $Query = mysqli_query($con_tempData, $Email_Exist_signup);

				           $num= mysqli_num_rows($Query);
				           if($num > 0){
				           	$error = "Email is already Registered";
				           	// echo "Email is already Registered";
				           	exit();
				           }

           


			         // check for  register table in clothEcom
			         $check_Email_Exist = "SELECT * FROM `register` WHERE email = '$email'";
			         $result = mysqli_query($con_clothEcom, $check_Email_Exist);


           

			         $num_emailRows = mysqli_num_rows($result);


				         if($num_emailRows > 0) {
				         	$error= "Email is already Registered";
				             // echo "EMAIL IS ALREADY REGISTERED YOU CAN LOGIN";
				         }else if($num_emailRows == 0){
					         	// insert into signup table of temp database
					         	 $sql =  "INSERT INTO `signup` (`username`, `email`,`password`, `token`, `expire`) VALUES ('$name', '$email','$password', '$token', '$expire')";
							      $result = mysqli_query($con_tempData, $sql);


				                 if(!$result){
				                 	echo "Unable to insert";
				                 }else{
				                 	// sending mail for verification
				                 	  $body = "click on this link to activate your account and we strongly recommend you to click to activate because token will be expired in 5 minute";
				                 	
								      $body.= '<a href="http://localhost/clothOnlineShop/activate.php?token='.$token.'">'.$token.'</a>';
								       if(mail($email, $subject, $body, $header)){

			                              $success = 'VISIT'.$email.'to activate your account';
								       	// echo 'VISIT'.$email.'to activate your account';

								      
								       }else{
								       	  $error="Email Send Failed";
								       	 // echo "Email Send Failed";
								       }

				                 }
				         }else{
				         	   $error = "Email is already registered";
				         	// echo "Email already registered";
				         }
			  		

			  	}else{
			  		// echo "Stop";
			  		$error = "recaptcha is not clicked";
			  	}


     
        //  }else{
	    //  	echo "Something went wrong";
	    //  }


  }



?>



<style>
	
.popup_content {
	position: absolute;
	top: 20%;
	left: 39%;
	background-color: #fff;
	box-shadow: 0 2rem 4rem rgba(0, 0, 0, 0.2);
	border-radius: 3px;
	/*overflow: hidden;*/
	padding: 1rem 1rem;
	opacity: 0;
	transform: translate(-500%);
	transition: all .4s;
	font-size: 1rem;
	display: flex;
	justify-content: space-between;
	width: 20rem;
    
}

.open-popup{
	opacity: 1;
	transform: translate(0);
}

.close-popup{
	background: transparent;
	border: transparent;
	color: red;
}

.success {
  color: green;
}

.error{
	color: red;
}



</style>





<section class="form_section">
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])  ?> " method ="post" class="form">
			<h1 class="heading-1">Create Account</h1>

		<div class="form-label">
			<label>FullName</label>
			<input type="text" name="fullname"  required>
		</div>

		<div class="form-label">
			<label>Email</label>
			<input type="email" name="email" required >
		</div>

		<div class="form-label">
			<label>Password </label>
			<input type="password" name="password" required>
		</div>

		<div class="form-label">
			<label>Confirm Password</label>
			<input type="password" name="password2" required>
		</div>

		 <div class="g-recaptcha" data-sitekey="6LcQnr4ZAAAAAH7IBPvV4PxZxw7JZRdzdo7yXVTV"></div>
      <br/> <br>

		<button type="submit" name="submit" class="btn">Submit</button>
 
         <p class="text">Already Have a Account ? <a href="./login.php">Login</a></p>

          <?php
		    if(isset($_GET['tok'])){
				echo 
				'<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Sorry ! </strong>Token is not matching.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
				  </div>';
			}
		  
			if(isset($_GET['reg'])){
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Sorry ! </strong>Email is already registered
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
				  </div>';
		  
			}
		  
		   if(isset($_GET['emailerr'])){
			   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Sorry ! </strong>Email is not registered 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
				  </div>';
		   }





          if($error){
          	echo 
          	  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>Sorry ! </strong>'.$error.'
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>';
          }else if($success){
          	echo '
          	  <div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Success</strong>'.$success.'
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>';
          }else{
          	echo "";
          }
       
		?>

	</form>
</section>





 
