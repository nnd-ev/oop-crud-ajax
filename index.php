<?php
require_once "database.php";
require_once "controller.php";

// $db= new Database();
// $success_message = "";
// if(isset($_POST['submit'])){
//     $insert_data = array(
//         'post_title' => mysqli_real_escape_string($db->con, $_POST['post_title']),
//         'post_desc' => mysqli_real_escape_string($db->con, $_POST['post_desc'])
//     );

//     if($db->insert('tbl_posts', $insert_data)){
//         $success_message = 'Post inserted';
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
</head>
<body>
    
<br /><br />  
           <div class="container" style="width:700px;">  
                <form method="post">  
                     <label>Post Title</label>  
                     <input type="text" name="post_title" class="form-control" />  
                     <br />  
                     <label>Post Description</label>  
                     <textarea name="post_desc" class="form-control"></textarea>  
                     <br />  
                     <input type="submit" name="submit" class="btn btn-info" value="Submit" />  
                     <span class="text-success">  
                     <?php  
                     if(isset($success_message))  
                     {  
                          echo $success_message;  
                     }  
                     ?>  
                     </span>  
                </form> 

</body>
</html>
 