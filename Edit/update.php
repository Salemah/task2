<?php
//insert.php;

if (isset($_POST["name"])) {

    $connect = new PDO("mysql:host=localhost;dbname=task", "root", "");
  
    for ($count = 0; $count < count($_POST["name"]); $count++) {
        $query = " UPDATE `attendance` SET `name`=:name,`attendance`=:attendance WHERE id=:atdid ";

        $statement = $connect->prepare($query);
        $statement->execute(
            array(

                ':name'  => $_POST["name"][$count],
                ':attendance' => $_POST["attendance"][$count],
                ':atdid' => $_POST["atdid"][$count]

            )
        );
    }
    $result = $statement->fetchAll();
    if (isset($result)) {
        echo 'ok';
    }
}
?>
