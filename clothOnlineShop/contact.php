<?php 

include "_partials/_header.php";
include "_partials/_dbconnect.php";

?>

<?php include '_partials/links/links.php'; ?>
<?php include '_partials/links/scriptLink.php'; ?>



<style type="text/css">

	.contact {
		grid-row: 2/ span 1;
		grid-column: 1/-1;
		
	}
	
	.context {
		display: flex;
		width: 50vw;
		margin: auto;
		flex-direction: column;
	}

	.btn-send{
		background-color: green;
		border: 0;
		padding: 1rem 3rem;
		font-size: 1rem; 
	}
</style>
<link rel="stylesheet" type="text/css" href="css/main.css">





<section class="contact">
<?php 
      if(isset($_GET["success"])) {
      	  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Success ! </strong>Message is sent.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>';
      } 
      if(isset($_GET["unsuccess"])){
       echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>Sorry! </strong>Message sent failed
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>';	
      }
      if(isset($_GET['recaptcha'])){
      	 echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>Sorry ! </strong>Recaptcha is not clicked
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>';
      }

?>




	  <h1 class="text-center my-3 font-weight-bold">Contact Us</h1>
     <p class=" my-2 display-6 text-center">If you have any question then you can contact us</p>

     <div class=" context container display-6 my-5">
	

    <?php if(empty($_SESSION['username'])) {
    	echo '
    	 	<form action="send_without_login.php" method="post">
    	<div class="mb-3">
			  <label for="Name" class="form-label">Name</label>
			  <input type="text" name="name" class="form-control" id="Name">
		</div>';

		echo '<div class="mb-3">
			  <label for="Email" class="form-label">Email</label>
			  <input type="email" name="email" class="form-control" id="Email">
		</div>';

		echo '<div class="mb-3">
			  <label for="subject" class="form-label">Subject</label>
			  <input type="text" name="subject" class="form-control" id="subject">
		</div>
		<div class="mb-3">
			  <label for="message" class="form-label">Message</label>
			  <textarea class="form-control" name="message" id="message" rows="3">
			  	
			  </textarea>
		</div>
          <div class="g-recaptcha" data-sitekey="6LcQnr4ZAAAAAH7IBPvV4PxZxw7JZRdzdo7yXVTV"></div>
     

	         <button type="submit" name="send" class="btn-send btn-lg">SEND</button>
        </form>';

     }else{
        ?>
     	 <form action="send_with_login.php" method="post">
		<div class="mb-3">
			  <label for="subject" class="form-label">Subject</label>
			  <input type="text" name="subject" class="form-control" id="subject">
		</div>
		<div class="mb-3">
			  <label for="message" class="form-label">Message</label>
			  <textarea class="form-control" name="message" id="message" rows="3">
			  	
			  </textarea>
		</div>
         
          <div class="g-recaptcha" data-sitekey="6LcQnr4ZAAAAAH7IBPvV4PxZxw7JZRdzdo7yXVTV"></div>
      

	    <button type="submit" class="btn-send btn-lg" name="send-btn">SEND</button>
     </form>

	</div>';
	<?php
     }
   	?>
  
</section>



<?php include "_partials/_footer.php"; ?>