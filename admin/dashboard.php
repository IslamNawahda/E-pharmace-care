<?php
session_start();
require "config.php";

if (!isset($_SESSION["userId"])) {

    header("Location: ../login.php");
}
try {
    $stmt = $con->prepare("SELECT MONTH(s.sales_date) AS month, SUM(m.price * d.quantity) AS monthly_total
                            FROM sales s
                            JOIN details d ON s.id = d.sales_id
                            JOIN medicine m ON d.medicineId = m.medicineId
                            GROUP BY MONTH(s.sales_date)
                            ORDER BY month");

    // Check if the prepare statement was successful
    if (!$stmt) {
        throw new Exception("Error in preparing SQL statement: " . $con->error);
    }

    $stmt->execute();

    // Check if the query executed successfully
    if ($stmt) {
        $result = $stmt->get_result();

        $months = [];
        $totalPayments = [];

        while ($row = $result->fetch_assoc()) {
            $months[] = date('F', mktime(0, 0, 0, $row['month'], 1));
            $totalPayments[] = (float)$row['monthly_total'];
        }

        $stmt->close();
    } else {
        // Handle the case where the query fails
        throw new Exception("Error in executing SQL query: " . $con->error);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


$cardData = array(
    array("icon" => "fe-users","title" => "Users","table" => "users","color" => "bg-success","userType" =>"1"),
    array("icon" => "fe-users","title" => "Admin","table" => "users","color" => "bg-primary","userType" => "2"),
    array("icon" => "fe-users","title" => "Drivers","table" => "users","color" => "bg-danger","userType" => "4"),
    array( "icon" => "fe-users", "title" => "Doctors", "table" => "doctor", "color" => "bg-info" ),
    array( "icon" => "fe-users", "title" => "Medicines", "table" =>"medicine", "color" => "bg-dark" ),
    array( "icon" => "fe-users", "title" => "Contact Messages", "table" => "contact", "color" => "bg-warning" ),
    array( "icon" => "fe-users", "title" => "Payments", "table" => "details", "color" => "bg-success" ),
    array( "icon" => "fe-users","title" => "Coupons", "table" => "coupon", "color" => "bg-info" ) ); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
        <title>Admin Dashboard - Dashboard</title>
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/feathericon.min.css" />
        <link rel="stylesheet" href="assets/plugins/morris/morris.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            // Check if userType is specified and create a query accordingly
            if (isset($data['userType'])) {
                $query = "SELECT COUNT(*) AS total_count FROM {$data['table']} WHERE userType = {$data['userType']}";
            } else {
                $query = "SELECT COUNT(*) AS total_count FROM {$data['table']}";
            }

            $result = mysqli_query($con, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row["total_count"]; // Use the generic alias
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
            <div class="site-section">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 text-black">Payment Chart</h2>
          </div>
          <div class="col-md-12 d-flex justify-content-center">
            <canvas id="paymentChart" width="800" height="400"></canvas>
          </div>
        </div>
      </div>
    </div>
        </div>
       
        <script>
    // Use the PHP-generated data
    var months = <?php echo json_encode($months); ?>;
    var totalPayments = <?php echo json_encode($totalPayments); ?>;

    // Create a chart
    var ctx = document.getElementById('paymentChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Total Payments',
                data: totalPayments,
                backgroundColor: '#04712C', 
                borderColor: 'rgba(75, 192, 192, 1)', 
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


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
