<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $total_price = $_POST['total_price'];
    $room_id = $_POST['room_id'];

    // Generate a unique payment code
    $paymentCode = strtoupper(substr(md5(time()), 0, 10));

    // Include header and links
    include('inc/header.php');
    include('inc/links.php');
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success - Hawassa Tourism & Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/common.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h2 class="text-center text-success">Booking Successful!</h2>
                <p class="text-center">Thank you for booking with Hawassa Tourism & Hotel Booking. Your booking details are as follows:</p>
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <h5>Booking Details</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Name: <?php echo htmlspecialchars($name); ?></li>
                            <li class="list-group-item">Email: <?php echo htmlspecialchars($email); ?></li>
                            <li class="list-group-item">Phone: <?php echo htmlspecialchars($phone); ?></li>
                            <li class="list-group-item">Check-in Date: <?php echo htmlspecialchars($checkin); ?></li>
                            <li class="list-group-item">Check-out Date: <?php echo htmlspecialchars($checkout); ?></li>
                            <li class="list-group-item">Adults: <?php echo htmlspecialchars($adults); ?></li>
                            <li class="list-group-item">Children: <?php echo htmlspecialchars($children); ?></li>
                            <li class="list-group-item">Total Price: <?php echo htmlspecialchars($total_price); ?> USD</li>
                        </ul>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5>Payment Details</h5>
                        <p>Your payment code is: <strong><?php echo htmlspecialchars($paymentCode); ?></strong></p>
                        <p>Please use the following methods to complete your payment:</p>
                        <ul class="list-group">
                            <li class="list-group-item">Credit/Debit Card</li>
                            <li class="list-group-item">Bank Transfer</li>
                            <li class="list-group-item">Mobile Payment</li>
                            <li class="list-group-item">PayPal</li>
                        </ul>
                        <p class="mt-3">Once your payment is confirmed, you will receive a confirmation email with your booking details.</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-primary">Return to Home</a>
                    <a href="rooms.php" class="btn btn-secondary">Book Another Room</a>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>
