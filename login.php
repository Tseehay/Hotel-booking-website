<?php
session_start();
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

header('Content-Type: application/json');

if (!isset($_POST['email'], $_POST['password'])) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
    exit();
}

$email = trim($_POST['email']);
$password = $_POST['password'];

$stmt = $con->prepare("SELECT `id`, `name`, `email`, `profile`, `password` FROM `user_cred` WHERE `email` = ? LIMIT 1");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Unable to process login request.']);
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email'],
            'profile' => !empty($user['profile']) ? 'uploads/' . $user['profile'] : 'images/ff.png'
        ];
        echo json_encode(['success' => true, 'message' => 'Login successful.']);
        $stmt->close();
        exit();
    }
}

echo json_encode(['success' => false, 'message' => 'Invalid login credentials.']);
$stmt->close();
?>
