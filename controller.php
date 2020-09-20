<?php
 $db= new Database();
 $success_message = "";
 if(isset($_POST['submit'])){
     $insert_data = array(
         'post_title' => mysqli_real_escape_string($db->con, $_POST['post_title']),
         'post_desc' => mysqli_real_escape_string($db->con, $_POST['post_desc'])
     );
 
     if($db->insert('tbl_posts', $insert_data)){
         $success_message = 'Post inserted';
     }
 }