
<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>

<?php 
$icount = 0;
$dbaseData = 0;
if(is_post_request()){
    $lID = $_GET['id'];
    $number = $_POST["choosenQuantity"];
    $sql = "SELECT quantity FROM `moving_instruments` WHERE id = '$lID'";
    $totalLabour = Instruments::$database->query($sql);
    foreach($totalLabour as $keys => $values){
        $dbaseData =  $values['quantity'];
    } 
    // echo $dbaseData;exit;
    if($number > $dbaseData){
        echo '<script>alert("Stoke out!")</script>';
    }



    $bookedInstrumentArray = [];
    if(isset($_SESSION['book_intruments'])) {  
      $icount = count($_SESSION["book_intruments"]); 
    $bookedInstrumentArray = array(
            'instruID'		   	=>	$_GET["id"],
            'instruName'			=>	$_POST["instrumentName"],
            'instruQuantity'		=>	$_POST["choosenQuantity"],
            'instruprice'			=>	$_POST["instrumentPrice"]
            
        );
        $_SESSION['book_intruments'][$icount] = $bookedInstrumentArray;
    }else{
      $bookedInstrumentArray = array(
        'instruID'		   	=>	$_GET["id"],
        'instruName'		=>	$_POST["instrumentName"],
        'instruQuantity'	=>	$_POST["choosenQuantity"],
        'instruprice'		=>	$_POST["instrumentPrice"]
        
    );
      $_SESSION['book_intruments'][0] = $bookedInstrumentArray;
    }

    
    
}
if(isset($_GET["action"]))
    {
        if($_GET["action"] == "delete")
        {
            foreach($_SESSION["book_intruments"] as $keys => $values)
            {
                if($values["instruID"] == $_GET["id"])
                {
                    unset($_SESSION["book_intruments"][$keys]);
                    echo '<script>alert("Item Removed")</script>';
                    redirect_to(url_for('cartItem.php'));
                }

            }
        }
    }


?>

<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Instruments Order</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->


   
    <section class="blog_area section-padding">
        <div class="container"> 
        <h3 class="text-center mb-5"><u>Moving Instruments</u></h3>
            <div class="row border-top border-bottom align-items-center">  
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name of the Intruments</th>
                    <th scope="col">Insert your Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
                $instruments = Instruments::find_all();
                foreach ($instruments as $instrument) {
                ?>
                <form method="post" action="order_instruments.php?action=add&id=<?php echo $instrument->id ?>">
                        <tr>
                        <td><img class="img-fluid" style="height: 100px; width:100px;" src="uploads/<?php echo $instrument->instruments_image ?>"></td>
                        <td><?php echo $instrument->instruments_name ?></td>
                        <td><input type="number" name="choosenQuantity" min="1" max="<?php echo $instrument->quantity ?>" style="width: 20%;"  value="1"/></td>
                        <td><?php echo $instrument->instruments_price ?></td>
                        <input type="hidden" name="instrumentName"  value="<?php echo $instrument->instruments_name ?>"/>
                        <input type="hidden" name="instrumentPrice"  value="<?php echo $instrument->instruments_price ?>"/>
                        <td><input type="submit" class="btn btn-outline-warning" value="Book"></td>
                        </tr>
                    
                    </form> 
                    <?php } ?>
                    </tbody>
                    </table>
                    
                        
                
                
            </div>
                 
            
        </div> 
            <div class="container"> 
                <div class="row">
                    <div class="col-2"><a href="hire_ac.php"><button class="btn btn-outline-danger mt-5">Back</button></a></div>
                    <div class="col-9"></div>
                    <div class="col-1"><a href="cartItem.php"><button class="btn btn-outline-danger mt-5">Cart</button></a></div>
                </div>
            </div>
    </section>
    <!--================Blog Area =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>