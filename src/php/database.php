<?php
    class DB{
        protected static $connection;

        public function connect(){
            if(!isset(self::$connection)){
                $config = parse_ini_file('../../config/config.ini', true);
                self::$connection = new mysqli('localhost', $config['database']['username'], $config['database']['password'], $config['database']['dbname']);
            }
            if(self::$connection === false){

             }
            return self::$connection;
        }
    public function query($query){
        $connection = $this->connect();
        $result = $connection->query($query);
        return $result;
    }
    public function select($query){
        $rows = array();
        $result = $this->query($query);
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    public function quote($value){
        $connection = $this->connect();
        return "'".$connection->real_escape_string($value)."'";
    }
    public function insert($table, $data){
        $formats = '(';
        $values = '(';
        foreach($data as $key => $value){
            $formats .= "`".$key.'`, ';
            $values .= '"'.$value.'", ';
        }

        $formats = rtrim($formats, ',').')';
        $values = rtrim($values, ',').')';
        $this->query('INSERT INTO `'.$table.'` '.$formats.' VALUES '.$values);
    }
    public function update($table, $data, $identifier){
        $values = "";
        foreach($data as $key => $value){
            $values .= '`'.$key.'`="'.$value.'", ';
        }

        $values = rtrim($values, ',');
        $this->query('UPDATE `'.$table.'` SET '.$values.' WHERE '.$identifier);
    }
    public function delete($table, $identifier)
    {
        $this->query('DELETE FROM `'.$table.'` WHERE '.$identifier);
    }
    }

?>
