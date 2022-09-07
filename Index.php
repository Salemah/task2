<?php
//index.php

$connect = new PDO("mysql:host=localhost;dbname=task", "root", "");

function fill_unit_select_box($connect)
{ 
 $output = '';
 $query = "SELECT * FROM student ORDER BY name ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();

 
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["name"].'">'.$row["name"].'</option>';
 
 }

 return $output;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="finall.css">
</head>
<title>Document</title>
</head>

<body>
    <div class="">
        <div class="container addstudent-style">


            <div class="row">
                <div class="col-auto">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Student Name">
                </div>
                <div class="col-auto">
                    <button onclick="StudentAdd()" type="submit" class="btn btn-primary mb-3">Add Student</button>
                </div>
            </div>

        </div>
        <!-- view all student -->
        <div class="container  " style="margin: 30px;" id="allstudentview">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <tbody id="tbody">


                </tbody>
            </table>


        </div>
        <!-- end view -->
        <!-- Attendnce start -->
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
                        <div>
                            <tr>
                                
                                <td><select name="name[]" class="name form-select ">
                                    <option value="">Select Name</option>
                                    <?php echo fill_unit_select_box($connect); ?></select>
                                </td>
                                

                                <td>
                                    <select name="attendance[]" class="attendance form-select ">
                                    <option value="" >Select</option>
                                   
                                        <option value="Present">Present</option>
                                        <option value="Absent">Absent</option> 

                                    </select>
                                </td>
                                <td>
                                    <a class="form-control btn btn-success btn-icon active" id="add" style="color: white; ">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        </div>

                    </tbody>
                </table>

                <div align="center">
                    <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                </div>
            </form>
  </div>


    </div>
    <!-- JS  -->

    <script src="https://kit.fontawesome.com/75f8bf0fae.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            document.getElementById("allstudentview").style.display = "none";
        });

        function StudentAdd() {

            var name = $("#name").val();
            $.ajax({
                url: "AddStudent.php",
                method: "POST",
                data: {
                    name: name
                },
                success: function(data) {
                    read();

                }

            })
            document.getElementById("allstudentview").style.display = "block";
        }

        function read() {

            var read = "";
            $.ajax({
                url: "studentlist.php",
                method: "POST",
                data: {
                    read: read
                },
                success: function(data) {

                    $("#tbody").html(data);
                }
            });

        }

        function Studentdelete(id) {
            $.ajax({
                url: "studentdelete.php",
                method: "POST",
                data: {
                    userid: id
                },
                success: function() {
                    read();

                }
            })
        }
          $(document).ready(function() {
            var count = 1;
            $('#add').click(function() {
                var x = 0;
                var read = "";
                $.ajax({
                    url: "addmore.php",
                    method: "POST",
                    data: {
                        read: read
                    },
                    success: function(data) {
                        count = count + 1;
                        // var html_code ="<div id='row" + count + ">  ";
                        var html_code = "<tr id='row" + count + "'>";
                        html_code += data;
                        html_code += `<td>
                        <select name="attendance[]" class="attendance form-select">
                        <option value="" >Select</option>
                           <option value="Present" >Present</option>
                            <option value="Absent">Absent</option>

                         </select>
                         </td>`;
                        html_code += "<td><div class='d-inline-flex '> <a type='button' name='remove' data-row='row" + count + "' class='remove form-control btn btn-success btn-icon active me-3 '  ><i class='fa fa-minus'></i></a><br> <a type='button' name='admid' data-row='row" + count + "'class='admid form-control btn btn-success btn-icon active'  style='color: white; '><i class='fa fa-plus'></i></a></div>  </td>";
                        html_code += "</tr>";
                        // html_code += "</div>";
                        $('#tbody2').append(html_code);

                    }
                });
            });

            $(document).on('click', '.remove', function() {

                var delete_row = $(this).data("row");
                // alert(delete_row);
                $('#' + delete_row).remove();
            });

               $(document).on('click', '.admid', function() {
                var newrow = $(this).data("row");
                alert(newrow);
                var x = 0;
                var read = "";
                $.ajax({
                    url: "addmore.php",
                    method: "POST",
                    data: {
                        read: read
                    },
                    success: function(data) {
                        count = count + 1;
                        var html_code = "<tr style='background:red' id='row" + count + "'>";
                        html_code += data;
                        html_code += `<td>
                        <select name="attendance[]" class="attendance form-select">
                        <option value="" >Select</option>
                           <option value="Present" >Present</option>
                            <option value="Absent">Absent</option>

                         </select>
                         </td>`;
                        html_code += "<td><div class='d-inline-flex '> <a type='button' name='remove' data-row='row" + count + "' class='remove form-control btn btn-success btn-icon active me-3 '  ><i class='fa fa-minus'></i></a><br> <a data-row='row" + count + "'class='admid form-control btn btn-success btn-icon active'  style='color: white; '><i class='fa fa-plus'></i></a></div>  </td>";
                        html_code += "</tr>";
                        $('#' + newrow).after(html_code);
                        // $('#mytablle').append(html_code);

                    }
                });
            });




            // 

           
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
                      
                       url:"insert.php",
                       method:"POST",
                       data:form_data,
                       success: function(data) {
                           if (data == 'ok') {
                            
                               $('#mytablle').find("tr:gt(1)").remove();
                               $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
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