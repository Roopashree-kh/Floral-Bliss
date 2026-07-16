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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style1.css">
   <link rel="stylesheet" href="styles.css">

  <title>Floral Themes</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap');


    .section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10rem 8rem;
      position: relative;
      overflow: hidden;
      border-radius: 100% 100% 0 0;
      margin-bottom: 2rem;
    }

    .dark {
      background-color: #eeb378;
      color: rgb(94, 27, 27);
      border:#512a01c5 solid 6px ;
    }

    .light {
      background-color: #74223d;
      color:white;
      border: #512a01 solid 6px;
    }
    
    .rich {
      background-color: #894b55;
      color:white;
      border: #512a01 solid 6px;
    }

    .content {
      max-width: 60%;
      z-index: 2;
      margin: 4.8rem;
    }

    .content h2 {
      font-size: 2.5rem;
      align-items: left;
      margin-bottom: 1rem;
    }

    .content p {
      line-height: 1.8;
      font-size: 1rem;
    }

    .colors {
      display: flex;
      gap: 10px;
      margin: 1rem 0;
    }

    .colors span {
      display: inline-block;
      width: 15px;
      height: 15px;
      border-radius: 50%;
    }

    .colors .one { background: #e49da6; }
    .colors .two { background: #d6d7c8; }
    .colors .three { background: #f8e2e5; }

    .bn {
      margin-top: 1rem;
      display: inline-block;
      border-bottom: 1px solid currentColor;
      font-size: 1.8rem;
      text-decoration: none;
      color: inherit;
      padding-right: 62rem;
    }

    .img {
      width:400px;
      height: 400px;
      display:flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .img img {
      width: 100%;
      height: 100%;
      position: static;
      z-index: 3;
      border-radius: 0;
      object-fit: cover;
      object-position:center;
      
    }

   
    .profile-card {
  position: absolute;
  bottom: 50px;
  left:115px;
  background-color: rgba(255, 255, 255, 0.464);
  border-radius: 12px;
  padding: 10px 15px;
  display: flex;
  align-items: center;
  gap: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.profile-pic {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
  border: 1px solid #fff;
}

.profile-info {
  display: flex;
  flex-direction: column;
}

.profile-info span:first-child {
  font-weight: bold;
}
.job{
  font-family: playfair display;
  font-size: small;
}
/*  Responsive Styles  */
@media (max-width: 1024px) {
  .section {
    padding: 6rem 4rem;
    flex-direction: column;
    align-items: center;
  }

  .content {
    max-width: 90%;
    margin: 2rem 0;
    text-align: center;
  }

  .img {
    width: 300px;
    height: 300px;
    margin: 1rem 0;
  }

  .bn {
    padding-right: 0;
    font-size: 1.5rem;
  }

  .profile-card {
    left: 20px;
    bottom: 20px;
    flex-direction: column;
    align-items: flex-start;
  }
}

@media (max-width: 600px) {
  .section {
    padding: 4rem 1.5rem;
  }

  .content h2 {
    font-size: 1.8rem;
  }

  .content p {
    font-size: 0.95rem;
  }

  .img {
    width: 250px;
    height: 250px;
  }

  .profile-pic {
    width: 40px;
    height: 40px;
  }

  .bn {
    font-size: 1.2rem;
  }
}
@media (max-width: 1024px) {
  .profile-pic {
    width: 60px;
    height: 60px;
    object-fit: cover;
  }

  .profile-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .job {
    font-size: 0.75rem;
  }
}

@media (max-width: 1024px) {
  .section {
    padding: 4rem 2rem;
    flex-direction: column;
    align-items: center;
    border-radius: 0; /* remove if it's causing clipping */
  }

  .content {
    max-width: 100%;
    text-align: center;
    word-break: break-word; /* ensures text wraps */
  }

  .img {
    width: 200px;
    height: 200px;
    object-fit: cover;
  }
}

  </style>
</head>
<body>
  
<?php @include 'header.php'; ?>

  <!-- private events -->
  <section class="section dark">
    <div class="content">
      <h2 style="text-align: left;">Private Events</h2>
      <p style="font-size: 1.8rem; text-align: left;">"Where Intimacy Meets Elegance. I love bringing warmth and beauty into personal gatherings. 
        Every bloom I choose tells a story — tailored to the moment, the mood, and the people.
        It's all about making your space quietly magical."</p>
      <div class="colors">
        <span class="one"></span>
        <span class="two"></span>
        <span class="three"></span>
      </div>
      <a href="sahana.php" class="bn">Find Arrangements →</a>
    </div>
    <div class="img">
      <img src="./image/f11.jpg" alt="Roses">
    </div>
    <div class="profile-card">
      <img src="./image/sanu.jpg" class="profile-pic" alt="Florist" />
      <div class="profile-info">
        <span class="job">Sahana R S</span>
        <span class="job">Florist & Designer</span>
      </div>
    </div>
  </section>

  <!-- weddings -->
  <section class="section light">
    <div class="content">
      <h2 style="text-align: left; color:#fff;">Wedding Specialisation</h2>
      <p style="font-size: 1.8rem; text-align: left;">"There’s nothing quite like crafting floral poetry for two souls tying the knot. From intimate garden vows to grand ballroom celebrations, I design every arrangement with deep intention and romance. Every petal whispers a story, every bouquet becomes a memory. Creating floral dreams for weddings isn’t just my profession—it’s my heart’s devotion"</p>
      <div class="colors">
        <span class="one"></span>
        <span class="two"></span>
        <span class="three"></span>
      </div>
      <a href="kiran.php" class="bn">Find Arrangements →</a>
    </div>
    <div class="img">
      <img src="./image/f26.jpg" alt="Dahlias">
    </div>
    <div class="profile-card">
      <img src="./image/kiran.jpg" class="profile-pic" alt="Florist" />
      <div class="profile-info">
        <span class="job">Kiran</span>
        <span class="job">Florist & Designer</span>
      </div>
    </div>
  </section>

  <!-- professional events -->
  <section class="section rich">
    <div class="content">
      <h2 style="text-align: left; color:#fff;">Professional Events</h2>
      <p style="font-size: 1.8rem; text-align: left;">“In the world of suits and deadlines, flowers bring in the softness, the grace. Whether it’s a product launch, a boardroom event, or a corporate gala, I curate floral themes that reflect elegance and precision. My florals speak the language of class—professional, yet unforgettable. It's not just about looking good. It's about feeling right.”</p>

      <div class="colors">
        <span class="one"></span>
        <span class="two"></span>
        <span class="three"></span>
      </div>
      <a href="paru.php" class="bn">Find Arrangements →</a>
    </div>
    <div class="img">
      <img src="./image/f34.jpg" alt="Tulips">
    </div>
    <div class="profile-card">
      <img src="./image/paru.jpg" class="profile-pic" alt="Florist" />
      <div class="profile-info">
        <span class="job">G M Parvathi</span>
        <span class="job">Florist & Designer</span>
      </div>
    </div>
  </section>
  <?php @include 'footer.php'; ?>
<script src="script.js"></script>
<script src="app.js"></script>

</body>
</html>