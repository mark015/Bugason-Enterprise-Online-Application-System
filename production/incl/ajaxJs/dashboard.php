<!-- 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script type="text/javascript">

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(fetchOrderData);

function fetchOrderData() {
    $.ajax({
        url: 'incl/ajaxData/pieChart.php', // PHP script to fetch order data
        type: 'GET',
        dataType: 'json', // Expect JSON data
        success: function(data) {
            drawChart(data); // Render the bar chart with fetched data
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', xhr.responseText); // Log error message if AJAX fails
        }
    });
}

function drawChart(data) {
    var dataArray = [['Category', 'Value']];
    // Assuming your data is in the format: [{category: 'Category 1', value: 10}, ...]
    data.forEach(function(item) {
        dataArray.push([item.category, item.value]);
    });

    var chartData = google.visualization.arrayToDataTable(dataArray);

    var options = {
        title: 'Order Counts by Order Status',
        chartArea: {width: '50%'},
        hAxis: {
            title: 'Value',
            minValue: 0
        },
        vAxis: {
            title: 'Order Status'
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('barchart'));
    chart.draw(chartData, options);
}



    $(document).ready(function() {
    // Function to fetch user count using AJAX
    function fetchUserCount() {
        $.ajax({
            url: 'incl/ajaxData/dashboard.php', // Your PHP script to fetch user count
            type: 'GET',
            dataType: 'json', // Expect JSON data
            success: function(response) {
                $('#userCount').text(response.user_count); // Update user count on success
                $('#product_count').text(response.product_count); // Update user count on success
                $('#orderCount').text(response.order_count); // Update user count on success
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log error message if AJAX fails
            }
        });
    }
    // Function to fetch order data using AJAX
    function fetchOrderData() {
        $.ajax({
            url: 'incl/ajaxData/pieChart.php', // PHP script to fetch order data
            type: 'GET',
            dataType: 'json', // Expect JSON data
            success: function(data) {
                
                // drawChart(data) // Render the pie chart with fetched data
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log error message if AJAX fails
            }
        });
    }

    function renderPieChart(data) {
        // Extract labels and values from data
        var labels = data.map(function(item) { return item.label; });
        var values = data.map(function(item) { return item.value; });

        // Render the pie chart
        var ctx = document.getElementById('piecountChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Set to true if you want the chart to be responsive
                title: {
                    display: true,
                    text: 'Order Status Distribution'
                }
            }
        });
    }


    function fetcChartData() {
        $.ajax({
            url: 'incl/ajaxData/barChart.php', // PHP script to fetch order data
            type: 'GET',
            dataType: 'json', // Expect JSON data
            success: function(data) {
                renderChart(data); // Render the chart with fetched data
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log error message if AJAX fails
            }
        });
    }
    function renderChart(data) {
        // Extract month names and order amounts from data
        var months = data.map(function(item) { return item.order_month; });
        var orderAmounts = data.map(function(item) { return item.order_amount; });

        // Render the chart
        var ctx = document.getElementById('barGraphMonth').getContext('2d');
        var orderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Order Amount',
                    data: orderAmounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Set to true if you want the chart to be responsive
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Order Amounts by Month'
                }
            }
        });
    }

    fetcChartData()
    // Call fetchOrderData function on page load
    fetchOrderData();


    // Call fetchUserCount function on page load
    fetchUserCount();
});
</script>