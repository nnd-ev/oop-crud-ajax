<?php

class Validation{
    

function check_empty($data){
    foreach($data as $value){
        if(empty($value)){
            return FALSE;
        }else{
            return $value;
        }
    }
}
    // Functions to filter user inputs
function filterName($data){
    // // Sanitize user name
    // $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // // Validate user name
    // if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     return $field;
    // } else{
    //     return FALSE;
    // }
    foreach($data as $value){
        $value = filter_var(trim($value), FILTER_SANITIZE_STRING);
        if(filter_var($value, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
           return $value;
        }else{
            return FALSE;
        }
    }
}    
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    } else{
        return FALSE;
    }
}
function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    } else{
        return FALSE;
    }
}
}