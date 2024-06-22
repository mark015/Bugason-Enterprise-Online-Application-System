
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Toboso QR Attendance</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendors/swal/dist/sweetalert2.min.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  </head>

  <body class="login" style="background-color:#ffffff;">
    <div>
    <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="registerForm">
              <h1>Register</h1>
              <div>
                <input type="text" id="name" name="name" class="form-control" placeholder="name" required="" />
              </div>
              <div>
                <input type="text" id="address" name="address" class="form-control" placeholder="address" required="" />
              </div>
              <div>
                <input type="text" id="contact" name="contact" class="form-control" placeholder="contact" required="" />
              </div>
              <div>
                <input type="text" id="username" name="password" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-type Password" required="" />
              </div>
              <span id="password-message"></span>
              <div>
                <button class="btn btn-secondary" type="submit" value="Register">Register</button>
              </div>
                <a href="../index">login</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#registerForm').submit(function(event) {
            event.preventDefault();
            
            var name = $('#name').val();
            var address = $('#address').val();
            var contact = $('#contact').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var repassword = $('#repassword').val();
            if (password !== repassword) {
              // If registration failed, show error message
            toastr.error('Registration failed. Please try again.', 'Passwords do not match');
                    return;
                }else{
                  $.ajax({
                type: 'POST',
                url: 'users/register_process.php',
                data: {username: username, password: password, name: name, address: address, contact:contact},
                success: function(response) {
                    // Check if registration was successful
                    if(response.trim() == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful',
                            text: 'You have successfully registered.',
                            showConfirmButton: false,
                            timer: 2000 // Close the alert after 2 seconds
                        }).then(function() {
                            location.href = "../index";
                        });
                    } else {
                        // If registration failed, show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: response // Assuming response contains error message
                        });
                    }
                }
            });
                }

            
        });
    });


</script>

    <script src="../vendors/swal/dist/sweetalert2.min.js"></script>
  </body>
</html>
