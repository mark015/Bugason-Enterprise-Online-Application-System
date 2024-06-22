<div class="card">
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <table id="categoryTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data for first table will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                 <h2>Add Category</h2>
        <form id="addCategoryForm">
            <div class="form-group">
                <label for="categoryName">Category Name:</label>
                <input type="text" class="form-control" id="categoryNames" name="categoryName" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
            </div>
        </div>
    </div>
</div>

    <!-- Update Category Modal -->
    <div class="modal fade" id="updateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName">Category Name:</label>
                        <input type="text" class="form-control" id="categoryName">
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updateCategoryBtn">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
