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

  <?php 
  if(isset($_GET['id'])){
    $oID = $_GET['id'];
    $sql = "UPDATE orders SET isCompleted = 1 WHERE id = $oID";
    $result = Database::$database->query($sql); 
  }

?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Instruments Order</h3>

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
                      <th>OrderNo</th>
                      <th>CustomerName</th>
                      <th>CustomerPhone</th>
                      <th>ReportingHouse</th>
                      <th>ReportingRoad</th>
                      <th>PostCode</th>
                      <th>City/Area</th>
                      <th>Instrument Name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Completed</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 10;
                    $sql = "SELECT COUNT(*) AS count FROM (SELECT ordered_instruments.order_id, q1.CustomerID,q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, moving_instruments.instruments_name, ordered_instruments.quantity, ordered_instruments.price FROM `ordered_instruments` 
                    INNER JOIN moving_instruments
                    ON ordered_instruments.instruments_id=moving_instruments.id
                    INNER JOIN 
                    (SELECT orders.id, user.id AS 'CustomerID', user.name AS 'CustomerName', user.phone AS 'CustomerPhone', orders.houseNo, orders.roadNo, orders.postCode, orders.city FROM `orders` INNER JOIN user ON orders.user_id = user.id) AS q1
                    ON ordered_instruments.order_id = q1.id) AS q2";

                    $countData = Database::$database->query($sql);
                    foreach($countData as $keys => $values){
                        $total_count = $values['count'];
                    }

                    

                    $pagination = new Pagination($current_page, $per_page, $total_count);

                    $sql = "SELECT ordered_instruments.order_id, q1.CustomerID,q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.isCompleted, q1.roadNo, q1.postCode, q1.city, moving_instruments.instruments_name, ordered_instruments.quantity, ordered_instruments.price FROM `ordered_instruments` 
                    INNER JOIN moving_instruments
                    ON ordered_instruments.instruments_id=moving_instruments.id
                    INNER JOIN 
                    (SELECT orders.id, user.id AS 'CustomerID', user.name AS 'CustomerName', user.phone AS 'CustomerPhone', orders.houseNo, orders.roadNo, orders.postCode, orders.city, orders.isCompleted FROM `orders` INNER JOIN user ON orders.user_id = user.id) AS q1
                    ON ordered_instruments.order_id = q1.id
                    ";
                    $instrumentorderDetails = Database::$database->query($sql);
                    
                    foreach($instrumentorderDetails as $keys=>$values){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $values['order_id'] ?></td>
                      <td><?php echo $values['CustomerName'] ?></td>
                      <td><?php echo $values['CustomerPhone'] ?> </td>
                      <td><?php echo $values['houseNo'] ?></td>
                      <td><?php echo $values['roadNo'] ?></td>
                      <td><?php echo $values['postCode'] ?></td>
                      <td><?php echo $values['city'] ?></td>
                      <td><?php echo $values['instruments_name'] ?> </td>
                      <td><?php echo $values['quantity'] ?></td>
                      <td><?php echo $values['price'] ?></td>
                      <?php if($values['isCompleted'] === '0'){?>
                      <td> Not Completed </td>
                      <?php }else{ ?>
                        <td>Completed </td>
                      <?php } ?>
                      <td>
                        <?php if($values['isCompleted'] === '0') {?>
                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <a class = "delete"  href="instruments_orders.php?id=<?php echo $values['order_id']?>">Complete</a>
                          </button>
                          <?php } ?>
                      </td>
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
            $url =('instruments_orders.php');
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
                <h3 class="card-title">Instruments Order</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    
                      <th>CustomerName</th>
                      <th>CustomerPhone</th>
                      <th>ReportingHouse</th>
                      <th>ReportingRoad</th>
                      <th>PostCode</th>
                      <th>City/Area</th>
                      <th>Instrument Name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      
                    </tr>
                  </thead>
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 10;
                    $sql = "SELECT COUNT(*) AS count FROM (SELECT ordered_instruments.order_id, q1.CustomerID,q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.roadNo, q1.postCode, q1.city, moving_instruments.instruments_name, ordered_instruments.quantity, ordered_instruments.price FROM `ordered_instruments` 
                    INNER JOIN moving_instruments
                    ON ordered_instruments.instruments_id=moving_instruments.id
                    INNER JOIN 
                    (SELECT orders.id, user.id AS 'CustomerID', user.name AS 'CustomerName', user.phone AS 'CustomerPhone', orders.houseNo, orders.roadNo, orders.postCode, orders.city FROM `orders` INNER JOIN user ON orders.user_id = user.id) AS q1
                    ON ordered_instruments.order_id = q1.id) AS q2";

                    $countData = Database::$database->query($sql);
                    foreach($countData as $keys => $values){
                        $total_count = $values['count'];
                    }

                    

                    $pagination = new Pagination($current_page, $per_page, $total_count);

                    $sql = "SELECT ordered_instruments.order_id, q1.CustomerID,q1.CustomerName, q1.CustomerPhone, q1.houseNo, q1.isCompleted, q1.roadNo, q1.postCode, q1.city, moving_instruments.instruments_name, ordered_instruments.quantity, ordered_instruments.price FROM `ordered_instruments` 
                    INNER JOIN moving_instruments
                    ON ordered_instruments.instruments_id=moving_instruments.id
                    INNER JOIN 
                    (SELECT orders.id, user.id AS 'CustomerID', user.name AS 'CustomerName', user.phone AS 'CustomerPhone', orders.houseNo, orders.roadNo, orders.postCode, orders.city, orders.isCompleted FROM `orders` INNER JOIN user ON orders.user_id = user.id) AS q1
                    ON ordered_instruments.order_id = q1.id WHERE CustomerID = $cust_id;
                    ";
                    $orderDetails = Database::$database->query($sql);
                    
                    foreach($orderDetails as $keys=>$values){
                  ?>
                  <tbody>
                    <tr>
                    
                      <td><?php echo $values['CustomerName'] ?></td>
                      <td><?php echo $values['CustomerPhone'] ?> </td>
                      <td><?php echo $values['houseNo'] ?></td>
                      <td><?php echo $values['roadNo'] ?></td>
                      <td><?php echo $values['postCode'] ?></td>
                      <td><?php echo $values['city'] ?></td>
                      <td><?php echo $values['instruments_name'] ?> </td>
                      <td><?php echo $values['quantity'] ?></td>
                      <td><?php echo $values['price'] ?></td>
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
            $url =('instruments_orders.php');
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