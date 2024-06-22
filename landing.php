<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Landing Page</div>
                    <div class="card-body">
                        <?php
                        // Start or resume session
                        session_start();

                        // Check if session is active
                        if (isset($_SESSION['user_id'])) {
                            echo '<p>Your session ID is: ' . $_SESSION['user_id'] . '</p>';
                        } else {
                            echo '<p>No active session found.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
