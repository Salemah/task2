<?php
$conn = mysqli_connect("localhost", "root", "", "task");
$select = "SELECT * FROM student";
$result = mysqli_query($conn, $select);
?>
 
 
<?php
while ($row = mysqli_fetch_array($result)) {

?>
<option value="<?php  $row['name']; ?>"><?php echo $row['name']; ?></option>
<?php
  
}
?>

