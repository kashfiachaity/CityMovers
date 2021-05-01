<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>

<?php 
    $errors = [];
    $phone = '';
    $password = '';
    if(is_post_request()){
        $phone = $_POST['phone'] ?? '';;
        $password = $_POST['password'] ?? '';;

        if(is_blank($phone)) {
            $errors[] = "phone cannot be blank.";
          }
          if(is_blank($password)) {
            $errors[] = "Password cannot be blank.";
          }

          if(empty($errors)){
            $user = User::find_by_phone($phone);

            // test if user found and password is correct
            if($user != false && $user->verify_password($password)) {
              // Mark user as logged in
              $session->login($user);
              $session->message('Logged In successfully.');
              redirect_to(url_for('index.php'));
            } else {
              // username not found or password does not match
             $errors[] = "Your Phone or Password is Incorrect!";
            }
          }
        
          

}

?>


<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="bradcam_text text-center">
                                <h3>Log In Form</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--/ bradcam_area  -->

<section class="blog_area section-padding">
        <div class="container"> 
        <?php echo display_session_message(); ?>
            <div class = "row">
                <div class="col-2 "></div>
                    <div class="col-8 card">
                        <div class="row g-3">
                            <div class="col-3"></div>
                                <div class="col-6 mt-4">
                                <div class="text-center"><h3>Log In Form</h3></div>
                                <?php echo display_errors($errors); ?>
                                <form action="loginForm.php" method="post">
                                    <label class="" for="inputGroupFile02">Phone Number</label>
                                    <input type="text" class="form-control" name = "phone" placeholder="+017..." value="">
                                </div>  
                        
                            <div class="col-3"></div>
                        </div>  
                        <div class="row g-3">
                            <div class="col-3"></div>
                                <div class="col-6 mt-4">
                                    <label class="" for="inputGroupFile02">Password</label>
                                    <input type="password" class="form-control" name = "password" placeholder="" value="">
                                    <div class="text-center mt-4"><button class="btn btn-primary" type="submit">Log In</button></div>
                                    <div class="text-center mt-4 mb-4">Not Registered? <a href="user_reg.php?type=customer">Create an account </a></div>
                                    <div class="text-center mt-4 mb-4"> <a href="user_reg.php">Register As Service Provider </a></div>
                                </div>  
                            </form>
                            <div class="col-3"></div>
                        </div> 
                    </div> 
                </div> 
            </div> 
                
            
        </div>
</section>
    <!--================Blog Area =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>