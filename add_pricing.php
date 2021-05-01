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
    
    if(is_post_request()) {

        
        $args = $_POST['pricing'];
        $addingPrices = new Pricing($args);
        $result = $addingPrices->save();
    
    } else {
        // display the form
        $addingPrices = new Pricing;
    }

    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="col-8"><?php echo display_errors($addingPrices->errors); ?></div>
      
      <form action="add_pricing.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-4">
                <label class="" for="inputGroupFile02">Distance Price</label>
                    <input type="text" class="form-control" name="pricing[distancePrice]" placeholder="Distance Price in Taka" value="">
                </div>
                <div class="col-4">
                <label class="" for="inputGroupFile02">Room Price</label>
                    <input type="text" class="form-control" name="pricing[roomPrice]" placeholder="Room Price in Taka" value="">
                </div>
            </div>
            
            <div class="row g-3 mt-2">
                <div class="col-4">
                <label class="" for="inputGroupFile02">Office Area Price</label>
                    <input type="text" class="form-control" name="pricing[officeAreaPrice]" placeholder="Office Area Price in Taka" value="">
                    
                </div>
                <div class="col-4">
                <label class="" for="inputGroupFile02">Floor Price</label>
                    <input type="text" class="form-control" name="pricing[floorPrice]" placeholder="Floor Price in Taka" value="">
                </div>
                
            </div>
            <div class="row g-3 m-2">
                <button class="btn btn-primary" type="submit">Submit Form</button>
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