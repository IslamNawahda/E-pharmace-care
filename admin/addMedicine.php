<?php
session_start();
require("config.php");

if(!isset($_SESSION['userId']))
{
	    header("Location: ../login.php");
}

//// add code
$error="";
$msg="";
if(isset($_POST['addMedicine']))
{
	
	$amplitude=$_POST['amplitude'];
	$productionDate=$_POST['productionDate'];
	$expiryDate=$_POST['expiryDate'];
	$price=$_POST['price'];

	$Effect=$_POST['Effect'];
	$Barcode=$_POST['Barcode'];
	$Contents=$_POST['Contents'];
	$toAge=$_POST['toAge'];
	$Name=$_POST['Name'];
	$forUse=$_POST['forUse'];
	$manufactureCompany=$_POST['manufactureCompany'];
	$Complications=$_POST['Complications'];
	$Description=$_POST['Description'];
	$imageName=$_FILES['imageName']['name'];
	$barcode=$_FILES['Barcode']['name'];
	$quantity=$_POST['quantity'];
	$temp_name1 = $_FILES['imageName']['tmp_name'];
	$temp_name2 = $_FILES['Barcode']['tmp_name'];


	move_uploaded_file($temp_name1,"medicies/$imageName");
	move_uploaded_file($temp_name2,"medicies/$barcode");

	$sql = "INSERT INTO `medicine`(`amplitude`, `expiryDate`, `productionDate`, `Effect`, `Barcode`, `Contents`, `toAge`, `Name`, `forUse`, `manufactureCompany`, `Complications`, `Description`, `imageName`,`price`,`quantity`) VALUES ('$amplitude', '$expiryDate', '$productionDate', '$Effect', '$barcode', '$Contents', '$toAge', '$Name', '$forUse', '$manufactureCompany', '$Complications', '$Description', '$imageName','$price','$quantity')";

	$result=mysqli_query($con,$sql);
	if($result)
		{
			$msg="<p class='alert alert-success'>Medicine Inserted Successfully</p>";
					
		}
		else
		{
			$error="<p class='alert alert-warning'>Medicine Not Inserted Some Error</p>";
		}
}
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin Dashboard | Add Medicine</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/css/select2.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		
    </head>
    <body>
	
		<!-- Main Wrapper -->
		
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
								<h3 class="page-title">Add Medicine</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Add Medicine</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title">Add Medicine</h2>
								</div>
								<form method="post" enctype="multipart/form-data">
								<div class="card-body">
										<div class="row">
											<div class="col-xl-12">
												<?php echo $error; ?>
												<?php echo $msg; ?>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="Name" required="">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Description</label>
													<div class="col-lg-9">
														<textarea class="form-control" name="Description" rows="5"></textarea>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Amplitude</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="amplitude" required="">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Production Date</label>
													<div class="col-lg-9">
														<input type="date" class="form-control" name="productionDate" required="">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Expiry Date</label>
													<div class="col-lg-9">
														<input type="date" class="form-control" name="expiryDate" required="">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Price</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="price" >
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Effect</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="Effect" required="">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Contents</label>
													<div class="col-lg-9">
														<textarea  class="form-control" name="Contents" required="" rows="5"></textarea>
													</div>
												</div>
												
											

												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Image</label>
													<div class="col-lg-9">
														<input class="form-control" name="imageName" type="file" required="">
													</div>
												</div>
												
												
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">toAge</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="toAge" >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">forUse</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="forUse" >
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Manufacture Company</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="manufactureCompany" >
													</div>
												</div>
											
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Complications</label>
													<div class="col-lg-9">
														<textarea class="form-control" name="Complications" rows="5"></textarea>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Barcode</label>
													<div class="col-lg-9">
														<input class="form-control" name="Barcode" type="file" required="">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Quantity</label>
													<div class="col-lg-9">
														<input type="number" class="form-control" name="quantity" >
													</div>
												</div>
												
											</div>
										</div>
										<div class="text-left">
											<input type="submit" class="btn btn-primary"  value="Add" name="addMedicine" style="margin-left:200px;">
										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
			<!-- /Page Wrapper -->
		<!-- /Main Wrapper -->
		<script src="assets/plugins/tinymce/tinymce.min.js"></script>
		<script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
    </body>

</html>