<script>
function checkQuantity(productId){
    $.ajax({
        url: 'users/check_quantity.php', // PHP file that handles database insertion
        type: 'POST',
        dataType: 'json',
        data: {productId: productId},
        success: function(response){
            // Handle success response

            
            if(parseInt(response.quantity) >= parseInt(productQuantity)){
              // console.log(response.quantity +'<'+ productQuantity)

              insertTocart()
            }else{
              toastr.error('Not enough stocks!', 'Error');
            }
        },
        error: function(xhr, status, error){
            // Handle error response
            console.error('Error inserting data:', xhr.responseText);
        }
    });
  }
</script>
