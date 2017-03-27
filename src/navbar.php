<nav class="topnav">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="personalarea.php">Personal Area</a>
    <?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
        $name = htmlspecialchars_decode($_SESSION["user_data"]["Firstname"].' '.$_SESSION["user_data"]["Surname"]);
        echo '<a class="align-right">Welcome back, '.$name.'</a>';
    }else{
        echo '<a class="login-open align-right">Login</a>';
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
            $(".topnav a").css({
                "display": "block",
                "float": "none",
                "text-align": "left"
            });
            toggled = true;
        } else {
            $(".animated-icon").toggleClass("icon-change");
            $(".topnav a:not(:first-child)").css({
                "display": "none",
            });
            toggled = false;
        }
    }
</script>
<link rel="stylesheet" type="text/css" href="css/navbar-style.css"/>
<?php
    require "login.php";
?>