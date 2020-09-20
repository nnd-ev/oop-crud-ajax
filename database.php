<?php

class Database{
    public $con;
    public $error;
    public function __construct(){
        $this->con = mysqli_connect("localhost", "root", "", "testing");
        if(!$this->con){
            echo "Database connection Error" + mysqli_connect_error($this->con);
        } 
    }

    public function insert($table_name, $data){
        $query = "INSERT INTO ".$table_name." (";
        $query.= implode(",", array_keys($data)). ')VALUES (';
        $query.= "'" .implode("','", array_values($data)). "')";

        if(mysqli_query($this->con, $query)){
            return true;
        }else{
            echo mysqli_error($this->con);
        }
    }

}
