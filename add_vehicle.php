<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>
<?php echo display_session_message(); ?>


    
        <!-- bradcam_area  -->
        <div class="bradcam_area bradcam_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="bradcam_text text-center">
                                <h3>Vehicle Registration</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ bradcam_area  -->

    <?php 
        if(is_post_request()) {

            
            $args['vehicle'] = $_POST['vehicle'];
            $args['fileUpload'] = $_FILES;
            $addingVehicle = new Vehicle($args);
            $addingVehicle->uploadPhoto();
            $result = $addingVehicle->save();
            if($result == true){
            $session->message('Vehicle Registered successfully.');
            redirect_to(url_for('loginForm.php'));
            }
        
        } else {
            // display the form
            $addingVehicle = new Vehicle;
        }
    ?>
   
    <section class="blog_area section-padding">
        <div class="container card">
        <h3 class="text-center mt-2"><u>Service Provider Registation</u></h3>
        <?php 
        if(isset($_GET['id'])){
        $userID = $_GET['id'];
        }
        ?>
        <?php echo display_errors($addingVehicle->errors); ?>
        <form action="add_vehicle.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col">
                <label class="" for="inputGroupFile02">Name</label>
                    <input type="text" class="form-control" name = "vehicle[name]" placeholder="Name of the Driver" aria-label="First name">
                </div>
                <div class="col">
                <label class="" for="inputGroupFile02">Year</label>
                    <input type="text" class="form-control" name = "vehicle[experience_year]" placeholder="Year of Experience" aria-label="Last name">
                </div>
                </div>
            
            <div class="row g-3 mt-2">
                
                <div class="col-6">
                    <label class="" for="inputGroupFile02">Upload Image of the Vehicle</label>
                    <input class="form-control" name = "uploadImage" type="file" id="formFile" >
                    
                </div>
                <div class="col-4">
                    <label for="inputState" class="form-label">Select Vehicle</label>
                    <select id="inputState" name = "vehicle[vehicle_type]" class="form-select">
                    <option value="0">Type of Vehicle</option>
                    <option value="Truck">Truck</option>
                    <option value="Pick Up">Pick Up</option>
                    <option value="Van">Van </option>
                    </select>
                </div>
                <div class="col-2">
                <label class="" for="inputGroupFile02">Trip Price</label>
                    <input type="text" class="form-control" name = "vehicle[price]" placeholder="Price" >
                    <input type="hidden" name="vehicle[user_id]"  value="<?php echo $userID?>"/>
                    <input type="hidden" name="vehicle[isApproved]"  value="0"/>
                </div>
                
                
            </div>
            <div class="row g-3 m-2">
                <button class="btn btn-primary" type="submit">Submit From</button>
            </div>
        </form>
    
        </div> 
    </section>
    <!--================Blog Area =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>