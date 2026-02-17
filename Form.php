<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel-booking-website";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = mysqli_real_escape_string($conn, trim($_POST['name']));
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$address = mysqli_real_escape_string($conn, trim($_POST['address']));
$phone = mysqli_real_escape_string($conn, trim($_POST['phonenum']));
$pin = mysqli_real_escape_string($conn, trim($_POST['pincode']));
$dob = mysqli_real_escape_string($conn, trim($_POST['dob']));
$profile = $_FILES['profile']['name'];
$password = $_POST['pass'];
$cpass = $_POST['cpass'];

// Validate passwords match
if ($password !== $cpass) {
    echo "<script>alert('Passwords do not match'); window.location.href='index.php';</script>";
    exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// File upload path with validation
$targetDir = "uploads/";

// Validate file upload
if (!empty($_FILES["profile"]["name"])) {
    // Check for upload errors
    if ($_FILES["profile"]["error"] !== UPLOAD_ERR_OK) {
        echo "<script>alert('File upload error'); window.location.href='index.php';</script>";
        exit();
    }
    
    // Check file size (limit to 5MB)
    if ($_FILES["profile"]["size"] > 5242880) {
        echo "<script>alert('File size must be less than 5MB'); window.location.href='index.php';</script>";
        exit();
    }
    
    // Validate file type by extension
    $fileType = strtolower(pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    
    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Only JPG, JPEG, PNG & GIF files are allowed'); window.location.href='index.php';</script>";
        exit();
    }
    
    // Validate actual MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $_FILES["profile"]["tmp_name"]);
    finfo_close($finfo);
    
    $allowedMimeTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($mimeType, $allowedMimeTypes)) {
        echo "<script>alert('Invalid file type'); window.location.href='index.php';</script>";
        exit();
    }
    
    // Generate a unique, safe filename
    $uniqueFilename = uniqid('profile_', true) . '.' . $fileType;
    $targetFilePath = $targetDir . $uniqueFilename;
    
    // Attempt to move the uploaded file
    if (!move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFilePath)) {
        echo "<script>alert('Failed to upload file'); window.location.href='index.php';</script>";
        exit();
    }
    
    $profile = $uniqueFilename;
} else {
    // No profile picture uploaded
    $profile = '';
}

// Prepare SQL statement (store only hashed password)
$stmt = $conn->prepare("INSERT INTO user_cred (name, email, address, phonenum, pincode, dob, profile, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $name, $email, $address, $phone, $pin, $dob, $profile, $hashed_password);

// Execute the statement
if ($stmt->execute()) {
    // Store user information in the session
    $_SESSION['user'] = [
        'name' => $name,
        'email' => $email,
        'profile' => !empty($profile) ? 'uploads/' . $profile : ''
    ];
    echo "<script>alert('Registered successfully');</script>";
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
