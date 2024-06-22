<script>
        function category(){
                $.ajax({
                url: 'incl/ajaxData/categoryData.php',
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    var len = response.length;
                    for(var i=0; i<len; i++){
                        var category = response[i].category;
                        var categoryId = response[i].cat_id;
                        var updateBtn = "<button class='btn btn-primary update-btn' data-id='" + categoryId + "' data-name='" + category + "' data-toggle='modal' data-target='#updateModal'><i class='fa fa-pencil'></i></button>"; // Update button HTML
                        var deleteBtn = "<button class='btn btn-danger delete-btn' id='deleteCategory' data-id='" + categoryId + "'><i class='fa fa-trash'></i></button>"; // Delete button HTML
                        var row = "<tr>" +
                                    "<td>" + category + "</td>" +
                                    "<td>"+updateBtn + deleteBtn +"</td>" +
                                  "</tr>";

                        $("#categoryTable tbody").append(row);
                    }
                    $('#categoryTable').DataTable();
                }
            });
            }
            function addCategory(){
                $('#addCategoryForm').submit(function(e){
                e.preventDefault(); // Prevent default form submission
                
                var categoryNames = $('#categoryNames').val();
                
                // Perform AJAX call to add category
                $.ajax({
                    url: 'incl/ajaxData/add_category.php',
                    type: 'POST',
                    data: { categoryName: categoryNames },
                    success: function(response){
                        // Handle success, e.g., show success message or redirect to another page
                        Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Record has been added.',
                        showConfirmButton: false,
                        timer: 1500
                        }).then(function() {
                            $('#categoryNames').val('');
                            $("#categoryTable tbody").empty();
                            category()
                        });
                    }
                });
            });
            }
        $(document).ready(function(){
            addCategory()
            category()
        });

        $(document).on('click', '.update-btn', function(){
            var categoryId = $(this).data('id');
            var categoryName = $(this).data('name');

            $('#categoryName').val(categoryName);
            $('#updateCategoryBtn').data('id', categoryId);
        });

        // Function to handle update category button click
        $(document).on('click', '#updateCategoryBtn', function(){
            var categoryId = $(this).data('id');
            var categoryName = $('#categoryName').val();
            $.ajax({
                url: 'incl/ajaxData/update_category.php',
                type: 'POST',
                data: { id: categoryId, name: categoryName },
                success: function(response){
                    // Handle success, e.g., update table or show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Record has been updated.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        $("#categoryTable tbody").empty();
                        category()
                        $('#updateModal').modal('hide');
                    });
                    
                }
            });
        });

        $(document).on('click', '#deleteCategory', function(){
            var categoryId = $(this).data('id');

            Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms deletion, send AJAX request to delete.php
                $.ajax({
                    url: 'incl/ajaxData/deleteCategory.php',
                    type: 'POST',
                    data: {id: categoryId},
                    success: function(response) {
                        // Handle success response (if any)
                        // For example, you can display a success message or reload the page
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Record has been deleted.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $("#categoryTable tbody").empty();
                            category()
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error response (if any)
                        // For example, you can display an error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while deleting the record.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        });



            
        });
    </script>