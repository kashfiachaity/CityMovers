<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>

<?php require_login() ?>

<?php 

$miID = '';
$vehicle_type='';
$vehicle_price=0;
$lcompany_name='';
$ltotalPrice=0;
$accompany_name='';
$actotalPrice=0;
$ecompany_name='';
$etotalPrice=0;
$totalMovingCost = 0;
$totalHiringCost = 0;
$grandTotal = 0;
$orderID = '';
$vehicle_id = 0;
$labour_id = 0;
$labour_number = 0;
$ac_id = 0;
$ac_worker_number = 0;
$e_id = 0;
$e_worker_number = 0;

?>

<!-- Retriving Data From Session Variable -->
            
<?php 
    if(isset($_SESSION["movingInformation"])){
        $miID = $_SESSION["movingInformation"]["bookingID"];
        $totalMovingCost = $_SESSION["movingInformation"]["totalCalculation"];
         }
    
    if(isset($_SESSION["hired_car"])){
        foreach($_SESSION["hired_car"] as $keys => $values)
        {
            $vehicle_id = $values['carID'];
            $vehicle_type =  $values["name"];
            $vehicle_price = $values["price"];
        }
    }
    
    if(isset($_SESSION["hired_labour"])){

        foreach($_SESSION["hired_labour"] as $keys => $values)
        {
            $labour_id = $values['labID'];
            $lcompany_name = $values["comName"];
            $labour_number = $values['hiredLab'];
            $labour_price = $values["wages"];
            $ltotalPrice = $values["wages"]*$values['hiredLab'];
        }
    }

    if(isset($_SESSION["hired_ac"])){   
        foreach($_SESSION["hired_ac"] as $keys => $values)
        {
            $ac_id = $values['acID'];
            $accompany_name = $values["comName"];
            $ac_worker_number = $values['hiredAC'];
            $ac_price = $values["wages"];
            $actotalPrice = $values["wages"]*$values['hiredAC'];
        }
    }

    if(isset($_SESSION["hired_electrician"])){    
        foreach($_SESSION["hired_electrician"] as $keys => $values)
        {
            $e_id = $values['elecID'];
            $ecompany_name = $values["comName"];
            $e_worker_number = $values['hiredElectrician'];
            $e_price = $values["wages"];
            $etotalPrice = $values["wages"]*$values['hiredElectrician'];
        }
    }
            
?>






<!-- Retrive Moving Information -->
<?php
    $movingInfo = Booking::find_by_id($miID);
    
?>

