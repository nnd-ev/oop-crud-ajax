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
    
    public function select($table_name){
        $niz = array();
        $query = "SELECT * FROM ".$table_name."";
        $result = mysqli_query($this->con, $query);
        while($row= mysqli_fetch_assoc($result)){
            $niz[] = $row;
        }
        return $niz;
    }

    public function select_whereID($table_name, $id){
        $niz= array();
        $query = "SELECT * FROM ".$table_name." WHERE id=".$id;
        $result = mysqli_query($this->con, $query);
        while($row= mysqli_fetch_assoc($result)){
            $niz[] = $row;
        }
        return $niz;
    }



    public function delete($table_name, $where_condition){
        $condition='';
        foreach($where_condition as $key=>$value){
            $condition .=$key." = ".$value;
        }
        $query = "DELETE FROM ".$table_name." WHERE ".$condition."";
        if(mysqli_query($this->con, $query)){
            return true;
        }
    }


    public function update($table_name, $fields, $where_condition){
        $query='';
        $condition='';
        foreach($fields as $key=>$value){
            $query.= $key ."='".$value."', ";
        }
        $query = substr($query, 0, -2);
        /*This code will convert array to string like this-  
           input - array(  
                'key1'     =>     'value1',  
                'key2'     =>     'value2'  
           )  
           output = key1 = 'value1', key2 = 'value2'*/ 

        foreach($where_condition as $key=>$value){
            $condition .=$key ."='".$value."' AND ";
        }
        $condition = substr($condition, 0, -5);
        $query = "UPDATE ".$table_name." SET ".$query. " WHERE ".$condition."";
        if(mysqli_query($this->con, $query)){
            return true;
        }


    }

}
