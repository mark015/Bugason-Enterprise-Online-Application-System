
<?php
// Set the active class based on the current link
$activeLink = isset($_GET['link']) ? $_GET['link'] : '';

function isActive($link, $activeLink) {
  return $link == $activeLink ? 'current-page' : '';
}
?>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li class="<?= isActive('dashboard', $activeLink); ?>"><a href="index?link=dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      <li class="<?= isActive('products', $activeLink); ?>"><a href="index?link=products"><i class="fa fa-cubes"></i>Products</a></li>
      <li class="<?= isActive('order', $activeLink); ?>"><a href="index?link=order"><i class="fa fa-shopping-cart"></i>Orders</a></li>
      <li class="<?= isActive('category', $activeLink); ?>"><a href="index?link=category"><i class="fa fa-folder"></i>Category</a></li>
      <li class="<?= isActive('users', $activeLink); ?>"><a href="index?link=users"><i class="fa fa-users"></i>Users</a></li>
      <!-- <li class="<?= isActive('users', $activeLink); ?>"><a href="index?link=reports"><i class="fa fa-calendar"></i>Reports</a></li> -->
      <li class="<?= isActive('settings', $activeLink); ?>">
        <a><i class="fa fa-calendar"></i> Reports <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li class="<?= isActive('daily_reports', $activeLink); ?>"><a href="index?link=daily_reports">Daily</a></li>
          <li class="<?= isActive('monthly_reports', $activeLink); ?>"><a href="index?link=monthly_reports">Monthly</a></li>
          <li class="<?= isActive('anual_reports', $activeLink); ?>"><a href="index?link=anual_reports">Anual</a></li>
        </ul>
      </li>
      <!-- Dropdown menu item -->
      <!--  -->
    </ul>
  </div>
</div>