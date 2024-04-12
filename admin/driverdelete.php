<?php
include "config.php";

$uid = $_GET['id'];
$msg = "";

$sql = "DELETE FROM users WHERE userId = '$uid'";
$result = mysqli_query($con, $sql);

if ($result) {
    $msg = "<p class='alert alert-success'>Driver Deleted</p>";
    header("Location: driversList.php?msg=$msg");
} else {
    $msg = "<p class='alert alert-warning'>Driver Not Deleted</p>";
    header("Location: driversList.php?msg=$msg");
}

mysqli_close($con);
?>
