<script>
function fetchData() {
    $.ajax({
        url: "incl/ajaxData/productsData.php",
        type: "GET",
        dataType: "json",
        success: function(data){
            if(data.length > 0) {
                $('#inventory_table tbody').empty(); // Clear existing rows
                $.each(data, function(index, product){
                    var row = "<tr>" +
                        "<td>" + product.product_id + "</td>" +
                        "<td>" + product.product_name + "</td>" +
                        "<td>" + product.category + "</td>" +
                        "<td>" + product.quantity_in_stock + "</td>" +
                        "<td>₱" + product.price + "</td>" +
                        "<td><img src='incl" + product.img + "' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>" +
                        "<td><button class='btn btn-primary' id='editBtn' data-product-id='" + product.product_id + "' data-toggle='modal' data-target='#editProductModal'><i class='fa fa-edit'></i></button>" +
                        "<button class='btn btn-danger delete-btn' id='deleteProducts' data-delete-product-id='" + product.product_id + "'><i class='fa fa-trash'></i></button>" +
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

function deleteProducts(){
    $(document).on('click', '.delete-btn', function() {
        // Retrieve the ID of the record to be deleted
        var id = $(this).data('delete-product-id');

        // Show confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms deletion, send AJAX request to delete.php
                $.ajax({
                    url: 'incl/ajaxData/deleteProducts.php',
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        // Handle success response (if any)
                        // For example, you can display a success message or reload the page
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Record has been deleted.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
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
}


function addProducts(){
    $('#addProductBtn').on('click', function(){
            var formData = new FormData($('#addProductForm')[0]); // FormData object to store form data
            // Perform AJAX request to add the product
            $.ajax({
                url: "incl/ajaxData/addProducts.php",
                type: "POST",
                data: formData,
                processData: false, // Prevent jQuery from automatically processing form data
                contentType: false, // Prevent jQuery from automatically setting Content-Type
                success: function(response){
                    // Handle success response
                    Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Record has been added.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    $('#addProductModal').modal('hide'); // Hide the modal
                    // You may want to reload the product list or update it dynamically
                },
                error: function(){
                    // Handle error
                    alert("Error adding product.");
                }
            });
        });
}

function updateFetchProductData(){
    $(document).on('click','#editBtn', function(){
            var productId = $(this).data('product-id');
            // Fetch product details using AJAX and populate the edit form
            $.ajax({
                url: "incl/ajaxData/updateFetchProduct.php",
                type: "GET",
                data: { productId: productId },
                dataType: "json",
                success: function(product){
                    $('#editProductId').val(product.products_id);
                    $('#editProductName').val(product.products);
                    $('#editQuantity').val(product.quantity);
                    $('#editPrice').val(product.price);
                    $('#editImage').val(product.img);
              
                },
                error: function(){
                    alert("Error fetching product details.");
                }
            });
        });
}

$('#updateProductBtn').on('click', function(){
    var formData = new FormData($('#editProductForm')[0]); // FormData object to store form data
    console.log(formData)
    // Perform AJAX request to update the product
    $.ajax({
        url: "incl/ajaxData/updateProducts.php",
        type: "POST",
        data: formData,
        processData: false, // Prevent jQuery from automatically processing form data
        contentType: false, // Prevent jQuery from automatically setting Content-Type
        success: function(response){
            // Handle success response
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Record has been updated.',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                location.reload();
            });
            $('#editProductModal').modal('hide'); // Hide the modal
            // You may want to reload the product list or update it dynamically
        },
        error: function(){
            // Handle error
            alert("Error updating product.");
        }
    });
});

$(document).ready(function(){
    fetchData();
    addProducts()
    updateFetchProductData()
    deleteProducts()
});

</script>