

<?php  
include('incl/user_north.php');

include('incl/user_nav.php');
?>

    <div class="container body">
        <div class="main_container">
            <div class="card">
                <div class="card-body">
                    <div class="container mt-5">
                      <label for="searchProduct">Search</label>
                      <input type="text" class="form form-cotrol" id="searchProduct">
                      <label for="selectCategory">Categories</label>
                      <select name="selectCategory" id="selectCategory" class="form">
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
                          echo "<ul>";
                          while($row = $result->fetch_assoc()) {
                              echo "<option value=".$row['cat_id'].">" . $row['category'] . "</option>";
                          }
                          echo "</ul>";
                      } else {
                          // No results
                          echo "No categories found";
                      }

                      // Close connection
                      $conn->close();
                      ?>
                      </select>
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
  function cardProduct(product){
    var card = '<div class="col-md-3 mb-4">';
        card += '<div class="card">';
        card += '<div class="row">';
        card += '<div class="col-md-6 col-sm-3">';
        card += '<img src="incl/incl/' + product.img + '" class="card-img-top img-fluid" style="height: 200px; width: 200px; margin: 10px" alt="' + product.products + '">';
        card += '</div>';
        card += '<div class="col-md-6">';
        card += '<div class="card-body">';
        card += '<h5 class="card-title">' + product.products + '</h5>';
        card += '<p class="card-text">Price: ₱' + product.price + '</p>';
        card += '<p class="card-text">Remaining Quantity: ' + product.quantity + '</p>';
        card += '<button class="btn btn-primary add-to-cart" id="add-to-cart" data-product-id="' + product.products_id + '" data-toggle="modal" data-target="#productModal"><i class="fa fa-shopping-cart"></i></button>';
        card += '</div>';
        card += '</div>';
        card += '</div>';
        card += '</div>';
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