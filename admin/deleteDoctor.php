<?php
include "config.php";

$doctorId = $_GET['id'];
$msg = "";

$selectSql = "SELECT email FROM doctor WHERE doctorId = ?";
$selectStmt = mysqli_prepare($con, $selectSql);

if ($selectStmt === false) {
    die('Error preparing select statement: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($selectStmt, "i", $doctorId);
mysqli_stmt_execute($selectStmt);
mysqli_stmt_bind_result($selectStmt, $userEmail);

if (mysqli_stmt_fetch($selectStmt)) {
    // Free the result set
    mysqli_stmt_free_result($selectStmt);

    // Now that we have the email, delete the doctor from the doctors table
    $deleteDoctorSql = "DELETE FROM doctor WHERE doctorId = ?";
    $deleteDoctorStmt = mysqli_prepare($con, $deleteDoctorSql);

    mysqli_stmt_bind_param($deleteDoctorStmt, "i", $doctorId);
    $deleteDoctorResult = mysqli_stmt_execute($deleteDoctorStmt);

    // Free the result set
    mysqli_stmt_free_result($deleteDoctorStmt);

    // Delete the user from the users table
    $deleteUserSql = "DELETE FROM users WHERE email = ?";
    $deleteUserStmt = mysqli_prepare($con, $deleteUserSql);

    mysqli_stmt_bind_param($deleteUserStmt, "s", $userEmail);
    $deleteUserResult = mysqli_stmt_execute($deleteUserStmt);

    if ($deleteDoctorResult && $deleteUserResult) {
        $msg = "<p class='alert alert-success'>Doctor Deleted</p>";
        header("Location: doctorslist.php?msg=$msg");
    } else {
        $msg = "<p class='alert alert-warning'>Doctor Not Deleted</p>";
        header("Location: doctorslist.php?msg=$msg");
    }
    mysqli_stmt_free_result($deleteUserStmt);
} else {
    $msg = "<p class='alert alert-warning'>Doctor not found</p>";
    header("Location: doctorslist.php?msg=$msg");
}

mysqli_stmt_close($selectStmt);
mysqli_close($con);
?>
