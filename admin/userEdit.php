<?php
session_start();
require("config.php");

if (!isset($_SESSION['userId'])) {
        header("Location: ../login.php");
}

$error = "";
$msg = "";
$mid = $_GET['id'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['address'];
    $phone = $_POST['phone'];

    $imgName = $_FILES['imgName']['name'];
    $temp_name = $_FILES['imgName']['tmp_name'];
    move_uploaded_file($temp_name, "user/$imgName");

    $stmt = mysqli_prepare($con, "UPDATE users SET name=?, address=?, phone=?, email=?, imgName=? WHERE userId=?");
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $location, $phone, $email, $imgName, $mid);

   

    if (mysqli_stmt_execute($stmt)) {
        $msg = "<p class='alert alert-success'>User Updated Successfully</p>";
    } else {
        $error = "<p class='alert alert-warning'>User Not Updated, Error: " . mysqli_error($con) . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin Dashboard | Update User</title>
		
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
								<h3 class="page-title">User</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">User</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Update User Details</h4>
								</div>
								<form method="post" enctype="multipart/form-data">
								<div class="card-body">
									<h5 class="card-title">Personal Detail</h5>
									<?php echo $error; ?>
									<?php echo $msg; ?>
									<?php
                                $sql = "SELECT * FROM users where userId  = $mid";
                                $result = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_row($result)) { ?>
										<div class="row">
											<div class="col-xl-12">
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="name" value="<?php echo $row['1']; ?>" placeholder="User Name" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Email</label>
													<div class="col-lg-9">
														<input type="email" class="form-control" name="email" value="<?php echo $row['4']; ?>" placeholder="User Email" required >
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Address</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" value="<?php echo $row['2']; ?>" name="address" placeholder="User Address" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Phone</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="phone" value="<?php echo $row['3']; ?>" placeholder="User Phone" required>
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Picture</label>
													<div class="col-lg-9">
													<img src="user/<?php echo $row['5']; ?>" height="100px" width="100px"><br><br>
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
													<input type="submit" value="Save" class="btn btn-primary"name="update" style="margin-left:200px;">
													</div>
												</div>

											</div>
										</div>
								</form>
								<?php }
                                ?>
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