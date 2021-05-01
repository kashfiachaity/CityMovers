<div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-12 d-block d-lg-none">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="img/logo1.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a  href="index.php">home</a></li>
                                            <li><a  href="service.php">Services</a></li>
                                            <li><a href="about.php">about</a></li>
                                            <li><a href="order_instruments.php">Order Instruments</a></li>
                                            <li><a href="pricing.php">Our Pricing </a>
                                            <?php if($session->is_logged_in()) {
                                                $id = $session->user_id;
                                                $user = User::find_by_id($id);
                                            ?>
                                            <li class="justify-content-end"><a href="#"><?php echo $user->name ?> <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="show_customers.php?id=<?php echo $user->id?>">Account Info</a></li>
                                                <?php if($user->userRole === 'Admin'){?>
                                                <li><a href="adminDashboard.php">My Dashboard</a></li>
                                                <?php }elseif($user->userRole === 'Customer'){ ?>
                                                <li><a href="userDashboard.php">My Dashboard</a></li>
                                                <?php }elseif($user->userRole === 'Vehicle'){ ?>
                                                <li><a href="vehicleDashboard.php">My Dashboard</a></li>
                                                <?php }elseif($user->userRole === 'Labour'){ ?>
                                                <li><a href="labourDashboard.php">My Dashboard</a></li>
                                                <?php }elseif($user->userRole === 'AC'){ ?>
                                                <li><a href="acDashboard.php">My Dashboard</a></li>
                                                <?php }elseif($user->userRole === 'Electrician'){ ?>
                                                <li><a href="electricianDashboard.php">My Dashboard</a></li>
                                                <?php } ?>
                                                <li><a href="logout.php">Log Out</a></li>
                                            </ul>
                                            <?php }else{?>
                                                <li><a href="user_reg.php?type=customer">Get Service </a>
                                                <li><a href="user_reg.php">Join Us </a></li>
                                                <li class="loginbtn"><a href="loginForm.php" style="color:#fff;"><i class="ti-lock" style="font-size: 15px; margin-right:2px;"></i>Log In </a></li>
                                           <?php } ?>
                                        </li>
                                            <li> <a href="cartItem.php">
                                            <i class="fa fa-shopping-cart" style="font-size: 25px;"></i>
                                            <?php 
                                                $countCar = 0;
                                                $countLabour = 0;
                                                $countElectrician = 0;
                                                $countAC = 0;
                                                $countInstruments = 0;
                                                if(isset($_SESSION['hired_car']) && !empty($_SESSION['hired_car'])){
                                                  $countCar = count($_SESSION['hired_car']);
                                                } ;
                                                if(isset($_SESSION['hired_labour']) && !empty($_SESSION['hired_labour'])){
                                                  $countLabour = count($_SESSION['hired_labour']);
                                                };
                                                if(isset($_SESSION['hired_electrician']) && !empty($_SESSION['hired_electrician'])){
                                                  $countElectrician = count($_SESSION['hired_electrician']);
                                                } ;
                                                if(isset($_SESSION['hired_ac']) && !empty($_SESSION['hired_ac'])){
                                                  $countAC = count($_SESSION['hired_ac']);
                                                };
                                                if(isset($_SESSION['book_intruments']) && !empty($_SESSION['book_intruments'])){
                                                  $countInstruments = count($_SESSION['book_intruments']);
                                                };
                                                 $totalCount= ($countCar + $countLabour + $countElectrician + $countAC + $countInstruments);
                                            ?>
                                            <span class="cartItems" >
                                                (<?php 
                                                    echo ($totalCount);
                                                  ?>)
                                                
                                            </span>
                                        </a></li>
                                       
                                        </ul>
                                        
                                    </nav>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->