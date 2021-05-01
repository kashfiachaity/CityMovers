<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>
<?php require_login() ?>
<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Admin") {?>
    
        <!-- bradcam_area  -->
        <div class="bradcam_area bradcam_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="bradcam_text text-center">
                                <h3>Add Instruments</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ bradcam_area  -->

    <?php 
    
    if(is_post_request()) {

        
        $args['instruments'] = $_POST['instruments'];
        $args['fileUpload'] = $_FILES;
        $addingInstruments = new Instruments($args);
        $addingInstruments->uploadPhoto();
        $result = $addingInstruments->save();
        if($result == true){
            $session->message('Instrument Added successfully.');
            redirect_to(url_for('show_instruments.php'));
            }
    
    } else {
        // display the form
        $addingInstruments = new Instruments();
    }

    ?>
   
    <section class="blog_area section-padding">
        <div class="container card">
        <h3 class="text-center mt-2"><u>Moving Service Intstruments</u></h3>
        <?php echo display_errors($addingInstruments->errors); ?>
        <form action="add_instruments.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col">
                <label class="" for="inputGroupFile02">Instruments Name</label>
                    <input type="text" class="form-control" name = "instruments[instruments_name]" placeholder="Name of the Instruments" aria-label="First name">
                </div>
                <div class="col">
                <label class="" for="inputGroupFile02">Instruments Image</label>
                    <input class="form-control" name = "upimage" type="file" id="formFile" >
                </div>
            </div>
            
            <div class="row g-3 mt-2">
                
            <div class="col">
                <label class="" for="inputGroupFile02">Instruments Quantity</label>
                    <input type="text" class="form-control" name = "instruments[quantity]" placeholder="Name of the Instruments" aria-label="First name">
                </div>
                <div class="col">
                <label class="" for="inputGroupFile02">Instruments Price</label>
                    <input type="text" class="form-control" name = "instruments[instruments_price]" placeholder="Name of the Instruments" aria-label="First name">
                </div>
                
                
            </div>
            <div class="row g-3 m-2">
                <button class="btn btn-primary" type="submit">Submit Form</button>
            </div>
        </form>
        </div> 
    </section>
    <?php } ?>
    <!--================Blog Area =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>