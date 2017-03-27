<?php
    require "database.php";
    $database = new DB();
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $row = $database->select('SELECT * FROM `users` WHERE `Email`="'.$email.'"');
    if(!$row){
        echo "Incorrect Email";
    }else{
        if(password_verify($password, $row[0]["Password"])){
            session_start();
            $_SESSION["logged_in"] = true;
            unset($row["Password"]);
            $_SESSION["user_data"] = $row[0];
            echo "Correct Login";
        }else{
            echo "Incorrect Password";
            echo $row[0]["Password"];
        }
    }
?>