<?php include 'incl/north.php';?>
        <!-- page content -->
  <div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row col-md-12 col-sm-12" style="display: inline-block;" >

      <?php 
        if($link == 'products'){
          include 'incl/tables/products.php';
        }else if($link === 'order'){
          if(!empty($_GET['viewOrder'])){
            include 'incl/tables/viewOrder.php';  
          }else{
            include 'incl/tables/order.php';
          }
        }else if($link === 'users'){
          include 'incl/tables/users.php';  
        }else if($link === 'category'){
          include 'incl/tables/category.php';  
        }else{
          include 'incl/dashboard/dashboard.php';
        }
      ?>
  </div>
    <!-- /top tiles -->
    
      </div>
<?php include 'incl/south.php';?>
<?php 
        if($link == 'products'){
          include 'incl/ajaxJs/products.php'; 
        }else if($link === 'order'){
          if(!empty($_GET['viewOrder'])){
            include 'incl/ajaxJs/viewOrder.php';
            // include 'incl/tables/viewOrder.php';
          }else{
            include 'incl/ajaxJs/order.php';
          }
          
        }else if($link === 'users'){
          include 'incl/ajaxJs/user.php';  
        }else if($link === 'category'){
          include 'incl/ajaxJs/category.php';  
        }else{
          include 'incl/ajaxJs/dashboard.php';
        }
      ?>