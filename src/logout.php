<?php
  session_start();
  session_destroy();
  $_SESSION = [];
  if(isset($_COOKIE["huauserid"])){
    setcookie("huauserid", "", time() + 0.1, '/');
  }
  header("location: index.php");
?>
