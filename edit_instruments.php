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

  // Save record using post parameters
  $args = $_POST['instruments'];
  $instruments->merge_attributes($args);
  $result = $instruments->save();

  if($result === true) {
    $session->message('The admin was updated successfully.');
    redirect_to(url_for('show_instruments.php'));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>
    <!-- Main content -->
    <section class="content">
    <?php
        if(!isset($instruments)) {
        redirect_to(url_for('show_instruments.php'));
        }
        ?>
        <h3>Update Instruments</h3>
      <div class="container-fluid">
        <form action="edit_instruments.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-4">
                    <label class="" for="inputGroupFile02">Instruments Name</label>
                        <input type="text" class="form-control" name = "instruments[instruments_name]" placeholder="Name of the Instruments" value="<?php echo $instruments->instruments_name ?>">
                    </div>
                    <div class="col-4">
                    <label class="" for="inputGroupFile02">Instruments Quantity</label>
                        <input type="text" class="form-control" name = "instruments[quantity]" placeholder="Name of the Instruments" value="<?php echo $instruments->quantity ?>">
                    </div>
                    <div class="col-4">
                    <label class="" for="inputGroupFile02">Instruments Price</label>
                        <input type="text" class="form-control" value="<?php echo $instruments->instruments_price ?>" name = "instruments[instruments_price]" placeholder="Name of the Instruments" >
                    </div>
                    
                </div>
                
                
                <div class="row g-3 m-2">
                    <button class="btn btn-primary" type="submit">Update Instruments</button>
                </div>
            </form>

      

      </div><!-- /.container-fluid -->
    </section>
    <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>