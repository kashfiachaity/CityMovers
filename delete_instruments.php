<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login() ?>
<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Admin") {?>

<?php
if(!isset($_GET['id'])) {
  redirect_to(url_for('show_instruments.php'));
}
$id = $_GET['id'];
$instruments = Instruments::find_by_id($id);
if($instruments == false) {
  redirect_to(url_for('show_instruments.php'));
}

if(is_post_request()) {

    $result =  $instruments->delete();
    $session->message('The admin was updated successfully.');
    redirect_to(url_for('show_instruments.php'));
  

} else {

  // display the form

}

?>

<!-- Main content -->
<section class="content">
      <div class="container-fluid">

      <form action="delete_instruments.php?id=<?php echo $id?>" method="post" name = "formDelete" enctype="multipart/form-data">
        </form>

    <script>
    window.onload = function(){
        alert("Are you want to delete this  item?"); 
        document.forms['formDelete'].submit();
        
    }
    </script>

      </div><!-- /.container-fluid -->
    </section>
    <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>