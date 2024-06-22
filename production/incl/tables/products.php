<div class="card">

    <div class="card-body">
        <table id="inventory_table" class=" table table-stripped">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity in Stock</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        
        <!-- Button to trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProductModal">
                Add Products
            </button>

            <!-- Modal -->

            <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit product form -->
                <form id="editProductForm">
                    <input type="hidden" id="editProductId" name="editProductId">
                    <div class="form-group">
                        <label for="editProductName">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="editProductName">
                    </div>
                    <div class="form-group">
                        <label for="editQuantity">Quantity</label>
                        <input type="number" class="form-control" id="editQuantity" name="editQuantity">
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price</label>
                        <input type="number" step="0.01" class="form-control" id="editPrice" name="editPrice">
                    </div>
                    <div class="form-group">
                        <label for="editImage">Image</label>
                        <input type="file" class="form-control-file" id="editImage" name="editImage">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateProductBtn">Update Product</button>
            </div>
        </div>
    </div>
</div>


  <!-- Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add product form -->
                        <form id="addProductForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Category</label>
                                <select type="number" class="form-control" id="category" name="category">
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
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addProductBtn">Add Product</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

