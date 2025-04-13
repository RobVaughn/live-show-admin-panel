<?php
  if (isset($_SESSION['status'])) {
    $sidebar_menu_hidden = "";
    $sidebar_logged_in = "nav-hidden";
  } else {
    $sidebar_menu_hidden = "nav-hidden";
    $sidebar_logged_in = "";
  }
?>

<!-- Sidebar Menu -->
<aside class="main-sidebar bg-grey-dark">
  <div class="sidebar sticky-top">
    <nav class="mt-2">
      <ul class="nav nav-sidebar flex-column">
        <li class="nav-header nav-hide-on-mobile">MAIN</li>
        <div class="nav-group nav-hide-on-mobile">
          <li class="nav-item <?php echo $sidebar_logged_in; ?>">
            <a href="admin.php?func=login" class="nav-link">
              <p><i class="fa-solid fa-right-to-bracket"></i>Login</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../index.php" class="nav-link" target="_blank">
              <p><i class="fa-solid fa-house"></i>Main Site</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../live.php" class="nav-link" target="_blank">
              <p>
                <i class="fa-solid fa-eye"></i>Show Listings<br>
                <small class="text-muted">Opens New Page</small>                                       
              </p>
            </a>
          </li>
        </div>
 
        <li class="nav-header nav-hide-on-mobile">UPDATE</li>
        <div class="nav-group">
          <li class="nav-item <?php echo $sidebar_menu_hidden; ?>">
            <a href="admin.php?func=add" class="nav-link">
              <p><i class="fa-solid fa-plus"></i>Add Listing</p>
            </a>
          </li>
          <li class="nav-item <?php echo $sidebar_menu_hidden; ?>">
            <a href="admin.php?func=main" class="nav-link">
              <p><i class="fa-solid fa-table-columns"></i>Edit Listings</p>
            </a>
          </li>
          <li class="nav-item nav-hide-on-mobile <?php echo $sidebar_menu_hidden; ?>">
            <a href="admin.php?func=delete-all" class="nav-link">
              <p><i class="fa-solid fa-trash"></i>Delete Range</p>
            </a>
          </li>
        </div>
        
        <li class="nav-header nav-hide-on-mobile">IMPORT</li>
        <div class="nav-group nav-hide-on-mobile">
          <li class="nav-item nav-hide-on-mobile <?php echo $sidebar_menu_hidden; ?>">
            <a href="admin.php?func=import" class="nav-link">
              <p><i class="fa-solid fa-arrows-up-to-line"></i>Import Listings</p>
            </a>
          </li>
        </div>
        
        <li class="nav-header nav-hide-on-mobile">EXPORT</li>
        <div class="nav-group nav-hide-on-mobile">
          <li class="nav-item nav-hide-on-mobile <?php echo $sidebar_menu_hidden; ?>">
            <a href="admin.php?func=export" class="nav-link">
              <p><i class="fa-solid fa-arrows-down-to-line"></i>Export Listings</p>
            </a>
          </li>
        </div>

        <li class="nav-header nav-hide-on-mobile">ADMIN</li>
        <div class="nav-group">
          <li class="nav-item">
            <a href="admin.php?func=forgot-password" class="nav-link">
              <p><i class="fa-solid fa-question"></i>Forgot Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin.php?func=change-password" class="nav-link">
              <p><i class="fa-solid fa-unlock"></i>Change Password</p>
            </a>
          </li>
          <li class="nav-item <?php echo $sidebar_menu_hidden; ?>">
            <a href="actions/logout.php" class="nav-link">
              <p><i class="fa-solid fa-right-from-bracket"></i>Logout</p>
            </a>
          </li>
        </div>
      </ul>
    </nav>
  </div>
</aside>
