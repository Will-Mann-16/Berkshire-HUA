<!DOCTYPE html>
<html>
    <head>
        <?php
            require "php/dependencies.php";
        ?>
        <script>
          $(function(){
            drawCalender();
          });
          function drawCalender(){
            var today = new Date();
            var month = today.getMonth();
            var year = today.getFullYear();
            var daysInMonth = getDaysInMonth(month + 1, year);
            var html = '<tr>';
            var dayTally = 0;
            for(var i = 1; i < daysInMonth; i++){
              var date = new Date(year, month, i);
              var day = date.getDay();
              var mDay = date.getDate();
              if(i == 1){
                var difference = 6 - day;
                for(var j = 1; j < difference; j++){
                  html += '<td></td>';
                  dayTally++;
                }
              }
              if(date.toDateString() == today.toDateString()){
                  html += '<td class="active">' + mDay + '</td>';
              }else{
                html += '<td>' + mDay + '</td>';
              }
              dayTally++;
              if(dayTally == 7 && i != daysInMonth - 1){
                html += '</tr><tr>';
                dayTally = 0;
              }
            }
            html += '</tr>';
            $(".calender").append(html);
          }
          function getDaysInMonth(month, year){
            return (new Date(year, month, 0).getDate());
          }
        </script>
        <link rel="stylesheet" type="text/css" href="css/personal-area-style.css"/>
    </head>
    <body>
        <?php
            session_start();
            $requireLogin = !isset($_SESSION["logged_in"]);
            require "navbar.php";
            $userData = $_SESSION["user_data"];
            $name = $userData["Firstname"].' '.$userData["Surname"];
        ?>
        <div class="container">
            <h1 class="header">Personal Area</h1>
            <div class="card col-6">
              <h1>Availability</h1>
              <table class="calender" style="width: 100%;">
                <tr>
                  <th>Mon</th>
                  <th>Tues</th>
                  <th>Weds</th>
                  <th>Thurs</th>
                  <th>Fri</th>
                  <th>Sat</th>
                  <th>Sun</th>
                </tr>
              </table>
            </div>
            <div class="card col-6">
              <h1>Personal Details</h1>
              <form class="card-form" id="update-user-info">
                <label>Firstname</label>
                <input type="text" name="firstname" placeholder="Enter Firstname" <?php echo 'value='.$userData["Firstname"]; ?> />
                <label>Surname</label>
                <input type="text" name="surname" placeholder="Enter Surname" <?php echo 'value='.$userData["Surname"]; ?> />
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter Email" <?php echo 'value='.$userData["Email"]; ?> />
              </form>
            </div>
         </div>
    </body>
</html>
