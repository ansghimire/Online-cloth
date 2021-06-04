<?php include '_partials/_dbconnect.php'; ?>
<?php include '_partials/_header.php'; ?>
<?php include '_partials/links/links.php'; ?>
<?php include '_partials/links/scriptLink.php' ?>




<?php

$error = '';
$success= '';

if(isset($_POST['submit'])){
  // for recaptcha

    // $captcha=$_POST['g-recaptcha-response'];
    // $secretkey= "6LcQnr4ZAAAAABpoHvJeCTotW3jf1hwA6iNgtmUj";

  	// $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($secretkey).'&response='.urldecode($captcha).'';

  	// $response = file_get_contents($url);
  	// $responsekey= json_decode($response, TRUE);
  	// print_r($responsekey);

  	// if($responsekey['success']){
	  		$email = mysqli_real_escape_string($con_clothEcom, $_POST['email']);
		   $password = stripslashes($_POST['password']);

		   $fetchSql = "SELECT * FROM `register` WHERE `email` = '$email'";
		    $result = mysqli_query($con_clothEcom, $fetchSql);


			if(!$result){
				echo "unsuccess";
				exit();
			}

		$num = mysqli_num_rows($result);

	   if($num > 0){

           $row = mysqli_fetch_assoc($result);
           $passdecode = password_verify($password, $row['password']);

          if($passdecode){
          	    $_SESSION['user_id'] = $row['user_id'];
	          	$_SESSION['username']=$row['username'];
	        	$_SESSION['email']= $row['email'];
	        	$_SESSION['loggedin']=true;
	        	$success="YOUR EMAIL IS SUCCESSFULLY REGISTERED";
	        	?>
	        	<script>
                   location.replace("index.php");
	        	</script>
	        	<?php

	        }else{
	        	$error = "Password do not match";
	        }


		}else{
			$error = "Email is not registered";
			 
		 }
  		
  	// }else{
  	// 	$error = "recaptcha is not clicked";
  	   
  	// }

}


 ?>






<link rel="stylesheet" type="text/css" href="css/main.css">
<section class="form_section">



	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])  ?>" method ="post" class="form">
			<h1 class="heading-1">Sign-in</h1>
		<div class="form-label">
			<label>Email</label>
			<input type="email" name="email"  required>
		</div>

		<div class="form-label">
			<label>Password </label>
			<input type="password" name="password" required>
		</div>

	  <div class="g-recaptcha" data-sitekey="6LcQnr4ZAAAAAH7IBPvV4PxZxw7JZRdzdo7yXVTV"></div>
      <br/>


		<button type="submit" class="btn" name="submit">Submit</button>
         
         <p class="text">Not Have a Account  ? <a href="./signin.php">signin</a></p>
         <p class="text">Forget Password <a href="./resetEmail.php">Click Here</a></p>


           <?php
		   if(isset($_GET['log'])){
			echo 
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
					 <strong>success ! </strong> You can login now.
					 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					 </button>
			   </div>';
		}
			if(isset($_GET['update'])){
					echo 
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>success ! </strong> You can login now.
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
          	echo "<span> </span>";
          }




       
		?>



	</form>
</section>

