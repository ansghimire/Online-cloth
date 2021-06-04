<?php
 require"_partials/_dbconnect.php";
 include "_partials/_function.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="css/index.css">

</head>
<body class="index-container">
	<?php require"_partials/_header.php"; ?>


<section class="slider">
	<div class="stuff">
		<h1>New, Amazing<br> Stuff Is Here</h1>
		<p>Shop today and get <b>20% discount</b></p>
		<button class="btn btn-lg btn-success">Shop Now</button>
		
	</div>


	<div id="carouselExampleIndicators" class="carousel slide nextsl" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./dev_img/3955.jpg" class="d-block  sl-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./dev_img/man-img.jpg" class="d-block sl-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./dev_img/men.jpg" class="d-block sl-img" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>
</div>

<div class="design">
	
</div>

	
</section>

<?php 
    if(isset($_GET['message'])){
    	echo 
 	'<div class="d-block">
 	<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Success ! </strong> You are able to purchase your best items.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
		</div>';
    }

	if(isset($_GET['pay'])){
    	echo 
 	'<div class="d-block">
 	<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Success ! </strong>'.$_GET['pay'].'.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
		</div>';
    }


?>



<main class="main_content">
	<h1 class="h-title">Trending Now</h1>

<?php 

$fetchItem = "SELECT * FROM `item`";
$fetchquery = mysqli_query($con_clothEcom, $fetchItem);

if(!$fetchquery){
	echo "unsuccessfull";
}

$num = mysqli_num_rows($fetchquery);

if($num > 0){

  while($row = mysqli_fetch_assoc($fetchquery)){
  	echo '<div class="product-heading">
			      <div class="img-block">
				       <a href="view_details.php?id='.$row['item_id'].'">
					      <img src="../admin_login/image/'.$row['item_image'].'" class="image-product">
					 </a>
				</div>
			    
			    <div class="name">
			         <a href="view_details.php?id='.$row['item_id'].'">
			         	<p>'.$row["item_name"].'</p>
			         </a>
			    </div>

			    <div class="review-rating">
			    	<span><i class="fa fa-star"></i></span>
			    	<span><i class="fa fa-star"></i></span>
			    	<span><i class="fa fa-star"></i></span>
			    	<span><i class="fa fa-star"></i></span>
			    	<span><i class="fa fa-star"></i></span>
			    </div> 

			   <div class="review-num">'.calcReview($con_clothEcom, $row['item_id']).' review</div>

			    <div class="Brand">Brand : '.$row["item_category"].'</div>

			    <div class="price"> Rs '.$row["item_price"].'</div>

	</div>';

  }

}else{
	echo "<h1>No items to Display</h1>";
}


?>


</main>






  <?php include "_partials/_footer.php"; ?> 
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <!-- JavaScript and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>



















