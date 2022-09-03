<?php

$id =  $_GET['id'];

$connect = new PDO("mysql:host=localhost;dbname=task", "root", "");
$output = '';
$query = "SELECT * FROM attendance ORDER BY name ASC";
$query2 = "SELECT * FROM `attendance` WHERE id=$id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$statement2 = $connect->prepare($query2);
$statement2->execute();
$resultt = $statement2->fetchAll();
$count = count($resultt);




foreach ($resultt as $rowe) { 
   
    $rowe["name"] ;
    $rowe["name"] ;
  
  
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class="container " style="margin: 30px;">
        <span id="error"></span>
        
        <form method="post" id="insert_form">
           
            <table class="table" id="mytablle">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Attendance</th>
                        <th>add</th>


                    </tr>
                </thead>
                <tbody id="tbody2">
                    
                        <tr>

                            <td><select name="name[]" class="name form-select ">
                                    <option value="">Select Name</option>
                                    <?php
                                    foreach ($result as $row) {
                                    ?>
                                        <option  <?php 
                                        if($rowe["id"] == $row["id"]  ) 
                                        {
                                           ?>
                                            selected
                                            <?php 
                                        }
                                        
                                        ?> value="<?php echo $row["name"] ?>">

                                            <?php echo $row["name"] ?>
                                        </option>
                                    <?php
                                    }


                                    ?>


                                </select>
                            </td>


                            <td>
                                <select name="attendance[]" class="attendance form-select ">
                                    <option 
                                     <?php
                                     if($rowe["attendance"]=="Present")
                                     {
                                        ?>
                                        selected
                                        <?php
                                     }
                                     
                                     ?>
                                     value="Present">Present</option>
                                    <option
                                    <?php
                                     if($rowe["attendance"]=="Absent")
                                     {
                                        ?>
                                        selected
                                        <?php
                                     }
                                     
                                     ?>
                                    
                                    
                                    value="Absent">Absent</option>
                                     
                                  

                                </select>
                            </td>
                            <td>
                                <input hidden type="text"  name="atdid[]" class="atdid" id="" value="<?php echo $rowe["id"] ?>">
                                
                            </td>
                        </tr>
                   

                </tbody>
            </table>


            <div align="center">
                <input type="submit" name="submit" class="btn btn-info" value="Update" />
            </div>
        </form>


    </div>





    <script src="https://kit.fontawesome.com/75f8bf0fae.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
       
          $(document).ready(function() {
            $('#insert_form').on('submit', function(event) {
               
               event.preventDefault();
               var error = '';
            
               $('.name').each(function() {
                   var count = 1;
                   if ($(this).val() == '') {
                       error += "<p>Select Name " + count + " Row</p>";
                       return false;
                   }
                   count = count + 1;
               });

               $('.attendance').each(function() {
                   var count = 1;
                   if ($(this).val()=='') {
                    error += "<p>Present Or Absent " + count + " Row</p>";
                       return false;
                   }
                   count = count + 1;
               });

            
               var form_data=$(this).serialize();
               if (error == '') {
                   if(form_data){ 
                       alert(form_data)
                   }
                  
                   $.ajax({
                      
                       url:"update.php",
                       method:"POST",
                       data:form_data,
                       success: function(data) {
                           if (data == 'ok') {
                            
                               $('#mytablle').find("tr:gt(1)").remove();
                               $('#error').html('<div class="alert alert-success">Attendance Updated</div>');
                           }
                       }
                   });
               } else {
                   $('#error').html('<div class="alert alert-danger">' + error + '</div>');
               }
           });

           });
    </script>
</body>

</html>






<?php
// $conn = mysqli_connect("localhost","root","","task");

// $id = $_POST['Attendanceid'];

// $select = "SELECT `id`, `name`, `attendance` FROM `attendance` WHERE $id";
// $result = mysqli_query($conn, $select);

// if($result ){
//     echo "Dlete succesfull";
// }
// else{
//     echo "delete failded";
// }
?>