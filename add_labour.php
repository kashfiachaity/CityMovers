<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>
    
        <!-- bradcam_area  -->
        <div class="bradcam_area bradcam_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="bradcam_text text-center">
                                <h3>Labour Registration</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ bradcam_area  -->

    <?php 
    require_once('includes/initialize.php');

    if(is_post_request()) {

        
        $args = $_POST['labour'];
        $addingLabour = new Labour($args);
        $result = $addingLabour->save();
        if($result == true){
            $session->message('Labour Company Registered successfully.');
            redirect_to(url_for('loginForm.php'));
            }
    
    } else {
        // display the form
        $addingLabour = new Labour();
    }

    ?>
    <!--================Service Provider Registation =================-->
    <section class="blog_area section-padding">
        <div class="container card">
        <?php echo display_session_message(); ?>
        <h3 class="text-center mt-2"><u>Service Provider Registation</u></h3>
        <?php 
        if(isset($_GET['id'])){
        $userID = $_GET['id'];
        }
        ?>
        <?php echo display_errors($addingLabour->errors); ?>
        
        <form action="add_labour.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-6">
                <label class="" for="inputGroupFile02">Name</label>
                    <input type="text" class="form-control" name="labour[company_name]" placeholder="Name of the Company" aria-label="First name">
                </div>
                <div class="col-4">
                <label class="" for="inputGroupFile02">Labour Number</label>
                    <input type="text" class="form-control" name="labour[labour_number]" placeholder="Number of Labour" aria-label="Last name">
                </div>
                </div>
            
            <div class="row g-3 mt-2">
                <div class="col-2 ">
                <label class="" for="inputGroupFile02">Labour wages</label>
                    <input type="text" class="form-control" name="labour[labour_wages]" placeholder="Per Person wages" aria-label="Last name">
                    <input type="hidden" name="labour[user_id]"  value="<?php echo $userID ?>"/>
                </div>
                
            </div>
            <div class="row g-3 m-2">
                <button class="btn btn-primary" type="submit">Submit Form</button>
            </div>
        </form>
    </section>
    <!--================Service Provider Registation =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>