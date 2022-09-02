<?php
$conn = mysqli_connect("localhost", "root", "", "task");
$select = "SELECT * FROM student";
$result = mysqli_query($conn, $select);

while ($row = mysqli_fetch_array($result)) {

?>
    <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td> <button onclick="Studentdelete(<?php echo $row['id']; ?>)">X</button></td>
    </tr>



<?php
  
}



?>