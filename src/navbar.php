<nav class="topnav">
    <a class="topnav-links" href="index.php">Home</a>
    <a class="topnav-links" href="about.php">About</a>
    <a class="topnav-links" href="personalarea.php">Personal Area</a>
    <?php
    if(!isset($_SESSION)){
        session_start();
        include_once "php/testcookie.php";  
    }
    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
        $name = htmlspecialchars_decode($_SESSION["user_data"]["Firstname"].' '.$_SESSION["user_data"]["Surname"]);
        echo '<div class="dropdown align-right"><a class="dropbtn topnav-links">Welcome back, '.$name.'</a>
        <div class="dropdown-content">
        <a href="logout.php">Logout</a>
        </div>
        </div>';
    }else{
        echo '<a class="login-open align-right topnav-links">Login</a>';
    }

    ?>
    <span class="icon" onclick="toggleNavbar();">
        <div class="animated-icon">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </span>
</nav>
<script>
    var toggled = false;

    function toggleNavbar() {
        if (!toggled) {
            $(".animated-icon").toggleClass("icon-change");
            $(".topnav .topnav-links").css({
                "display": "block",
                "float": "none",
                "text-align": "left"
            });
            $(".topnav .dropbtn").css({
              "display": "inline-block"
            });
            toggled = true;
        } else {
            $(".animated-icon").toggleClass("icon-change");
            $(".topnav a:not(:first-child)").css({
                "display": "none"
            });
            $(".topnav .dropbtn").css({
              "display": "none"
            });
            toggled = false;
        }
    }
</script>
<link rel="stylesheet" type="text/css" href="css/navbar-style.css"/>
<?php
    require "login.php";
?>
