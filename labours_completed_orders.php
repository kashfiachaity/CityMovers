<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login()?>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <?php if($session->is_logged_in() && $_SESSION['user_role'] === "Labour") {
                $lid = $session->user_id;
      ?>

        <div class="row">
              <?php $labour = User::find_by_id($lid);
              
              $sql = "SELECT * FROM `labour` WHERE user_id = $lid";
              $lcompanys = Labour::find_by_sql($sql);
              foreach($lcompanys as $lcompany){
                $clabour_id = $lcompany->id;
                

              ?>
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>Company Name: <?php echo $lcompany->company_name?>
                    <?php } ?>
                  </h4>
                </div>
                <!-- /.col -->
              </div>

              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Owner Name:<?php echo $labour->name?></strong><br>
                    Phone:<?php echo $labour->phone?><br>
                    Email: <?php echo $labour->email?>
                    
                  </address>
                </div>
                <!-- /.col -->
              </div>
    
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Labour Order Details</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>CustomerName</th>
                      <th>CustomerPhone</th>
                      <th>LabourNo</th>
                      <th>PresentLoc</th>
                      <th>MovingLoc</th>
                      <th>MovingDate</th>
                      <th>Type</th>
                      <th>Total</th>
                      
                    </tr>
                  </thead>
                  <?php 
                    

                    $sql = "SELECT labour_id, id, CustomerName, CustomerPhone, houseNo, roadNo, postCode, city, hired_labour_number, (hired_labour_number*labour_wages) AS 'price', presentAddress, newAddress, distance, movingDate, type, houseTypeDetails, officeAreaOne, officeAreaTwo, presentFloor, newFloor FROM (SELECT labour_id, orders.id, orders.isCompleted, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type, vehicle.price, labour.company_name AS 'lcompany', booking_details.hired_labour_number, labour.labour_wages, aircondition.company_name AS 'acompany', booking_details.hired_ac_number, electrician.company_name AS 'ecompany', booking_details.hired_electrician_number, bookinginformation.distance AS 'distance', bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type, bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
                    INNER JOIN
                    orders ON booking_details.order_id = orders.id
                    INNER JOIN
                    vehicle ON booking_details.vehicle_id = vehicle.id
                    INNER JOIN
                    labour ON booking_details.labour_id = labour.id
                    INNER JOIN
                    aircondition ON booking_details.ac_id = aircondition.id
                    INNER JOIN
                    electrician on booking_details.electrician_id = electrician.id
                    INNER JOIN
                    bookinginformation ON booking_details.booking_id = bookinginformation.id
                    INNER JOIN 
                    (SELECT orders.id, user.name AS 'CustomerName', user.phone AS 'CustomerPhone', orders.houseNo, orders.roadNo, orders.postCode, orders.city FROM `orders` INNER JOIN user ON orders.user_id = user.id) AS q1
                    ON booking_details.order_id = q1.id) AS l1 WHERE isCompleted = 1 AND labour_id = $clabour_id
                    ";
                    $instrumentorderDetails = Database::$database->query($sql);
                    $pricings = Pricing::find_all();
                    foreach($pricings as $pricing){
                        $distancePricing = $pricing->distancePrice;
                        $rprice = $pricing->roomPrice;
                        $officePrice = $pricing->officeAreaPrice;
                        $floorPrice = $pricing->floorPrice;
                    }
                    
                    foreach($instrumentorderDetails as $keys=>$values){
                        
                        if($values['type'] === "House"){   
                            $totalCost = ($values['distance']  * $distancePricing) + ($values['houseTypeDetails']  * $rprice) + ($values['presentFloor'] * $floorPrice) + ($values['newFloor'] * $floorPrice);
                          }else{
                            $totalCost =($values['distance']  * $distancePricing) + ($values['officeAreaOne']/1000 * $officePrice) +($values['officeAreaTwo']/1000 * $officePrice) + ($values['presentFloor'] * $floorPrice) + ($values['newFloor'] * $floorPrice);
                          }
                        $per_share = (15/100)*$totalCost;
                        $labourPayment = $per_share + $values['price'];
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $values['CustomerName'] ?></td>
                      <td><?php echo $values['CustomerPhone'] ?> </td>
                      <td><?php echo $values['hired_labour_number'] ?></td>
                      <td><?php echo $values['presentAddress'] ?> </td>
                      <td><?php echo $values['newAddress'] ?></td>
                      <td><?php echo $values['movingDate'] ?></td>
                      <td><?php echo $values['type'] ?> </td>
                      <td>&#2547; <?php echo number_format($labourPayment)  ?></td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
                <?php } ?>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="row no-print">
                <div class="col-12">
                  <button type="button" onclick="window.print()" class="btn btn-success "><i class="fas fa-print"></i></i> Print
                  </button>
                  
                </div>
              </div>
            <!-- /.card -->
          </div>
        </div>

        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>