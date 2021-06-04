<?php
 include "_partials/_header.php";
 include "_partials/_function.php";
 include "_partials/_dbconnect.php";
 include "_partials/links/links.php";
 include "_partials/links/scriptLink.php";  
 ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/viewdetails.css">



<section class="ProductDetails">


<!-- EDIT Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Review</h5>
        <button type="button" class="btn-close btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
      	
      	 	<form action="store_review.php" method="post"class="comment_form">
      	 		<?php 
            if($_SESSION['username']){
            	//array for rating
            	$rating_arr = array('Poor', 'Fair', 'Good', 'Very Good', 'Excellent');

            	$name = $_SESSION['username'];
            	$user_id = $_SESSION['user_id'];
            	$item_id = $_GET['id'];
            
                 //getting data if userid and review id match
            	$fsql = "SELECT * FROM `review` WHERE `user_id` = '$user_id' AND `item_id` = '$item_id'";

            	$res= mysqli_query($con_clothEcom, $fsql);
            	if(!$res){
            		echo "unsuccess";
            	}

            	$num = mysqli_num_rows($res);
            	if($num > 0){

            	   $row = mysqli_fetch_assoc($res);
            	   $rate = $row['review_star'];
            	   $id = $row['item_id'];
            	   $user_id = $row['user_id'];
            	   $username = $_SESSION['username'];

            	   echo '
			    <input type="hidden" name="id" value="'.$id.'">
			    <input type="hidden" name="user_id" value="'.$user_id.'">
			    <input type="hidden" name="uname" value="'.$username.'">
            	   ';


            	   echo '<div class="form-group">
				<label>Edit Rating</label>
				<select required="" name="editrating" id="editrating">
                        <option value="'.$rate.'">'.$row['review_star'].' = '.$rating_arr[$rate - 1].'</option>
                        <option value="1">1 = Poor</option>
                        <option value="2">2 = Fair</option>
                        <option value="3">3 = Good</option>
                        <option value="4">4 = Very Good</option>
                        <option value="5">5 = Excellent</option>
                </select>
            </div>
             
             <div class="form-group">
             	<label>Edit Comment</label>
             	<textarea required="" name="editcomment" id="comment" style="margin: 0px; width: 320px; height: 99px;">'.$row['comment'].'</textarea>
              </div>';
              echo '  <button class="cart-btn" name="edit-review">Submit</button>';
            	}
            }
      	?>
            

			</form>
        
      </div>
    </div>
  </div>
</div>

	<!-- modal ends -->
