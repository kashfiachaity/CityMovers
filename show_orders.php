<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login() ?>
<?php if(is_post_request()){

$vID = $_POST['vehicleID'];
$lID = $_POST['labourID'];
$cID = $_POST['acID'];
$eID = $_POST['elecID'];
$oID = $_POST['orderID'];


if(!empty($vID)){
  $sql = "UPDATE vehicle SET isHired = 0 WHERE id = $vID";
      $result = Database::$database->query($sql);
  }

  if(!empty($lID)){
      $sql = "UPDATE labour SET isHired = 0 WHERE id = $lID";
          $result = Database::$database->query($sql);
      }
  
  if(!empty($cID)){
      $sql = "UPDATE aircondition SET isHired = 0 WHERE id = $cID";
          $result = Database::$database->query($sql);
      }

  if(!empty($eID)){
      $sql = "UPDATE electrician SET isHired = 0 WHERE id = $eID";
          $result = Database::$database->query($sql);
      }
      if(!empty($oID)){
        $sql = "UPDATE orders SET isCompleted = 1 WHERE id = $oID";
            $result = Database::$database->query($sql);
        }

      

}
?>

<?php if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] === "Admin")){?>




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Details</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>OrderNo</th>
                      <th>CustomerName</th>
                      <th>CustomerPhone</th>
                      <th>ReportingHouse</th>
                      <th>ReportingRoad</th>
                      <th>PostCode</th>
                      <th>City/Area</th>
                      <th>Vehicle</th>
                      <th>LabourComp</th>
                      <th>LabourNo</th>
                      <th>ACCompany</th>
                      <th>ACNO</th>
                      <th>ElectricianComp</th>
                      <th>Electrician NO</th>
                      <th>PresentLoc</th>
                      <th>MovingLoc</th>
                      <th>MovingDate</th>
                      <th>Type</th>
                      <th>NoofBedroom</th>
                      <th>OfficeArea</th>
                      <th>PresentFloor</th>
                      <th>NewFloor</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 5;
                    $sql = "SELECT COUNT(*) AS COUNT FROM (SELECT orders.id AS 'Order ID', q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type AS 'Vehicle', labour.company_name AS 'Labour Company', booking_details.hired_labour_number, aircondition.company_name AS 'AC Company', booking_details.hired_ac_number, electrician.company_name AS 'Electrician Company', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type AS 'Booking Type', bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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
                    ON booking_details.order_id = q1.id) as q1";

                    $countData = Database::$database->query($sql);
                    foreach($countData as $keys => $values){
                        $total_count = $values['COUNT'];
                    }

                    

                    $pagination = new Pagination($current_page, $per_page, $total_count);

                    $sql = "SELECT orders.id AS 'Order ID',vehicle_id, labour_id, ac_id, electrician_id, q1.CustomerID, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type AS 'Vehicle', labour.company_name AS 'Labour Company', booking_details.hired_labour_number, aircondition.company_name AS 'AC Company', booking_details.hired_ac_number, electrician.company_name AS 'Electrician Company', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type AS 'Booking Type', bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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
                    (SELECT orders.id, user.id AS 'CustomerID', user.name AS 'CustomerName', user.phone AS 'CustomerPhone', orders.houseNo, orders.roadNo, orders.postCode, orders.city FROM `orders` INNER JOIN user ON orders.user_id = user.id) AS q1
                    ON booking_details.order_id = q1.id WHERE isCompleted = 0
                    ";
                    $orderDetails = Database::$database->query($sql);
                    
                    foreach($orderDetails as $keys=>$values){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $values['Order ID'] ?></td>
                      <td><?php echo $values['CustomerName'] ?></td>
                      <td><?php echo $values['CustomerPhone'] ?> </td>
                      <td><?php echo $values['houseNo'] ?></td>
                      <td><?php echo $values['roadNo'] ?></td>
                      <td><?php echo $values['postCode'] ?></td>
                      <td><?php echo $values['city'] ?></td>
                      <td><?php echo $values['Vehicle'] ?> </td>
                      <td><?php echo $values['Labour Company'] ?></td>
                      <td><?php echo $values['hired_labour_number'] ?></td>
                      <td><?php echo $values['AC Company'] ?></td>
                      <td><?php echo $values['hired_ac_number'] ?></td>
                      <td><?php echo $values['Electrician Company'] ?> </td>
                      <td><?php echo $values['hired_electrician_number'] ?></td>
                      <td><?php echo $values['newAddress'] ?></td>
                      <td><?php echo $values['movingDate'] ?></td>
                      <td><?php echo $values['Booking Type'] ?></td>
                      <td><?php echo $values['houseTypeDetails'] ?></td>
                      <td><?php echo $values['officeAreaOne'] ?></td>
                      <td><?php echo $values['officeAreaTwo'] ?></td>
                      <td><?php echo $values['presentFloor'] ?></td>
                      <td><?php echo $values['newFloor'] ?></td>
                      <td><?php echo $values['total_amount'] ?></td>
                      <form action="show_orders.php" method="post">
                      <input type="hidden" name="vehicleID" value="<?php echo $values['vehicle_id'] ?>">
                      <input type="hidden" name="labourID" value="<?php echo $values['labour_id'] ?>">
                      <input type="hidden" name="acID" value="<?php echo $values['ac_id'] ?>">
                      <input type="hidden" name="elecID" value="<?php echo $values['electrician_id'] ?>">
                      <input type="hidden" name="orderID" value="<?php echo $values['Order ID'] ?>">
                      
                      <td><button class="btn btn-outline-danger mt-5" type="submit">Completed</button></td>
                      </form>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <?php
            $url =('show_orders.php');
            echo $pagination->page_links($url);
        ?>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <?php } else{?>
    <!-- Customers -->
    <?php $cust_id = $session->user_id?>
    <section class="content">
      <div class="container-fluid">
    
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Details</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>OrderNo</th>
                      <th>CustomerName</th>
                      <th>CustomerPhone</th>
                      <th>ReportingHouse</th>
                      <th>ReportingRoad</th>
                      <th>PostCode</th>
                      <th>City/Area</th>
                      <th>Vehicle</th>
                      <th>LabourComp</th>
                      <th>LabourNo</th>
                      <th>ACCompany</th>
                      <th>ACNO</th>
                      <th>ElectricianComp</th>
                      <th>Electrician NO</th>
                      <th>PresentLoc</th>
                      <th>MovingLoc</th>
                      <th>MovingDate</th>
                      <th>Type</th>
                      <th>NoofBedroom</th>
                      <th>OfficeArea</th>
                      <th>newOfficeArea</th>
                      <th>PresentFloor</th>
                      <th>NewFloor</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 5;
                    $sql = "SELECT COUNT(*) AS COUNT FROM (SELECT orders.id AS 'Order ID', q1.CustomerID, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type AS 'Vehicle', labour.company_name AS 'Labour Company', booking_details.hired_labour_number, aircondition.company_name AS 'AC Company', booking_details.hired_ac_number, electrician.company_name AS 'Electrician Company', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type AS 'Booking Type', bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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
                    (SELECT orders.id, user.id AS 'CustomerID', user.name AS 'CustomerName', user.phone AS 'CustomerPhone', orders.houseNo, orders.roadNo, orders.postCode, orders.city FROM `orders` INNER JOIN user ON orders.user_id = user.id) AS q1
                    ON booking_details.order_id = q1.id) as q1";

                    $countData = Database::$database->query($sql);
                    foreach($countData as $keys => $values){
                        $total_count = $values['COUNT'];
                    }

                    

                    $pagination = new Pagination($current_page, $per_page, $total_count);

                    $sql = "SELECT orders.id AS 'Order ID',vehicle_id, labour_id, ac_id, electrician_id, q1.CustomerID, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type AS 'Vehicle', labour.company_name AS 'Labour Company', booking_details.hired_labour_number, aircondition.company_name AS 'AC Company', booking_details.hired_ac_number, electrician.company_name AS 'Electrician Company', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type AS 'Booking Type', bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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
                    (SELECT orders.id, user.id AS 'CustomerID', user.name AS 'CustomerName', user.phone AS 'CustomerPhone', orders.houseNo, orders.roadNo, orders.postCode, orders.city FROM `orders` INNER JOIN user ON orders.user_id = user.id) AS q1
                    ON booking_details.order_id = q1.id WHERE CustomerID = $cust_id AND isCompleted = 0
                    ";
                    $orderDetails = Database::$database->query($sql);
                    
                    foreach($orderDetails as $keys=>$values){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $values['Order ID'] ?></td>
                      <td><?php echo $values['CustomerName'] ?></td>
                      <td><?php echo $values['CustomerPhone'] ?> </td>
                      <td><?php echo $values['houseNo'] ?></td>
                      <td><?php echo $values['roadNo'] ?></td>
                      <td><?php echo $values['postCode'] ?></td>
                      <td><?php echo $values['city'] ?></td>
                      <td><?php echo $values['Vehicle'] ?> </td>
                      <td><?php echo $values['Labour Company'] ?></td>
                      <td><?php echo $values['hired_labour_number'] ?></td>
                      <td><?php echo $values['AC Company'] ?></td>
                      <td><?php echo $values['hired_ac_number'] ?></td>
                      <td><?php echo $values['Electrician Company'] ?> </td>
                      <td><?php echo $values['hired_electrician_number'] ?></td>
                      <td><?php echo $values['presentAddress'] ?></td>
                      <td><?php echo $values['newAddress'] ?></td>
                      <td><?php echo $values['movingDate'] ?></td>
                      <td><?php echo $values['Booking Type'] ?></td>
                      <td><?php echo $values['houseTypeDetails'] ?></td>
                      <td><?php echo $values['officeAreaOne'] ?></td>
                      <td><?php echo $values['officeAreaTwo'] ?></td>
                      <td><?php echo $values['presentFloor'] ?></td>
                      <td><?php echo $values['newFloor'] ?></td>
                      <td><?php echo $values['total_amount'] ?></td>
                      <form action="show_orders.php" method="post">
                      <input type="hidden" name="vehicleID" value="<?php echo $values['vehicle_id'] ?>">
                      <input type="hidden" name="labourID" value="<?php echo $values['labour_id'] ?>">
                      <input type="hidden" name="acID" value="<?php echo $values['ac_id'] ?>">
                      <input type="hidden" name="elecID" value="<?php echo $values['electrician_id'] ?>">
                      <input type="hidden" name="orderID" value="<?php echo $values['Order ID'] ?>">
                      
                      <td><button class="btn btn-outline-danger mt-5" type="submit">Completed</button></td>
                      </form>
                      
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <?php
            $url =('show_orders.php');
            echo $pagination->page_links($url);
        ?>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>