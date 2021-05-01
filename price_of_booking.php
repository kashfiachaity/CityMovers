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


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
     
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Moving Pricing Details</h3>

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
                      <th>Distance Price</th>
                      <th>Room Price</th>
                      <th>Office Area Price</th>
                      <th>Per Floor Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php 
                    
                    $pricedetails = Pricing::find_all();
                    foreach($pricedetails as $pricedetail){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $pricedetail->id ?></td>
                      <td>&#2547; <?php echo $pricedetail->distancePrice ?></td>
                      <td>&#2547; <?php echo $pricedetail->roomPrice ?></td>
                      <td>&#2547; <?php echo $pricedetail->officeAreaPrice ?></td>
                      <td>&#2547; <?php echo $pricedetail->floorPrice ?></td>
                      <td>
                        <div class="table-data-feature">

                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                              <a class = "action" href="edit_pricing.php?id=<?php echo $pricedetail->id?>"> <i class="fas fa-edit"></i></a>
                          </button>
                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <a class = "delete"  href="delete_pricing.php?id=<?php echo $pricedetail->id?>"><i class="fas fa-trash"></i></a>
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
    <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--  Include Footer -->
<?php include_once('includes/dashboard/dashFooter.php') ?>