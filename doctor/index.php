<?php
session_start();
$error = "";
$msg = "";

$dsn = "mysql:host=localhost;dbname=projectdb";
$username = "root";
$password = "";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Failed to connect to the database: " . $e->getMessage());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        if (isset($_POST['adminEmail']) && isset($_POST['adminPass'])) {
            $email = $_POST['adminEmail'];
            $pass = $_POST['adminPass'];

            $stmt = $conn->prepare("SELECT * FROM admin WHERE adminEmail = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $row = $stmt->fetch();

            if ($row && password_verify($pass, $row['adminPass'])) {
                $userId = $row["adminId"];


                $_SESSION["adminId"] = $userId;
				$_SESSION["adminName"] = $row['adminName'];

                header("Location: dashboard.php");
                exit();
            } else {
                $error = 'Invalid Username or Password'; // Updated error message
            }
        } else {
            $error = 'Please provide both Username and Password'; // Updated error message
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin Dashboard - Login</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]
</head>
<body>
    <!-- Main Wrapper -->
    <div class="page-wrappers login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            <p style="color:red;"><?php echo $error; ?></p>
							<p style="color:red;"><?php echo $msg; ?></p>

                            <!-- Form -->
                            <form method="post">
                                <div class="form-group">
                                    <input class="form-control" name="adminEmail" type="text" placeholder="User Name">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="adminPass" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
                                </div>
                            </form>
                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>
                            <!-- Social Login -->
                   
                            <!-- /Social Login -->
                            <div class="text-center dont-have">Don't have an account? <a href="register.php">Register</a></div>
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
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>