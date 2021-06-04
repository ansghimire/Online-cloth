<?php 

if(isset($_POST['send'])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];


 if(empty($name)) {
	 	header("Location:contact.php");
	 	exit();
 }
 if(empty($email)) {
 	header("Location:contact.php");
	 	exit();
 }
 if(empty($subject)) {
 	header("Location:contact.php");
	 	exit();
 }
 if(empty($message)) {
 	header("Location:contact.php");
	 	exit();
 }


 	  $to_email = "ansghimire321@gmail.com";

 	  $subject = 'From: '.$email.' '.$subject;

 	  $body = 'From: '.$username.' '.$message;

 	  $header = "FROM:".$email;


            // for recaptcha

		    $captcha=$_POST['g-recaptcha-response'];
		    $secretkey= "6LcQnr4ZAAAAABpoHvJeCTotW3jf1hwA6iNgtmUj";

		  	$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($secretkey).'&response='.urldecode($captcha).'';

		  	$response = file_get_contents($url);
		  	$responsekey= json_decode($response, TRUE);
		  	// print_r($responsekey);

		  	if($responsekey['success']){
		  		
                       if(mail($to_email, $subject, $body, $header)){
				 	  	?>
				 	  	<script>window.location.replace("http://localhost/clothOnlineShop/contact.php?success=message_sent_successfully")</script>
				 	  	<?php

				 	  }else{
				 	  	?>
				 	  	<script>window.location.replace("http://localhost/clothOnlineShop/contact.php?unsuccess=message_unable_to_send")</script>
				 	  	<?php

				 	  }

		  	}else{
		  		 header("Location: contact.php?recaptcha=recaptcha_is_not_clicked");
		  	     exit();
		  	}

	
}else{
	header("Location:contact.php");
}	

?>