<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $subject = mysqli_real_escape_string($conn, $_POST['subject']);
   $message = mysqli_real_escape_string($conn, $_POST['message']);

   $insert = mysqli_query($conn, "INSERT INTO enquiries (first_name, last_name, phone, email, subject, message) 
   VALUES ('$first_name', '$last_name', '$phone', '$email', '$subject', '$message')") or die('query failed');

   if ($insert) {
      echo "<script>alert('Enquiry submitted successfully!'); window.location.href='theme.php';</script>";
   } else {
      echo "<script>alert('Submission failed. Try again!'); window.history.back();</script>";
   }
} else {
   header("Location: theme.php"); // or wherever your form lives
}
?>
