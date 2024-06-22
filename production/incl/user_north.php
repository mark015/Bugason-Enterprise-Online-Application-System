<?php
  include('incl/auth.php');
  $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
  <?php include 'incl/head.php';?>
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for Navbar */
    .navbar-brand {
      font-weight: bold;
    }
    .navbar-nav .nav-link {
      color: #333;
      font-weight: bold;
    }
    .navbar-nav .nav-link:hover {
      color: #007bff;
    }
    .navbar{
      background-color: black;
      color: white;
      margin: 0px;
    }
    .navbar-toggler{
      border-color: #fff;
    }
</style>
  <body>