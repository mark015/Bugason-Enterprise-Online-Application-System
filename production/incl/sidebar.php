<?php
if($link == 'products'){
  $active = 'current-page';
}else{
  $active = '';
}
?>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li class="current-page"><a href="index"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      <li  class="current-page"><a href="index?link=products" class="current-page"><i class="fa fa-cubes"></i>Products</a></li>
      <li class="current-page"><a href="index?link=order" class="current-page"><i class="fa fa-shopping-cart"></i>Orders</a></li>
      <li class="current-page"><a href="index?link=category" class="current-page"><i class="fa fa-folder"></i>Category</a></li>
      <li class="current-page"><a href="index?link=users"><i class="fa fa-users"></i>Users</a></li>
    </ul>
  </div>
</div>