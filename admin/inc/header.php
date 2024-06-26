<div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h6 class="mt-2 text-light">ADMIN PANEL</h6>
            <button class="navbar-toggler shadow-none d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column width=30px align-items-stretch" id="adminDropdown">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="features_facilities.php">Features & Facilites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="user_queries.php">User Queries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get all the nav links inside the adminDropdown
    var navLinks = document.querySelectorAll("#adminDropdown .nav-link");

    // Add click event listener to each nav link
    navLinks.forEach(function(navLink) {
        navLink.addEventListener("click", function(event) {
            // Remove 'active' class from all nav links
            navLinks.forEach(function(link) {
                link.classList.remove("active");
            });

            // Add 'active' class to the clicked nav link
            this.classList.add("active");
        });
    });
});
</script>

<style>
.nav-link.active {
    background-color: blue; /* Change background color when active */
}
</style>
