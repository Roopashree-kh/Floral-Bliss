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
<!DOCTYPE html><html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style1.css">
   <link rel="stylesheet" href="styles.css">
  <title>Private Events</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fff;
      color: #333;
    }
    .headers, section {
      padding: 60px 20px;
      text-align: center;
    }
    .headers {
      background-image: url('./image/san.jpg');
      background-size: cover;
      background-position: center;
      height: 200px;
      display: flex;
      align-items: flex-end;
      justify-content: center;
    }
    .headers h1 {
      color: white;
      font-size: 3em;
      margin-bottom: 20px;
    }
    .sections h2 {
      font-size: 2.5em;
      margin-bottom: 20px;
    }
    .sections p {
      max-width: 800px;
      margin: 0 auto 40px;
      line-height: 1.6;
      font-size: 2em;
    }
    .two-column {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 40px;
      align-items: center;
    }
    .two-column img {
      max-width: 400px;
      width: 100%;
      border-radius: 10px;
    }
    .two-column .text {
      max-width: 500px;
      text-align: justify;
      font-size: 1.8rem;
    }
    .gallery {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
      padding: 40px 0;
    }
    .gallery img {
      max-width: 300px;
      width: 100%;
      border-radius: 10px;
    }
    .button {
      display: inline-block;
      padding: 12px 24px;
      border: 2px solid black;
      text-decoration: none;
      color: black;
      margin-top: 20px;
      font-weight: bold;
      border-radius: 6px;
    }
   
   .image-wrapper {
  position: relative;
  width: fit-content;
  display: inline-block;
}

.green-bg {
  background-color: #69764d; /* olive green tone */
  padding: 60px;
  position: relative;
  display: inline-block;
}

.main-image{
  display:block;
  max-width: 100%;
  height: auto;
}

.vertical-text {
  position: absolute;
  left: 10%; /* adjust as needed */
  top: 50%;
  transform: rotate(-90deg) translateY(-50%);
  transform-origin: left center;
  font-family: 'YourFont'; /* match the style */
  color: rgb(255, 255, 255);
  letter-spacing: 2px;
}
.our-process-section {
  background-color: #bfbaa0; /* Beige background */
  padding: 60px 20px;
  text-align: center;
}

.content-container {
  max-width: 800px;
  margin: 0 auto;
}

.our-process-section h2 {
  font-family: 'Cormorant Garamond', serif; /* Match the Fiore style */
  font-size: 36px;
  margin-bottom: 20px;
  color: #111;
}

.our-process-section p {
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  color: #333;
  line-height: 1.7;
  margin-bottom: 20px;
}
/* --------------------- Popup Modal Styles --------------------- */

.open-modal-btn {
  margin: 100px auto;
  display: block;
  padding: 20px 25px;
  background-color: #000;
  color: #fff;
  border: none;
  border-radius: 30px;
  cursor: pointer;
  font-size: 16px;
}

.modal {
  display: none;
  position: fixed;
  z-index: 999;
  left: 0;
  top: 0;
  width: 100%;
  height: 112%;
  background-color: rgba(0, 0, 0, 0.6);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fff;
  padding: 50px;
  border-radius: 10px;
  width: 90%;
  max-width: 700px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  position: relative;
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}

.modal-content h2 {
  text-align: center;
  font-size: 32px;
  font-family: 'Playfair Display', serif;
  margin-bottom: 10px;
}

.modal-content p {
  text-align: center;
  font-size: 15px;
  color: #555;
  margin-bottom: 30px;
}

.form-row {
  display: flex;
  gap: 20px;
  margin-bottom: 15px;
  flex-wrap: wrap;
}

.form-row input,
.form-row textarea {
  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 14px;
  font-family: 'Segoe UI', sans-serif;
}

textarea {
  resize: vertical;
  height: 100px;
}

