<script>
    $(document).ready(function(){
    function updateNotificationCount(){
        $.ajax({
            url: 'users/get_notification_count.php', // Path to your PHP script
            type: 'GET',
            data: {user_id: <?php echo $_SESSION['user_id'];?>},
            dataType: 'json',
            success: function(response){
                if(response.count > 0){
                    $('#notification-badge').text(response.count).show();
                } else {
                    $('#notification-badge').hide(); // Hide the badge if there are no notifications
                }
            },
            error: function(xhr, status, error){
                console.error('Error fetching notification count:', xhr.responseText);
            }
        });
    }

    // Initial call to update the badge when the page loads
    updateNotificationCount();

    // Set an interval to check for new notifications every 30 seconds
    setInterval(updateNotificationCount, 30000); // 30000 ms = 30 seconds

    $(document).on('click', '#updateNotif', function(){
        $.ajax({
            url: 'users/update_notification.php', // Path to your PHP script
            type: 'GET',
            data: {user_id: <?php echo $_SESSION['user_id'];?>},
            dataType: 'json',
            success: function(response){
              
            },
            error: function(xhr, status, error){
                console.error('Error fetching notification count:', xhr.responseText);
            }
        });
    })
});

</script>

</body>
</html> 