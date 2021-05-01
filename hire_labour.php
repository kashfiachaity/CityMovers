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
$lcount=0;
    if(is_post_request()){
        $lID = $_GET['id'];
        $number = $_POST["hiredLabourNumber"];
        $sql = "SELECT labour_number FROM `labour` WHERE id = '$lID'";
        $totalLabour = Labour::$database->query($sql);
        foreach($totalLabour as $keys => $values){
            $dbaseData =  $values['labour_number'];
        } 
        // echo $dbaseData;exit;
        if($number > $dbaseData){
            echo '<script>alert("They Don\'t have this amount of worker!")</script>';
        }

        if(isset($_SESSION['hired_labour']) && empty($_SESSION['hired_labour'])) {
        $hiredLabourArray = [];
        if(isset($_SESSION['hired_labour'])) {  
        $lcount = count($_SESSION["hired_labour"]); 
        $hiredLabourArray = array(
                'labID'		   	=>	$_GET["id"],
                'comName'		=>	$_POST["companyName"],
                'hiredLab'      =>  $_POST["hiredLabourNumber"],
                'wages'			=>	$_POST["labourWages"]
                
            );
            
            $_SESSION['hired_labour'][$lcount] = $hiredLabourArray;
        }else{
        $hiredLabourArray = array(
            'labID'		   	=>	$_GET["id"],
            'comName'		=>	$_POST["companyName"],
            'hiredLab'      =>  $_POST["hiredLabourNumber"],
            'wages'			=>	$_POST["labourWages"]
            
        );
        $_SESSION['hired_labour'][0] = $hiredLabourArray;
        }
        redirect_to(url_for('hire_electrician.php'));
        }else{
            foreach($_SESSION["hired_labour"] as $keys => $values)
		    {
				unset($_SESSION["hired_labour"][$keys]);
		    }
            $hiredLabourArray = [];
        if(isset($_SESSION['hired_labour'])) {  
        $lcount = count($_SESSION["hired_labour"]); 
        $hiredLabourArray = array(
                'labID'		   	=>	$_GET["id"],
                'comName'		=>	$_POST["companyName"],
                'hiredLab'      =>  $_POST["hiredLabourNumber"],
                'wages'			=>	$_POST["labourWages"]
                
            );
            
            $_SESSION['hired_labour'][$lcount] = $hiredLabourArray;
        }else{
        $hiredLabourArray = array(
            'labID'		   	=>	$_GET["id"],
            'comName'		=>	$_POST["companyName"],
            'hiredLab'      =>  $_POST["hiredLabourNumber"],
            'wages'			=>	$_POST["labourWages"]
            
        );
        $_SESSION['hired_labour'][0] = $hiredLabourArray;
        }
        redirect_to(url_for('hire_electrician.php'));


        
        }

        

    
    }

    if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["hired_labour"] as $keys => $values)
		{
			if($values["labID"] == $_GET["id"])
			{
				unset($_SESSION["hired_labour"][$keys]);
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
                                <h3>Labour Hiring</h3>
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
                    <th scope="col">Number of Labour</th>
                    <th scope="col">Insert your number of labour</th>
                    <th scope="col">Per Labour Wage</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>
                <?php
                $current_page = $_GET['page'] ?? 1;
                $per_page = 5;
                $sql = "SELECT COUNT(*) AS 'count' FROM (SELECT * FROM labour WHERE isHired = 0 AND isApproved = 1) AS q1";
                $totallabours = Database::$database->query($sql);
                foreach($totallabours as $key => $values){
                $total_count = $values['count'];
                }

                $pagination = new Pagination($current_page, $per_page, $total_count);

                $sql = "SELECT * FROM labour WHERE isHired = 0 AND isApproved = 1 ";
                $sql .= "LIMIT {$per_page} ";
                $sql .= "OFFSET {$pagination->offset()}";
                $labours = Labour::find_by_sql($sql);
                foreach ($labours as $labour) {
                ?>
                <form method="post" action="hire_labour.php?action=add&id=<?php echo $labour->id ?>">
                    <tr>
                    <td><?php echo $labour->id ?></td>
                    <td><?php echo $labour->company_name ?></td>
                    <td><?php echo $labour->labour_number ?></td>
                    <td><input type="number" min="1" max="<?php echo $labour->labour_number ?>" name="hiredLabourNumber" style="width: 20%;" value="1"/></td>
                    <td><?php echo $labour->labour_wages ?></td>
                    <input type="hidden" name="companyName"  value="<?php echo $labour->company_name ?>"/>
                    <input type="hidden" name="labourWages"  value="<?php echo $labour->labour_wages ?>"/>
                    <td><input type="submit" class="btn btn-outline-warning" value="Hire"></td>
                    </tr>
                </form> 
                <?php } ?>
                </tbody>
                </table>
                    
                        
                
                
            </div>
            <p style="color:red">If You hire one labor it will take more time to complete your work.</p>
            <?php
            $url =('hire_labour.php');
            echo $pagination->page_links($url);
        ?>
                 
            
        </div> 
            <div class="container"> 
                <div class="row">
                    <div class="col-2"><a href="hire_vehicle.php"><button class="btn btn-outline-danger mt-5">Back</button></a></div>
                    <div class="col-9"></div>
                    <div class="col-1"><a href="hire_electrician.php" ><button class="btn btn-outline-danger mt-5">Skip</button></a></div>
                </div>
            </div>
    </section>
    <!--================Blog Area =================-->

    <!-- Include Footer -->
<?php include_once 'includes/footer.php'?>