<!DOCTYPE html>
<html>
    <head>
        <?php
            require "php/dependencies.php";
        ?>
    </head>
    <body>
        <?php
            session_start();
            $requireLogin = !isset($_SESSION["logged_in"]);
            require "navbar.php";
        ?>
        <div class="container">
            <h1 class="header">Personal Area</h1>
            <p id="name"></p>
         </div>
    </body>
</html>