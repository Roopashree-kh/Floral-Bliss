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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style1.css">
   <link rel="stylesheet" href="styles.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script|Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap" rel="stylesheet">
   

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Floral Bliss</h3>
      <p><b>"Where every flower tells a story—of beauty, purpose, and emotion."</b><br> Whether it’s for wellness, fragrance,
         food, or design, our curated floral experiences connect nature’s essence with your everyday moments.
      </p>
      <button class="explore" onclick="navigateToFlowers()">Explore</button>
     
   </div>

</section>

 <!-- Landing Page -->
 <div class="columns">
        <div class="brown">
            <img src="./image/one.jpg" alt="Professional Event">
            <div class="find"><b>Professional Events</b></div>
            <div class="descript">Our expert team crafts unforgettable floral arrangements<br>
             tailored for conferences, corporate gatherings, and brand launches,<br>
              ensuring your event blooms with elegance and impact.</div>
            <div class="find-out"><a href="theme.php">FIND OUT MORE</a></div>
        </div>
        <div class="white">
            <div class="image-container">
                <img class="middle" src="./image/two.jpg" alt="Floral Bliss Flowers">
            </div>
            <div style="writing-mode: horizontal-tb; font-size: 2.8rem; font-style: kaushan-script; margin-bottom: 1rem; right: 57%; bottom: 3.7%; position: absolute;color: rgb(71, 2, 2);"><b>Floral Bliss</b></div>
            <div style="writing-mode: vertical-rl; transform: rotate(180deg); position: absolute; left: 90%; top: 10%; font-size: 1.1rem; color: rgb(109, 48, 48);">BLISS FLOWERS</div>
        </div>
        <div class="pink">
            <img src="./image/three.jpg" alt="Private Events">
            <div class="find"><b>Private Events</b></div>
            <div class="descript">We are on hand to speak with you to create the most beautiful flowers <br>
            for your event & making it memorable.</div>
            <div class="find-out"><a href="theme.php">FIND OUT MORE</a></div>
        </div>
    </div>

    
<div style="margin: 0.5rem;">
<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Our garden of support is always in bloom. Whether you're a customer, farmer, or vendor—drop us a message, and we’ll respond with care and clarity</p>
      <a href="contact.php" class="btn">contact us</a>
   </div>

</section>
</div>


</section>


<div style="margin-top: 0,5rem; margin-bottom:0.5rem;">
<section class="reviews" id="reviews">

    <h1 class="title" style="font-family: playfair-display;">client's reviews</h1>

    <div class="box-container">

        <div class="box">
            <img src="./images/aksh.jpg" alt="">
            <p>I’m absolutely satisfied with the flowers from Floral Bliss for my sister's wedding. The arrangements were vibrant, fresh, and perfectly suited the wedding theme. The team helped us select flowers based on our preferences and location, making the process smooth and stress-free. The customized bouquets were a beautiful touch, and guests kept complimenting the decor. <b>Mr. Kiran</b> helped me with the entire process, He's highly creative. I highly recommend Floral Bliss for any event!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Akshatha Y C</h3>
        </div>

        <div class="box">
            <img src="./images/sru.jpg" alt="">
            <p>I’m incredibly happy with the flowers from Floral Bliss for my private party. The arrangements, made by Sahana, were exquisite—elegant, fresh, and perfectly tailored to the intimate atmosphere I wanted to create. Sahana was fantastic in guiding me through the options and even helped customize bouquets that matched the theme. Guests were in awe of the decor, and I received endless compliments. I highly recommend Floral Bliss and <b>Sahana</b> for anyone planning a special event!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h3>Srusthi M S</h3>
        </div>

        <div class="box">
            <img src="./images/ayur.jpeg" alt="">
            <p>We’ve been sourcing flowers from Floral Bliss for our medicinal shop, and we couldn't be more pleased with the service and quality. The flowers are always fresh and carefully selected, ensuring they meet the needs of our customers looking for medicinal herbs and natural remedies. The team at Floral Bliss is reliable, efficient, and offers excellent customer service, making the purchasing process smooth. We highly recommend Floral Bliss to other businesses seeking high-quality flowers for medicines!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Glare Ayurveda.co</h3>
        </div>

        <div class="box">
            <img src="./images/fiona.jpeg" alt="">
            <p>As a floral shop, we’ve been sourcing our bulk flowers from Floral Bliss, and it has been an excellent experience. The quality of the flowers is consistently fresh and vibrant, and they offer a wide variety that suits our clients' diverse needs. The team at Floral Bliss is always professional, responsive, and ensures timely delivery, which is essential for our business. The dynamic pricing and loyalty program for bulk purchases have been a huge plus. We’re extremely satisfied and look forward to continuing our partnership with Floral Bliss!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Fiona Floral shop</h3>
        </div>

        <div class="box">
            <img src="./images/jessica.jpg" alt="">
            <p>I’m thoroughly impressed with the floral arrangements provided by Floral Bliss for our recent professional event. Parvathi, the florist, went above and beyond to create stunning and sophisticated floral designs that perfectly matched the tone of our event. The flowers were fresh, elegant, and arranged with great attention to detail. Parvathi was attentive to our needs and ensured everything was set up seamlessly. I highly recommend Floral Bliss and Parvathi for anyone looking to elevate their professional events with beautiful floral arrangements.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Jessica</h3>
        </div>

        <div class="box">
            <img src="./images/decor.jpeg" alt="">
            <p>We’ve been sourcing bulk flowers from Floral Bliss for our dried and long-lasting floral decor, and we couldn’t be more satisfied. The flowers are consistently fresh and of exceptional quality, which is crucial for our products. The variety offered by Floral Bliss is impressive, giving us plenty of options for creating arrangements. Their reliable service and great pricing make them a valuable partner for our business. We suggest Floral Bliss for anyone in the floral industry looking for premium, long-lasting flowers.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h3>Jhonson's dried & longlasting floral decor</h3>
        </div>

    </div>

</section>
</div>





 <!-- About Section -->
 <section class="hero">
        <div class="hero-text">
            <h1>Welcome to Floral Bliss<br>A blooming platform that connects hearts through flowers and fresh stories.</h1>
        </div>
        <div class="hero-image">
            <img src="./image/girl.jpg" alt="Women with flowers">
        </div>
    </section>

    <section class="about-section">
        <div class="left-block pink">
            <h2 class="rotate-text">About Us</h2>
        </div>
        <div class="middle-block">
            <p>
                Since 2024, Floral Bliss has been empowering local flower farmers and vendors by providing a digital platform to showcase and sell their blossoms. We bring nature closer to people’s hearts with quality, beauty, and purpose.<br><br>
                We collaborate with florists and everyday flower lovers to ensure every occasion is graced with the freshest petals. From traditional worship to weddings and gifting, Floral Bliss blooms in every corner of your life.
            </p>
        </div>
        <div class="right-block coral"></div>
    </section>

    <section class="footer-section">
        <div class="footer-image">
            <img src="./image/shop.jpg" alt="Gift flowers">
        </div>
        <div class="footer-text purple">
            <p>
                Our goal is to inspire and celebrate the everyday moments by spreading floral joy. Whether you're planning an event or just picking flowers for home, Floral Bliss is here to deliver beauty straight from the farm to you.
            </p>
        </div>
    </section>
<?php @include 'footer.php'; ?>

<script src="script.js"></script>
<script src="app.js"></script>

</body>
</html>