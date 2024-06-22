<script>
    function fetchDataOrder() {
    $.ajax({
        url: "incl/ajaxData/OrderData.php",
        type: "GET",
        dataType: "json",
        success: function(data){
            if(data.length > 0) {
                $('#inventory_table tbody').empty(); // Clear existing rows
                $.each(data, function(index, product){
                    var row = "<tr>" +
                        "<td>" + product.order_id + "</td>" +
                        "<td>" + product.name + "</td>" +
                        "<td>" + product.contact + "</td>" +
                        "<td>₱" + product.total_price + "</td>" +
                        "<td>" + product.order_date + "</td>" +
                        "<td>" + product.order_status + " </td>" +
                        "<td></button>" +
                        "<button class='btn btn-primary view-btn' id='viewOrders' data-view-order-id='" + product.order_id + "'><i class='fa fa-eye'></i></button>" +
                        "</td></tr>";
                    $('#inventory_table tbody').append(row); // Append row to table body
                });
                // Initialize DataTable
                $('#inventory_table').DataTable();
            } else {
                $('#inventory_table tbody').html('<tr><td colspan="5">No products found</td></tr>');
            }
        },
        error: function(){
            $('#inventory_table tbody').html('<tr><td colspan="5">Error loading inventory data.</td></tr>');
        }
    });
}
// Attach click event handler to view buttons
$(document).on('click', '.view-btn', function() {
    var orderId = $(this).data('view-order-id');
    // Perform any action you want with the order ID, such as showing detailed information
    location.href="index.php?link=order&&viewOrder="+orderId;
});
$(document).ready(function(){
    fetchDataOrder()
});
</script>