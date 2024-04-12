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
    $description = $_POST['description'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $speciality = $_POST['speciality'];
    $phone = $_POST['phone'];

    // Sanitize user inputs to prevent SQL injection
    $name = mysqli_real_escape_string($con, $name);
    $description = mysqli_real_escape_string($con, $description);
    $email = mysqli_real_escape_string($con, $email);
    $location = mysqli_real_escape_string($con, $location);
    $speciality = mysqli_real_escape_string($con, $speciality);
    $phone = mysqli_real_escape_string($con, $phone);

    $doctorImage = $_FILES['doctorImage']['name'];
    $doctorSyndicate = $_FILES['syndicate']['name'];

    $temp_name = $_FILES['doctorImage']['tmp_name'];
    $temp_name1 = $_FILES['syndicate']['tmp_name'];

    move_uploaded_file($temp_name, "user/$doctorImage");
    move_uploaded_file($temp_name1, "user/syndicate/$doctorSyndicate");

    $sql = "INSERT INTO doctor (name, description, email, location, speciality, phone, doctorImage, syndicate)
            VALUES ('$name', '$description', '$email', '$location', '$speciality', '$phone', '$doctorImage', '$doctorSyndicate')";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $msg = "<p class='alert alert-success'>Doctor Inserted Successfully</p>";
    } else {
        $error = "<p class='alert alert-warning'>Doctor Not Inserted Some Error</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin Dashboard | Add Doctor</title>
		
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
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>

		
			<!-- Header -->
			<?php include("header.php"); ?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Doctor</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Doctor</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Add Doctor Details</h4>
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
														<input type="text" class="form-control" name="name"  placeholder="Doctor Name" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Email</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="email" placeholder="Doctor Email" required >
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Address</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="location" placeholder="Doctor Address" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Phone</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="phone" placeholder="Doctor Phone" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Picture</label>
													<div class="col-lg-9">
														<input class="form-control" name="doctorImage" type="file" required="">
													</div>
												</div>
											</div>
											<h5 class="card-title">Job Detail</h5>
						
									
											<div class="col-xl-12">
												<br>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Description</label>
													<div class="col-lg-9">
														<textarea class="form-control" name="description" cols="20" rows="5" placeholder="Doctor Description" required></textarea>
													</div>
												</div>
												<div class="form-group row">
    <label class="col-lg-2 col-form-label">Speciality</label>
    <div class="col-lg-9">
        <select class="form-control" name="speciality">
            <option value="">Select Speciality</option>
            <option value="Allergist">Allergist</option>
            <option value="Anesthesiologist">Anesthesiologist</option>
            <option value="Cardiologist">Cardiologist</option>
            <option value="Dermatologist">Dermatologist</option>
            <option value="Endocrinologist">Endocrinologist</option>
            <option value="Gastroenterologist">Gastroenterologist</option>
            <option value="Hematologist">Hematologist</option>
            <option value="Infectious Disease Specialist">Infectious Disease Specialist</option>
            <option value="Internist">Internist</option>
            <option value="Nephrologist">Nephrologist</option>
            <option value="Neurologist">Neurologist</option>
            <option value="Obstetrician/Gynecologist">Obstetrician/Gynecologist</option>
            <option value="Oncologist">Oncologist</option>
            <option value="Ophthalmologist">Ophthalmologist</option>
            <option value="Orthopedic Surgeon">Orthopedic Surgeon</option>
            <option value="Otolaryngologist (ENT Specialist)">Otolaryngologist (ENT Specialist)</option>
            <option value="Pediatrician">Pediatrician</option>
            <option value="Physiatrist (Physical Medicine and Rehabilitation Specialist)">Physiatrist (Physical Medicine and Rehabilitation Specialist)</option>
            <option value="Plastic Surgeon">Plastic Surgeon</option>
            <option value="Psychiatrist">Psychiatrist</option>
            <option value="Pulmonologist">Pulmonologist</option>
            <option value="Radiologist">Radiologist</option>
            <option value="Rheumatologist">Rheumatologist</option>
            <option value="Surgeon">Surgeon</option>
            <option value="Urologist">Urologist</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>

												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Syndicate membership</label>
													<div class="col-lg-9">
														<input class="form-control" name="syndicate" type="file"  required>
													</div>
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

		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		<script src="assets/plugins/tinymce/tinymce.min.js"></script>
		<script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		
    </body>

</html>