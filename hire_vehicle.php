
<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>
<?php require_booking_info() ?>

<?php 
$count=0;
if(is_post_request()) {
  if(isset($_SESSION['hired_car']) && empty($_SESSION['hired_car'])) {
    $hiredCarArray = [];
    if(isset($_SESSION['hired_car'])) {  
      $count = count($_SESSION["hired_car"]); 
    $hiredCarArray = array(
            'carID'		   	=>	$_GET["id"],
            'name'			=>	$_POST["vehicleType"],
            'price'			=>	$_POST["vehicleprice"]
            
        );
        $_SESSION['hired_car'][$count] = $hiredCarArray;
    }else{
      $hiredCarArray = array(
        'carID'		   	=>	$_GET["id"],
        'name'			=>	$_POST["vehicleType"],
        'price'			=>	$_POST["vehicleprice"]
        
    );
      $_SESSION['hired_car'][0] = $hiredCarArray;
    }
    redirect_to(url_for('hire_labour.php')); 
    
}else{
  foreach($_SESSION["hired_car"] as $keys => $values)
		{
				unset($_SESSION["hired_car"][$keys]);
		}

    $hiredCarArray = [];
    if(isset($_SESSION['hired_car'])) {  
      $count = count($_SESSION["hired_car"]); 
    $hiredCarArray = array(
            'carID'		   	=>	$_GET["id"],
            'name'			=>	$_POST["vehicleType"],
            'price'			=>	$_POST["vehicleprice"]
            
        );
        $_SESSION['hired_car'][$count] = $hiredCarArray;
    }else{
      $hiredCarArray = array(
        'carID'		   	=>	$_GET["id"],
        'name'			=>	$_POST["vehicleType"],
        'price'			=>	$_POST["vehicleprice"]
        
    );
      $_SESSION['hired_car'][0] = $hiredCarArray;
    }
    redirect_to(url_for('hire_labour.php'));
  

}
    
        
  }
  

  if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["hired_car"] as $keys => $values)
		{
			if($values["carID"] == $_GET["id"])
			{
				unset($_SESSION["hired_car"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				redirect_to(url_for('cartItem.php'));
			}
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
                        <h3>Vehicle Hiring</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->


   
    <section class="blog_area section-padding">
    
        <div class="container">
        <h3 class="text-center mb-5"><u>Moving Service Provider</u></h3>
            <?php
                $current_page = $_GET['page'] ?? 1;
                $per_page = 5;
                $sql = "SELECT COUNT(*) AS 'count' FROM (SELECT * FROM vehicle WHERE isHired = 0 AND isApproved = 1) AS q1";
                $totallabours = Database::$database->query($sql);
                foreach($totallabours as $key => $values){
                $total_count = $values['count'];
                }

                $pagination = new Pagination($current_page, $per_page, $total_count);

                $sql = "SELECT * FROM vehicle WHERE isHired = 0 AND isApproved = 1 ";
                $sql .= "LIMIT {$per_page} ";
                $sql .= "OFFSET {$pagination->offset()}";
                $vehicles = Vehicle::find_by_sql($sql);
                foreach ($vehicles as $vehicle) {
            ?>
                <form method="post" action="hire_vehicle.php?action=add&id=<?php echo $vehicle->id ?>">
                    <div class="row border-top border-bottom align-items-center">
                   <?php if(!empty($vehicle->image)) {?>
                        <div class="col-2" ><img class="img-fluid" style="height: 90px;" src="uploads/<?php echo $vehicle->image ?>"></div>
                        <?php }else{ ?>
                          <div class="col-2" ><img class="img-fluid" style="height: 90px;" src="img/elements/car.png"></div>
                          <?php } ?>
                        <div class="col-3">
                            <div class="row text-muted" > <?php echo $vehicle->vehicle_type ?></div>
                            <div class="row"><b>Driver:  </b><?php echo $vehicle->name ?></div>
                        </div>
                        <div class="col-3"><b>Experience:</b> <?php echo $vehicle->experience_year ?> Years</div>
                        <div class="col-2"><b>Price: </b>  <span>&#2547; <?php echo $vehicle->price ?></span></div>
                        <input type="hidden" name="vehicleType"  value="<?php echo $vehicle->vehicle_type ?>"/>
                        <input type="hidden" name="vehicleprice"  value="<?php echo $vehicle->price ?>"/>
                        <div class="col-2"><input type="submit" class="btn btn-outline-warning" value="Hire"></div>
                </form>  
                    </div>
                <?php } ?>

                <?php
                  $url =('hire_vehicle.php');
                  echo $pagination->page_links($url);
                ?>
                    
                <div class="row">
                    <div class="col-11"></div>
                    <div class="col-1"><a href="hire_labour.php"><button class="btn btn-outline-danger mt-5">Skip</button></a></div>
                </div>
        </div> 
    </section>
    <!--================Blog Area =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>