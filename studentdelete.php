<?php
$conn = mysqli_connect("localhost","root","","task");

$id = $_POST['userid'];
$select = "DELETE FROM `student` WHERE id=$id";
$result = mysqli_query($conn, $select);

if($result ){
    echo "Dlete succesfull";
}
else{
    echo "delete failded";
}

?>