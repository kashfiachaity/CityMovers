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
    $acID = $_GET['id'];
    $sql = "UPDATE aircondition SET isApproved = 1 WHERE id = $acID";
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
                <h3 class="card-title">AC Company Information</h3>

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
                      <th>Company Name</th>
                      <th>Worker Number</th>
                      <th>Per Worker Wages</th>
                      <th>Approved</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 5;
                    $total_count = Aircondition::count_all();

                    $pagination = new Pagination($current_page, $per_page, $total_count);

                    $sql = "SELECT * FROM aircondition ";
                    $sql .= "LIMIT {$per_page} ";
                    $sql .= "OFFSET {$pagination->offset()}";
                    $airconditions = Aircondition::find_by_sql($sql);
                    foreach($airconditions as $aircondition){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $aircondition->id ?></td>
                      <td><?php echo $aircondition->company_name ?></td>
                      <td><?php echo $aircondition->worker_number ?> People</td>
                      <td>&#2547; <?php echo $aircondition->per_worker_wages ?></td>
                      <?php if($aircondition->isApproved === '0'){?>
                      <td> Not Approved </td>
                      <?php }else{ ?>
                        <td>Approved </td>
                      <?php } ?>
                      <td>
                        <div class="table-data-feature">

                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                              <a class = "action" href="edit_ac.php?id=<?php echo $aircondition->id?>"> <i class="fas fa-edit"></i></a>
                          </button>
                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <a class = "delete"  href="delete_ac.php?id=<?php echo $aircondition->id?>"><i class="fas fa-trash"></i></a>
                          </button>
                          <?php if($aircondition->isApproved === '0') {?>
                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <a class = "delete"  href="show_ac_company.php?id=<?php echo $aircondition->id?>">Approve</a>
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
            $url =('show_ac_company.php');
            echo $pagination->page_links($url);
        ?>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <?php }else{ ?>
      <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "AC") {?>
      <?php $u_id = $session->user_id?>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">AC Company Information</h3>
  
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
                        <th>Company Name</th>
                        <th>Worker Number</th>
                        <th>Per Worker Wages</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php 
                      $sql = "SELECT * FROM aircondition WHERE user_id = $u_id ";
                      $airconditions = Aircondition::find_by_sql($sql);
                      foreach($airconditions as $aircondition){
                    ?>
                    <tbody>
                      <tr>
                        <td><?php echo $aircondition->id ?></td>
                        <td><?php echo $aircondition->company_name ?></td>
                        <td><?php echo $aircondition->worker_number ?> People</td>
                        <td>&#2547; <?php echo $aircondition->per_worker_wages ?></td>
                        <?php if($aircondition->isApproved === '0'){?>
                        <td> Not Approved </td>
                        <?php }else{ ?>
                          <td>Approved </td>
                        <?php } ?>
                        <td>
                          <div class="table-data-feature">
  
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                <a class = "action" href="edit_ac.php?id=<?php echo $aircondition->id?>"> <i class="fas fa-edit"></i></a>
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