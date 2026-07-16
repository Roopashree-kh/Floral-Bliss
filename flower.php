<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}


if(isset($_POST['add_to_wishlist'])){

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];

$check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

$check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

if(mysqli_num_rows($check_wishlist_numbers) > 0){
    $message[] = 'already added to wishlist';
}elseif(mysqli_num_rows($check_cart_numbers) > 0){
    $message[] = 'already added to cart';
}else{
    mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
    $message[] = 'product added to wishlist';
}

}

if(isset($_POST['add_to_cart'])){

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];
$product_quantity = $_POST['product_quantity'];

$check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

if(mysqli_num_rows($check_cart_numbers) > 0){
    $message[] = 'already added to cart';
}else{

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_wishlist_numbers) > 0){
        mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
    }

    mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
    $message[] = 'product added to cart';
}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Floral Collections</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style1.css">
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Cormorant+Garamond&family=Montserrat&display=swap" rel="stylesheet">
</head>
<body class="category-body">
    <?php @include 'header.php'; ?>
    <div class="category-container">
        <div class="category-header">
            <h1>Premium Floral Collections</h1>
            <p class="category-subtitle">Botanical Excellence Curated for Discerning Tastes</p>
        </div>
        
        <div class="categories-list" id="categories-list">
            <!-- Categories will be dynamically injected here -->
        </div>
    </div>

    <?php @include 'footer.php'; ?>

    <script src="app.js"></script>
    <script src="script.js"></script>

</body>
</html>