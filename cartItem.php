
<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>



<section class="blog_area section-padding">
  <div class="container">
      <?php 
      $vehiclePrice = 0;
      $labourTotal = 0;
      $acTotal = 0;
      $instruTotal=0;
      $electriTotal = 0;
      $totalCount = 0;
      $bookingTotal = 0;
      
      if(empty($_SESSION["hired_car"]) && empty($_SESSION["hired_labour"]) && empty($_SESSION["hired_ac"]) && empty($_SESSION["hired_electrician"]) && empty($_SESSION["book_intruments"])){ ?>
          <h1 class="text-center"><i class="ti-thumb-down mr-2"></i>No Item is Added to the cart!</h1>
      <?php }else{ ?>

      <?php

      if(!empty($_SESSION["hired_car"])){
          $total = 0;
          foreach($_SESSION["hired_car"] as $keys => $value)
        { 

      ?>
        <h3 class="text-center">Vehicle Information</h3><hr>
        <div class="row">
          <div class="col-3 text-center"><h4>Vehicle Type</h4></div>
          <div class="col-3 text-center"><h4>Hired Number</h4></div>
          <div class="col-3 text-center"><h4>Price</h4></div>
          <div class="col-3 text-center"><h4>Action</h4></div>
        </div>
        <hr>
        <div class="row">
          <div class="col-3 text-center"><?php echo $value["name"] ?></div>
          <div class="col-3 text-center">1</div>
          <div class="col-3 text-center">&#2547; <?php echo $value["price"] ?></div>
          <div class="col-3 text-center"><a href="hire_vehicle.php?action=delete&id=<?php echo $value["carID"] ?>"><span class="text-danger">Remove</span></a></div>
        </div>
          <?php $vehiclePrice = $value["price"]?>
          <?php } ?>
        
      <?php } ?>
    
  </div>
</section>

<section class="blog_area section-padding">
  <div class="container">
   
      <?php 
      if(!empty($_SESSION["hired_labour"])){
        
          foreach($_SESSION["hired_labour"] as $keys => $value)
        { 

      ?>
        <h3 class="text-center">Labour Information</h3><hr>
        <div class="row">
          <div class="col-3 text-center"><h4>Company Name</h4></div>
          <div class="col-3 text-center"><h4>Hired Labour</h4></div>
          <div class="col-2 text-center"><h4>Base Price</h4></div>
          <div class="col-2 text-center"><h4>Calculated Price</h4></div>
          <div class="col-2 text-center"><h4>Action</h4></div>
        </div>
        <hr>
        <div class="row">
          <div class="col-3 text-center"><?php echo $value["comName"] ?></div>
          <div class="col-3 text-center"> <?php echo $value["hiredLab"]?></div>
          <div class="col-2 text-center">&#2547; <?php echo $value["wages"] ?></div>
          <div class="col-2 text-center">&#2547; <?php echo ($value["wages"]*$value["hiredLab"]) ?></div>
          <div class="col-2 text-center"><a href="hire_labour.php?action=delete&id=<?php echo $value["labID"] ?>"><span class="text-danger">Remove</span></a></div>
        </div>
        
          <?php $labourTotal =  ($value["wages"]*$value["hiredLab"])?>
          <?php } ?>
         
      <?php } ?>
    
  </div>
</section>

<!-- Air Condition -->
<section class="blog_area section-padding">
  <div class="container">
    
      <?php 
      if(!empty($_SESSION["hired_ac"])){
        
        
          foreach($_SESSION["hired_ac"] as $keys => $value)
        { 

      ?>
        <h3 class="text-center">Air Condition Repairer Information</h3><hr>
        <div class="row">
          <div class="col-3 text-center"><h4>Company Name</h4></div>
          <div class="col-3 text-center"><h4>Hired Worker</h4></div>
          <div class="col-2 text-center"><h4>Base Price</h4></div>
          <div class="col-2 text-center"><h4>Calculated Price</h4></div>
          <div class="col-2 text-center"><h4>Action</h4></div>
        </div>
        <hr>
        <div class="row">
          <div class="col-3 text-center"><?php echo $value["comName"] ?></div>
          <div class="col-3 text-center"> <?php echo $value["hiredAC"]?></div>
          <div class="col-2 text-center">&#2547; <?php echo $value["wages"] ?></div>
          <div class="col-2 text-center">&#2547; <?php echo ($value["wages"]*$value["hiredAC"]) ?></div>
          <div class="col-2 text-center"><a href="hire_ac.php?action=delete&id=<?php echo $value["acID"] ?>"><span class="text-danger">Remove</span></a></div>
        </div>
        
          <?php $acTotal = ($value["wages"]*$value["hiredAC"])?>
          <?php } ?>
          
      
        
      
      <?php } ?>
    
  </div>
</section>

<!-- ELectrician Condition -->
<section class="blog_area section-padding">
  <div class="container">
    
      <?php 
      if(!empty($_SESSION["hired_electrician"])){
        
        
          foreach($_SESSION["hired_electrician"] as $keys => $value)
        { 

      ?>
        <h3 class="text-center">Electrician Information</h3><hr>
        <div class="row">
          <div class="col-3 text-center"><h4>Company Name</h4></div>
          <div class="col-3 text-center"><h4>Hired Worker</h4></div>
          <div class="col-2 text-center"><h4>Base Price</h4></div>
          <div class="col-2 text-center"><h4>Calculated Price</h4></div>
          <div class="col-2 text-center"><h4>Action</h4></div>
        </div>
        <hr>
        <div class="row">
          <div class="col-3 text-center"><?php echo $value["comName"] ?></div>
          <div class="col-3 text-center"><?php echo $value["hiredElectrician"]?></div>
          <div class="col-2 text-center">&#2547; <?php echo $value["wages"] ?></div>
          <div class="col-2 text-center">&#2547; <?php echo ($value["wages"]*$value["hiredElectrician"]) ?></div>
          <div class="col-2 text-center"><a href="hire_electrician.php?action=delete&id=<?php echo $value["elecID"] ?>"><span class="text-danger">Remove</span></a></div>
        </div>
          <?php $electriTotal = ($value["wages"]*$value["hiredElectrician"])?>
          <?php } ?>
          
        
      <?php } ?>
      
  </div>
</section>

<!-- Instruments -->

<section class="blog_area section-padding">
  <div class="container">
  <?php if(!empty($_SESSION["book_intruments"])){ ?>
      <h3 class="text-center">Instruments Booking Information</h3><hr>
        <div class="row">
          <div class="col-3 text-center"><h4>Instrument Name</h4></div>
          <div class="col-3 text-center"><h4>Quantity</h4></div>
          <div class="col-2 text-center"><h4>Base Price</h4></div>
          <div class="col-2 text-center"><h4>Calculated Price</h4></div>
          <div class="col-2 text-center"><h4>Action</h4></div>
        </div>
        <hr>
      <?php 
      
          foreach($_SESSION["book_intruments"] as $keys => $value)
        { 

      ?>
        
        <div class="row">
          <div class="col-3 text-center"><?php echo $value["instruName"] ?></div>
          <div class="col-3 text-center"><h4> <?php echo $value["instruQuantity"]?></h4></div>
          <div class="col-2 text-center">&#2547; <?php echo $value["instruprice"] ?></div>
          <div class="col-2 text-center">&#2547; <?php echo ($value["instruprice"]*$value["instruQuantity"]) ?></div>
          <div class="col-2 text-center"><a href="order_instruments.php?action=delete&id=<?php echo $value["instruID"] ?>"><span class="text-danger">Remove</span></a></div>
        </div>
          <?php $instruTotal = $instruTotal + ($value["instruprice"]*$value["instruQuantity"])?>
          <?php } ?>
      
      <?php } ?>
      <hr>


      <!-- Calculation of Iteam & Total Cost -->
      <?php $total = ($vehiclePrice + $labourTotal + $acTotal + $electriTotal + $instruTotal + $bookingTotal);?>
      <!-- End of Calculation of Iteam & Total Cost -->
      
				
      <div class="row">
        <div class="col-3 text-center"></div>
        <div class="col-3 text-center"></div>
        <div class="col-2 text-center"><h4>Grand Total</h4></div>
        <div class="col-2 text-center"><h4>&#2547; <?php echo number_format($total, 2); ?></h4></div>
        <div class="col-2 text-center"></div>
      </div>
      <div class="row">
        <div class="col-3 text-center"></div>
        <div class="col-3 text-center"></div>
        <div class="col-2 text-center"></div>
        <div class="col-2 text-center"></div>
        <div class="col-2 text-center"><a href="checkout.php" ><button class="btn btn-outline-danger mt-5">Check Out</button></a></div>
      </div>
    
  </div>
    
    
  </div>
</section>
<?php } ?>







<?php include_once 'includes/footer.php'?>