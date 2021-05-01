<!-- Include Init File -->
<?php require_once('includes/initialize.php'); ?>
<!-- Include Head -->
<?php include_once 'includes/head.php'?>
<!-- Include Top Bar -->
<?php include_once 'includes/top-bar.php'?>
<!-- Include Navigation -->
<?php include_once 'includes/nav.php'?>
<?php echo display_session_message(); ?>


    

<?php
$distance = 0;
if(is_post_request()) {
  if(!empty($_POST['book']['presentAddress']) && !empty($_POST['book']['newAddress'])){
  $pvalue = $_POST['book']['presentAddress'];
  $nvalue = $_POST['book']['newAddress'];
  
// Starting API
 function getDistance($addressFrom, $addressTo, $unit = ''){
  // Google API key
  $apiKey = 'AIzaSyAwoKS3y1YDQGgDrTE1o-BQoCsdWdwSq5I';
  
  // Change address format
  $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
  $formattedAddrTo     = str_replace(' ', '+', $addressTo);
  
  // Geocoding API request with start address
  $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
  $outputFrom = json_decode($geocodeFrom);
  if(!empty($outputFrom->error_message)){
      return $outputFrom->error_message;
  }
  
  // Geocoding API request with end address
  $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
  $outputTo = json_decode($geocodeTo);
  if(!empty($outputTo->error_message)){
      return $outputTo->error_message;
  }
  
  // Get latitude and longitude from the geodata
  $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
  $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
  $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
  $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
  
  // Calculate distance between latitude and longitude
  $theta    = $longitudeFrom - $longitudeTo;
  $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
  $dist    = acos($dist);
  $dist    = rad2deg($dist);
  $miles    = $dist * 60 * 1.1515;
  
  // Convert unit and return distance
  $unit = strtoupper($unit);
  if($unit == "K"){
      return round($miles * 1.609344, 2);
  }elseif($unit == "M"){
      return round($miles * 1609.344, 2);
  }else{
      return round($miles, 2).' miles';
  }
}

$addressFrom = $pvalue;
$addressTo   = $nvalue;

// Get distance in km
$distance = getDistance($addressFrom, $addressTo, "K");

}



//
    
$args = $_POST['book'];
$args['distance'] = $distance;
$booking = new Booking($args);
$result = $booking->save();

if($result === true) {
  $bID = $booking->id;
  $room = $booking->houseTypeDetails;
  $distance = $booking->distance;
  $oAreaOne = $booking->officeAreaOne;
  $oAreaTwo = $booking->officeAreaTwo;
  $pFloor = $booking->presentFloor;
  $nFloor = $booking->newFloor;

  $pricingDetails = Pricing::find_all();
  foreach ($pricingDetails as $pricingDetail) {
        $distancePricing = $pricingDetail->distancePrice;
        $rprice = $pricingDetail->roomPrice;
        $officePrice = $pricingDetail->officeAreaPrice;
        $floorPrice = $pricingDetail->floorPrice;
  }
  
  if($room != 0){
    $totalCost =($distance * $distancePricing) + ($room * $rprice) + ($pFloor * $floorPrice) + ($nFloor * $floorPrice);
  }else{
    $totalCost = ($distance * $distancePricing) + ($oAreaOne/1000 * $officePrice) +($oAreaTwo/1000 * $officePrice) + ($pFloor * $floorPrice) + ($nFloor * $floorPrice);
  }


  $bookingInfo = [];
  $bookingInfo = array(
    'bookingID' => $bID,
    'totalCalculation' => $totalCost
  );
  
    $_SESSION["movingInformation"] = $bookingInfo;
  

    redirect_to(url_for('hire_vehicle.php'));
  

  
} else {
  // show errors
}

} else {
// display the form
  $booking = new Booking();
}

