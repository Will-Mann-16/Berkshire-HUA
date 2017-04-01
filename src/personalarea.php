<!DOCTYPE html>
<html>
    <head>
        <?php
            require "php/dependencies.php";
         ?>
        <script src="js/personal-area-script.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/personal-area-style.css"/>
        <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAC8Ec_Wp02bh8CEGolZQp8mtQuKmR2BwI">
   </script>
    </head>
    <body>
        <?php
        session_start();
        $requireLogin = !isset($_SESSION["logged_in"]);
        if(!$requireLogin){
          echo '<script>
          var userData = '.json_encode($_SESSION["user_data"]).';
          setUserData(userData);
          </script>';
        }
            require "navbar.php";
            $userData = $_SESSION["user_data"];
            $name = $userData["Firstname"].' '.$userData["Surname"];
        ?>
        <div class="container">
            <h1 class="header">Personal Area</h1>
            <div class="flex-coloumn left col-6">
              <div class="key card">
                <h1>Key</h1>
                <div class="flex-row">
                <p class="today">Today</p>
                <p class="fixture">Fixture that is available for you to umpire</p>
                <p class="fixture-involved">Fixture that you've been selected for</p>
                <p class="fixture-past">Fixture that you've previously umpired</p>
                <p class="fixture-unavailable">Fixture that has enough umpires</p>
              </div>
              </div>
            <div class="card">
              <h1>Availability</h1>
              <div class="calender">
                <div class="month">
                <ul>
                  <li class="prev" onclick="previousMonth();">&#10094;</li>
                  <li class="next" onclick="nextMonth();">&#10095;</li>
                  <li class="month-name">

                  </li>
                </ul>
              </div>
              <ul class="weekdays">
                <li>M</li>
                <li>T</li>
                <li>W</li>
                <li>T</li>
                <li>F</li>
                <li>S</li>
                <li>S</li>
              </ul>
              <ul class="days">
              </ul>
            </div>
            </div>
            <div class="card">
              <h1>Personal Details</h1>
              <form class="card-form" id="update-user-info">
                <label>Firstname*</label>
                <input type="text" name="firstname" placeholder="Enter Firstname" <?php echo 'value='.$userData["Firstname"]; ?> />
                <label>Surname*</label>
                <input type="text" name="surname" placeholder="Enter Surname" <?php echo 'value='.$userData["Surname"]; ?> />
                <label>Email*</label>
                <input type="email" name="email" placeholder="Enter Email" <?php echo 'value='.$userData["Email"]; ?> />
                <label>Mobile Telephone Number</label>
                <input type="text" name="mobile" placeholder="Enter Mobile Telephone Number" <?php if(isset($userData["MobileNo"])) { echo 'value='.$userData["MobileNo"];} ?> />
                <label>House Telephone Number</label>
                <input type="text" name="house" placeholder="Enter House Telephone Number" <?php if(isset($userData["HouseNo"])) {echo 'value='.$userData["HouseNo"]; }?> />
                <strong></strong>
                <input type="button" class="button" style="float: right;" id="update-submit" value="Submit"/>
              </form>
            </div>
          </div>
          <div class="flex-coloumn right col-6">
            <div class="card">
              <h1>Fixtures</h1>
              <div class="fixtures-content">
              </div>
            </div>
            <div class="card personal-area-map">
              <h1>Map</h1>
              <p id="map-address"></p>
              <div id="gmap" style="height: 400px"></div>
            </div>
            <div class="card">
              <h1>Useful Contact Details</h1>
              <div class="contact-content">
              </div>
          </div>
         </div>
    </body>
</html>
