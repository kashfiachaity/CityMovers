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
  redirect_to(url_for('show_labour_company.php'));
}
$id = $_GET['id'];
$labours = Labour::find_by_id($id);
if($labours == false) {
  redirect_to(url_for('show_labour_company.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['labour'];
  $labours->merge_attributes($args);
  $result = $labours->save();

  if($result === true) {
    $session->message('The admin was updated successfully.');
    redirect_to(url_for('show_labour_company.php'));
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
        if(!isset($labours)) {
        redirect_to(url_for('show_labour_company.php'));
        }
        ?>
      <div class="container-fluid">

      <form action="edit_labour.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-6">
                <label class="" for="inputGroupFile02">Name</label>
                    <input type="text" class="form-control" name="labour[company_name]" placeholder="Name of the Company" value="<?php echo $labours->company_name?>">
                </div>
                <div class="col-4">
                <label class="" for="inputGroupFile02">Labour Number</label>
                    <input type="text" class="form-control" name="labour[labour_number]" placeholder="Number of Labour" value="<?php echo $labours->labour_number?>">
                </div>
                </div>
            
            <div class="row g-3 mt-2">
                <div class="col-2 ">
                <label class="" for="inputGroupFile02">Labour wages</label>
                    <input type="text" class="form-control" name="labour[labour_wages]" placeholder="Per Person wages" value="<?php echo $labours->labour_wages?>">
                    
                </div>
                
            </div>
            <div class="row g-3 mt-2">
                <button class="btn btn-primary" type="submit">Update Labor Info</button>
            </div>
        </form>



      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>