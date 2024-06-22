<?php  
include('incl/user_north.php');

include('incl/user_nav.php');?>
    <div class="container body">
        <div class="main_container">
            <div class="card">
                <div class="card-body">
                    <div class="container mt-5">
                        <h2>Order Details</h2>
                        <div class="card text-center ">
                            <div id="orderDetails">
                            
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'incl/script.php';?>
<script>




    $(document).ready(function() {
        // Make an AJAX request to fetch order details
        $.ajax({
            url: 'users/fetch_order.php', // PHP script that fetches order details
            method: 'POST',
            data: {userId: <?php echo $_SESSION['user_id'];?>},
            dataType: 'json',
            success: function(response) {
                // Process the response and update the content
                console.log(response)
                var orderDetailsHtml = 'NOTE: Cannot Cancel if the products on dilever';
                response.forEach(function(order) {
                    orderDetailsHtml += '<div class="card">';
                    orderDetailsHtml += '<div class="flex">';
                    order.forEach(function(item) {
                        orderDetailsHtml += '<div >';
                        orderDetailsHtml += '<label>' + item.label + ':</label>';
                        orderDetailsHtml += '<span>' + item.value + '</span>';
                        orderDetailsHtml += '</div>';

                    });
                    orderDetailsHtml += '<button class="btn btn-primary view-order" data-order-id="' + order[4].value + '"><i class="fa fa-eye"></i></button>';

                    if(order[6].value === 'Pending' || order[6].value === 'Preparing Order'){
                        orderDetailsHtml += '<button class="btn btn-danger cancel-order" id="RC" data-cancel-id="' + order[4].value + '">Cancel</button>';
                    }else if(order[6].value === 'On Deliver'){
                        orderDetailsHtml += '<button class="btn btn-success cancel-order" id="RC" data-cancel-id="' + order[4].value + '">Receive</button>';
                    }


                    
                    orderDetailsHtml += '</div></div>';
                });
                $('#orderDetails').html(orderDetailsHtml);
            },
            error: function(xhr, status, error) {
                console.error('AJAX request error:', error);
            }
        });

        

        $(document).on('click', '.view-order', function() {
            var orderId = $(this).data('order-id');
            // Redirect to the order page or perform any action with the order ID
            location.href = 'viewOrder?order_id=' + orderId;
        });
        
        $(document).on('click', '.cancel-order', function() {
            var orderId = $(this).data('cancel-id');
            var value = $(this).text();
            if(value === 'Cancel'){
                var confirmButtonText = "Yes, Cancel it!"
                var text = "You want to Cancel?"
                var texto = "Successfully Canceled !"
            }else{
                var confirmButtonText = "Yes, Receive it!"
                var text = "You want to Receive?"
                var texto = "Successfully Received !"
            }
            
        Swal.fire({
            title: 'Are you sure?',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms deletion, send AJAX request to delete.php
                $.ajax({
            url: 'users/cancelOrder.php', // PHP script to fetch order details by order ID
            method: 'POST',
            data: { orderId: orderId, value: value },
            dataType: 'json',
            success: function(response) {
                // Process the response and display the order details
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: texto,
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    location.href = 'order';
                });
                // Display the order details (e.g., in a modal)
            },
            error: function(xhr, status, error) {
                console.error('AJAX request error:', error);
            }
        });
            }
        });
        });
        
    });

    function fetchOrderDetails(orderId) {

        $.ajax({
            url: 'users/fetch_order_details.php', // PHP script to fetch order details by order ID
            method: 'GET',
            data: { orderId: orderId },
            dataType: 'json',
            success: function(response) {
                // Process the response and display the order details
                console.log('Order details:', response);
                // Display the order details (e.g., in a modal)
            },
            error: function(xhr, status, error) {
                console.error('AJAX request error:', error);
            }
        });
    }
</script>
  </body>
</html>  