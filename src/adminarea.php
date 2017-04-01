<!DOCTYPE html>
<html>
    <head>
        <?php
            require "php/dependencies.php";
         ?>
        <script src="js/admin-area-script.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/admin-area-style.css"/>
    </head>
    <body>
        <?php
        session_start();
        $requireLogin = !isset($_SESSION["logged_in"]);
        if($_SESSION["user_data"]["Admin"] != "true"){
          header("location: personalarea.php");
        }
            require "navbar.php";
            $userData = $_SESSION["user_data"];
            $name = $userData["Firstname"].' '.$userData["Surname"];
        ?>
        <div class="container">
            <h1 class="header">Admin Area</h1>
            <div class="flex-coloumn left col-6">
            </div>
          <div class="flex-coloumn right col-6">
         </div>
    </body>
</html>
