<?php
  require "database.php";
  $umpires = json_decode($_GET["umpires"]);
  $selectAll = $_GET["selectall"];
  $final = [];
  if($selectAll){
    $final = DB::query("SELECT * FROM users ORDER BY Surname, Firstname");
    for($i = 0; $i < count($final); $i++){
      unset($final[$i]["Password"]);
    }
  }
  else{
  foreach($umpires as $umpire){
    $umpireRow = DB::queryFirstRow("SELECT * FROM users WHERE ID=%i", $umpire["ID"]);
    unset($umpireRow["Password"]);
    $final[] = $umpireRow;
  }
}
echo json_encode($final);

?>
