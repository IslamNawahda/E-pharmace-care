<?php
include("config.php");
$aid = $_GET['id'];
$sql = "DELETE FROM medicine WHERE medicineId  = {$aid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	$msg="<p class='alert alert-success'>medicineId  Deleted</p>";
	header("Location:medicineView.php?msg=$msg");
}
else{
	$msg="<p class='alert alert-warning'>medicineId  Not Deleted</p>";
	header("Location:medicineView.php?msg=$msg");
}
mysqli_close($con);
?>
