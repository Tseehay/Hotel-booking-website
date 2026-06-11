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

// Check if required POST parameters exist
if (!isset($_POST['name'], $_POST['email'], $_POST['address'], $_POST['phonenum'], 
           $_POST['pincode'], $_POST['dob'], $_POST['pass'], $_POST['cpass'])) {
    echo "<script>alert('All fields are required'); window.location.href='index.php';</script>";
    exit();
}

// Get form data
$name = mysqli_real_escape_string($conn, trim($_POST['name']));
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$address = mysqli_real_escape_string($conn, trim($_POST['address']));
$phone = mysqli_real_escape_string($conn, trim($_POST['phonenum']));
$pin = mysqli_real_escape_string($conn, trim($_POST['pincode']));
$dob = mysqli_real_escape_string($conn, trim($_POST['dob']));
$password = $_POST['pass'];
$cpass = $_POST['cpass'];

// Validate passwords match
if ($password !== $cpass) {
    echo "<script>alert('Passwords do not match'); window.location.href='index.php';</script>";
    exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check for duplicate email
$email_check = $conn->prepare("SELECT id FROM user_cred WHERE email = ?");
$email_check->bind_param("s", $email);
$email_check->execute();
$email_check->store_result();

if ($email_check->num_rows > 0) {
    echo "<script>alert('Email already registered'); window.location.href='index.php';</script>";
    $email_check->close();
    $conn->close();
    exit();
}
$email_check->close();

// Profile upload removed; keep empty profile value for compatibility with schema.
$profile = '';

// Prepare SQL statement (store only hashed password)
$stmt = $conn->prepare("INSERT INTO user_cred (name, email, address, phonenum, pincode, dob, profile, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $name, $email, $address, $phone, $pin, $dob, $profile, $hashed_password);

// Execute the statement
if ($stmt->execute()) {
    // Store user information in the session
    $_SESSION['user'] = [
        'name' => $name,
        'email' => $email,
        'profile' => !empty($profile) ? 'uploads/' . $profile : 'images/ff.png'
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