?>
<!-- slider_area_start -->
<div class="slider_area">
  <div class="single_slider d-flex align-items-center slider_bg_1">
    <div class="container align-content-center">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8"><?php echo display_errors($booking->errors); ?></div>
        <div class="col-2"></div>
      </div>
    <form action="index.php" method="post" >
    <div class="row">
    <div class="col-lg-2 col-md-2 "></div>
      <div class="col-lg-4 col-md-4 ">
        <input type="text" id="autocomplete" class="form-control" name = "book[presentAddress]" placeholder="Present Address" >
      </div>
      <div class="col-lg-4 col-md-4">
        <input type="text" id="autocomplete2"  class="form-control" name = "book[newAddress]" placeholder="Moving Address" >
      </div>
      <div class="col-lg-2 col-md-2 "></div>
    </div>
    <div class="row">
    <div class="col-lg-2 col-md-2 "></div>
      <div class="col-lg-4 col-md-4">
        <label for="movingDate" class="form-label" style="color:aliceblue">Moving Date</label>
        <input type="date" class="form-control" name = "book[movingDate]" placeholder="Moving Date" aria-label="First name">
      </div>
      <div class="col-lg-2 col-md-2 "></div>
      
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-2 "></div>
      <div class="col-lg-4 col-md-4 typeRadio mt-2">
        <input class="selectTypeOne" type="radio" value="House" name="book[type]" id="selectType ">
        <label class="radioImage typeSelectOne" style="color:aliceblue" for="typeSelect">House
        </label>
      </div>
      <div class="col-lg-4 col-md-4 typeRadio mt-2">
        <input class="selectTypeTwo" type="radio" value="Office" name="book[type]" id="selectType">
        <label class="radioImage typeSelectTwo" style="color:aliceblue" for="typeSelect">Office
        </label>
      </div>
      <div class="col-lg-2 col-md-2 "></div>
    </div>
    <!-- Drop Down -->
    <div class="row ">
      <div class="col-lg-2 col-md-2 "></div>
      <div class="col-lg-4 col-md-4 houseRoom typeRadio mt-2">
        <div class="col-lg-6 col-md-6  ml-2">
          <input class="form-check-input" type="radio" value="1" name="book[houseTypeDetails]" >
          <label class="form-check-label" style="color:aliceblue" for="flexRadioDefault1">
            1 Bed Room
          </label>
        </div>
        <div class="col-lg-6 col-md-6  ml-2">
          <input class="form-check-input" type="radio" value="2" name="book[houseTypeDetails]" >
          <label class="form-check-label" style="color:aliceblue" for="flexRadioDefault1">
            2 Bed Room
          </label>
        </div>
        <div class="col-lg-6 col-md-6  ml-2">
          <input class="form-check-input" type="radio" value="3" name="book[houseTypeDetails]" >
          <label class="form-check-label" style="color:aliceblue" for="flexRadioDefault1">
            3 Bed Room
          </label>
        </div>
        <div class="col-lg-6 col-md-6  ml-2">
          <input class="form-check-input" type="radio" value="4" name="book[houseTypeDetails]">
          <label class="form-check-label" style="color:aliceblue" for="flexRadioDefault1">
            4 Bed Room
          </label>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 "></div>
    </div>
    <!-- End -->

    <!-- Drop Down -->
    <div class="row ">
      <div class="col-lg-2 col-md-2 "></div>
      <div class="col-lg-4 col-md-4 officeRoom typeRadio mt-2">
        <div class="col-lg-9 col-md-9 mt-2">
          <input type="text" class="form-control" name="book[officeAreaOne]" placeholder="Present Office Area/Sq. Feet" aria-label="Last name">
        </div>
        <div class="col-lg-9 col-md-9 mt-2">
          <input type="text" class="form-control" name="book[officeAreaTwo]" placeholder="New Office Area/Sq. Feet" aria-label="Last name">
        </div>
      </div>
      <div class="col-lg-2 col-md-2 "></div>
    </div>
    <!-- End -->
   
    <div class="row">
    <div class="col-lg-2 col-md-2 "></div>
      <div class="col-lg-4 col-md-4 mt-2">
        <select class="form-select" name="book[presentFloor]" aria-label="Default select example">
          <option value="0" >Select Your Current House Floor</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="col-lg-4 col-md-4 mt-2">
        <select class="form-select" name="book[newFloor]" aria-label="Default select example">
          <option value="0" >Select Your New House Floor</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="col-lg-2 col-md-2 "></div>
    </div>
    <div class="row">
    <div class="col-lg-2 col-md-2 "></div>
    <div class="col-lg-4 col-md-4 mt-2"></div>
      <div class="col-lg-4 col-md-4 mt-2">
        <button  type="submit" class="genric-btn success-border">Submit</button>
      </div>
      <div class="col-lg-2 col-md-2 "></div>
    </div>
  </form>
      </div>
    </div>
  </div>
