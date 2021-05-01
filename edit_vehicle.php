<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login() ?>
<?php
if(!isset($_GET['id'])) {
  redirect_to(url_for('show_vehicle_company.php'));
}
$id = $_GET['id'];
$vehicles = Vehicle::find_by_id($id);
if($vehicles == false) {
  redirect_to(url_for('show_vehicle_company.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['vehicle'];
  $args['fileUpload'] = $_FILES;
  $vehicles->merge_attributes($args);
  $vehicles->uploadPhoto();
  $result = $vehicles->save();
    
  if($result === true) {
    $session->message('The admin was updated successfully.');
    redirect_to(url_for('show_vehicle_company.php'));
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
        if(!isset($vehicles)) {
        redirect_to(url_for('show_vehicle_company.php'));
        }
        ?>
      <div class="container-fluid">

      <form action="edit_vehicle.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col">
                <label class="" for="inputGroupFile02">Name</label>
                    <input type="text" class="form-control" name = "vehicle[name]" placeholder="Name of the Driver" value="<?php echo $vehicles->name ?>">
                </div>
                <div class="col">
                <label class="" for="inputGroupFile02">Year</label>
                    <input type="text" class="form-control" name = "vehicle[experience_year]" placeholder="Year of Experience" value="<?php echo $vehicles->experience_year ?>">
                </div>
                </div>
            
            <div class="row g-3 mt-2">
                
                
                <div class="col-4" style="margin-top: 35px;">
                    <label for="inputState" class="form-label">Select Vehicle</label>
                    <select id="inputState" name = "vehicle[vehicle_type]" class="form-select">
                    <option selected>Type of Vehicle</option>
                    <?php foreach(Vehicle::VehicleType as $type) { ?>
                    <option value="<?php echo $type; ?>" <?php if($vehicles->vehicle_type == $type) { echo 'selected'; } ?>><?php echo $type; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="col-2">
                <label class="" for="inputGroupFile02">Trip Price</label>
                    <input type="text" class="form-control" name = "vehicle[price]" placeholder="Price for Each Trip $" value="<?php echo $vehicles->price ?>">
                    
                </div>
                
                
            </div>
            <div class="row g-3 mt-2">
                <button class="btn btn-primary" type="submit">Button</button>
            </div>
        </form>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>