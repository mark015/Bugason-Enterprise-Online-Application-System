<?php  
include('incl/user_north.php');

include('incl/user_nav.php');?>
<div class="container body">
    <div class="main_container">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <h2>Orders</h2>
                    <div class="table-responsive">
                    <table id="order-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows will be loaded dynamically here -->
                        </tbody>
                        <tfoot>
                            <tr id="total-row">
                                <th colspan="4">Total:</th>
                                <th colspan="2" id="total-amount"></th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'incl/script.php';?>
<script>
    $(document).ready(function() {
        console.log(<?php echo $_GET['order_id'];?>)
        function fetchCartItems() {
        $.ajax({
            url: 'users/fetch_cart_items.php', // Change the URL to your PHP file
            type: 'POST',
            data: {order_id: <?php echo $_GET['order_id'];?>},
            dataType: 'json',
            success: function(response) {
                var totalAmount = 0;
                // Clear existing table data
                var cartTable = $('#order-table tbody');
                // Populate table with fetched data
                $.each(response, function(index, data) {
                    $('#order-table tbody').append('<tr>' +
                        '<td><image src="incl/incl/' + data.img + '" style="height: 80px; width: 80px; margin: 10px"></image></td>' +
                        '<td>' + data.pro + '</td>' +
                        '<td>' + data.cq + '</td>' +
                        '<td>&#8369; ' + data.pri + '</td>' +
                        '<td>&#8369; ' + data.total + '</td>' +
                        '</tr>');
                    totalAmount += parseFloat(data.total);
                });
                $('#total-amount').text(totalAmount.toFixed(2));
                // Update total amount in the table
                // var peso = totalAmount.toFixed(2);
                // $('#total-amount').text(peso);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    // Function to fetch cart items
    function fetchCartItemss() {
        $.ajax({
            url: 'users/fetch_cart_items.php', // PHP script that fetches cart items
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Process the response and update the table
                cartTable.empty(); // Clear existing rows
                var totalAmount = 0;

                // Loop through each cart item and add a row to the table
                response.forEach(function(item) {
                    var totalPrice = item.cart_quantity * item.price;
                    totalAmount += totalPrice;

                    cartTable.append(
                        '<tr>' +
                        '<td>Image</td>' +
                        '<td>' + item.product + '</td>' +
                        '<td>' + item.cart_quantity + '</td>' +
                        '<td>' + item.price + '</td>' +
                        '<td>' + totalPrice + '</td>' +
                        '</tr>'
                    );
                });

                // Update the total amount
            },
            error: function(xhr, status, error) {
                console.error('AJAX request error:', error);
            }
        });
    }

    // Initial fetch of cart items
    fetchCartItems();
});

</script>
  </body>
</html>  