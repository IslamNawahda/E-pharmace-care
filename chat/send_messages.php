<?php
include('../includes/config.php');
session_start();

if (!isset($_SESSION['userId'])) {
    echo "User not logged in.";
    exit;
}

$senderId = $_SESSION['userId'];

// Validate and sanitize receiver ID and message
$receiverId = filter_input(INPUT_POST, 'receiver', FILTER_VALIDATE_INT);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

if (false === $receiverId || null === $message) {
    echo "Invalid input data.";
    exit;
}

$fileName = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetDir = "../images/";
    createDirectoryIfNeeded($targetDir);

    $fileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type.";
        exit;
    }

    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        echo "Error uploading file.";
        exit;
    }
} elseif (isset($_FILES['image']['error']) && UPLOAD_ERR_NO_FILE != $_FILES['image']['error']) {
    echo "File upload error: " . $_FILES['image']['error'];
    exit;
}

// Insert data into the database
$insert = $con->prepare("INSERT INTO conversations (sender, receiver, message, image) VALUES (?, ?, ?, ?)");
if ($insert === false) {
    echo "Failed to prepare statement: " . $con->error;
    exit;
}

$insert->bind_param("iiss", $senderId, $receiverId, $message, $fileName);

if ($insert->execute()) {
    
    echo "Message sent successfully.";
} else {
    echo "Message send failed: " . $insert->error;
}

$con->close();

// Helper function to create directory if it doesn't exist
function createDirectoryIfNeeded($dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true); // Adjusted permissions to be more secure
    }
}
?>
