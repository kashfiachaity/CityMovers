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
                                <h3>User Registration</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ bradcam_area  -->
<?php 

if(is_post_request()) {

    
    $args = $_POST['user'];
    $user = new User($args);
    $result = $user->save();
  
    if($result === true) {
        $regID = $user->id;
        if($user->userRole === "Customer"){
            $session->message('Customer Registered successfully.');
            redirect_to(url_for('loginForm.php'));
        }else if($user->userRole === "Vehicle"){
            $session->message('Customer Registered successfully.');
            redirect_to(url_for('add_vehicle.php?id=' . $regID));
        }else if($user->userRole === "Labour"){
            $session->message('Customer Registered successfully.');
            redirect_to(url_for('add_labour.php?id=' . $regID));
        }else if($user->userRole === "AC"){
            $session->message('Customer Registered successfully.');
          redirect_to(url_for('add_ac.php?id=' . $regID));
        }else if($user->userRole === "Electrician"){
            $session->message('Customer Registered successfully.');
          redirect_to(url_for('add_electrician.php?id=' . $regID));
        }else {

        }
      
    } else {
      // show errors
    }
  
  } else {
    // display the form
    $user = new User();
  }

?>

   
    <section class="blog_area section-padding">
        <div class="container card">
            <?php 
            $type='';
            if(isset($_GET['type'])){
                $type = $_GET['type'];
            } ?>

            <?php if($type === "customer"){?>
                <h3 class="text-center mt-2"><u>User Registation</u></h3>
                <?php }else{ ?>
                    <h3 class="text-center mt-2"><u>Service Provider Registation</u></h3>
                <?php } ?>
                <?php echo display_errors($user->errors); ?>
                <?php if($type === "customer"){?>
            <form action="user_reg.php?type=customer" method="post" enctype="multipart/form-data">
            <?php } ?>
            <form action="user_reg.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-4">
                <label class="mt-2" for="inputGroupFile02" >Name</label>
                    <input type="text" class="form-control" name = "user[name]" placeholder="John Doe" aria-label="First name">
                </div>
                <div class="col-4">
                <label class="mt-2" for="inputGroupFile02" >Phone Number</label>
                    <input type="text" class="form-control" name = "user[phone]" placeholder="+017..." aria-label="Last name">
                </div>
                <div class="col-4">
                <label class="mt-2" for="inputGroupFile02" >Password</label>
                    <input type="password" class="form-control" name = "user[password]" placeholder="Provide Strong Password" aria-label="Last name">
                </div>
                </div>
            
            <div class="row g-3 mt-2">
                
                <div class="col-4">
                    <label class="" for="inputGroupFile02">Email Address</label>
                    <input class="form-control" name = "user[email]" type="text" placeholder="someone@domain.com" id="formFile" >
                    
                </div>
                <?php if($type === "customer"){ ?>
                    <input class="form-control" name = "user[userRole]" Value = "Customer" type="hidden"  >
               <?php }else{ ?>
                <div class="col-4">
                    <label for="inputState" class="form-label">Select Role</label>
                    <select id="inputState" name = "user[userRole]" class="form-select">
                    <option selected>Type of User</option>
                    <option value="Vehicle">Veihcle Provider</option>
                    <option value="Labour">Labour Provider </option>
                    <option value="AC">AC Service Provider </option>
                    <option value="Electrician">Electrician </option>
                    </select>
                </div>
                <?php } ?>
                
                
            </div>
            <div class="row g-3 m-2 ml-2">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
        </div> 
    </section>
    <!--================Blog Area =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>