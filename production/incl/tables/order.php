<h1>
    Orders
</h1>

<div class="card">
    <div class="row p-3">
        <div class="col-md-6">
            <select class="form form-control" id="orderStatus">
                <option value="">Select Status</option>
                <option value="All">Select All</option>
                <option value="Pending">Pending</option>
                <option value="Preparing Order">Preparing Order</option>
                <option value="On Delivery">On Delivery</option>
                <option value="Products Receive">Products Receive</option>
                <option value="Cancel Order">Cancel Order</option>
            </select>
        </div>
        <div class="col-md-6">
            <select class="form form-control" id="type">
                <option value="">Select Type</option>
                <option value="All">Select All</option>
                <option value="admin">Walkin</option>
                <option value="user">Online Order</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <table id="inventory_table" class=" table table-stripped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Total Price</th>
                    <th>Date of Order</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

</div>

