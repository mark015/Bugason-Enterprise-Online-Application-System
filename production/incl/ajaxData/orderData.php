<?php
include('../config.php');

// Initialize the base SQL query
$sql = "SELECT o.order_id, u.name, u.address, u.contact, o.order_date, o.order_status, o.total_price, u.role 
        FROM `order` AS o 
        INNER JOIN users AS u ON o.client_id = u.user_id";

// Initialize an array to store query conditions
$conditions = array();
$params = array(); // Array to hold the parameters for the prepared statement
$param_types = ''; // String to hold the parameter types for bind_param

// Append status condition if provided and not 'All'
if (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] !== 'All') {
    $conditions[] = "o.order_status = ?";
    $params[] = $_GET['status'];
    $param_types .= 's'; // 's' indicates the parameter type is a string
}
// Append type condition if provided and not 'All'
if (isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] !== 'All') {
    $conditions[] = "u.role = ?";
    $params[] = $_GET['type'];
    $param_types .= 's';
}

// Append conditions to the SQL query
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters if there are any
    if (!empty($params)) {
        $stmt->bind_param($param_types, ...$params);
    } 

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data and prepare the response
    $orders = array();
    while ($row = $result->fetch_assoc()) {
        $orders[] = array(
            'order_id' => $row['order_id'],
            'name' => $row['name'],
            'address' => $row['address'],
            'contact' => $row['contact'],
            'order_date' => $row['order_date'],
            'order_status' => $row['order_status'],
            'total_price' => $row['total_price']
        );
    }
    echo json_encode($orders);
} else {
    echo json_encode(array('message' => 'Failed to prepare the SQL statement'));
}

$conn->close();
?>