</div>
<!-- slider_area_end -->
  <script>
  var searchInput = 'autocomplete';
  
  $(document).ready(function () {
  var autocomplete;
  autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
    types: ['geocode'],
    /*componentRestrictions: {
    country: "USA"
    }*/
  });
    
  google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var near_place = autocomplete.getPlace();
  });
  });
  </script>
  <script>
  var searchInputTwo = 'autocomplete2';
  
  $(document).ready(function () {
  var autocompletetwo;
  autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInputTwo)), {
    types: ['geocode'],
    /*componentRestrictions: {
    country: "USA"
    }*/
  });
    
  google.maps.event.addListener(autocompletetwo, 'place_changed', function () {
    var near_placetwo = autocompletetwo.getPlace();
  });
  });
  </script>

<div class="transportaion_area">
  <div class="container">
    <div class="row">
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="single_transport">
          <div class="icon">
            <img src="img/svg_icon/hiring.png" alt="" />
          </div>
          <h3>Hiring</h3>
          <p>
            You can easily hire people in different sector of moving from here.
          </p>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="single_transport">
          <div class="icon">
            <img src="img/svg_icon/supplies.png" alt="" />
          </div>
          <h3>Order Instruments</h3>
          <p>
          You can order moving instruments for moving from here.
          </p>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="single_transport">
          <div class="icon">
            <img src="img/svg_icon/buildings.png" alt="" />
          </div>
          <h3>Whole City Service</h3>
          <p>
            You can hire moving service provider to move any place of the city.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="service_area">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="section_title mb-50 text-center">
          <h3>Services We Offer</h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <div class="service_active owl-carousel">
          <div class="single_service">
            <div class="thumb">
              <img src="img/service/1.jpg" alt="" />
            </div>
            <div class="service_info">
              <h3><a href="service_details.html">Hire Labour</a></h3>
              <p>We provide service to hire Labour</p>
            </div>
          </div>
          <div class="single_service">
            <div class="thumb">
              <img src="img/service/2.jpg" alt="" />
            </div>
            <div class="service_info">
              <h3><a href="service_details.html">Hire Vehicle</a></h3>
              <p>We provide service to hire Vehicle.</p>
            </div>
          </div>
          <div class="single_service">
            <div class="thumb">
              <img src="img/service/3.jpg" alt="" />
            </div>
            <div class="service_info">
              <h3><a href="service_details.html">Hire Electrician</a></h3>
              <p>We provide service to hire Electrician.</p>
            </div>
          </div>
          <div class="single_service">
            <div class="thumb">
              <img src="img/service/4.jpg" alt="" />
            </div>
            <div class="service_info">
              <h3><a href="service_details.html">Hire AC Mechanic</a></h3>
              <p>We provide service to hire AC Mechanic.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- contact_action_area  -->
<div class="contact_action_area">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-7 col-md-6">
        <div class="action_heading">
          <h3>100% verified man power</h3>
          <p>
            We register moving service provider after inspection and with their past experience.
          </p>
        </div>
      </div>
     
    </div>
  </div>
</div>
<!-- /contact_action_area  -->
<!-- chose_area  -->
<div class="chose_area"id="whyus">
  <div class="container">
    <div class="features_main_wrap">
      <div class="row align-items-center">
        <div class="col-xl-5 col-lg-5 col-md-6">
          <div class="about_image">
            <img src="img/about/about.png" alt="" />
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="features_info">
            <h3>Why Choose Us?</h3>
            <p>
              We give best moving service experience in the town.
            </p>
            <ul>
              <li>Hire multiple section service provider in one place.</li>
              <li>Know about the costing.</li>
              <li>Can Order moving instruments to reduce the moving work.</li>
            </ul>

            <div class="about_btn">
              <a class="boxed-btn3-line" href="about.html">About Us</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ chose_area  -->

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
<div class="testimonial_area" id="testimonial">
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

<!--/ contact_location  -->

<!-- Include Footer -->
<?php include_once 'includes/footer.php'?>

