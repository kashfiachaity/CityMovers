<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login() ?>
<?php if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] === "Admin")){?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Completed Hiring Details</h3>

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
                      <th>Vehicle</th>
                      <th>LabourComp</th>
                      <th>ACCompany</th>
                      <th>ElectricianComp</th>
                      <th>PresentLoc</th>
                      <th>MovingLoc</th>
                      <th>MovingDate</th>
                      <th>Type</th>
                      <th>Total</th>
                      
                    </tr>
                  </thead>
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 5;
                    $sql = "SELECT COUNT(*) AS COUNT FROM (SELECT orders.id AS 'Order ID', orders.isCompleted, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type AS 'Vehicle', labour.company_name AS 'Labour Company', booking_details.hired_labour_number, aircondition.company_name AS 'AC Company', booking_details.hired_ac_number, electrician.company_name AS 'Electrician Company', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type AS 'Booking Type', bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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

                    $sql = "SELECT orders.id, orders.isCompleted, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type, labour.company_name AS 'lcompany', booking_details.hired_labour_number, aircondition.company_name AS 'acompany', booking_details.hired_ac_number, electrician.company_name AS 'ecompany', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type, bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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
                    ON booking_details.order_id = q1.id WHERE isCompleted = 1
                    ";
                    $orderDetails = Database::$database->query($sql);
                    
                    foreach($orderDetails as $keys=>$values){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $values['id'] ?></td>
                      <td><?php echo $values['CustomerName'] ?></td>
                      <td><?php echo $values['CustomerPhone'] ?> </td>
                      <td><?php echo $values['vehicle_type'] ?> </td>
                      <td><?php echo $values['lcompany'] ?></td>
                      <td><?php echo $values['acompany'] ?></td>
                      <td><?php echo $values['ecompany'] ?> </td>
                      <td><?php echo $values['presentAddress'] ?></td>
                      <td><?php echo $values['newAddress'] ?></td>
                      <td><?php echo $values['movingDate'] ?></td>
                      <td><?php echo $values['type'] ?></td>
                      <td><?php echo $values['total_amount'] ?></td>
                      
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
                <h3 class="card-title">Completed Hiring Details</h3>

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
                      
                    </tr>
                  </thead>
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 5;
                    $sql = "SELECT COUNT(*) AS COUNT FROM (SELECT orders.id AS 'Order ID', orders.isCompleted, q1.CustomerID, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type AS 'Vehicle', labour.company_name AS 'Labour Company', booking_details.hired_labour_number, aircondition.company_name AS 'AC Company', booking_details.hired_ac_number, electrician.company_name AS 'Electrician Company', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type AS 'Booking Type', bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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

                    $sql = "SELECT orders.id AS 'Order ID', orders.isCompleted, q1.CustomerID, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type AS 'Vehicle', labour.company_name AS 'Labour Company', booking_details.hired_labour_number, aircondition.company_name AS 'AC Company', booking_details.hired_ac_number, electrician.company_name AS 'Electrician Company', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type AS 'Booking Type', bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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
                    ON booking_details.order_id = q1.id WHERE CustomerID = $cust_id AND isCompleted = 1
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