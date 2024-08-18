<?php
include('../config.php');
header('Content-Type: application/json'); // Set the correct content type

$response = []; // Initialize an empty array for the response

if (isset($_POST['date']) && isset($_POST['reportType'])) {
    $selectedDate = $_POST['date'];
    $selectedStatus = isset($_POST['status']) ? $_POST['status'] : '';
    $reportType = $_POST['reportType'];

    // Adjust query based on report type
    switch ($reportType) {
        case 'daily_reports':
            $query = "SELECT * FROM `order` as o 
                      INNER JOIN users as c ON o.client_id = c.user_id
                      WHERE DATE(order_date) = ?";
            break;
        case 'monthly_reports':
            $query = "SELECT * FROM `order` as o 
                      INNER JOIN users as c ON o.client_id = c.user_id
                      WHERE DATE_FORMAT(order_date, '%Y-%m') = ?";
            break;
        case 'anual_reports':
            $query = "SELECT * FROM `order` as o 
                      INNER JOIN users as c ON o.client_id = c.user_id
                      WHERE YEAR(order_date) = ?";
            break;
        default:
            echo json_encode(['error' => 'Invalid report type']);
            exit;
    }

    if (!empty($selectedStatus)) {
        $query .= " AND order_status = ?";
    }
        $query .= " order by c.role";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        if (!empty($selectedStatus)) {
            $stmt->bind_param('ss', $selectedDate, $selectedStatus); // Bind both date and status
        } else {
            $stmt->bind_param('s', $selectedDate); // Bind only the date
        }

        $stmt->execute();
        $result = $stmt->get_result();
        // Initialize an array to store the results
        $data = [];

        // Fetch the data and format it as an array of arrays
        while ($row = $result->fetch_assoc()) {
            if($row['role'] ==='cashier'){
                $customer = "Walkin";
            }else{
                $customer = "Online Order";
            }
            $data[] = [
                htmlspecialchars($row['name']),
                htmlspecialchars($row['address']),
                htmlspecialchars($row['order_status']),
                htmlspecialchars($customer),
                htmlspecialchars($row['order_date']),
                htmlspecialchars($row['total_price']),
                "<button class='btn btn-sm btn-primary'>View</button>"
            ];
        }

        // Populate response with data
        $response['data'] = $data;

        // Return the data as a JSON-encoded string
        echo json_encode($response);

        // Close the statement and connection
        $stmt->close();
    } else {
        // Handle errors and return JSON with error message
        echo json_encode(['error' => 'Failed to prepare the SQL statement']);
    }

    $conn->close();
} else {
    // Return JSON with an error message if required parameters are missing
    echo json_encode(['error' => 'Required parameters not provided']);
}
?>
