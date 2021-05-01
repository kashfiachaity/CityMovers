<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="img/logo1.png" alt="CityMovers Logo" class="ml-4"
           >
      <span class="brand-text font-weight-light"></span>
    </a>

<!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Admin") {       ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="adminDashboard.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Registered Companies
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="show_vehicle_company.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vehicle Company</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show_labour_company.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Labour Company</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show_ac_company.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>AC Company</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show_electrician_company.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Electrician Company</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="show_instruments.php" class="nav-link">
              <i class="nav-icon fas fa-luggage-cart"></i>
              <p>
                Instruments
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="add_instruments.php" class="nav-link">
              <i class="nav-icon fas fa-luggage-cart"></i>
              <p>
                ADD Instruments
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="show_customers.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
              </p>
            </a>
            
          </li>
          <?php if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] === "Customer") || ($_SESSION['user_role'] === "Admin")){?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="show_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Hirings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="completed_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Hirings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="instruments_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Instruments Hirings</p>
                </a>
              </li>
              
              
            </ul>
          </li>
          <?php } ?>
          <li class="nav-item has-treeview">
            <a href="price_of_booking.php" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Pricing of the Booking
                
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="add_pricing.php" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
               Add Pricing
                
              </p>
            </a>
          </li>
          
       
        </ul>
        <?php } ?>
        <!-- Vehicle Company Dashboard -->
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Vehicle") {       ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="vehicleDashboard.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vehicle_new_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Hirings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="vehicle_completed_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Hirings</p>
                </a>
              </li>
            </ul>
            <li class="nav-item">
                <a href="show_vehicle_company.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company Information</p>
                </a>
              </li>
          </li>
        </ul>
          <?php } ?>
        <!-- Labour Company Dashboard -->
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Labour") {       ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="labourDashboard.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="labours_new_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Hirings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="labours_completed_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Hirings</p>
                </a>
              </li>
            </ul>
            <li class="nav-item">
                <a href="show_labour_company.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company Information</p>
                </a>
              </li>
          </li>
        </ul>
          <?php } ?>
        <!-- Air Condition Company Dashboard -->
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "AC") {       ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="acDashboard.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ac_new_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Hirings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ac_completed_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Hirings</p>
                </a>
              </li>
              
            </ul>
            <li class="nav-item">
                <a href="show_ac_company.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company Information</p>
                </a>
              </li>
          </li>
        </ul>
        <?php } ?>
        <!-- Customer -->
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Customer") {       ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="userDashboard.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="show_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Hirings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="completed_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Hirings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="instruments_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Instruments Orders</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <?php } ?>
        <!-- Electrician Company Dashboard -->
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Electrician") {       ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="electricianDashboard.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="electrician_new_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Hirings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="electrician_completed_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Hirings</p>
                </a>
              </li>
            </ul>
            <li class="nav-item">
                <a href="show_electrician_company.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company Information</p>
                </a>
              </li>
          </li>
        </ul>
        <?php } ?>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
