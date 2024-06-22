<script>
        $(document).ready(function(){
            $.ajax({
                url: 'incl/ajaxData/get_users.php',
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    var len = response.length;
                    for(var i=0; i<len; i++){
                        var user_id = response[i].user_id;
                        var name = response[i].name;
                        var address = response[i].address;
                        var contact = response[i].contact;
                        var username = response[i].username;
                        var role = response[i].role;

                        var row = "<tr>" +
                                    "<td>" + name + "</td>" +
                                    "<td>" + address + "</td>" +
                                    "<td>" + contact + "</td>" +
                                    "<td>" + username + "</td>" +
                                    "<td>" + role + "</td>" +
                                  "</tr>";

                        $("#userTable tbody").append(row);
                    }
                    $('#userTable').DataTable();
                }
            });
        });
    </script>