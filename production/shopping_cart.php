<?php  
include('incl/user_north.php');

include('incl/user_nav.php');?> 
<div class="container body">
    <div class="main_container">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <h2>Shopping Cart</h2>
                        <p>Note: Minimum purchase to avail freeshipping fee is  ₱ 10000.00</p>
                    <div class="table-responsive">
                        <table id="cart-table" class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Cart ID</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                                <!-- AJAX data will be inserted here -->
                            </tbody>
                            <tfoot>
                              <tr id="total-row">
                                  <th colspan="4">Total:</th>
                                  <th colspan="2" id="total-amount"></th>
                              </tr>
                            </tfoot>
                        </table>
                        <button class="btn btn-success" id="placeOrder">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'incl/script.php';?>
<script>
$(document).ready(function(){
    // Function to fetch data via AJAX
    function fetchCartData() {
        $.ajax({
            url: 'users/fetch_cart_data.php', // Change the URL to your PHP file
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var totalAmount = 0;
                // Clear existing table data
                $('#cart-table-body').empty();
                // Populate table with fetched data
                $.each(response, function(index, data) {
                    $('#cart-table-body').append('<tr>' +
                        '<td><input type="checkbox" class="cart-item" value="' + data.ci + '"> <image src="incl/incl/' + data.img + '" style="height: 80px; width: 80px; margin: 10px"></image></td>' +
                        '<td>' + data.pro + '</td>' +
                        '<td>' + data.cq + '</td>' +
                        '<td>&#8369; ' + data.pri + '</td>' +
                        '<td>&#8369; ' + data.total + '</td>' +
                        '</tr>');
                    totalAmount += parseFloat(data.total);
                });
                // Update total amount in the table
                // var peso = totalAmount.toFixed(2);
                // $('#total-amount').text(peso);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Initial fetch of data
    fetchCartData();
    placeOrder()
    // Event listener for checkbox change
    
});
function placeOrder(){
   
    $(document).on('click','#placeOrder', function(){
        var cat_id = []; // Array to store checkbox values

// Iterate through each checked checkbox and get its value
$('.cart-item:checked').each(function() {
    cat_id.push($(this).val());
});
$.ajax({
        url: 'users/placeOrder.php', // Replace with your server endpoint
        method: 'POST',
        data: { cat_id: cat_id },
        dataType: 'json',
        success: function(response) {
            Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Add to shooping cart successfully.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    location.href = 'order';
                });
    // Check the actual response received from the server
    
},
        error: function(xhr, status, error) {
            console.error('AJAX request error:', error);
            // Handle the error as needed
        }
    });
    });
}
$(document).on('change', '.cart-item', function() {
  var cat_id = []; // Array to store checkbox values

// Iterate through each checked checkbox and get its value
$('.cart-item:checked').each(function() {
    cat_id.push($(this).val());
});
    // Send the value of the checkbox via AJAX
    $.ajax({
        url: 'users/check_box.php', // Replace with your server endpoint
        method: 'POST',
        data: { cat_id: cat_id },
        dataType: 'json',
        success: function(response) {
            console.log('AJAX request successful:', response.totalP);
            if (response && response.totalP !== undefined) {
                // Update the UI with the total price
                $('#total-amount').text('₱ ' +response.totalP);
            } else {
                console.error('Invalid response received from server.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request error:', error);
            // Handle the error as needed
        }
    });


});
</script>
  </body>
</html>  