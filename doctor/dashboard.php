<?php
session_start();
require "config.php";

if (!isset($_SESSION["adminId"])) {
        header("Location: ../login.php");
}

// Define an array for card data
$cardData = array(
    array(
        "icon" => "fe-users",
        "title" => "Users",
        "table" => "users",
        "color" => "bg-success"
    ),
    array(
        "icon" => "fe-users",
        "title" => "Doctors",
        "table" => "doctor",
        "color" => "bg-info"
    ),
    array(
        "icon" => "fe-users",
        "title" => "Medicines",
        "table" => "medicine",
        "color" => "bg-dark"
    ),
    array(
        "icon" => "fe-users",
        "title" => "Contact Messages",
        "table" => "contact",
        "color" => "bg-warning"
    ),
    array(
        "icon" => "fe-users",
        "title" => "Admin",
        "table" => "admin",
        "color" => "bg-primary"
    ),
    array(
        "icon" => "fe-users",
        "title" => "Drivers",
        "table" => "driver",
        "color" => "bg-danger"
    ),
    array(
        "icon" => "fe-users",
        "title" => "Payments",
        "table" => "medicine_users",
        "color" => "bg-success"
    ),
    array(
        "icon" => "fe-users",
        "title" => "Coupons",
        "table" => "coupon",
        "color" => "bg-info"
    )
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin Dashboard - Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Main Wrapper -->
    <!-- Header -->
    <?php include "header.php"; ?>
    <!-- /Header -->
    
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <p></p>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <?php foreach ($cardData as $data) : ?>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon <?php echo $data['color']; ?>">
                                        <i class="fe <?php echo $data['icon']; ?>"></i>
                                    </span>
                                </div>

                                <?php
                                $query = "SELECT COUNT(*) AS {$data['table']}_count FROM {$data['table']}";
                                $result = mysqli_query($con, $query);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    $count = $row["{$data['table']}_count"];
                                } else {
                                    $count = 0;
                                }

                                $maxValue = 50;
                                $progressWidth = ($count / $maxValue) * 100;
                                ?>

                                <div class="dash-widget-info">
                                    <h3><?php echo $count; ?></h3>
                                    <h6 class="text-muted"><?php echo $data['title']; ?></h6>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar <?php echo $data['color']; ?>" style="width: <?php echo $progressWidth; ?>%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- JavaScript and other scripts go here -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/js/chart.morris.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
