<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>
<?php require_booking_info() ?>


<?php 
$ecount=0;
    if(is_post_request()){
        $eID = $_GET['id'];
        $number = $_POST["hiredWorkerNumber"];
        $sql = "SELECT worker_number FROM `electrician` WHERE id = '$eID'";
        $totalElectrician = Electrician::$database->query($sql);
        foreach($totalElectrician as $keys => $values){
            $dbaseData =  $values['worker_number'];
        } 
        // echo $dbaseData;exit;
        if($number > $dbaseData){
            echo '<script>alert("They Don\'t have this amount of worker !")</script>';
        }

        if(isset($_SESSION['hired_electrician']) && empty($_SESSION['hired_electrician'])) {
        $hiredElectricianArray = [];
        if(isset($_SESSION['hired_electrician'])) {  
        $ecount = count($_SESSION["hired_electrician"]); 
        $hiredElectricianArray = array(
                'elecID'		   	=>	$_GET["id"],
                'comName'		=>	$_POST["companyName"],
                'hiredElectrician'      =>  $_POST["hiredWorkerNumber"],
                'wages'			=>	$_POST["workerWages"]
                
            );
            
            $_SESSION['hired_electrician'][$ecount] = $hiredElectricianArray;
        }else{
        $hiredElectricianArray = array(
            'elecID'		   	=>	$_GET["id"],
            'comName'		=>	$_POST["companyName"],
            'hiredElectrician'      =>  $_POST["hiredWorkerNumber"],
            'wages'			=>	$_POST["workerWages"]
            
        );
        $_SESSION['hired_electrician'][0] = $hiredElectricianArray;
        }
        redirect_to(url_for('hire_ac.php'));
        }else{
            foreach($_SESSION["hired_electrician"] as $keys => $values)
		    {
				unset($_SESSION["hired_electrician"][$keys]);
		    }

            $hiredElectricianArray = [];
        if(isset($_SESSION['hired_electrician'])) {  
        $ecount = count($_SESSION["hired_electrician"]); 
        $hiredElectricianArray = array(
                'elecID'		   	=>	$_GET["id"],
                'comName'		=>	$_POST["companyName"],
                'hiredElectrician'      =>  $_POST["hiredWorkerNumber"],
                'wages'			=>	$_POST["workerWages"]
                
            );
            
            $_SESSION['hired_electrician'][$ecount] = $hiredElectricianArray;
        }else{
        $hiredElectricianArray = array(
            'elecID'		   	=>	$_GET["id"],
            'comName'		=>	$_POST["companyName"],
            'hiredElectrician'      =>  $_POST["hiredWorkerNumber"],
            'wages'			=>	$_POST["workerWages"]
            
        );
        $_SESSION['hired_electrician'][0] = $hiredElectricianArray;
        }
        redirect_to(url_for('hire_ac.php'));
        }

        

        
    }

    if(isset($_GET["action"]))
    {
        if($_GET["action"] == "delete")
        {
            foreach($_SESSION["hired_electrician"] as $keys => $values)
            {
                if($values["elecID"] == $_GET["id"])
                {
                    unset($_SESSION["hired_electrician"][$keys]);
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
                                <h3>Electrician Hiring</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ bradcam_area  -->


   
    <section class="blog_area section-padding">
        <div class="container"> 
        <h3 class="text-center mb-5"><u>Moving Service Provider</u></h3>
            <div class="row border-top border-bottom align-items-center">  
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name of the Company</th>
                    <th scope="col">Number of worker</th>
                    <th scope="col">Insert your number of worker</th>
                    <th scope="col">Per Labour Wage</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>
                <?php
                $current_page = $_GET['page'] ?? 1;
                $per_page = 5;
                $sql = "SELECT COUNT(*) AS 'count' FROM (SELECT * FROM electrician WHERE isHired = 0 AND isApproved = 1) AS q1";
                $totallabours = Database::$database->query($sql);
                foreach($totallabours as $key => $values){
                $total_count = $values['count'];
                }

                $pagination = new Pagination($current_page, $per_page, $total_count);

                $sql = "SELECT * FROM electrician WHERE isHired = 0 AND isApproved = 1 ";
                $sql .= "LIMIT {$per_page} ";
                $sql .= "OFFSET {$pagination->offset()}";
                $electricians = Electrician::find_by_sql($sql);
                foreach ($electricians as $electrician) {
                ?>
                <form method="post" action="hire_electrician.php?action=add&id=<?php echo $electrician->id ?>">
                        <tr>
                        <td><?php echo $electrician->id ?></td>
                        <td><?php echo $electrician->company_name ?></td>
                        <td><?php echo $electrician->worker_number ?></td>
                        <td><input type="number" min="1" max="<?php echo $electrician->worker_number ?>" name="hiredWorkerNumber" style="width: 20%;"  value="1"/></td>
                        <td><?php echo $electrician->per_worker_wages ?></td>
                        <input type="hidden" name="companyName"  value="<?php echo $electrician->company_name ?>"/>
                        <input type="hidden" name="workerWages"  value="<?php echo $electrician->per_worker_wages ?>"/>
                        <td><input type="submit" class="btn btn-outline-warning" value="Hire"></td>
                        </tr>
                    
                    </form> 
                    <?php } ?>
                    </tbody>
                    </table>
                    
                        
                
                
            </div>
            <p style="color:red">If You hire one worker it will take more time to complete your work.</p>
            <?php
                  $url =('hire_electrician.php');
                  echo $pagination->page_links($url);
                ?>
                 
            
        </div> 
            <div class="container"> 
                <div class="row">
                    <div class="col-2"><a href="hire_labour.php"><button class="btn btn-outline-danger mt-5">Back</button></a></div>
                    <div class="col-9"></div>
                    <div class="col-1"><a href="hire_ac.php" ><button class="btn btn-outline-danger mt-5">Skip</button></a></div>
                </div>
            </div>
    </section>
    <!--================Blog Area =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>