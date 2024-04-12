<?php
include "config.php";
$cid = $_GET['id'];
$sql = "DELETE FROM coupon WHERE couponId  = {$cid}";
$result = mysqli_query($con, $sql);
if ($result == true) {
    $msg = "<p class='alert alert-success'>Coupon Deleted</p>";
    header("Location:viewCoupons.php?msg=$msg");
} else {
    $msg = "<p class='alert alert-warning'>Coupon Not Deleted</p>";
    header("Location:viewCoupons.php?msg=$msg");
}
mysqli_close($con);
?>
