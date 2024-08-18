<nav class="navbar navbar-expand-lg">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand" href="#">
      <img src="images/off_logo.png" alt="Bugason Enterprise Logo" class="rounded-circle" height="30">
      Bugason Enterprise
    </a>
    <!-- Toggler Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar Items -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="user_index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shopping_cart">Shopping Carts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="profile">
            Profile
          </a>
        </li>
        <li class="nav-item position-relative">
          <!-- Envelope Icon -->
          <a class="nav-link p-0" id="updateNotif" href="order" style="position: relative;">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.803 2.882L15 11.535V5.383zM1 5.383v6.152l4.803-3.27L1 5.383zm5.197 3.427L1 12.617V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-.617l-5.197-3.807z"/>
              </svg>
              <span id="notification-badge" class="badge badge-danger position-absolute" style="top: -5px; right: -5px; font-size: 0.7rem; display: none;">
                  0
              </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
