<script>
function fetchDataOrder() {
    var selectedStatus = $('#orderStatus').val(); // Get the selected status
    var selectedType = $('#type').val(); // Get the selected type
    var role ="<?php echo $row['role']?>"
    console.log(role)
    $.ajax({
        url: "incl/ajaxData/OrderData.php",
        type: "GET",
        dataType: "json",
        data: { 
            status: selectedStatus,
            type: selectedType,  // Send type (could be empty or not present),
            role: role
        },
        beforeSend: function() {
            // Show loader or spinner
            $('#inventory_table tbody').html('<tr><td colspan="7">Loading...</td></tr>');
        },
        success: function(data) {
            var table = $('#inventory_table').DataTable();
            table.clear().draw(); // Clear existing rows

            if (data.length > 0) {
                $.each(data, function(index, product) {
                    var row = "<tr>" +
                        "<td>" + product.order_id + "</td>" +
                        "<td>" + product.name + "</td>" +
                        "<td>" + product.contact + "</td>" +
                        "<td>₱" + product.total_price + "</td>" +
                        "<td>" + product.order_date + "</td>" +
                        "<td>" + product.order_status + "</td>" +
                        "<td>" +
                        "<button class='btn btn-primary view-btn' data-view-order-id='" + product.order_id + "'><i class='fa fa-eye'></i></button>" +
                        "</td></tr>";
                    table.row.add($(row)).draw(); // Append row to table
                });
            } else {
                $('#inventory_table tbody').html('<tr><td colspan="7">No orders found</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            // Display a more detailed error message
            $('#inventory_table tbody').html('<tr><td colspan="7">Error loading inventory data: ' + error + '</td></tr>');
        }
    });
}

// Attach click event handler to view buttons
$(document).on('click', '.view-btn', function() {
    var orderId = $(this).data('view-order-id');
    // Perform any action you want with the order ID, such as showing detailed information
    location.href = "index.php?link=order&&viewOrder=" + orderId;
});

$(document).ready(function() {
    // Initialize DataTable once
    if (!$.fn.DataTable.isDataTable('#inventory_table')) {
        $('#inventory_table').DataTable();
    }

    // Fetch order data initially or on status/type change
    fetchDataOrder(); // Fetch data on page load

    $('#orderStatus, #type').on('change', function() { // Trigger fetchDataOrder on change of status or type dropdown
        fetchDataOrder();
    });
});
</script>
