<?php 

include 'index.php';
include '_partials/_dbconnect.php';

?>

<?php 
if(isset($_SESSION['username'])) {
	$email = $_SESSION['email'];

if(isset($_FILES['uploadimg'])){
	$fileName = $_FILES['uploadimg']['name'];
	$fileType = $_FILES['uploadimg']['type'];
	$fileSize = $_FILES['uploadimg']['size'];
	$fileTemp = $_FILES['uploadimg']['tmp_name'];
	$error = false;



   $random = mt_rand(1, 1000);
   $random = $random + time();
   $random = base64_encode($random);
 


   $targer_dir = "image/";

   $target_file = $targer_dir.basename($fileName);

   $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

   $extension = array("jpg","jpeg","png");

	   if(in_array($file_ext, $extension) == false){
	   	$error = true;
	   	 echo "Please upload the valid file jpg";
	   	 exit();
	   }

	   if($error == false){
          
          if($fileType == 'image/jpeg' || $fileType == 'image/png' || $fileType == "image/jpg"){

          	// uploading file from temp to image
          	move_uploaded_file($fileTemp, $targer_dir.$random.".".$file_ext);
            
            //pathname for eg: 1244.jpeg
            $actualPath=$random.".".$file_ext;

            // fetch
            $fetchSql = "SELECT * FROM `register` WHERE `email` = '$email' AND `image` = ''";
            $fetchQ = mysqli_query($con_clothEcom, $fetchSql);

            $num = mysqli_num_rows($fetchQ);

            if($num > 0){
            	//update image if image field in database is empty
		            $updateSql = "UPDATE `register` SET `image` = '$actualPath' WHERE `register`.`email` = '$email'";
				    $updateQuery = mysqli_query($con_clothEcom, $updateSql);
				   ?><script>location.replace("index.php");</script> <?php
				   exit();

            }else if($num == 0){
               $fetch = "SELECT * FROM `register` WHERE `email` = '$email'";
               $run = mysqli_query($con_clothEcom, $fetch);
               $row = mysqli_fetch_assoc($run);
               $url ="image/";
               $url.=$row['image'];
               echo $url;
         
		                 //delete from the file
		            	 if(unlink($url)){
		            	 	 //delete the first image if the same user upload image second time
				            $updateSql = "UPDATE `register` SET `image` = '$actualPath' WHERE `register`.`email` = '$email'";
				            $updatequery = mysqli_query($con_clothEcom, $updateSql);

		            	 	echo "PREVIOUS IMAGE WAS SUCCESSFULLY DELETED";
						     header("Location: index.php");
						      ?><script>location.replace("index.php");</script> <?php
		            	 }else{
                            echo "SORRY FAILED TO DELETE IMAGE";
		            	 }
              
            }
          }else{
          	echo "file type didn't match";
          	exit();
          }
	   }


 }

}else{
	?><script>location.replace("index.php");</script> <?php
	exit();
}



?>



<style>

.popup_content{
	position: absolute;
	top: 4rem;
    right: 0rem;
    background: black;
    padding: 2rem 0rem;
    margin: 1rem 1rem;
    color: #fff;
    font-size: 1.2rem;
    border-radius: 5px;

}

.form_up{
	margin: 0rem .5rem;
}


.btn-submit{
	padding: .5rem .3rem;
	background-color: #d87218;
	border: none;
	color: #fff;
	font-size: 1rem;

}

.btn-submit:hover{
	background: #d87718;
}

</style>
<?php 
if(isset($_SESSION['username'])) {
   ?>
	<div class="popup_content">
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?> " method="post" class="form_up" enctype="multipart/form-data" >
          <input type="file" name="uploadimg" class="upload"><br><br>

          <button type="submit" name="btn-submit" class="btn-submit">upload image</button>
	</form>
  </div>

<?php
}	
?>



