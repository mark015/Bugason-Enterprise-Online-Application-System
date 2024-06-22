<?php
session_start(); //We start the session 
//Set a session cookies to the one year duration
include('incl/config.php');
    if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
        header("location: ../");
    }else{
        $user_id =$_SESSION['user_id'];
        
        // Prepare the SQL statement with a WHERE clause to filter by user_id
        $sql = "SELECT `user_id`, `name`, `address`, `contact`, `username`, `password`, `role` FROM `users` WHERE `user_id` = $user_id";
        
        // Execute the SQL statement
        $result = $conn->query($sql);
   
        $row = $result->fetch_assoc();
    }
    
?>