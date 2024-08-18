

<?php  
include('incl/user_north.php');

include('incl/user_nav.php');
?>
<style>
.card {
    border-radius: 10px;
    overflow: hidden; /* Ensures content does not overflow */
    width: 100%; /* Full width of the container */
    margin-top: 20px;
}

.card-img-container {
    display: flex;
    justify-content: center; /* Center image horizontally */
    align-items: center; /* Center image vertically */
    overflow: hidden; /* Hide overflowed parts of the image */
}

.card-img-top {
    border-radius: 10px 10px 0 0;
    width: 100%; /* Make image take full width of the container */
    height: 300px; /* Fixed height */
    object-fit: cover; /* Ensure image covers the area without distortion */
    transition: width 0.3s ease, height 0.3s ease; /* Smooth transition for both width and height */
    margin-top: 20px;
}

.card-img-top:hover {
    width: 110%; /* Keep width at full size */
    height: 320px; /* Increase height on hover */
}

.card-body {
    padding: 1.25rem;
}

.card-title, .card-text {
    margin: 0; /* Remove margin from text elements */
}
.add-to-cart {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}
.form-control {
    width: 100%; /* Full width to ensure responsiveness */
    max-width: 400px; /* Optional: Limit max width */
    padding: 0.5rem; /* Add padding for better appearance */
    border-radius: 5px; /* Rounded corners */
    border: 1px solid #ced4da; /* Border color */
    background-color: #fff; /* Background color */
    font-size: 1rem; /* Font size */
    box-sizing: border-box; /* Include padding and border in element's total width and height */
}

/* Optional: Additional styling for focus state */
.form-control:focus {
    border-color: #007bff; /* Focus border color */
    box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25); /* Shadow on focus */
}


</style>

    <div class="container body">
        <div class="main_container">
            <div class="card">
                <div class="card-body">
                    <div class="container mt-5">
                      <dic class="row">
                        <div class="col-md-6">
                          <label for="selectCategory">Categories</label>
                          <select name="selectCategory" id="selectCategory" class="form-control">
                            <option value="all">Select All</option>
                            <?php
                            // Include database configuration
                            include('incl/config.php');
                            
                            // SQL query to select all categories
                            $sql = "SELECT * FROM categories";
                            
                            // Execute the query
                            $result = $conn->query($sql);
                            
                            // Check if there are any results
                            if ($result->num_rows > 0) {
                                // Output HTML for categories
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row['cat_id']."'>" . $row['category'] . "</option>";
                                }
                            } else {
                                // No results
                                echo "<option disabled>No categories found</option>";
                            }
                            
                            // Close connection
                            $conn->close();
                            ?>
                          </select>

                        </div>
                        <div class="col-md-6">
                          <label for="searchProduct">Search</label>
                          <input type="text" class="form form-control" id="searchProduct">
                        </div>
                      </dic>
                      
                    
                        <div class="row" id="product-list">
                            
                            <!-- Add more product cards as needed -->
                        </div>
                    </div>
                </div>
            </div>
        <!-- /page content -->
<!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Product details will be displayed here -->
                <input type="hidden" id="productIdInput">
                <label for="productQuantity">Quantity:</label>
                <input type="number" name="productQuantity" class="form form-control" id="productQuantity" max="100">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addToCartBtn">Add to Cart</button>
              </div>
            </div>
          </div>
        </div>

        <!-- footer content -->
        <!-- /footer content -->
        </div>
    </div>
    <?php include 'incl/script.php';?>
    <?php include 'userJs/user.php';?>
<script>
  function checkQuantity(productQuantity){

  }
  function cardProduct(product) {
    var card = '<div class="col-md-3 mb-3  d-flex">';
    card += '  <div class="card shadow-sm border-light">';
    card += '    <img src="incl/incl/' + product.img + '" class="card-img-top" style="" alt="' + product.products + '">';
    card += '    <div class="card-body">';
    card += '      <h5 class="card-title">' + product.products + '</h5>';
    card += '      <p class="card-text">Price: ₱' + product.price + '</p>';
    card += '      <p class="card-text">Remaining Quantity: ' + product.quantity + '</p>';
    card += '      <div class="d-flex justify-content-between align-items-center">';
    card += '        <button class="btn btn-primary add-to-cart" id="add-to-cart" data-product-id="' + product.products_id + '" data-toggle="modal" data-target="#productModal"><i class="fa fa-shopping-cart"></i> Add to Cart</button>';
    card += '      </div>';
    card += '    </div>';
    card += '  </div>';
    card += '</div>';

    $('#product-list').append(card);
}

  $(document).ready(function(){
    // Function to fetch products based on search query and category
    function fetchProducts(query, category){
        $.ajax({
            url: 'users/get_products.php', // PHP file that handles search and fetches filtered data
            type: 'POST',
            dataType: 'json',
            data: {query: query, category: category}, // Pass category as data
            success: function(response){
                if(response && response.length > 0){
                    $('#product-list').empty(); // Clear previous results
                    $.each(response, function(index, product){
                      cardProduct(product)
                    });
                } else {
                    // No products found
                    $('#product-list').html('<p>No products found.</p>');
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                $('#product-list').html('<p>Error loading products. Please try again later.</p>');
            }
        });
    }

    // Initial load of all products without search query
    fetchProducts('', '');

    // Listen for changes in the search input field and category dropdown
    $('#searchProduct, #selectCategory').on('input', function(){
        var query = $('#searchProduct').val().trim();
        var category = $('#selectCategory').val();
        fetchProducts(query, category); // Fetch products based on search query and category
    });
});
$(document).on("click", ".add-to-cart", function () {
  var productId = $(this).data('product-id');
  $("#productIdInput").val(productId);
});

$(document).ready(function(){
    // Add to cart button click event
    $('#addToCartBtn').click(function(){
      var productId = $('#productIdInput').val();
      var productQuantity = $('#productQuantity').val();
      
        // Data to be sent to the server
        var data = {
            client_id: <?php echo $_SESSION['user_id'];?>,
            product_id: productId,
            date_add: 'date_add_value',
            cart_quantity: productQuantity,
            status: '',
            order_status: ''
        };

        // Send AJAX request
        function checkQuantity(productId){
    $.ajax({
              url: 'users/check_quantity.php', // PHP file that handles database insertion
              type: 'POST',
              dataType: 'json',
              data: {productId: productId},
              success: function(response){
                  // Handle success response
                  if(parseInt(response.quantity) >= parseInt(productQuantity)){
                    // console.log(response.quantity +'<'+ productQuantity)
  
                    insertTocart()
                  }else{
                    toastr.error('Not enough stocks!', 'Error');
                  }
              },
              error: function(xhr, status, error){
                  // Handle error response
                  console.error('Error inserting data:', xhr.responseText);
              }
          });
  }

checkQuantity(productId)
        function insertTocart(){
          $.ajax({
            url: 'users/insert_shopping_cart.php', // PHP file that handles database insertion
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response){
                // Handle success response
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Add to shooping cart successfully.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    location.reload();
                });
            },
            error: function(xhr, status, error){
                // Handle error response
                console.error('Error inserting data:', xhr.responseText);
            }
          });
        }
        
    });
});
</script> 
<?php

include('incl/user_south.php');
?>