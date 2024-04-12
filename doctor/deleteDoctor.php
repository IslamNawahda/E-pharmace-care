<?php
include("config.php");

$uid = $_GET['id'];
$msg = "";

$sql = "DELETE FROM doctor WHERE doctorId = '$uid'";
$result = mysqli_query($con, $sql);

if ($result) {
    $msg = "<p class='alert alert-success'>Doctor Deleted</p>";
    header("Location: doctorslist.php?msg=$msg");
} else {
    $msg = "<p class='alert alert-warning'>Doctor Not Deleted</p>";
    header("Location: doctorslist.php?msg=$msg");
}

mysqli_close($con);
?>
