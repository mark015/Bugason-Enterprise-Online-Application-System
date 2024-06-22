<?php
// Assuming you have already connected to your database

include('../incl/config.php');
if (isset($_POST['cat_id'])) {
    $cat_ids = $_POST['cat_id'];

    // Construct the SQL query to fetch the items in the shopping cart for the selected categories
    $sql = "SELECT SUM(P.price * SC.cart_quantity) AS total 
            FROM `shopping_cart` as SC 
            INNER JOIN `products` as P 
            ON SC.product_id = P.products_id 
            WHERE SC.cart_id IN (".implode(',', $cat_ids).")";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch the total price
        $row = mysqli_fetch_assoc($result);
        $totalPrice = $row['total'];

        // Encode the total price as JSON and send it back as the AJAX response
        echo json_encode(['totalP' => $totalPrice]);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo json_encode(['totalP' =>'0']);;
}
?>
