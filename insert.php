<?php
//insert.php;

if (isset($_POST["name"])) {

    $connect = new PDO("mysql:host=localhost;dbname=task", "root", "");
  
    for ($count = 0; $count < count($_POST["name"]); $count++) {
        $query = "INSERT INTO attendance (name, attendance) 
                        VALUES( :name , :attendance)";

        $statement = $connect->prepare($query);
        $statement->execute(
            array(

                ':name'  => $_POST["name"][$count],
                ':attendance' => $_POST["attendance"][$count]

            )
        );
    }
    $result = $statement->fetchAll();
    if (isset($result)) {
        echo 'ok';
    }
}
?>
<?php
// $connect = mysqli_connect("localhost", "root", "", "task");
// if (isset($_POST["name"])) {

//     $name = $_POST["name"];
//     $attendance = $_POST["attendance"];


//     $query = '';
//     for ($count = 0; $count < count($name); $count++) {

//         if ($count > 0) {
//         }
//         $item_name_clean = mysqli_real_escape_string($connect, $name[$count]);
//         $item_attendance_clean = mysqli_real_escape_string($connect, $attendance[$count]);



//         if ($item_name_clean != '' && $item_attendance_clean != '') {
//             $query .= '
//     INSERT INTO attendance(name, attendance) 
//     VALUES("' . $item_name_clean . '", "' . $item_attendance_clean . '")
//     ';
//         }
//     }
//     if ($query != '') {
//         if (mysqli_multi_query($connect, $query)) {
//             echo 'Item Data Inserted';
//         } else {
//             echo 'Error';
//         }
//     } else {
//         echo 'All Fields are Required';
//     }
//}
?>
