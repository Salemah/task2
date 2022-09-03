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
 
 

<td><select name="name[]" class="name form-select "><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>


 
