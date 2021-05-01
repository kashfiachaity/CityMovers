<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login() ?>

<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Electrician") {       ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <h3>Electrician Dashboard</h3>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>