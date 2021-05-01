<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login() ?>
<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Admin") {?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                  $sql = "SELECT COUNT(*) AS count FROM(SELECT orders.id, q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, vehicle.vehicle_type, labour.company_name AS 'lcompany', booking_details.hired_labour_number, aircondition.company_name AS 'acompany', booking_details.hired_ac_number, electrician.company_name AS 'ecompany', booking_details.hired_electrician_number, bookinginformation.presentAddress, bookinginformation.newAddress, bookinginformation.movingDate, bookinginformation.type, bookinginformation.houseTypeDetails, bookinginformation.officeAreaOne, bookinginformation.officeAreaTwo, bookinginformation.presentFloor, bookinginformation.newFloor, booking_details.total_amount FROM `booking_details` 
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
                  ON booking_details.order_id = q1.id) AS q1";

                $results = Database::$database->query($sql);
                foreach($results as $result=>$value){
                ?>
                <h3><?php echo $value['count'] ?></h3>
                  <?php } ?>
                <p>New Hiring</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="show_orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
              $totalCompany = '';
              $totalVehicle = Vehicle::count_all();
              $totalLabour = Labour::count_all();
              $totalAC = Aircondition::count_all();
              $totalElectrician = Electrician::count_all();
              
              $totalCompany = $totalVehicle + $totalLabour + $totalAC + $totalElectrician;

              
              ?>
                <h3><?php echo $totalCompany ?><sup style="font-size: 20px"></sup></h3>

                <p>Registered Company</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                  $total_count = User::count_all();
                ?>
                <h3><?php echo $total_count ?></h3>
                

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="show_customers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>