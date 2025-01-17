<?php
session_start();
require "config.php";

if (!isset($_SESSION['userId'])) {
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin Dashboard | Admin</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="assets/plugins/datatables/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="assets/plugins/datatables/select.bootstrap4.min.css">
		<link rel="stylesheet" href="assets/plugins/datatables/buttons.bootstrap4.min.css">
		
        <link rel="stylesheet" href="assets/css/style.css">
		
		
    </head>
    <body>
	
		
		
				<?php include "header.php"; ?>
			
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
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
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Drivers List</h4>
									<?php if (isset($_GET['msg'])) {
             echo $_GET['msg'];
         } ?>
								</div>
								<div class="card-body">

									<table id="basic-datatable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
													<th>Image</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
											<?php
           $query = mysqli_query($con, "select * from users where userType=4");
           $cnt = 1;
           while ($row = mysqli_fetch_row($query)) { ?>
    <tr>
        <td><?php echo $cnt; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[4]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row[2]; ?></td>
		<td>
    <?php if (!empty($row[5])) {
        echo '<img src="user/' . $row[5] . '" height="50px" width="50px">';
    } else {
        echo '<img src="user/avatar-01.png" height="50px" width="50px">';
    } ?>
</td>
<td><a href="userEdit.php?id=<?php echo $row['0']; ?>">Edit</a></td>

     <td><a href="driverdelete.php?id=<?php echo $row[0]; ?>">Delete</a></td>

    </tr>
<?php $cnt = $cnt + 1;}
           ?>
                                            </tbody>
                                        </table>
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
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
		<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
		<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
		
		<script src="assets/plugins/datatables/dataTables.select.min.js"></script>
		
		<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
		<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
		<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
		<script src="assets/plugins/datatables/buttons.flash.min.js"></script>
		<script src="assets/plugins/datatables/buttons.print.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		
    </body>
</html>
