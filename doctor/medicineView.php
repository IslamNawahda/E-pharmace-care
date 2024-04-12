<?php
session_start();
require("config.php");
 
 
if(!isset($_SESSION['userId']))
{
	    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin Dashboard | View Medicine</title>
		
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
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">View Medicine</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">View Medicine</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">List Of Medicines</h4>
									<?php 
											if(isset($_GET['msg']))	
											echo $_GET['msg'];
											
									?>
								</div>
								<div class="card-body">

									<div class="table-responsive">
										<table class="table table-stripped">
											<thead>
												<tr>
													<th>Id</th>
													<th>Name</th>
													<th>Description</th>
													<th>amplitude</th>
													<th>productionDate</th>
													<th>expiryDate</th>
													<th>Contents</th>
													<th>Effect</th>
													<th>toAge</th>
													<th>forUse</th>
													<th>manufactureCompany</th>
													<th>Complications</th>
													<th>Image</th>
													<th>Barcode</th>
													<th>Edit</th>
													<th>Delete</th>
													
												</tr>
											</thead>
											<?php
													
													$query=mysqli_query($con,"select * from medicine");
													$cnt=1;
													while($row=mysqli_fetch_row($query))
														{
											?>
											<tbody>
												<tr>
													<td><?php echo $cnt; ?></td>
													<td><?php echo $row['8']; ?></td>
													<td><?php echo $row['12']; ?></td>
													<td><?php echo $row['1']; ?></td>
													<td><?php echo $row['3']; ?></td>
													<td><?php echo $row['2']; ?></td>
													<td><?php echo $row['6']; ?></td>
													<td><?php echo $row['4']; ?></td>
													<td><?php echo $row['7']; ?></td>
													<td><?php echo $row['9']; ?></td>
													<td><?php echo $row['10']; ?></td>
													<td><?php echo $row['11']; ?></td>
													<td><img src="medicies/<?php echo $row['13']; ?>" height="50px" width="50px"></td>
													<td><img src="medicies/<?php echo $row['5']; ?>" height="50px" width="50px"></td>
													<td><a href="Medicineedit.php?id=<?php echo $row['0']; ?>">Edit</a></td>
													<td><a href="Medicinedelete.php?id=<?php echo $row['0']; ?>">Delete</a></td>
												</tr>
											</tbody>
												<?php
												$cnt=$cnt+1;
												}
												?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				</div>
			</div>
			<!-- /Main Wrapper -->

		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		
    </body>
</html>
