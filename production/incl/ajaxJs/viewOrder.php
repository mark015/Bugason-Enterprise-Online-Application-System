<script>


function fetchCartItems() {
    console.log(<?php echo $_GET['viewOrder'];?>)
$.ajax({
    url: 'incl/ajaxData/fetch_order.php', // Change the URL to your PHP file
    type: 'POST',
    data: {order_id: <?php echo $_GET['viewOrder'];?>},
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
                '<td>₱ ' + data.pri + '</td>' +
                '<td>₱ ' + data.total + '</td>' +
                '</tr>');
            totalAmount += parseFloat(data.total);
        });
        $('#total-amount').text('₱'+totalAmount.toFixed(2));
        // Update total amount in the table
        // var peso = totalAmount.toFixed(2);
        // $('#total-amount').text(peso);
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
    }
});
}

function orderDetails() {
    $.ajax({
        url: 'incl/ajaxData/fetchOrderDetails.php', // PHP script that fetches order details
        method: 'POST',
        data: {order_id: <?php echo $_GET['viewOrder'];?>},
        dataType: 'json',
        success: function(response) {
            console.log(response)
            // Process the response and update the content
            var orderDetailsHtml = '';
            response.forEach(function(order) {
                orderDetailsHtml += '<div class="flex">';
                order.forEach(function(item) {
                    orderDetailsHtml += '<div>';
                    orderDetailsHtml += '<label>' + item.label + ':</label>';
                    if (item.label === 'Order Status') { // Change 'Your Button Label' to the label of the value you want to turn into a button
                        console.log(item.value)
                        if(item.value === 'Products Receive'){
                            orderDetailsHtml += '<span>' + item.value + '</span>';
                        }else{
                            orderDetailsHtml += ' <button class="btn btn-sm btn-primary" id="updateStatus" >' + item.value + '</button>';
                        }

                        
                    } else {
                        orderDetailsHtml += '<span>' + item.value + '</span>';
                    }
                    orderDetailsHtml += '</div>';
                });
                orderDetailsHtml += '</div>';
            });
            $('#orderDetails').html(orderDetailsHtml);
        },
        error: function(xhr, status, error) {
            console.error('AJAX request error:', error);
        }
    });
}
function fetchData() {
    $.ajax({
        url: 'ajaxData/updateStatus.php', // URL to your AJAX endpoint
        method: 'GET', // or 'POST' depending on your server-side implementation
        dataType: 'json', // or other data type you expect
        success: function(response) {
            // Process the response data here
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request error:', error);
        }
    });
}

$(document).on('click', '#updateStatus', function() {
    var btnValue = $(this).text(); 
    // console.log(btnValue)

    Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms deletion, send AJAX request to delete.php
                $.ajax({
                    url: 'incl/ajaxData/updateStatus.php',
                    type: 'POST',
                    data: {order_id: <?php echo $_GET['viewOrder']; ?>, status:btnValue},
                    dataType: 'json', // or other data type you expect
                    success: function(response) {
                        console.log(response)
                        // Handle success response (if any)
                        // For example, you can display a success message or reload the page
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Status updated.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                        // Handle error response (if any)
                        // For example, you can display an error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while deleting the record.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        });
    
});

      $(document).ready(function() {

        orderDetails()
fetchCartItems()
      });

</script>