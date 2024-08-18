<h1>
    <?php 
        if($link == 'daily_reports'){
            echo "Daily Reports";
        }else if($link == 'monthly_reports'){
            echo "Monthly Reports";
        }else if($links == 'anual_reports'){
            echo "Unual Reports";
        }
    ?>

</h1>

<div class="card shadow-sm">
    <!-- Navbar with Date Input -->
    <div class="row p-3">
        <div class="col-md-4">
            <?php
             if($_GET['link'] === 'daily_reports'){?>
                <input type="date" class="form form-control" id="dateInput">
            <?php
                }else if($_GET['link'] === 'monthly_reports'){
            ?>
                <input type="month" class="form form-control" id="dateInput">
            <?php
                }else{
            ?>
             <select class="form form-control" id="dateInput">
                <option value="">Select Year</option>
                <?php 
                    $currentYear = date("Y");
                    for ($year = $currentYear; $year >= 1900; $year--) { 
                        echo "<option value='$year'>$year</option>";
                    }
                    ?>
                    </select>
                <?php

             }
            ?>
            
        </div>
        <div class="col-md-4">
            <select class="form form-control" id="orderStatus">
                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Preparing Order">Preparing Order</option>
                <option value="On Delivery">On Delivery</option>
                <option value="Products Receive">Products Receive</option>
                <option value="Cancel Order">Cancel Order</option>
            </select>
        </div>
    </div>
    <!-- Card Body with Table -->
    <div class="card-body">
    <table id="reportTable" class="table table-stripped">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Order Status</th>
                    <th>Customer Status</th>
                    <th>Order Date</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be dynamically populated here -->
            </tbody>
        </table>
    </div>
</div>
