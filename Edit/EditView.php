<?php
//index.php

$connect = new PDO("mysql:host=localhost;dbname=task", "root", "");


$output = '';
$query = "SELECT * FROM attendance ORDER BY id ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<title>Document</title>
</head>

<body>
    <div class="">

        <div class="container " style="margin: 30px;">

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
                        <?php
                        foreach ($result as $row) { ?>

                            <tr>
                                <td>
                                    <?= $row["name"] ?>
                                </td>
                                <td>
                                    <?= $row["attendance"] ?>

                                </td>
                                <td>
                                    <a class="editatd form-control btn btn-success btn-icon active"
                                    data-id="<?php echo $row['id']; ?>"  style="color: white; ">
                                 
                                        Edit</i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
    <!-- JS  -->

    <script src="https://kit.fontawesome.com/75f8bf0fae.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.editatd', function() {
            
            var id = $(this).data('id');
            
            if (id != undefined && id != null) {
                window.location = 'Edit.php?id=' + id;
            }
        });


       
        $(document).ready(function() {
            var count = 1;
            $('#add').click(function() {
                var x = 0;
                var read = "";
                $.ajax({
                    url: "AddAttendance.php",
                    method: "POST",
                    data: {
                        read: read
                    },
                    success: function(data) {
                        count = count + 1;
                        var html_code = "<tr id='row" + count + "'>";
                        html_code += data;
                        html_code += `<td>
                        <select name="attendance[]" class="attendance form-select">
                        <option value="" >Select</option>
                           <option value="Present" >Present</option>
                            <option value="Absent">Absent</option>

                         </select>
                         </td>`;
                        html_code += "<td><a type='button' name='remove' data-row='row" + count + "' class='remove form-control btn btn-success btn-icon active '  ><i class='fa fa-minus'></i></a></td>";
                        html_code += "</tr>";
                        $('#mytablle').append(html_code);

                    }
                });
            });

            $(document).on('click', '.remove', function() {

                var delete_row = $(this).data("row");
                alert(delete_row);
                $('#' + delete_row).remove();
            });


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
                    if ($(this).val() == '') {
                        error += "<p>Present Or Absent " + count + " Row</p>";
                        return false;
                    }
                    count = count + 1;
                });


                var form_data = $(this).serialize();
                if (error == '') {
                    if (form_data) {
                        alert(form_data)
                    }

                    $.ajax({

                        url: "InserAttendance.php",
                        method: "POST",
                        data: form_data,
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