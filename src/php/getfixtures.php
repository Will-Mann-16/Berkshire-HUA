<?php
  require "database.php";
  $rows = DB::query("SELECT * FROM fixtures ORDER BY Timestamp DESC");
  $result = [];
  $id = $_GET["id"];
  foreach($rows as $row){
    $timestamp = new DateTime($row["Timestamp"]);
    //if(new DateTime() <= $timestamp){
      $umpires = json_decode($row["Umpires"]);
      if(in_array($id, $umpires) || in_array(-1, $umpires)){
      $row["Timestamp"] = $timestamp->format(DateTime::ISO8601);
      $umpiresFinal = [];
      for($i = 0; $i < count($umpires); $i++){
        $unassigned = $umpires[$i] == -1  ? true : false;
        if(!$unassigned){
       $umpire = DB::queryFirstRow("SELECT * FROM users WHERE ID=%i", $umpires[$i]);
        $umpiresFinal[] = array("Firstname" => $umpire["Firstname"], "Surname" => $umpire["Surname"], "ID" => $umpire["ID"]);
      }else{
        $umpiresFinal[] = array("Firstname" => "", "Surname" => "", "ID" => -1);
      }
      }
      $row["Umpires"] = $umpiresFinal;
      $result[] = $row;
  }
  }
  echo json_encode($result);
?>
