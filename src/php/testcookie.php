<?php
  require_once "database.php";
  if(isset($_COOKIE["huauserid"])){
    $row = DB::queryFirstRow("SELECT * FROM users WHERE UserKey=%s", $_COOKIE["huauserid"]);
    $_SESSION["logged_in"] = true;
    unset($row["Password"]);
    $_SESSION["user_data"] = $row;
  }
?>
