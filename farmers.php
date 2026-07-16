<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>farmers</title>
   
  <style>
body {
  font-family: 'Roboto', sans-serif;
  background-color: #fffaf6;
  color: #3b2e2e;
  margin: 0;
  padding: 0;
  background-image: url('https://www.transparenttextures.com/patterns/paper-fibers.png');
}

.farmers-section {
  padding: 80px 20px;
  text-align: center;
  animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.farmers-section h1 {
  font-family: 'Playfair Display', serif;
  font-size: 2.8rem;
  color: #6b3f3f;
  margin-bottom: 15px;
}

.intro {
  font-size: 1.1rem;
  max-width: 700px;
  margin: 0 auto 50px;
  color: #7c5a4d;
}

.farmers-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 40px;
  max-width: 1200px;
  margin: auto;
  justify-items: center; /* Justify the content in the center */
}

.farmer-card {
  background: #fff8f0;
  padding: 25px;
  border-radius: 15px;
  border: 1px solid #f0ddd2;
  box-shadow: 0 8px 25px rgba(0,0,0,0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  overflow: hidden;
  font-family: 'Roboto', sans-serif;
}

.farmer-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 12px 35px rgba(0,0,0,0.12);
}

.farmer-card img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 50%;
  border: 2px solid #e4cfc0;
  margin-bottom: 20px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.farmer-card h2 {
  font-family: 'Playfair Display', serif;
  font-size: 1.6rem;
  margin-top: 15px;
  color: #4f362d;
}

.farmer-card .location {
  color: #967c6b;
  margin-bottom: 12px;
  font-size: 0.9rem;
}

.farmer-card p {
  font-size: 1rem;
  margin: 4px 0;
  color: #55443c;
}

.farmer-card .story {
  margin-top: 10px;
  font-style: normal;
  color:rgb(45, 31, 26);
  font-size: 1rem;
  font-weight: normal;
}

.farmer-card .contact-number {
  margin-top: 12px;
  font-size: 1rem;
  color: #7c5a4d;
  font-weight: bold;
}

.farmer-card .badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background-color: #cfa285;
  color: #fff;
  padding: 6px 14px;
  font-size: 0.85rem;
  border-radius: 16px;
  font-weight: bold;
  box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
}

.farmer-card-container {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}

  </style>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="style1.css">
   <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Roboto&display=swap" rel="stylesheet" />

</head>
<body>
      
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>farmer's profile</h3>
    <p> <a href="home.php">home</a> / farmer </p>
</section>
  <section class="farmers-section">
    <h1>Meet Our Farmers</h1>
    <p class="intro">Each bloom you receive is a symbol of dedication and care. Explore the stories of the farmers who grow them.</p>

    <div class="farmers-grid">

      <div class="farmer-card">
        <div class="badge">🌿 Premium Partner</div>
        <div class="farmer-card-container">
          <img src="./image/farmer1.jpeg" alt="Farmer 1" />
          <h2>Ravi Kumar</h2>
          <p class="location">Nashik, Maharashtra</p>
          <p><strong>Years of Experience:</strong> 20+</p>
          <p><strong>Specialty Flowers:</strong> Marigold, Tuberose, Lotus</p>
          <p><strong>Monthly Capacity:</strong> 500 kg - 800 kg</p>
          <p class="story">"Through Floral Bliss, I’m able to provide my flowers to various occasions across India. It’s an honor to serve our community."</p>
          <p class="contact-number">Contact: +91 123 456 7890</p>
        </div>
      </div>

      <div class="farmer-card">
        <div class="farmer-card-container">
          <img src="./image/farmer6.jpg" alt="Farmer 2" />
          <h2>Meena Devi</h2>
          <p class="location">Madurai, Tamil Nadu</p>
          <p><strong>Years of Experience:</strong> 15</p>
          <p><strong>Specialty Flowers:</strong> Jasmine, Champa, Parijat</p>
          <p><strong>Monthly Capacity:</strong> 300 kg</p>
          <p class="story">"With our collective, we work together to provide the freshest flowers, supporting each other to thrive in our communities."</p>
          <p class="contact-number">Contact: +91 987 654 3210</p>
        </div>
      </div>

      <div class="farmer-card">
        <div class="badge">🌿 Premium Partner</div>
        <div class="farmer-card-container">
          <img src="./image/farmer5.jpg" alt="Farmer 3" />
          <h2>Harpreet Singh</h2>
          <p class="location">Amritsar, Punjab</p>
          <p><strong>Years of Experience:</strong> 18</p>
          <p><strong>Specialty Flowers:</strong> Hybrid Roses, Lilium</p>
          <p><strong>Monthly Capacity:</strong> 1000 kg</p>
          <p class="story">"Each flower has its journey. My roses are known for their beauty and fragrance, contributing to many high-end events."</p>
          <p class="contact-number">Contact: +91 112 233 4455</p>
        </div>
      </div>

      <!-- New Farmers -->
      <div class="farmer-card">
        <div class="farmer-card-container">
          <img src="./image/farmer4.jpg" alt="Farmer 4" />
          <h2>Sunita Rani</h2>
          <p class="location">Jaipur, Rajasthan</p>
          <p><strong>Years of Experience:</strong> 12</p>
          <p><strong>Specialty Flowers:</strong> Marigold, Bougainvillea</p>
          <p><strong>Monthly Capacity:</strong> 400 kg</p>
          <p class="story">"I’ve been growing marigolds for years. With Floral Bliss, I’m proud to see my flowers reaching all corners of the country."</p>
          <p class="contact-number">Contact: +91 321 654 9870</p>
        </div>
      </div>

      <div class="farmer-card">
        <div class="farmer-card-container">
          <img src="./image/farmer2.jpeg" alt="Farmer 5" />
          <h2>Amit Sharma</h2>
          <p class="location">Siliguri, West Bengal</p>
          <p><strong>Years of Experience:</strong> 25</p>
          <p><strong>Specialty Flowers:</strong> Orchids, Lilies</p>
          <p><strong>Monthly Capacity:</strong> 1200 kg</p>
          <p class="story">"Orchids and lilies are my passion. With Floral Bliss, we are bringing premium flowers to homes and events across India."</p>
          <p class="contact-number">Contact: +91 453 678 9012</p>
        </div>
      </div>

      <div class="farmer-card">
        <div class="farmer-card-container">
          <img src="./image/farmer3.jpg" alt="Farmer 6" />
          <h2>Farida Begum</h2>
          <p class="location">Kochi, Kerala</p>
          <p><strong>Years of Experience:</strong> 10</p>
          <p><strong>Specialty Flowers:</strong> Jasmine, Lilies</p>
          <p><strong>Monthly Capacity:</strong> 250 kg</p>
          <p class="story">"Growing jasmine and lilies has always been my passion. Floral Bliss has given my flowers a much larger platform to shine."</p>
          <p class="contact-number">Contact: +91 543 210 6789</p>
        </div>
      </div>

    </div>
  </section>




<?php @include 'footer.php'; ?>

<script src="script.js"></script>

</body>
</html>