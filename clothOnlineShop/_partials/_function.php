

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"> -->
<?php 


function test_input($con, $data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = mysqli_real_escape_string($con, $data);
	return $data;
}



function star($num){
  if($num == 1){
  	return '<span><i class="fa fa-star"></i></span>
  	        <span><i class="far fa-star"></i></span>
  	        <span><i class="far fa-star"></i></span>
  	        <span><i class="far fa-star"></i></span>
  	        <span><i class="far fa-star"></i></span>';
  }elseif($num == 2){
  	return '<span><i class="fa fa-star"></i></span>
  	        <span><i class="fa fa-star"></i></span>
  	        <span><i class="far fa-star"></i></span>
  	        <span><i class="far fa-star"></i></span>
  	        <span><i class="far fa-star"></i></span>';
  }else if($num == 3){
  	  return '<span><i class="fa fa-star"></i></span>
  	         <span><i class="fa fa-star"></i></span> 
  	         <span><i class="fa fa-star"></i></span>
  	         <span><i class="far fa-star"></i></span>
  	         <span><i class="fa fa-star-o"></i></span>';	        
  }else if($num == 4){
  	 return '<span><i class="fa fa-star"></i></span>
  	        <span><i class="fa fa-star"></i></span>
  	        <span><i class="fa fa-star"></i></span>
  	        <span><i class="fa fa-star"></i></span>
  	        <span><i class="far fa-star"></i></span>';
  }elseif($num==5){
  	  return '<span><i class="fa fa-star"></i></span>
  	        <span><i class="fa fa-star"></i></span>
  	        <span><i class="fa fa-star"></i></span>
  	        <span><i class="fa fa-star"></i></span>
  	        <span><i class="fa fa-star"></i></span>';
  }

}



function calcReview($con, $id){

     $Review = "SELECT * FROM `review` WHERE `item_id`='$id'";
      $Reviewres = mysqli_query($con, $Review);

      $count = mysqli_num_rows($Reviewres);

      return $count;


}



// function calcStar($con, $id){
//    	$Review = "SELECT * FROM `review` WHERE `review_id`='$id'";
// 	 $Reviewres = mysqli_query($con, $Review);
// 	 $num = mysqli_num_rows($Reviewres);
// 	 // echo $num."<br>";

//        $review_star = 0;
//       while($rows = mysqli_fetch_assoc($Reviewres)){ 	
//       	$review_star = $review_star +$rows['review_star'];
      

//       }
//       	$star = $num * 5 / $review_star;
//       	echo $star;


// }

























?>