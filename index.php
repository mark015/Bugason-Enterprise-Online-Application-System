<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BEIS</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendors/swal/dist/sweetalert2.min.css">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login" style="background-color:#ffffff;">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="login">
              <h1>Login</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email" name="userName" id="userName" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="pass" id="pass" required="" />
              </div>
              <div>
                <button class="btn btn-secondary" type="submit" name="login">Log in</button>
                
              </div>
              <p id="loginMessage" class="mt-3"></p>
              <a href="production/register" class="">Create New Account</a>
              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <hp><i class="fa fa-file-code-o"></i> Developed By <strong>TechzQuad</strong></p>
                  <p>©2016 All Rights Reserved. We Are The Solution</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <script src="vendors/swal/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#login').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                var username = $('#userName').val();
                var password = $('#pass').val();
                $.ajax({
                    type: 'POST',
                    url: 'login.php', // Replace 'login.php' with the URL of your login endpoint
                    data: {username: username, password: password},
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        // Handle the response from the server
                          console.log(response)
                        if (response.status === 'success') {
                          if(response.role === 'admin'){
                            Swal.fire({
                            icon: 'success',
                            title: '',
                            text: 'You have successfully Login.',
                            showConfirmButton: false,
                            timer: 2000 // Close the alert after 2 seconds
                                }).then(function() {
                                    location.href = "production/index";
                                });
                          }else{
                            Swal.fire({
                            icon: 'success',
                            title: '',
                            text: 'You have successfully Login.',
                            showConfirmButton: false,
                            timer: 2000 // Close the alert after 2 seconds
                                }).then(function() {
                                    location.href = "production/user_index";
                                });

                          }
                            // Redirect to the dashboard or another page upon successful login
                             // Replace 'dashboard.php' with the desired destination
                             
                        } else {
                            $('#loginMessage').text('Invalid username or password.');
                        }
                    }
                });
            });
        });
    </script>
  </body>
</html>
