<?php
session_start();
?>
<?php
if(isset($_POST['continue'])){
    $total_items = $_POST['total_item'];
    $total_value = $_POST['total_value'];
    $phone = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];

    if(empty($phone) && empty($address) && empty($city) && empty($postalCode)){
        header("Location:shipping.php?empty_field");
        exit();

    }

    $_SESSION['total_items'] = $total_items;
    $_SESSION['total_value'] = $total_value;
    $_SESSION['phone'] = $phone;
    $_SESSION['address'] = $address;
    $_SESSION['city'] = $city;
    $_SESSION['postalCode'] = $postalCode;
    header("Location:placeOrder.php");


}else{
    header("Location:addtocart.php?cart_is_not_submitted");
}



?>


	