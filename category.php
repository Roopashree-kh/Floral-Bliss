<?php

include 'config.php';

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

$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';

if(!$category){
    echo "<p class='empty'>No category selected.</p>";
    exit;
}

$query = "SELECT * FROM products WHERE category = '$category'";
$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floral Bliss | Category</title>
    <link rel="stylesheet" href="style1.css">
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style1.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Cormorant+Garamond&family=Montserrat&display=swap" rel="stylesheet">
   
</head>
<body>
    <?php @include 'header.php'; ?>
    
<section class="heading">
    <h3>Shop</h3>
    <p> <a href="home.php">home</a> / shop </p>
</section>


<section class="products">
    
   <div class="box-container">
<?php
if(mysqli_num_rows($result) > 0){
    while($product = mysqli_fetch_assoc($result)){
        ?>
       <form action="" method="POST" class="box">
   <a href="view_page.php?pid=<?php echo $product['id']; ?>" class="fas fa-eye"></a>
   <div class="price">₹<?php echo $product['price']; ?>/kg-</div>
   <img src="image/<?php echo $product['image']; ?>" alt="" class="image">
   <div class="name"><?php echo $product['name']; ?></div>
   <input type="number" name="product_quantity" value="1" min="0" class="qty">
   <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
   <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
   <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
   <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
   <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
   <input type="submit" value="add to cart" name="add_to_cart" class="btn">
</form>

        <?php
    }
} else {
    echo "<p class='empty'>No products available in this category!</p>";
}
?>
   </div>
</section>


    <div id="message"></div>
    <?php @include 'footer.php'; ?>
    <script src="script.js"></script>
    <script src="app.js"></script>

</body>
</html>