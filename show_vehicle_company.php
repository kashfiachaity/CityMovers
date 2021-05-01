<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login() ?>
<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Admin") {?>
<?php 
  if(isset($_GET['id'])){
    $vID = $_GET['id'];
    $sql = "UPDATE vehicle SET isApproved = 1 WHERE id = $vID";
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
                <h3 class="card-title">Vehicle Information</h3>

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
                      <th>ID</th>
                      <th>Driver Name</th>
                      <th>Experience Year</th>
                      <th>Vehicle Type</th>
                      <th>Rent Price</th>
                      <th>Approve</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 5;
                    $total_count = Vehicle::count_all();

                    $pagination = new Pagination($current_page, $per_page, $total_count);

                    $sql = "SELECT * FROM vehicle ";
                    $sql .= "LIMIT {$per_page} ";
                    $sql .= "OFFSET {$pagination->offset()}";
                    $vehicles = Vehicle::find_by_sql($sql);
                    foreach($vehicles as $vehicle){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $vehicle->id ?></td>
                      <td><?php echo $vehicle->name ?></td>
                      <td><?php echo $vehicle->experience_year ?> Years</td>
                      <td><?php echo $vehicle->vehicle_type ?></td>
                      <td>&#2547; <?php echo $vehicle->price ?></td>
                      <?php if($vehicle->isApproved === '0'){?>
                      <td> Not Approved </td>
                      <?php }else{ ?>
                        <td>Approved </td>
                      <?php } ?>
                      <td>
                        <div class="table-data-feature">

                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                              <a class = "action" href="edit_vehicle.php?id=<?php echo $vehicle->id?>"> <i class="fas fa-edit"></i></a>
                          </button>
                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <a class = "delete"  href="delete_vehicle.php?id=<?php echo $vehicle->id?>"><i class="fas fa-trash"></i></a>
                          </button>
                          <?php if($vehicle->isApproved === '0') {?>
                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <a class = "delete"  href="show_vehicle_company.php?id=<?php echo $vehicle->id?>">Approve</a>
                          </button>
                            <?php } ?>
                        </div>
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
            $url =('show_vehicle_company.php');
            echo $pagination->page_links($url);
        ?>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <?php }else{ ?>
      <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Vehicle") {?>
      <?php $u_id = $session->user_id?>
      <section class="content">
      <div class="container-fluid">
      
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vehicle Information</h3>

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
                      <th>ID</th>
                      <th>Driver Name</th>
                      <th>Experience Year</th>
                      <th>Vehicle Type</th>
                      <th>Rent Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php 
                    $sql = "SELECT * FROM vehicle WHERE user_id = $u_id";
                    $vehicles = Vehicle::find_by_sql($sql);
                    foreach($vehicles as $vehicle){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $vehicle->id ?></td>
                      <td><?php echo $vehicle->name ?></td>
                      <td><?php echo $vehicle->experience_year ?> Years</td>
                      <td><?php echo $vehicle->vehicle_type ?></td>
                      <td>&#2547; <?php echo $vehicle->price ?></td>
                      <td>
                        <div class="table-data-feature">

                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                              <a class = "action" href="edit_vehicle.php?id=<?php echo $vehicle->id?>"> <i class="fas fa-edit"></i></a>
                          </button>
                        </div>
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

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

    <?php } }?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>