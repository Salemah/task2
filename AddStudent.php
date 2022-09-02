<?php
$conn = mysqli_connect("localhost","root","","task");
extract ($_POST);

if(isset($_POST['name'])){
    $query = "INSERT INTO `student`( `name`) VALUES ('$name') ";
   $query= mysqli_query($conn,$query);
   if( $query){
   echo "Data insert Successfull";
   }
   else{
    echo "Data insert faild";
   }

}


?>