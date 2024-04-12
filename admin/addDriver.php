<?php
session_start();
require("config.php");

if (!isset($_SESSION['userId'])) {
        header("Location: ../login.php");
}

$error = "";
$msg = "";

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['address'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $name = mysqli_real_escape_string($con, $name);
    $password = mysqli_real_escape_string($con, $password);
    $email = mysqli_real_escape_string($con, $email);
    $location = mysqli_real_escape_string($con, $location);
    $phone = mysqli_real_escape_string($con, $phone);

    $imgName = $_FILES['imgName']['name'];
    $temp_name = $_FILES['imgName']['tmp_name'];

    move_uploaded_file($temp_name, "user/$imgName");

    $sql = "INSERT INTO users (name, address, phone, email, imgName, password,userType)
            VALUES ('$name', '$location', '$phone', '$email', '$imgName', '$password','4')";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $msg = "<p class='alert alert-success'>Driver Inserted Successfully</p>";
    } else {
        $error = "<p class='alert alert-warning'>Driver Not Inserted Some Error</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin Dashboard | Add Driver</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		
    </head>
    <body>

		
		
			<?php include("header.php"); ?>
		
			

            <div class="page-wrapper">
                <div class="content container-fluid">
				
				
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Driver</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Driver</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Add Driver Details</h4>
								</div>
								<form method="post" enctype="multipart/form-data">
								<div class="card-body">
									<h5 class="card-title">Personal Detail</h5>
									<?php echo $error; ?>
									<?php echo $msg; ?>
									
										<div class="row">
											<div class="col-xl-12">
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="name"  placeholder="Driver Name" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Email</label>
													<div class="col-lg-9">
														<input type="email" class="form-control" name="email" placeholder="Driver Email" required >
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Address</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="address" placeholder="Driver Address" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Phone</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="phone" placeholder="Driver Phone" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Password</label>
													<div class="col-lg-9">
														<input type="password" class="form-control" name="password" placeholder="Driver Password" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Picture</label>
													<div class="col-lg-9">
														<input class="form-control" name="imgName" type="file" required="">
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
			<!-- /Main Wrapper -->

		
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		<script src="assets/plugins/tinymce/tinymce.min.js"></script>
		<script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<script  src="assets/js/script.js"></script>
		
    </body>

</html>