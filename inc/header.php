
<script>
    // JavaScript function to redirect to a PHP file
    function redirectToLogout() {
        window.location.href = 'logout.php';
    }
</script>
<?php
session_start();
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

// Check if user is logged in
$userName = '';
$userProfile = '';
if (isset($_SESSION['user'])) {
    // User is logged in
    $userName = $_SESSION['user']['name'];
    $userProfile = $_SESSION['user']['profile'];
    $isLoggedIn = true;
} else {
    // User is not logged in
    $isLoggedIn = false;
}

$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$value = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $value, 'i'));
?>

<nav id="nav_bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Hawassa Tourism & Hotel Booking</a>
        <button class="navbar-toggler shadow-none navbar-light bg-white" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2" href="index.php">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="about.php">About</a>
                </li>
            </ul>

            <div class="d-flex">
                <?php if ($isLoggedIn): ?>
                    <div id="profilePic" class="position-relative">
                        <img src="<?php echo $userProfile; ?>" alt="Profile Picture" class="rounded-circle"
                            style="width: 40px; height: 40px; cursor: pointer;">
                    </div>
                <?php else: ?>
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                        data-bs-target="#loginModal" id="loginButton">
                        Login
                    </button>
                    <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
                        data-bs-target="#registerModal" id="registerButton">
                        Register
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo $userProfile ?? ''; ?>" alt="Profile Picture"
                    class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                <h5><?php echo $userName ?? 'Guest'; ?></h5>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="redirectToLogout()" class="btn btn-dark" id="logoutButton">Logout</button>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="loginForm" action="login.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>User Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control shadow-none">
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                    <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forget Password</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="Form.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 pe-0 mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 pe-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input name="phonenum" type="tel" pattern="^(\+251|0)9[0-9]{8}$" title="Enter Ethiopian phone number: +251 or 0, then 9 followed by 8 more digits" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Postal Code (4 digits)</label>
                                <input name="pincode" type="tel" pattern="^[0-9]{4}$" title="Enter 4-digit pincode" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 pe-0 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input name="dob" type="date" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input name="pass" type="password" minlength="8" title="Password must be at least 8 characters long" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input name="profile" type="file" accept=".jpg, .png, .jpeg, .webp"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input name="cpass" type="password" minlength="8" title="Password must be at least 8 characters long" class="form-control shadow-none" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Handle profile picture click
    const profileImage = document.querySelector('#profilePic img');
    if (profileImage) {
        profileImage.addEventListener('click', function () {
            $('#profileModal').modal('show');
        });
    }

    // Handle form submission via AJAX
    document.querySelector('#loginForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form from submitting normally

        // Collect form data
        let formData = new FormData(this);

        // Send AJAX request
        fetch('login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Login successful, hide modals
                $('#loginModal').modal('hide');
                $('#registerModal').modal('hide');
                // Reload the page to update UI
                location.reload();
            } else {
                alert(data.message || 'Invalid login credentials.');
            }
        })
        .catch(error => {
            console.error('Login error:', error);
            alert('An error occurred. Please try again.');
        });
    });

});
</script>
