<?php
require_once "database.php";
require_once "validation.php";
 $db= new Database();
 $validation = new validation();
 $success_message = "";

 
 if(isset($_POST["action"]) && $_POST["action"] == "Load_posts"){
    $result_array = array(); 
    
    $sql = "Select * from tbl_posts";
    $result = mysqli_query($db->con, $sql);
    if($result->num_rows > 0){
        while($row= mysqli_fetch_assoc($result)){
            array_push($result_array, $row);
        }
    }
    echo json_encode($result_array);
    exit();
}


if(isset($_POST["action"]) && $_POST["action"] == "Insert_post"){
    $post = $validation->filterName($_POST["post_title"]);
    $post_desc = $validation->filterName($_POST["post_desc"]);
    if(!$post && !$post_desc){
        echo 'Sva polja su obavezna';
        exit();
    }else{
         $insert_data = array(
        'post_title' => mysqli_real_escape_string($db->con, $_POST['post_title']),
        'post_desc' => mysqli_real_escape_string($db->con, $_POST['post_desc'])
    );
    $db->insert('tbl_posts', $insert_data);
    echo 'Data Inserted';  
    exit();
    } 
}

if(isset($_POST["action"]) && $_POST["action"]== "Delete_post"){
    $where = array(
        'post_id' => $_POST["user_id"] 
    );
    if($db->delete("tbl_posts", $where)){
        echo "Succesfully deleted data";
    }
    exit();
}

if(isset($_POST["action"]) && $_POST["action"]== "Update_post"){
    $update_data= array(
        'post_title' => mysqli_real_escape_string($db->con, $_POST['post_title']),
        'post_desc' => mysqli_real_escape_string($db->con, $_POST['post_desc'])
    );
    $where_condition = array(
        'post_id' => $_POST["post_id"]
    );
    
    if($db->update("tbl_posts", $update_data, $where_condition)){
        echo "Success";
    }

}