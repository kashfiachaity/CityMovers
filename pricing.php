<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Our Pricing</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Align Area -->
	<div class="whole-wrap">
		<div class="container box_1170">
			<div class="section-top-border">
				<h3 class="mb-30">Pricing For House</h3>
				<div class="row">
					<div class="col-md-6">
						<img src="img/elements/house.png" alt="" class="img-fluid">
					</div>
                    <?php $pricings = Pricing::find_all();
                    foreach ($pricings as $pricing) { ?>
					<div class="col-md-6 mt-sm-20">
                    
							<ul class="unordered-list">
								<li>For Each Bed Room of House We Charge &#2547; <?php echo $pricing->roomPrice ?> </li>
								<li>For Present House Floor We Charge &#2547; <?php echo $pricing->floorPrice ?> </li>
								<li>For New House Floor We Charge &#2547; <?php echo $pricing->floorPrice ?></li>
								<li>Per Kilometer distance we charge &#2547; <?php echo $pricing->distancePrice ?></li>
							</ul>
						
					</div>
				</div>
			</div>
			<div class="section-top-border text-right">
				<h3 class="mb-30">Pricing For Office</h3>
				<div class="row">
                <div class="col-md-6 mt-sm-20 " style="text-align: left;">
                    
                    <ul class="unordered-list">
                        <li>One Thousand Square Feet of present area of office We Charge &#2547; <?php echo $pricing->officeAreaPrice ?></li>
                        <li>One Thousand Square Feet of new area of office We Charge &#2547; <?php echo $pricing->officeAreaPrice ?> </li>
                        <li>For Present Office Floor We Charge &#2547; <?php echo $pricing->floorPrice ?></li>
                        <li>For New Office Floor We Charge &#2547; <?php echo $pricing->floorPrice ?></li>
                        <li>Per Kilometer distance we charge &#2547; <?php echo $pricing->distancePrice ?></li>
                    </ul>
                
            </div>
            <?php } ?>
					<div class="col-md-6">
						<img src="img/elements/office.png" alt="" class="img-fluid">
					</div>
				</div>
			</div>
        </div>
    </div>
    <!-- counter_area  -->
<div class="counter_area">
  <div class="container">
    <div class="offcan_bg">
      <div class="row">
        <div class="col-xl-3 col-md-3">
          <div class="single_counter text-center">
            <h3><span class="counter">42</span> <span>+</span></h3>
            <p>Company Registered</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-3">
          <div class="single_counter text-center">
            <h3><span class="counter">97</span> <span>+</span></h3>
            <p>Moved House</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-3">
          <div class="single_counter text-center">
            <h3><span class="counter">342</span></h3>
            <p>Happy Client</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-3">
          <div class="single_counter text-center">
            <h3><span class="counter">245</span></h3>
            <p>Business Done</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /counter_area  -->

<!-- testimonial_area  -->
<div class="testimonial_area">
  <div class="container">
    <div class="row">
      <div class="col-xl-7">
        <div class="testmonial_active owl-carousel">
          <div class="single_carousel">
            <div class="single_testmonial text-center">
              <div class="quote">
                <img src="img/svg_icon/quote.svg" alt="" />
              </div>
              <p>
                Donec imperdiet congue orci consequat mattis. Donec rutrum
                porttitor sollicitudin. Pellentesque id dolor tempor sapien
                feugiat ultrices.
              </p>
              <div class="testmonial_author">
                <div class="thumb">
                  <img src="img/case/testmonial.png" alt="" />
                </div>
                <h3>Robert Thomson</h3>
                <span>Business Owner</span>
              </div>
            </div>
          </div>
          <div class="single_carousel">
            <div class="single_testmonial text-center">
              <div class="quote">
                <img src="img/svg_icon/quote.svg" alt="" />
              </div>
              <p>
                Donec imperdiet congue orci consequat mattis. Donec rutrum
                porttitor sollicitudin. Pellentesque id dolor tempor sapien
                feugiat ultrices.
              </p>
              <div class="testmonial_author">
                <div class="thumb">
                  <img src="img/case/testmonial.png" alt="" />
                </div>
                <h3>Robert Thomson</h3>
                <span>Business Owner</span>
              </div>
            </div>
          </div>
          <div class="single_carousel">
            <div class="single_testmonial text-center">
              <div class="quote">
                <img src="img/svg_icon/quote.svg" alt="" />
              </div>
              <p>
                Donec imperdiet congue orci consequat mattis. Donec rutrum
                porttitor sollicitudin. Pellentesque id dolor tempor sapien
                feugiat ultrices.
              </p>
              <div class="testmonial_author">
                <div class="thumb">
                  <img src="img/case/testmonial.png" alt="" />
                </div>
                <h3>Robert Thomson</h3>
                <span>Business Owner</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /testimonial_area  -->


    </div>
  </div>
</div>
<!-- Estimate_area end  -->

<!-- contact_location  -->
<div class="contact_location">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="location_left">
          <div class="logo">
            <a href="index.html">
              <img src="img/logo1.png" alt="" />
            </a>
          </div>
          <ul>
            <li>
              <a href="#"> <i class="fa fa-facebook"></i> </a>
            </li>
            <li>
              <a href="#"> <i class="fa fa-google-plus"></i> </a>
            </li>
            <li>
              <a href="#"> <i class="fa fa-twitter"></i> </a>
            </li>
            <li>
              <a href="#"> <i class="fa fa-youtube"></i> </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-md-3">
        <div class="single_location">
          <h3><img src="img/icon/address.svg" alt="" /> Location</h3>
          <p>61/D, Green road, Farm Gate Dhaka-1205</p>
        </div>
      </div>
      <div class="col-xl-3 col-md-3">
        <div class="single_location">
          <h3><img src="img/icon/support.svg" alt="" /> Location</h3>
          <p>
            +880 1785 4745 7127 <br />
            support@citymovers.com
          </p>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Include Footer -->
<?php include_once 'includes/footer.php'?>