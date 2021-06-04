<?php
session_start();
  include '_partials/_dbconnect.php';
?>

<?php
if(isset($_POST['review'])){
    $item_id = $_POST['item_id'];
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];




   $select = "SELECT * FROM `review` WHERE `user_id`='$user_id' AND `item_id`='$item_id'";
   $selectQ = mysqli_query($con_clothEcom, $select);

   $Num = mysqli_num_rows($selectQ);
   if($Num > 0){
    // echo "YOUR DATA HAS BEEN ALREADY INSERTED";
    header('Location:view_details.php?id='.$item_id.'&already review');
    exit();
    }else{
        $insert = "INSERT INTO `review` (`item_id`, `user_id`,`review_star`, `comment`, `date`) VALUES ('$item_id', '$user_id', '$rating', '$comment', current_timestamp())";

        $run = mysqli_query($con_clothEcom, $insert);

        if(!$run){
            echo "unable to run";
            exit();
        }
        header('Location:view_details.php?id='.$item_id);

    }
// DELETE THE REVIEW
}else if(isset($_POST['del-review'])){
    $item_id = $_POST['item_id'];
    $user_id = $_POST['user_id'];
    $review_id = $_POST['review_id'];

    $delsql = "DELETE FROM `review` WHERE `item_id` = '$item_id' AND `review_id`='$review_id' AND `user_id`='$user_id'";
    $delquery = mysqli_query($con_clothEcom, $delsql);

    if(!$delquery){
     echo "unable to delete";
    }else{
        header('Location:view_details.php?id='.$item_id.'&mssg=successfully deleted');
    }
    

}elseif(isset($_POST['edit-review'])){
    $item_id =  $_POST['id']; 
    $user_id = $_POST['user_id'];
    $username =  $_POST['uname'];
    $editcomment = $_POST['editcomment'];
    $review_star = $_POST['editrating'];

    // echo $editcomment;

    if(empty($editcomment)) {
     header('Location:view_details.php?id='.$review_id.'&mssg=emtycommenttextarea');
     exit();
    }

 
   $update = "UPDATE `review` SET `comment` = '$editcomment', `review_star` = '$review_star' WHERE `review`.`item_id` = '$item_id' AND `review`.`user_id` = '$user_id'";
   $updateQ = mysqli_query($con_clothEcom, $update);

   if(!$updateQ){
     echo "unable to update";
   }
   header('Location:view_details.php?id='.$item_id.'&mssg=successfully updated');



}else{
    header('Location:view_details.php?id='.$item_id);
}


?>

