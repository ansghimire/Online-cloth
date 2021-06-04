<?php
// include '_partials/_header.php';
include '_partials/_dbconnect.php';

if(isset($_GET['token'])) {

	  $validator = $_GET['token'];
	  $current = time();

	  //check for empty
	if(empty($selector) && empty($validator)){
		header("Location: resendEmail.php?TOKEN NOT MATCH");
		exit();
	}


   // if validator contains hexadecimal then redirect and exit
	if(ctype_xdigit($validator)){
		   header("Location: resetEmail.php?Try again");
		   exit();
	}

  //if not expire then only fetch
    $fetchsql = "SELECT * FROM `reset` WHERE `token` = '$validator' and `expire` > '$current'";
    $res = mysqli_query($con_tempData, $fetchsql);

    if(!$res){
      echo "unable to fetch";
      exit();
    }

    $num = mysqli_num_rows($res);


  if($num > 0){
  	   //for finding the email which user wants to update
         $row = mysqli_fetch_assoc($res);
         $email =  $row['email'];
       
  	?>
  	    <link rel="stylesheet" type="text/css" href="css/main.css">
  	   <section class="form_section">
	      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])  ?>" method ="post" class="form">
			<h1 class="heading-1">Update Password</h1>
			<input type="hidden" name="Remail" value="<?php echo $email; ?>">
			<input type="hidden" name="token"  value="<?php echo $validator; ?>">
			<div class="form-label">
				<label>password</label>
				<input type="password" name="password"  required>
			</div>

			<div class="form-label">
				<label>confirm password</label>
				<input type="password" name="cpassword"  required>
			</div>

		<button type="submit" class="btn" name="update">update</button>
         
		</form>
	</section>

    <?php
     }else{
     	header("Location: resetEmail.php?No records found");
     }



}else{
	header("Location: resetEmail.php");
}




?>


<?php 
     if(isset($_POST['update'])){
     	$password = $_POST['password'];
     	$cpassword =  $_POST['cpassword'];
     	$Remail = $_POST['Remail'];
     	$token = $_POST['token'];

     	if($password == $cpassword){
     		$password = password_hash($password, PASSWORD_DEFAULT);

     		// update the password in register table
     		$update_register = "UPDATE `register` SET `password` = '$password' WHERE `register`.`email`='$Remail'";

     		$updateQuery = mysqli_query($con_clothEcom, $update_register);

     		if(!$updateQuery){
     			echo "not update";
     		}else{
     			// delete the data from the reset table
     		    $deleteTok = "DELETE FROM `signup` WHERE `signup`.`token` = '$token'";
		        $deleteQuery = mysqli_query($con_tempData, $deleteTok);
			     if($deleteQuery){
			     	header("Location: login.php?update=successfully update");
			     	exit();
			     }
     		}


     		
     	}else{
     		 echo 
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>sorry ! </strong> password donot match
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
     	}
     }

?>







