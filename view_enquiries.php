<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_id'])){
   header('location:login.php');
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `enquiries` WHERE id = '$delete_id'") or die('query failed');
    header('Location: view_enquiries.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>View Enquiries</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="admin_style.css">
   <link rel="stylesheet" href="style1.css">
</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="view-enquiries">
   <h1 class="title">User Enquiries</h1>
   <div class="box-container">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `enquiries` ORDER BY submitted_at DESC") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            while($row = mysqli_fetch_assoc($select)){
      ?>
      <div class="box">
         <p><strong>Name:</strong> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
         <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
         <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
         <p><strong>Subject:</strong> <?php echo $row['subject']; ?></p>
         <p><strong>Message:</strong> <?php echo $row['message']; ?></p>
         <p><strong>Date:</strong> <?php echo $row['submitted_at']; ?></p>
          <a href="view_enquiries.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('delete this query?');" class="delete-btn">delete</a>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No enquiries yet!</p>';
         }
      ?>
   </div>
</section>


<script src="admin_script.js"></script>
</body>
</html>
