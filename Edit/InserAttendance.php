<?php
//insert.php;

if (isset($_POST["name"])) {

    $connect = new PDO("mysql:host=localhost;dbname=task", "root", "");
  
    for ($count = 0; $count < count($_POST["name"]); $count++) {
        $query = "INSERT INTO attendance (name, attendance) 
                        VALUES( :name , :attendance)";

        $query ="UPDATE `attendance` SET `name`=:name,`attendance`=:attendance' WHERE 1";

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


// onclick="AttendanceEdit(<?php echo $row['id']; 
