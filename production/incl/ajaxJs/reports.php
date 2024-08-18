
<script>
    
 $(document).ready(function() {
    // Initialize the DataTable
    var table = $('#reportTable').DataTable();

    function fetchAndUpdateTable() {
        var selectedDate = $('#dateInput').val(); // Adjust based on input type
        var selectedStatus = $('#orderStatus').val(); // Get the selected order status

        $.ajax({
            url: 'incl/ajaxData/reports.php', // Adjust this path if necessary
            type: 'POST',
            dataType: 'json', // Expecting JSON response
            data: { 
                date: selectedDate,
                status: selectedStatus,
                reportType: '<?php echo $_GET['link']; ?>' // Pass the report type
            },
            success: function(response) {
                // Clear the existing data in the DataTable
                table.clear().draw();

                // Add the new data to the DataTable
                table.rows.add(response.data).draw();
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: ", status, error);
            }
        });
    }

    // Trigger AJAX request when the input changes
    $('#dateInput').on('change', function() {
        fetchAndUpdateTable();
    });

    // Trigger AJAX request when the order status changes
    $('#orderStatus').on('change', function() {
        fetchAndUpdateTable();
    });
});

</script>