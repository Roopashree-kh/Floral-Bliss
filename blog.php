<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>blog</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style1.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>blog</h3>
    <p> <a href="home.php">home</a> / blog</p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="./image/FLOWER.jpeg" alt="">
        </div>

        <div class="content">
            <h3>OUR FLORAL STORY</h3>
            <p>Floral Bliss began with a simple dream — to make every bloom count.<br>
Not just as a gift or decoration, but as a connection — between hands that grow, hearts that give, and moments that matter.<br>

We work hand-in-hand with farmers who rise with the sun, local vendors who carry tradition in every sale, and creators who turn petals into poetry.<br>
Together, we reduce waste, support livelihoods, and deliver flowers that carry meaning — not just scent.<br>

From sacred rituals to grand celebrations, we bring you seasonal freshness, thoughtful designs, and a gentle promise:<br>
That every flower you hold was chosen with care, rooted in purpose, and wrapped in love.<br><br>

<b>Floral Bliss — where beauty blooms with intention.</b></p>
            <a href="flower.php" class="btn">shop now</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>what we provide?</h3>
            <p>At Floral Bliss, we bring you more than just flowers — we bring thoughtfully crafted moments.<br>
             From fresh, seasonal blossoms perfect for worship, décor, or heartfelt gifting, to custom bouquets tailored with love, everything we offer is rooted in purpose. <br>
             We support vendors and event planners with reliable bulk orders, while ensuring our packaging stays kind to the earth.<br>

Our transparent supply chain lets you trace your flowers from farm to doorstep, and our loyalty program rewards every step you take with us. Most importantly, we stand by our farmers and local vendors, creating a community where every petal supports a dream.</p>
            <a href="contact.php" class="btn">contact us</a>
        </div>

        <div class="image">
            <img src="./image/flower2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="./image/flower3.jpeg" alt="">
        </div>

        <div class="content">
            <h3>who we are?</h3>
            <p>We are storytellers in petals, curators of connection, and quiet believers in the power of a single bloom.<br>
             Floral Bliss is a collective of farmers, vendors, dreamers, and doers — all united by a love for flowers and the lives they touch.<br>

Rooted in tradition and blossoming with purpose, we exist to bridge the gap between the hands that grow and the hearts that receive. Our platform brings fresh, meaningful flowers to people while uplifting the communities that nurture them.<br>

We’re not just selling flowers — we’re sharing stories, building bonds, and spreading a little more beauty in the world, one bloom at a time.</p>
        </div>

    </div>

</section>









<?php @include 'footer.php'; ?>

<script src="script.js"></script>

</body>
</html>