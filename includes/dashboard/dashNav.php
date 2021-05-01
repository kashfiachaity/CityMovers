<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
     
    </ul>


<!-- Right navbar links -->
      <?php if($session->is_logged_in()) {
        $uid = $session->user_id;
        $user = User::find_by_id($uid);
        
      ?>
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i> <span><?php echo $user->name ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        
                                            
          <div class="dropdown-divider"></div>
          <a href="show_customers.php?id=<?php echo $user->id?>" class="dropdown-item">
            <i class="fas fa-info mr-2"></i> User Info
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> Log Out
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
    </ul>
    <?php } ?>
    
  </nav>
  <!-- /.navbar -->