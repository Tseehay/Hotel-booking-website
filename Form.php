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
$targetFilePath = $targetDir . basename($profile);

// Validate file upload
if (!empty($_FILES["profile"]["name"])) {
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    
    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Only JPG, JPEG, PNG & GIF files are allowed'); window.location.href='index.php';</script>";
        exit();
    }
    
    move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFilePath);
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
        'profile' => $targetFilePath
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
