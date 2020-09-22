 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    
<br /><br />  
                <div class="container" style="width:700px;">  
                <div class="alert alert-danger display-error" style="display: none"></div>
                <form method="POST" id="user_from" onsubmit="insertData(event, 'user_from', 'Insert_post')">  
                     <label>Post Title</label>  
                     <input type="text" name="post_title" id="post_title" class="form-control" />  
                     <br />  
                     <label>Post Description</label>  
                     <textarea name="post_desc" id="post_desc" class="form-control"></textarea>  
                     <br />  
                     <div align="center">  
                               <input type="hidden" name="action" class="action" />  
                               <input type="hidden" name="id_post" id="id_post" class="action" />  
                               <input type="submit" name="button_action" id="button_action" class="btn btn-default" value="Insert"  />  
                               <input type="button" name="button_action" id="button_update" class="btn btn-default" value="Update" style="display: none;">  
                          </div> 
                     <span class="text-success">  
                     <?php  
                     if(isset($success_message))  
                     {  
                          echo $success_message;  
                     }  
                     ?>  
                     </span>  
                </form>  


                <br />  


                <div id="user_table" class="table-responsive">
                
                </div> 
                     <div id="records"></div>   
                  
            </div>

</body>
<script>
   $(document).ready(function(){
    load_data();
})
    function load_data(){
        var action = "Load_posts";
        $.ajax({
            url: "controller.php",
            method: "POST",
            data:{action: action},
            success: function(data){
                 
                var arr = JSON.parse(data);
                 
var string ='<table class="table table-bordered table-striped"><tr> <th width="30%">Title</th><th width="70%">Description</th></tr> ';
 
for(var item in arr){
    string+= '<tr>';
    string+= '<td>'+ arr[item].post_title + '</td>';
    string+= '<td>'+ arr[item].post_desc + '</td>';
    string+= '<td><button type="button" name="update" id="'+arr[item].post_id+'" class="btn btn-success btn-xs update">Update</button></td>';
    string+= '<td><button type="button" name="delete" id="'+arr[item].post_id+'" class="btn btn-danger btn-xs delete">Delete</button></td>';
    string+= '</tr>';
}
  
                string += '</table>'; 
             $("#records").html(string); 
            
            }
        });
    } 
   
   function insertData(event, form_name, insert_name){
    event.preventDefault();
    $('.action').val(insert_name); 
     var forma= document.querySelector('#'+form_name).getAttribute("id");
 
     $.ajax({
            url: "controller.php",
            method: "POST",
            data:new FormData(document.getElementById(''+form_name+'')),
            contentType : false,
            processData: false,
            success: function(data){
                alert(data);
                $('#user_from')[0].reset();
                load_data();
            }
        })
    }
    
    $(document).on('click', '.delete', function(){
        var user_id = $(this).attr("id");
   var action = "Delete_post";
   if(confirm("Are you sure you want to delete this?"))
   {
    $.ajax({
     url:"controller.php",
     method:"POST",
     data:{user_id:user_id, action:action},
     success:function(data)
     {
      alert(data);
      load_data();
     }
    });
   }
   else
   {
    return false;
   }
  });
 
  $(document).on('click', '.update', function(){  
                var user_id = $(this).attr("id");  
                var action = "Update_post";  
                 
                var title= $(this).closest('tr').find('td:nth-child(1)').text();
                var desc= $(this).closest('tr').find('td:nth-child(2)').text();
                 
                $("#post_title").val(title);
                $("#post_desc").val(desc);
                $("#id_post").val(user_id);
            
                $("#button_update").css("display","inline-block");
           });  

 $(document).on('click', "#button_update", function(){
    
    var post_id= $("#id_post").val();
    var post_title= $("#post_title").val();
    var post_desc= $("#post_desc").val();
    var action = "Update_post";

    $.ajax({
     url:"controller.php",
     method:"POST",
     data:{post_id:post_id, action:action, post_title:post_title,post_desc:post_desc},
     success:function(data)
     {
      alert(data);
      load_data();
      $("#button_update").css("display","none");
     }
    });
   

 });
     

    
 


</script>


</html>
 
