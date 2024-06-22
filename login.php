<?php
// Assuming you have a database connection established
include('production/incl/config.php');
// Check if the form is submitted via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Get username and password from the AJAX request
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = md5($password); 
    // Sanitize input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);

    // Prepare and execute a parameterized query to fetch user details based on the provided username
    $query = "SELECT `user_id`, `name`, `address`, `contact`, `username`, `password`, `role` FROM `users` WHERE `username` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        // Check if any rows are returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch the row
            $row = mysqli_fetch_assoc($result);
            // Verify the password
            if ($repassword===$row['password']) {
                // Password is correct, start session and set user_id
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                // Return success response as JSON
                $response = array('status' => 'success', 'user_id' => $row['user_id'] , 'role' => $row['role']);
                echo json_encode($response);
            } else {
                // Invalid password, return error response as JSON
                $response = array('status' => 'error', 'message' => 'Invalid username or passwords.');
                echo json_encode($response);
            }
        } else {
            // No user found with the provided username, return error response as JSON
            $response = array('status' => 'error', 'message' => 'Invalid username or password.');
            echo json_encode($response);
        }
    } else {
        // Error in query execution, return error response as JSON
        $response = array('status' => 'error', 'message' => 'Database error. Please try again later.');
        echo json_encode($response);
    }
    
} else {
    // If not submitted via AJAX, return error response as JSON
    $response = array('status' => 'error', 'message' => 'Invalid request.');
    echo json_encode($response);
}
?>