<?php
 ob_start();
 session_Start();

 ?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href=".css/main.css">
    <link rel="stylesheet" type="text/css" href="./css/header.css">

</head>

<body class="containers">
 <header class="header">
 	<div class="content">
		  <button class="sidebar-btn">
		       <i class="fas fa-bars"></i>
		  </button>
		  	<p class="logo">UNIQUIFYshop</p>
</div>
 <form class="search" action="search.php" method="get">
		  	<input type="search" name="search_product" placeholder="SEARCH....">
		  	<button type="submit" class="search-submit">
		  	   <i class="fa fa-search" ></i>	
		  	</button>
 </form>
 
<ul class="nav">
<?php
     if(isset($_SESSION['username'])) {

     	     include '_dbconnect.php';
     	     $email = $_SESSION["email"];
		     $fetch = "SELECT * FROM `register` WHERE email = '$email'";
		     $fetchquery = mysqli_query($con_clothEcom, $fetch);
		     $row =mysqli_fetch_assoc($fetchquery);
	         echo '<li>
	           <a href="profile.php">
	             ';


            if(empty($row['image'])){
            	 echo '<img src="image/user.jpg" class="img">';

            }elseif($row['email'] == $_SESSION['email']){
            	$url ="http://localhost/clothOnlineShop/image/";
            	$url.=$row['image'];
            	echo '<img src="'.$url.'" class="img">';           	
            }
           
           echo '
           </li>
         <li><a href="update.php">'.$_SESSION["username"].'</a></li>
           <li><a href="addtocart.php">Cart</a></li>';

         
     }else{
     	echo '<li><a href="./login.php">Sign-in</a></li>';
     }


 ?>
  	  
   	  <!-- <li class="null"><a href="#">Profile</a> -->
   	<!--   <li><a href="addtocart.php">Cart</a></li> -->
   </ul>

</header>

<aside class="sidebar">
	<div class="sidebar-heading">
		<span>&nbsp</span>
		<button class="close-btn">
			<i class="fas fa-times"></i>
		</button>

	</div>
	
	<ul class="sidebar-items--list">
		<li> <a href="index.php">Home</a> </li>
		<li> <a href="aboutus.php">About Us</a> </li>
	     <li> <a href="contact.php">Contact</a> </li>
	</ul>
      
		<h1 class="heading-1">Shop By Category</h1>

		    <ul>
		  	  	<a href="search.php?search_product=shirt" class="shopping-items-list">
              <li> Shirt </li>
              <i class="fa fa-chevron-right"></i>
               </a>
        
              <a href="search.php?search_product=pant" class="shopping-items-list">
              <li>Pant</li>
              <i class="fa fa-chevron-right"></i>
             </a>

             <a href="search.php?search_product=shoes" class="shopping-items-list"> 
              <li>Shoes</li>
               <i class="fa fa-chevron-right"></i>
               </a>
          </ul>

		


	
</aside>

</body>

<script>
 const icon = document.querySelector('.sidebar-btn');
 const sidebar = document.querySelector('.sidebar');
 const closeBtn = document.querySelector('.close-btn');

icon.addEventListener('click', function(){
	sidebar.classList.toggle('sidebar-show');
      
});

closeBtn.addEventListener('click', function(){
	 sidebar.classList.remove('sidebar-show');

})

</script>



</html>