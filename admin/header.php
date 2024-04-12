<?php
require "config.php";

if (!isset($_SESSION['name'])) {
    header("Location: ../login.php");
}
?>
  <div class="header">
			
                <div class="header-left">
                    <a href="dashboard.php" class="logo">
						<img src="assets/img/logo.png" alt="Logo">
					</a>
					<a href="dashboard.php" class="logo logo-small">
						<img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">
					</a>
                </div>
				
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				

				
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				
				<ul class="nav user-menu">
					<h4 style="color:white;margin-top:13px;text-transform:capitalize;"><?php echo $_SESSION['name']; ?></h4>
					<li class="nav-item dropdown app-dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
    <img class="rounded-circle" src="user/<?php echo isset($_SESSION['imgName']) ? $_SESSION['imgName'] : 'avatar-01.png'; ?>" width="31" alt="Admin Image">
</span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img  src="user/<?php echo isset($_SESSION['imgName']) ? $_SESSION['imgName'] : 'avatar-01.png'; ?>" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6><?php echo $_SESSION['name']; ?></h6>
									<p class="text-muted mb-0">Administrator</p>
								</div>
							</div>
							<a class="dropdown-item" href="profile.php">Profile</a>
							<a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					</li>

					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
			
			<!-- header --->
			
			
			
						<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title">
								<span>Main</span>
							</li>
							<li>
								<a href="dashboard.php"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							
						
							
							<li class="menu-title"> 
								<span>Users</span>
							</li>
						
							<li class="submenu">
								<a href="#"><i class="fe fe-user"></i> <span> Users </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								
									<li>
    <a href="#"> Admin </a>
    <ul>
        <li><a href="addAdmin.php">Add new Admin</a></li>
        <li><a href="adminlist.php">View Admins</a></li>
    </ul>
</li>
									<li>
    <a href="#"> Users </a>
    <ul>
        <li><a href="addUser.php">Add new User</a></li>
        <li><a href="userlist.php">View Users</a></li>
    </ul>
</li>
<li>
    <a href="#"> Doctors </a>
    <ul>
        <li><a href="addDoctor.php">Add new Doctor</a></li>
        <li><a href="doctorslist.php">View Doctors</a></li>
    </ul>
</li>
<li>
    <a href="#"> Drivers</a>
    <ul>
        <li><a href="addDriver.php">Add new Driver</a></li>
        <li><a href="driversList.php">View Drivers</a></li>
    </ul>
</li>

								</ul>
							</li>
						
							<li class="menu-title"> 
								<span>Medicines</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-user"></i> <span> Medicines</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="addMedicine.php"> Add Medicine</a></li>
									<li><a href="medicineView.php"> View Medicine </a></li>
									
								</ul>
							</li>
							
							<li class="menu-title"> 
								<span>Coupons</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-user"></i> 
								<span> Coupons </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								<li><a href="addCoupon.php">Add Coupon </a></li>
								<li><a href="viewCoupons.php"> View Coupons  </a></li>
								</ul>
							</li>
						
							
							<li class="menu-title"> 
								<span>Contacts</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-user"></i> <span> Contacts </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="contactview.php"> Contact </a></li>
								</ul>
							</li>
							<li class="menu-title"> 
								<span>About</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-user"></i> <span> About </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="aboutadd.php">Add About </a></li>
									<li><a href="aboutview.php"> View About </a></li>
								</ul>
							</li>
							
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->