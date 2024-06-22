<?php  
include('incl/user_north.php');

include('incl/user_nav.php');?>
    <div class="container body">
        <div class="main_container">
            <div class="card">
                <div class="card-body">
                    <div class="container mt-5">
                        <h2>Profile</h2>
                        <div class="card text-center ">
                            <div id="profile">

                            </div>
                            
                        </div>

                        <!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add form fields here for updating user details -->
        <form id="updateForm">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
          </div>
          <div class="form-group">
            <label for="address">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact">
          </div>
          <div class="form-group">
            <label for="address">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="address">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          
          <div class="form-group" id="newPasswordDiv">
            
          </div>
          <div class="form-group" id="confirmedPasswordDiv">
            
          </div>
          <div class="form-group">
            <label for="address">Role</label>
            <input type="text" class="form-control" id="role" name="role" readonly>
           
          </div>
          <!-- Add more form fields as needed -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'incl/script.php';?>
<script>
$(document).ready(function() {
  $("#password").keyup(function() {
    var username = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        url: 'users/password_checker.php', // PHP script that checks the password in the database
        method: 'POST',
        data: { userId: <?php echo $_SESSION['user_id'];?>, password: password },
        dataType: 'json',
        success: function(response) {
            if (response.correct) {
                var newPasswordLabel = '<label for="newPassword">New Password</label>';
                var newPassword = '<input type="password" class="form-control" id="newPassword" name="newPassword">';
                var confirmedPasswordLabel = '<label for="newPassword">Re-type New Password</label>';
                var confirmedPassword = '<input type="password" class="form-control" id="conPassword" name="conPassword">'
                $('#newPasswordDiv').html(newPasswordLabel + newPassword);
                $('#confirmedPasswordDiv').html(confirmedPasswordLabel + confirmedPassword);
                
            } else {
                $('#passwordStatus').text('Password is incorrect.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request error:', error);
        }
    });
});


$('#saveChangesBtn').click(function() {
            
            var name = $('#name').val();
            var address = $('#address').val();
            var contact = $('#contact').val();
            var username = $('#username').val();
            var password = $('#newPassword').val();
            var repassword = $('#conPassword').val();
            
            if (password !== repassword) {
              // If registration failed, show error message
            toastr.error('update failed. Please try again.', 'Passwords do not match');
                    return;
                }else{
                  $.ajax({
                type: 'POST',
                url: 'users/updateUser.php',
                data: {username: username, password: password, name: name, address: address, contact:contact},
                success: function(response) {
                    // Check if registration was successful
                    if(response.trim() == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful',
                            text: 'You have successfully updated.',
                            showConfirmButton: false,
                            timer: 2000 // Close the alert after 2 seconds
                        }).then(function() {
                    location.reload();
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


    $.ajax({
        url: 'users/fetch_user.php',
        method: 'GET',
        data: { userId: <?php echo $_SESSION['user_id'];?> },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                // Handle error (user not found)
                $('#userDetails').html('<p>' + response.error + '</p>');
            } else {
                // Display user details
                var userDetailsHtml = '<p>Name: ' + response.name + '</p>';
                userDetailsHtml += '<p>Address: ' + response.address + '</p>';
                userDetailsHtml += '<p>Contact: ' + response.contact + '</p>';
                userDetailsHtml += '<p>Username: ' + response.username + '</p>';
                userDetailsHtml += '<p>Role: ' + response.role + '</p>'
                userDetailsHtml += '<button class="btn btn-primary mt-3" data-toggle="modal" data-target="#updateModal">Update</button>';
                $('#profile').html(userDetailsHtml);
                $('#name').val(response.name);
                $('#address').val(response.address);
                $('#contact').val(response.contact);
                $('#username').val(response.username);
                $('#role').val(response.role);
              
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request error:', error);
        }
    });
});
</script>
  </body>
</html>  