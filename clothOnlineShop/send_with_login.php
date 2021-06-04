<?php
session_start();
include '_partials/_dbconnect.php';
include '_partials/_function.php';

?>

<?php

if(isset($_POST['send-btn'])){
   if($_SESSION['username']){
     
       if(empty($_POST['subject']) && empty($_POST['message'])){
   	    header("Location: contact.php?empty_field");
	   	 exit();
	   }

   	  $username = $_SESSION['username'];
      
      $fetchSql = "SELECT * FROM `register` WHERE `username`='$username'";
      $fquery = mysqli_query($con_clothEcom, $fetchSql);

      if(!$fquery){
      	echo "unable to fetch";
      	exit();
      }

     $num = mysqli_num_rows($fquery);
	     if($num == 1){
	     	  $row = mysqli_fetch_assoc($fquery);
	     	  if($username = $row['username']){
	     	  	 $email = $row['email'];
	     	  }

               // for recaptcha

		    $captcha=$_POST['g-recaptcha-response'];
		    $secretkey= "6LcQnr4ZAAAAABpoHvJeCTotW3jf1hwA6iNgtmUj";

		  	$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($secretkey).'&response='.urldecode($captcha).'';

		  	$response = file_get_contents($url);
		  	$responsekey= json_decode($response, TRUE);
		  	// print_r($responsekey);

		  	if($responsekey['success']){
		  		  $to_email = "ansghimire321@gmail.com";

		     	  $subject = 'From: '.$email.' '.$_POST['subject'];

		     	  $body = 'From: '.$username.' '.$_POST['message'];

		     	  $header = "FROM:".$email;

		     	  if(mail($to_email, $subject, $body, $header)){
		     	  	?>
		     	  	<script>window.location.replace("http://localhost/clothOnlineShop/contact.php?success=message_sent_successfully")</script>
		     	  	<?php

		     	  }else{
		     	  	?>
		     	  	<script>window.location.replace("http://localhost/clothOnlineShop/contact.php?unsuccess=message_sent_successfully")</script>
		     	  	<?php

		     	  }
		  	}else{
		  	     header("Location: contact.php?recaptcha=recaptcha_is_not_clicked");
		  	     exit();	
		  	}



	     	  
	     	





	     }else{
	     	header("Location:contact.php?unable to send didn't find username");
	     }
   	  
	}else{
		header("Location:contact.php");
	}

}else{
	header("Location:contact.php");
}




?>