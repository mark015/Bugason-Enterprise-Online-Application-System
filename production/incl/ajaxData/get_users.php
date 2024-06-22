<?php

include('../config.php');

$sql = "SELECT `user_id`, `name`, `address`, `contact`, `username`, `role` FROM `users` where `role`!='admin'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>