<?php 
  // getting  id from index.php 
  if(isset($_GET['id'])){
  	 $id = $_GET['id'];

// if mathc then fetch the result and show 
     $fetch = "SELECT * FROM `item` WHERE `item_id`='$id'";
     $result = mysqli_query($con_clothEcom, $fetch);

     if(!$result){
     	echo "unable to run";
     	exit();
     }
     
     $num = mysqli_num_rows($result);



     if(!$num > 0){
     	?>
     	<script>window.location.replace("index.php")</script>
     	<?php
     	exit();
     }

       // for showing the product details corressponding to the id
      $row = mysqli_fetch_assoc($result);


    // for counting reviews and adding to the UI
      $Review = "SELECT * FROM `review` WHERE `item_id`='$id'";
      $ReviewR = mysqli_query($con_clothEcom, $Review);
      $count = mysqli_num_rows($ReviewR);
	  $qty = $row['item_qty'];





      echo '<div class="front">
      <div class="img-sect">
	<img src="../admin_login/image/'.$row['item_image'].'" class="img-product">';
	
     echo '</div>
     <div class="product_feature">
	  <div class="title">'.$row["item_name"].'</div>
	  <div class="review-star">
	  	   <span><i class="fa fa-star"></i></span>
	    	<span><i class="fa fa-star"></i></span>
	    	<span><i class="fa fa-star"></i></span>
	    	<span><i class="fa fa-star"></i></span>
	    	<span><i class="fa fa-star"></i></span>
	    <div class="review_num">&nbsp;'.$count.' Reviews</div>

	  </div>
	  <div class="price">Price: '.$row["item_price"].'</div>
	  <div class="Description">Description: '.$row['item_description'].'</div>
</div>';

echo '<div class="cart-feature">
	  <div class="price-info">Price:'.$row['item_price'].'</div>';

echo '<div class="status">Status: In Stock('.$qty.' item available) </div>';

          if(isset($_SESSION['username'])){
          	echo '<form action="addtocart.php" method="post">
	       <input type="hidden" name="id" value="'.$id.'">
		   <input type="hidden" name="price" value="'.$row['item_price'].'">';

			if($qty == 0){
				echo '<button class="cart-btn" disabled> Unable to add Cart';
			}else{
				echo '<button class="cart-btn" name="cart"> Add To Cart
				</button>
				</form>';
			}
		  
		
          }else{
          	 echo '
          	 <a href="login.php">
          	 <button class="cart-btn">Signin To Add Cart</button>
          	 </a>';
          }	      
	      

	echo'</div>
	</div>
	';

?>




  <div class="show-reviews">
  	        <h1 class="review-head">REVIEWS</h1>
         <?php 
            // $fetchReview = "SELECT * FROM `review` WHERE `review_id` = '$id'";
            // $reviewResult = mysqli_query($con_clothEcom, $fetchReview);

		  	$fetchReview = "SELECT review.item_id, review.review_id, register.user_id, register.username, review.review_star, review.comment FROM review JOIN register ON review.user_id = register.user_id WHERE item_id = '$id'";
		  	$reviewResult = mysqli_query($con_clothEcom, $fetchReview);

             
            $num = mysqli_num_rows($reviewResult);
            if($num > 0){
            	 while($row = mysqli_fetch_assoc($reviewResult)){
            	 	 echo '<p class="title">'.$row['username'].'</p>';

            	 	 echo  star($row['review_star']);

            	 	 echo '<p class="Description">'.$row['comment'].'</p>';
            	 	 // echo 'Edit<br><br>';
            	 	 // Button trigger modal 
            	 	 if(isset($_SESSION['username'])){
            	 	 	 if($row['username'] == $_SESSION['username']){
            	 	 	 echo '<div class="action">
            	 	 	 <button type="button" class="btn-sm btn-primary mx-2" data-toggle="modal" data-target="#exampleModal">Edit</button>';
            	 	 	 echo ' <form action="store_review.php" method="post">
            	 	 	 		<input type="hidden" name="item_id" value="'.$row['item_id'].'">
            	 	 	 		<input type="hidden" name="review_id" value="'.$row['review_id'].'">
            	 	 	 		<input type="hidden" name="user_id" value="'.$row['user_id'].'">
            	 	 	 		<button type="submit" name="del-review" class="btn-danger btn-sm">Delete</button>
            	 	 	   </form>
            	 	 	   </div>';
            	 	 }
            	 	 }
            	 	else{
            	 	 	echo '';
            	 	 }
            	 	
            	 }   	 
            }else{
                 echo '<p class="review-item">There is no reviews</p>';
            } 

         ?>

		



  <?php  
      if(isset($_SESSION['username']) && $_SESSION['loggedin'] == true){     // loggedin true then only user get permission to comment otherwise not
       	echo'<p class="review-item">Write a Customer review</p>';
       	$username = $_SESSION['username'];
       	$user_id = $_SESSION['user_id'];
       	?>

	 	<form action="store_review.php" method="post"class="comment_form">
	 	       <?php

	 	         echo '
			    <input type="hidden" name="item_id" value="'.$id.'">
			    <input type="hidden" name="user_id" value="'.$user_id.'">
			    <input type="hidden" name="uname" value="'.$username.'">
			  
				<div class="form-group">
				<label>Rating</label>
				<select required="" name="rating" id="rating">
                        <option value="">Select</option>
                        <option value="1">1 = Poor</option>
                        <option value="2">2 = Fair</option>
                        <option value="3">3 = Good</option>
                        <option value="4">4 = Very Good</option>
                        <option value="5">5 = Excellent</option>
                </select>
            </div>
             
             <div class="form-group">
             	<label>Comment</label>
             	<textarea required="" name="comment" id="comment" style="margin: 0px; width: 320px; height: 99px;"></textarea>
              </div>
              <button class="cart-btn" name="review">Submit</button>

			</form>';

       }else{
       	echo '<p class="review-item">Please Signin to add a review <a href="login.php">SIGNIN</a></p>';
       }

  }else{                             // here isset($_GET['id']) close
       	?>
            <script>
            	window.location.replace("index.php");
            </script>
      

		</div>	
	
   <?php  
  }

 ?>

</section>















