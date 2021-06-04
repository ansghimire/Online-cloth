

<!DOCTYPE html>
<html>
<head>

	<title>Update</title>
	<link rel="stylesheet" type="text/css" href="css/update.css">
</head>
<body class="profile_containers">
<?php include "_partials/_header.php" ?>
<?php include '_partials/_dbconnect.php'; ?>

<?php 

if(isset($_POST['update'])){
	if($_POST['nickname']) {
	  $email = $_SESSION['email'];
	  $nickname = $_POST['nickname'];
	  $update = "UPDATE `register` SET `nickname` = '$nickname' WHERE `register`.`email` = '$email'";
	  $updateQ = mysqli_query($con_clothEcom, $update);

	  if(!$updateQ){
	  	echo "Error updating nickname";
	  }
	}

	if($_POST['bio']){
      $email = $_SESSION['email'];
	  $bio = $_POST['bio'];
	  $update = "UPDATE `register` SET `biodata` = '$bio' WHERE `register`.`email` = '$email'";
	  $updateQ = mysqli_query($con_clothEcom, $update);

	  if(!$updateQ){
	  	echo "Error updating bio";
	  }


}

}

?>

<section class="section_profile">

	<div class="user-profile">
	  <div class="upper-profile-bg"></div>
	   <div class="user-profile-details">
	<?php 
		 if(isset($_SESSION['username'])) {
		 	$email = $_SESSION['email'];
		 	$selectsql = "SELECT * FROM `register` WHERE `email` = '$email'";
		 	$selectquery = mysqli_query($con_clothEcom, $selectsql);

		 	$row = mysqli_fetch_assoc($selectquery);
		 	
		 	echo '<figure class="img--user">';
		 	if($row['image']){
		 		echo '<img src="./image/'.$row["image"].'" class="user-img">';
		 	}else{
		 		echo '<img src="./image/user.jpg" class="user-img">';
		 	}
		  	
		  	echo ' </figure>
		  	 <div class="user-bio">
		  	 	<p>Hello,I AM </p>
		  	 	<h1>'.$row['username'].'</h1>
		  	 	<h4>('.$row['nickname'].')</h4>
		  	 	<h3>'.$row['biodata'].'</h3>
		  	 </div>
		 	';
		 }else{
		 	header("Location: login.php");
		 	exit();
		 }
		?>	  	 
	  </div>
	 </div>
</section>

<section class="update__section">
<?php
 $email = $_SESSION['email'];
  $fetch_user = "SELECT * FROM `register` WHERE `email` = '$email'";
  $fetch_query = mysqli_query($con_clothEcom, $fetch_user);

  $row = mysqli_fetch_assoc($fetch_query);


?>

	 <form class="user-form" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
   	<h2 class="heading-2"> UPDATE YOUR NICKNAME AND BIO</h2>
		<div class="form-label">
			<label>Name</label>
			 <input type="text" name="username" value="<?php  echo $row['username'] ?>">
		</div>

		<div class="form-label">
			 <label>Nick Name</label>
			 <input type="text" name="nickname" value="<?php if($row['nickname']){echo $row['nickname'];}else{echo '';} ?>">
		</div>

		<div class="form-label">
			<label>Email</label>
			 <input type="text" name="email" value ="<?php echo $row['email'] ?>">
		</div>


		<div class="form-label">
			<label>BIODATA</label>
		 <textarea name="bio" rows="8" cols="55">		 	
		 	<?php if($row['biodata']){echo $row['biodata'];}else{echo '';} ?>
         </textarea>
		</div>
		<button type="submit" class="btn" name="update">UPDATE</button>
		<button class="log-btn"> <a href="logout.php">Logout</a></button>
   </form>
	

</section>



<?php include "_partials/_footer.php"; ?>

</body>
</html>


