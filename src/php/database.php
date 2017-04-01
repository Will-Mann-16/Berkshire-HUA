<?php
    require_once "dependencies/meekrodb.2.3.class.php";
    $config = parse_ini_file('D:/xampp/htdocs/Berkshire-HUA/config/config.ini', true);
    DB::$user = $config["database"]["username"];
    DB::$password = $config["database"]["password"];
    DB::$dbName = $config["database"]["dbname"];
?>
