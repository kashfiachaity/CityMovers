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
  redirect_to(url_for('price_of_booking.php'));
}
$id = $_GET['id'];
$pricings = Pricing::find_by_id($id);
if($pricings == false) {
  redirect_to(url_for('price_of_booking.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['pricing'];
  $pricings->merge_attributes($args);
  $result = $pricings->save();

  if($result === true) {
    $session->message('The admin was updated successfully.');
    redirect_to(url_for('price_of_booking.php'));
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
        if(!isset($pricings)) {
        redirect_to(url_for('price_of_booking.php'));
        }
        ?>
      <div class="container-fluid">
      <form action="edit_pricing.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-4">
                <label class="" for="inputGroupFile02">Distance Price</label>
                    <input type="text" class="form-control" name="pricing[distancePrice]" placeholder="Distance Price in Taka" value="<?php echo $pricings->distancePrice?>">
                </div>
                <div class="col-4">
                <label class="" for="inputGroupFile02">Room Price</label>
                    <input type="text" class="form-control" name="pricing[roomPrice]" placeholder="Room Price in Taka" value="<?php echo $pricings->roomPrice?>">
                </div>
            </div>
            
            <div class="row g-3 mt-2">
                <div class="col-4">
                <label class="" for="inputGroupFile02">Office Area Price</label>
                    <input type="text" class="form-control" name="pricing[officeAreaPrice]" placeholder="Office Area Price in Taka" value="<?php echo $pricings->officeAreaPrice?>">
                    
                </div>
                <div class="col-4">
                <label class="" for="inputGroupFile02">Floor Price</label>
                    <input type="text" class="form-control" name="pricing[floorPrice]" placeholder="Floor Price in Taka" value="<?php echo $pricings->floorPrice?>">
                </div>
                
            </div>
            <div class="row g-3 mt-2">
                <button class="btn btn-primary" type="submit">Update Pricing</button>
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