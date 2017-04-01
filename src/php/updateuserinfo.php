<?php
  require "database.php";
  $firstname = $_POST["firstname"];
  $surname = $_POST["surname"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  $house = $_POST["house"];
  $userkey = $_POST["userKey"];
  DB::update("users", array('Firstname' => $firstname, "Surname" => $surname, "Email" => $email, "MobileNo" => $mobile, "HouseNo" => $house), "UserKey=%s", $userkey);
  if(!isset($_SESSION)){
    session_start();
  }
  $_SESSION["user_data"] = DB::queryFirstRow("SELECT * FROM users WHERE UserKey=%s", $userKey);
  echo true;
?>