<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
        <!-- Moving Information -->
            <div class="col-6">
            <?php if($movingInfo == true){ ?>
                <h3>Moving Information</h3>
                <div class="row">
                    <div class="col-6"><label>Present Address: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->presentAddress ?></label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label>Moving Address: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->newAddress ?></label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label>Moving Date: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->movingDate ?></label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label>Moving Type House/Office: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->type ?></label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label>Present Ofiice/House Floor: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->presentFloor ?></label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label>New Ofiice/House Floor: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->newFloor ?></label></div>
                </div>
                <?php if($movingInfo->type === "House"){?>
                <div class="row">
                    <div class="col-6"><label>House Bed Room: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->houseTypeDetails ?></label></div>
                </div>
                <?php }else{ ?>
                <div class="row">
                    <div class="col-6"><label>Present Office Size: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->officeAreaOne ?> sq. ft</label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label>Present Office Size: </label></div>
                    <div class="col-6"><label><?php echo $movingInfo->officeAreaTwo ?> sq. ft</label></div>
                </div>
                <?php } }else{  ?>
                    <h3>No Moving Information</h3>
                    <?php } ?>
                <div class="row">
                    <div class="col-6"><label>Total Cost: </label></div>
                    <?php $totalHiringCost = $vehicle_price + $ltotalPrice + $actotalPrice + $etotalPrice; 
                    ?>
                    <?php if(!empty($totalMovingCost)){?>
                    <div class="col-6"><label><?php echo number_format($totalMovingCost,2) ?></label></div>
                    <?php } ?>
                </div>
            </div>
            <!-- Cart Information -->
            
            <div class="col-6">
                <h3>Hiring Information</h3>
                <div class="row">
                    <div class="col-6"><label><?php echo $vehicle_type ?></label></div>
                    <div class="col-6"><label>&#2547; <?php echo $vehicle_price ?></label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label><?php echo $lcompany_name ?> </label></div>
                    <div class="col-6"><label>&#2547; <?php echo $ltotalPrice ?></label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label><?php echo $accompany_name ?> </label></div>
                    <div class="col-6"><label>&#2547; <?php echo $actotalPrice ?></label></div>
                </div>
                <div class="row">
                    <div class="col-6"><label><?php echo $ecompany_name ?> </label></div>
                    <div class="col-6"><label>&#2547; <?php echo $etotalPrice ?></label></div>
                </div>
                
                <div class="row">
                    <div class="col-6"><label>Total </label></div>
                    <div class="col-6"><label>&#2547; <?php echo number_format($totalHiringCost,2)  ?></label></div>
                </div>
            
            </div>
        </div>
        
        
        <div class="row section-padding">
        <div class="col-6">
        <?php $user = User::find_by_id($id) ?>
        <h3>Customer Information</h3>
            <div class="row">
                <div class="col-6"><label>Customer Name</label></div>
                <div class="col-6"><label><?php echo $user->name ?></label></div>
            </div>
            <div class="row">
                <div class="col-6"><label>Phone Number</label></div>
                <div class="col-6"><label><?php echo $user->phone ?></label></div>
            </div>
            <!-- Orders -->
        <?php
        if(is_post_request()) {
                
        $args = $_POST['order'];
        $orders = new Order($args);
        $result = $orders->save();


        if($result == true){
            $orderID = $orders->id;
            $totalHiringCost = $vehicle_price + $ltotalPrice + $actotalPrice + $etotalPrice;
            $grandTotal = $totalHiringCost + $totalMovingCost;
            
            $sql = "INSERT INTO `booking_details`(`order_id`, `vehicle_id`, `labour_id`, `hired_labour_number`, `ac_id`, `hired_ac_number`, `electrician_id`, `hired_electrician_number`, `booking_id`, `total_amount`) VALUES ($orderID, $vehicle_id, $labour_id, $labour_number, $ac_id, $ac_worker_number, $e_id, $e_worker_number, $miID, $grandTotal)";
            
            $myresults = Database::$database->query($sql);

            if(isset($_SESSION["book_intruments"]) && !empty($_SESSION["book_intruments"])){
                foreach($_SESSION["book_intruments"] as $keys => $values){

                    $sql = "INSERT INTO `ordered_instruments`(`order_id`, `instruments_id`, `quantity`, `price`) VALUES ($orderID, {$values['instruID']}, {$values['instruQuantity']}, {$values['instruprice']})";
                    
                    $myresults = Database::$database->query($sql);
                }
            }

            // Update Movers

            if(!empty($vehicle_id)){
                $sql = "UPDATE vehicle SET isHired = 1 WHERE id = $vehicle_id";
                    $result = Database::$database->query($sql);
                }

                if(!empty($labour_id)){
                    $sql = "UPDATE labour SET isHired = 1 WHERE id = $labour_id";
                        $result = Database::$database->query($sql);
                    }
                
                if(!empty($ac_id)){
                    $sql = "UPDATE aircondition SET isHired = 1 WHERE id = $ac_id";
                        $result = Database::$database->query($sql);
                    }

                if(!empty($e_id)){
                    $sql = "UPDATE electrician SET isHired = 1 WHERE id = $e_id";
                        $result = Database::$database->query($sql);
                    }
                    // Unset The Session
                    if(isset($_SESSION["movingInformation"])){
                        unset ($_SESSION["movingInformation"]);
                    }
                    if(isset($_SESSION["hired_car"])){
                        unset ($_SESSION["hired_car"]);
                    }
                    if(isset($_SESSION["hired_labour"])){
                        unset ($_SESSION["hired_labour"]);
                    }
                    if(isset($_SESSION["hired_ac"])){
                        unset ($_SESSION["hired_ac"]);
                    }
                    if(isset($_SESSION["hired_electrician"])){
                        unset ($_SESSION["hired_electrician"]);
                    }
                    if(isset($_SESSION["book_intruments"])){
                        unset ($_SESSION["book_intruments"]);
                    }
                    $session->message('Your Hiring And Order placed successfully.');
                    redirect_to(url_for('index.php'));
            
                }
                    

                } else {
                    $orders = new Order();
                }

        ?>
            <!-- End -->
            <?php echo display_errors($orders->errors); ?>
            <form action = "checkout.php" method="post">
            <div class="row">
                <div class="col-6"><h3>Reporting Address</h3></div>
            </div>
            <div class="row">
        
                <div class="col-3">
                    <label class="">House No</label>
                    <input type="text" class="form-control" name = "order[houseNo]" placeholder="74/C" >
                </div>
                <div class="col-3">
                    <label class="">Road No</label>
                    <input type="text" class="form-control" name = "order[roadNo]" placeholder="10" >
                </div>
                <div class="col-3">
                    <label class="">Post Code</label>
                    <input type="text" class="form-control" name = "order[postCode]" placeholder="1200" >
                </div>
                <div class="col-3">
                    <label class="">City/Area</label>
                    <input type="text" class="form-control" name = "order[city]" placeholder="Dhanmondi" >
                </div>
                <input type="hidden" class="form-control" name = "order[user_id]" value = "<?php echo $id ?>" placeholder="Dhanmondi" >
                
            </div>
            <div class="row">
                <div class="col-3">
                    
                </div>
                <div class="col-3">
                    
                </div>
                <div class="col-3">
                    
                </div>
                <div class="col-3">
                    <button class="btn btn-primary mt-5" type="submit">Confirm Your Hire</button>
                </div>  
            </div>
            </form>
        </div>
        <div class="col-6">
            <h3>Instruments Information</h3>
            <?php 
            $instrumentPrice = 0;
            if(isset($_SESSION["book_intruments"]) && !empty($_SESSION["book_intruments"])){?>
                
                <table class="table caption-top">
                    
                    <thead>
                        <tr>
                        
                        <th scope="col">Instrument Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($_SESSION["book_intruments"] as $keys => $values){ ?>
                        <tr>
                        <td><?php echo $values['instruName'] ?></td>
                        <td><?php echo $values['instruQuantity'] ?></td>
                        <td><?php echo $values['instruprice'] ?></td>
                        </tr>
                        <?php $instrumentPrice = $instrumentPrice + ($values['instruprice']*$values['instruprice']) ?>
                        <?php } ?>
                        <tr>
							<td colspan="2" align="right">Total</td>
							<td align="right">&#2547; <?php echo number_format($instrumentPrice, 2); ?></td>
							<td></td>
					</tr>
                    </tbody>
                    </table>
                    <?php } ?>

            </div>
    </div>
   
    </div>
</section>










<?php include_once 'includes/footer.php'?>