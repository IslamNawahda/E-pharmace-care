<?php
session_start();
require("config.php");

if (!isset($_SESSION['userId'])) {
        header("Location: ../login.php");
}

$error = "";
$msg = "";

if (isset($_POST['update'])) {
	$aid = $_GET['id'];

    $name = $_POST['name'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $speciality = $_POST['speciality'];
    $phone = $_POST['phone'];

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

    move_uploaded_file($temp_name, 	"user/$doctorImage");
    move_uploaded_file($temp_name1, "user/syndicate/$doctorSyndicate");

	$sql1 = "UPDATE users SET name=?, address=?, phone=?, email=?, imgName=? WHERE userId=?";
	$stmt1 = mysqli_prepare($con, $sql1);
	
	if ($stmt1) {
		mysqli_stmt_bind_param($stmt1, "sssssi", $name, $location, $phone, $email, $doctorImage, $aid);
	
		// Execute the statement
		$result1 = mysqli_stmt_execute($stmt1);
	
		// Close the statement
		mysqli_stmt_close($stmt1);
	
		if ($result1) {
			$sql2 = "UPDATE doctor SET name=?, description=?, email=?, location=?, speciality=?, phone=?, doctorImage=?, syndicate=? WHERE doctorId=?";
			$stmt2 = mysqli_prepare($con, $sql2);
	
			if ($stmt2) {
				mysqli_stmt_bind_param($stmt2, "sssssissi", $name, $description, $email, $location, $speciality, $phone, $doctorImage, $doctorSyndicate, $aid);
	
				// Execute the statement
				$result2 = mysqli_stmt_execute($stmt2);
	
				// Close the statement
				mysqli_stmt_close($stmt2);
	
				if ($result2) {
					$msg = "<p class='alert alert-success'>Doctor Updated Successfully</p>";
				} else {
					$error = "<p class='alert alert-warning'>Error in Update doctor details2: " . mysqli_error($con) . "</p>";
				}
			} else {
				$error = "<p class='alert alert-warning'>Error in preparing update statement2: " . mysqli_error($con) . "</p>";
			}
		} else {
			$error = "<p class='alert alert-warning'>Error in Update doctor details1</p>";
		}
	} else {
		$error = "<p class='alert alert-warning'>Error in preparing update statement1: " . mysqli_error($con) . "</p>";
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin Dashboard | Update Doctor</title>
		
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
								<h3 class="page-title">Doctor</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Doctor</li>
								</ul>
							</div>
						</div>
					</div>
					
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
									<?php
									$aid=$_GET['id'];
                                $sql = "SELECT * FROM users Inner Join doctor on users.userId=doctor.doctorId  where userId  = $aid";
                                $result = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_row($result)) { ?>
										<div class="row">
											<div class="col-xl-12">
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="name"  placeholder="Doctor Name" value="<?php echo $row['1'];?>" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Email</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="email" placeholder="Doctor Email"  value="<?php echo $row['4'];?>" required >
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Address</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="location" placeholder="Doctor Address" value="<?php echo $row['2'];?>" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Phone</label>
													<div class="col-lg-9">

														<input type="number" class="form-control" name="phone" placeholder="Doctor Phone" value="<?php echo $row['3'];?>" required>

													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Picture</label>
													<div class="col-lg-9">
													<img src="user/<?php echo $row['5']; ?>" height="100px" width="100px"><br><br>

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
														<textarea class="form-control" name="description" cols="20" rows="5" placeholder="Doctor Description"  required><?php echo $row['10'];?></textarea>
													</div>
												</div>
												<div class="form-group row">
												<label class="col-lg-2 col-form-label">Speciality</label>
												<div class="col-lg-9">
													<select class="form-control" name="speciality">
														<option value="">Select Speciality</option>
														<option value="Allergist" <?php echo ($row['14'] == 'Allergist') ? 'selected' : ''; ?>>Allergist</option>
														<option value="Anesthesiologist" <?php echo ($row['14'] == 'Anesthesiologist') ? 'selected' : ''; ?>>Anesthesiologist</option>
														<option value="Cardiologist" <?php echo ($row['14'] == 'Cardiologist') ? 'selected' : ''; ?>>Cardiologist</option>
														<option value="Dermatologist" <?php echo ($row['14'] == 'Dermatologist') ? 'selected' : ''; ?>>Dermatologist</option>
														<option value="Endocrinologist" <?php echo ($row['14'] == 'Endocrinologist') ? 'selected' : ''; ?>>Endocrinologist</option>
														<option value="Gastroenterologist" <?php echo ($row['14'] == 'Gastroenterologist') ? 'selected' : ''; ?>>Gastroenterologist</option>
														<option value="Hematologist" <?php echo ($row['14'] == 'Hematologist') ? 'selected' : ''; ?>>Hematologist</option>
														<option value="Infectious Disease Specialist" <?php echo ($row['14'] == 'Infectious Disease Specialist') ? 'selected' : ''; ?>>Infectious Disease Specialist</option>
														<option value="Internist" <?php echo ($row['14'] == 'Internist') ? 'selected' : ''; ?>>Internist</option>
														<option value="Nephrologist" <?php echo ($row['14'] == 'Nephrologist') ? 'selected' : ''; ?>>Nephrologist</option>
														<option value="Neurologist" <?php echo ($row['14'] == 'Neurologist') ? 'selected' : ''; ?>>Neurologist</option>
														<option value="Obstetrician/Gynecologist" <?php echo ($row['14'] == 'Obstetrician/Gynecologist') ? 'selected' : ''; ?>>Obstetrician/Gynecologist</option>
														<option value="Oncologist" <?php echo ($row['14'] == 'Oncologist') ? 'selected' : ''; ?>>Oncologist</option>
														<option value="Ophthalmologist" <?php echo ($row['14'] == 'Ophthalmologist') ? 'selected' : ''; ?>>Ophthalmologist</option>
														<option value="Orthopedic Surgeon" <?php echo ($row['14'] == 'Orthopedic Surgeon') ? 'selected' : ''; ?>>Orthopedic Surgeon</option>
														<option value="Otolaryngologist (ENT Specialist)" <?php echo ($row['14'] == 'Otolaryngologist (ENT Specialist)') ? 'selected' : ''; ?>>Otolaryngologist (ENT Specialist)</option>
														<option value="Pediatrician" <?php echo ($row['14'] == 'Pediatrician') ? 'selected' : ''; ?>>Pediatrician</option>
														<option value="Physiatrist (Physical Medicine and Rehabilitation Specialist)" <?php echo ($row['14'] == 'Physiatrist (Physical Medicine and Rehabilitation Specialist)') ? 'selected' : ''; ?>>Physiatrist (Physical Medicine and Rehabilitation Specialist)</option>
														<option value="Plastic Surgeon" <?php echo ($row['14'] == 'Plastic Surgeon') ? 'selected' : ''; ?>>Plastic Surgeon</option>
														<option value="Psychiatrist" <?php echo ($row['14'] == 'Psychiatrist') ? 'selected' : ''; ?>>Psychiatrist</option>
														<option value="Pulmonologist" <?php echo ($row['14'] == 'Pulmonologist') ? 'selected' : ''; ?>>Pulmonologist</option>
														<option value="Radiologist" <?php echo ($row['14'] == 'Radiologist') ? 'selected' : ''; ?>>Radiologist</option>
														<option value="Rheumatologist" <?php echo ($row['14'] == 'Rheumatologist') ? 'selected' : ''; ?>>Rheumatologist</option>
														<option value="Surgeon" <?php echo ($row['14'] == 'Surgeon') ? 'selected' : ''; ?>>Surgeon</option>
														<option value="Urologist" <?php echo ($row['14'] == 'Urologist') ? 'selected' : ''; ?>>Urologist</option>
													</select>
												</div>
											</div>


												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Syndicate membership</label>
													<div class="col-lg-9">
													<img src="user/syndicate/<?php echo $row['17']; ?>" height="100px" width="100px"><br><br>

														<input class="form-control" name="syndicate" type="file"  required>
													</div>
												</div>
												<div class="form-group row">
												<label class="col-lg-3 col-form-label"></label>

													<div class="col-lg-9">
													<input type="submit" value="Update" class="btn btn-primary"name="update" style="margin-left:200px;">
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