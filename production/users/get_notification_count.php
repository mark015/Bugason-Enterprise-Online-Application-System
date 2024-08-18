<?php
// Include database configuration
include('../incl/config.php');
$user=$_GET['user_id'];
// SQL query to count unread notifications (modify according to your database structure)
$sql = "SELECT COUNT(*) as count FROM `order` WHERE notif_status = 'unread' and client_id='$user'";
$result = $conn->query($sql);

$notificationCount = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $notificationCount = $row['count'];
}

// Return the count as JSON
echo json_encode(['count' => $notificationCount]);

// Close the connection
$conn->close();
?>
