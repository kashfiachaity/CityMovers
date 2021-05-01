<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Dashboard Head-->
<?php include_once 'includes/dashboard/dashHead.php'?>
<!-- Include Dashboard Navigation-->
<?php include_once 'includes/dashboard/dashNav.php'?>
<!-- Include Side Menu -->
<?php include_once 'includes/dashboard/dashSideMenu.php'?>
<?php require_login() ?>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
     <?php ?>
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Information</h3>
                <?php echo display_session_message(); ?>


              </div>
              <!-- /.card-header -->
              <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Admin") {?>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Phone Number</th>
                      <th>Email Address</th>
                      <th>User Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <?php 
                    $current_page = $_GET['page'] ?? 1;
                    $per_page = 10;
                    $total_count = User::count_all();

                    $pagination = new Pagination($current_page, $per_page, $total_count);

                    $sql = "SELECT * FROM user ";
                    $sql .= "LIMIT {$per_page} ";
                    $sql .= "OFFSET {$pagination->offset()}";
                    $users = User::find_by_sql($sql);
                    foreach($users as $user){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $user->id ?></td>
                      <td><?php echo $user->name ?></td>
                      <td><?php echo $user->phone ?></td>
                      <td><?php echo $user->email ?></td>
                      <td><?php echo $user->userRole ?></td>
                      <td>
                        <div class="table-data-feature">

                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                              <a class = "action" href="edit_user.php?id=<?php echo $user->id?>"> <i class="fas fa-edit"></i></a>
                          </button>
                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <a class = "delete"  href="delete_customer.php?id=<?php echo $user->id?>"><i class="fas fa-trash"></i></a>
                          </button>

                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
              <?php
            $url =('show_customers.php');
            echo $pagination->page_links($url);
              ?>
              <?php } else{?>
              <!-- Users -->
              <?php if(isset($_GET['id'])){
                $current = $_GET['id'];
                }?>
                <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Phone Number</th>
                      <th>Email Address</th>
                      <th>User Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <?php 
                    $user = User::find_by_id($current);
                    
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $user->id ?></td>
                      <td><?php echo $user->name ?></td>
                      <td><?php echo $user->phone ?></td>
                      <td><?php echo $user->email ?></td>
                      <td><?php echo $user->userRole ?></td>
                      <td>
                        <div class="table-data-feature">

                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                              <a class = "action" href="edit_user.php?id=<?php echo $user->id?>"> <i class="fas fa-edit"></i></a>
                          </button>
                          

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <!-- /.card-body -->
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