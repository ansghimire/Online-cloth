<!-- 
//Enable full text in database for make search possible

alter table item add FULLTEXT(`item_name`, `item_author`);

// for cheking the search that match or not

SELECT * FROM `item` WHERE MATCH(item_name, item_author) against ('javascript');

 -->

 <?php
 include '_partials/_header.php';
 include "_partials/_dbconnect.php";
 include "_partials/_function.php";
 ?>
 
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/main.css">

<style>
    .containers{
        margin:0;
        padding:0;
    }
</style>

<main class="search_content">

<?php 
 $search =  $_GET['search_product'];
 $searchSql = "SELECT * FROM `item` WHERE MATCH(item_name, item_category)against ('$search')";
 $result = mysqli_query($con_clothEcom, $searchSql);
	 if(!$result){
	 	echo "unsuccessfull";
	 }
	   $num = mysqli_num_rows($result);
	   if($num > 0){
	   	 while($row = mysqli_fetch_assoc($result)) {
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

