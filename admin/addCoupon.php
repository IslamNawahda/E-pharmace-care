<?php
session_start();
require("config.php");

if (!isset($_SESSION['userId'])) {
        header("Location: ../login.php");
}

$error = "";
$msg = "";

if (isset($_POST['add'])) {
    $startDate = $_POST['startDate'];
    $expiryDate = $_POST['expiryDate'];
    $discountPercentage = $_POST['discountPercentage'];

    $sql = "INSERT INTO coupon (startDate, expiryDate, discountPercentage)
            VALUES ('$startDate', '$expiryDate', '$discountPercentage')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $msg = "<p class='alert alert-success'>Coupon Inserted Successfully</p>";
    } else {
        $error = "<p class='alert alert-warning'>Coupon Not Inserted. Some Error: " . mysqli_error($con) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin Dashboard | Add Coupon</title>
		
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
        <link rel="stylesheet" href="assets/css/feathericon.min.css">
		
        <link rel="stylesheet" href="assets/css/style.css">
		
		
    </head>
    <body>

		
		
			<?php include("header.php"); ?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Coupon</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Coupon</li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Add Coupon Details</h4>
								</div>
								<form method="post" enctype="multipart/form-data">
								<div class="card-body">
									<?php echo $error; ?>
									<?php echo $msg; ?>
									
										<div class="row">
											<div class="col-xl-12">
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Start Date</label>
													<div class="col-lg-9">
														<input type="date" class="form-control" name="startDate"  placeholder="Start Date" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Expiry Date</label>
													<div class="col-lg-9">
														<input type="date" class="form-control" name="expiryDate" placeholder="Expiry Date" required >
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Discount Percentage</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="discountPercentage" placeholder="Discount Percentage" required>
													</div>
												</div>
											
											</div>
														
											<div class="col-xl-12">
												<br>
											
												</div>
											
												<div class="form-group row">
												<label class="col-lg-3 col-form-label"></label>

													<div class="col-lg-9">
													<input type="submit" value="Add" class="btn btn-primary"name="add" style="margin-left:200px;">
													</div>
												</div>

											</div>
										</div>
								</form>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		<script src="assets/plugins/tinymce/tinymce.min.js"></script>
		<script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<script  src="assets/js/script.js"></script>
		
    </body>

</html>