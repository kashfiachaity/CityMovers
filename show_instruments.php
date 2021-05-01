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
              <?php echo display_session_message(); ?>
                <h3 class="card-title">Instruments Information</h3>

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
                      <th>Instrument Name</th>
                      <th>Quantity Number</th>
                      <th>Per Instrument Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php 
                    
                    $Instruments = Instruments::find_all();
                    foreach($Instruments as $Instrument){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $Instrument->id ?></td>
                      <td><?php echo $Instrument->instruments_name ?></td>
                      <td><?php echo $Instrument->quantity ?> Pieces</td>
                      <td>&#2547; <?php echo $Instrument->instruments_price ?></td>
                      <td>
                        <div class="table-data-feature">

                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                              <a class = "action" href="edit_instruments.php?id=<?php echo $Instrument->id?>"> <i class="fas fa-edit"></i></a>
                          </button>
                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                              <a class = "delete"  href="delete_instruments.php?id=<?php echo $Instrument->id?>"><i class="fas fa-trash"></i></a>
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