.submit-btn {
  width: 100%;
  padding: 12px;
  border: 2px solid #000;
  background-color: transparent;
  color: #000;
  font-weight: bold;
  font-size: 14px;
  cursor: pointer;
  border-radius: 30px;
  transition: all 0.3s ease;
}

.submit-btn:hover {
  background-color: #000;
  color: #fff;
}

.close-btn {
  position: absolute;
  top: 15px;
  right: 20px;
  font-size: 24px;
  font-weight: bold;
  cursor: pointer;
  color: #888;
}

.close-btn:hover {
  color: #000;
}


  </style>
</head>
<body> 
    
<?php @include 'header.php'; ?>
 <header class="headers">
    <!-- Background image in CSS -->
    <h1>Private Events</h1>
  </header>  
  <section class="sections">
    <p>Who doesn’t love a good party? Nothing gets us more excited than hearing about how we can be a part of your event.</p>
  </section>  <section class="two-column">
    <div class="image-wrapper">
      <div class="green-bg">
        <span class="vertical-text">Bliss Flowers</span>
    <img src="./image/sahana.jpg" alt="Floral arrangement" class="main-image">
    </div>
    </div>
    <div class="text">
      <h2>From an intimate dinner to a large scale private event</h2><br>
      <p>I'm here to help you bring your vision to life. I'll meet for a consultation with you to go over details and show you different blooms on site at our shop. After we walk the venue our graphics team will put together a customized mood board outlining colors, containers, mood and style of your event.</p><br>
      <p>Using inspirational images and floral samples you will have a clear concept of exactly what your event will look and feel like. From an intimate dinner to a large scale event we will guide you each step, help track your budget and ensure no detail is overlooked.</p>
      <button class="open-modal-btn" onclick="openModal()">Speak to our Experts</button>

    </div>
  </section>  
  <section class="our-process-section">
    <div class="content-container">
    <h2>Our Process</h2>
    <p>Once installed, Starbright will return weekly to care and nurture your new residents. Our dedicated staff will water, clean, prune and fertilize all of the plants so each can complement your space with grace and beauty. Many of our clients request orchids to adorn their space. These gorgeous, flowering plants are rotated on a monthly basis for our clients, so that the orchids are always in full, sumptuous bloom.</p>
    <p>Each event flower design is created only after conferring with the event flower design team who are keenly aware of the client’s vision. We always consider a client’s preferences, directives and objectives. Whether it’s a modern style event flowers or traditional style event flowers, our Events Flowers Team transforms our clients’ vision into reality.</p>
    </div>
  </section>  <section class="sections">
    <h2>Sahana's themes</h2>
    <div class="gallery">
      <img src="./image/sahana1.jpg" alt="Gallery Image 1">
      <img src="./image/sahana2.jpg" alt="Gallery Image 2">
      <img src="./image/sahana3.jpg" alt="Gallery Image 3">
    </div>
  </section>

<?php @include 'footer.php'; ?>

<script src="script.js"></script>
<script src="app.js"></script>
<div class="modal" id="popupModal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h2>Speak to our experts</h2>
    <p>Please leave your enquiry here and our team will be in touch.</p>
   <form action="submit_enquiry.php" method="POST">
  <div class="form-row">
    <input type="text" name="first_name" placeholder="First name" required />
    <input type="text" name="last_name" placeholder="Last name" required />
  </div>
  <div class="form-row">
    <input type="text" name="phone" placeholder="Phone number" required />
    <input type="email" name="email" placeholder="Email address" required />
  </div>
  <div class="form-row">
    <input type="text" name="subject" placeholder="Subject" required />
  </div>
  <div class="form-row">
    <textarea name="message" placeholder="Your message" required></textarea>
  </div>
  <button type="submit" class="submit-btn">SUBMIT</button>
</form>
  </div>
</div>
<script>
  function openModal() {
  document.getElementById('popupModal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('popupModal').style.display = 'none';
}

window.onclick = function(event) {
  const modal = document.getElementById('popupModal');
  if (event.target === modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>