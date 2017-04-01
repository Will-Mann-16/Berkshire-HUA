<?php
    require "database.php";
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $row = DB::queryFirstRow('SELECT * FROM `users` WHERE `Email`="'.$email.'"');
    if(!$row){
        echo "Incorrect Email";
    }else{
        if(password_verify($password, $row["Password"])){
            session_start();
            $_SESSION["logged_in"] = true;
            unset($row["Password"]);
            $_SESSION["user_data"] = $row;
            if($_POST["remember"] == true){
              setcookie("huauserid", $row["UserKey"], time()*60*60*365, '/');
            }
            if($row["Admin"] == "true")
            {
              echo "Correct Login - Admin";
            }
            else{
              echo "Correct Login - User";
            }
            
        }else{
            echo "Incorrect Password";
        }
    }
?>
