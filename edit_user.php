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
  redirect_to(url_for('show_customers.php'));
}
$id = $_GET['id'];
$users = User::find_by_id($id);
if($users == false) {
  redirect_to(url_for('show_customers.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['user'];
  $users->merge_attributes($args);
  $result = $users->save();

  if($result === true) {
    $session->message('The admin was updated successfully.');
    redirect_to(url_for('show_customers.php?id=' . $id));
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
        if(!isset($users)) {
        redirect_to(url_for('show_customers.php'));
        }
        ?>
      <div class="container-fluid">
      <form action="edit_user.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-4">
                <label class="" for="inputGroupFile02">Name</label>
                    <input type="text" class="form-control" name = "user[name]" placeholder="John Doe" value="<?php echo $users->name ?>">
                </div>
                <div class="col-4">
                <label class="" for="inputGroupFile02">Phone Number</label>
                    <input type="text" class="form-control" name = "user[phone]" placeholder="+017..." value="<?php echo $users->phone ?>">
                </div>
                <div class="col-4">
                <label class="" for="inputGroupFile02" >Password</label>
                    <input type="password" class="form-control" name = "user[password]" placeholder="Provide Strong Password" aria-label="Last name">
                </div>
                
            </div>
            
            <div class="row g-3 mt-2">
                
                <div class="col-4">
                    <label class="" for="inputGroupFile02">Email Address</label>
                    <input class="form-control" name = "user[email]" type="text" placeholder="someone@domain.com" id="formFile" value="<?php echo $users->email ?>">
                    
                </div>
                
                
                
                
            </div>
            <div class="row g-3 m-2">
                <button class="btn btn-primary" type="submit">Update Info</button>
            </div>
        </form>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>