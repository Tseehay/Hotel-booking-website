<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hawassa Tourism & Hotel Booking - ROOM DETAILS</title>
    <link rel="stylesheet" href="assets/common.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">
    <?php require('inc/header.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 px-4">
                <?php
                if (!isset($_GET['id'])) {
                    redirect('rooms.php');
                }

                $data = filteration($_GET);

                $room_res = select(
                    " SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",
                    [$data['id'], 1, 0],
                    'iii'
                );

                if (mysqli_num_rows($room_res) == 0) {
                    redirect('rooms.php');
                }

                $room_data = mysqli_fetch_assoc($room_res);
                ?>

                <h2 class="fw-bold"><?php echo $room_data['name'] ?></h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                        $img_q = mysqli_query($con, "SELECT * FROM `room_images` 
              WHERE `room_id`= '$room_data[id]'");

                        if (mysqli_num_rows($img_q) > 0) {
                            $active_class = 'active';

                            while ($img_res = mysqli_fetch_assoc($img_q)) {
                                echo "
                    <div class='carousel-item $active_class'>
                      <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100 rounded'>
                    </div>
                  ";
                                $active_class = '';
                            }
                        } else {
                            echo " <div class='carousel-item active'>
              <img src='$room_img' class='d-block w-100'>
            </div>";
                        }

                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h4 id="room-price" data-price="<?php echo $room_data['price']; ?>"><?php echo $room_data['price'] ?> USD per night</h4>
                        <div class="mb-3">
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>

                        <?php
                        $fac_q = mysqli_query($con, "SELECT * FROM `features` f
              INNER JOIN `room_features` rfac ON f.id = rfac.features_id
              WHERE rfac.room_id='$room_data[id]'");

                        $features_data = "";
                        while ($fea_row = mysqli_fetch_assoc($fac_q)) {
                            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'> 
              $fea_row[name]</span>";
                        }

                        echo "<div class='mb-3'>
                    <h6 class='mb-1 mt-3'>Features</h6>
                    $features_data
                  </div>";

                        $fac_q = mysqli_query($con, "SELECT * FROM `facilities` f
              INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
              WHERE rfac.room_id='$room_data[id]'");

                        $facilities_data = "";
                        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
               $fac_row[name]</span>";
                        }

                        echo "<div class='mb-3'>
                    <h6 class='mb-1 mt-3'>Facilities</h6>
                    $facilities_data
                  </div>";

                        echo "<div class='guests mb-3'>
                    <h6 class='mb-1 mt-3'>Guests</h6>
                    <span class='badge rounded-pill bg-light text-dark text-wrap'>$room_data[adult] Adults</span>
                    <span class='badge rounded-pill bg-light text-dark text-wrap'>$room_data[children] Children</span>
                  </div>";

                        echo "<div class='mb-1'>
                    <h6 class='mb-1 mt-3'>Area</h6>
                    <span class='badge rounded-pill bg-light text-dark text-wrap'>$room_data[area] sq. ft.</span>
                  </div>";

                        ?>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary text-white w-100 shadow-none mb-1" data-bs-toggle="modal" data-bs-target="#book-now-modal">
                            Book Now
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="book-now-modal" tabindex="-1" aria-labelledby="bookNowModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookNowModalLabel">Book Now</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="book-now-form" action="booking_success.php" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label fw-bold">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label fw-bold">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label fw-bold">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="checkin" class="form-label fw-bold">Check-in Date</label>
                                                    <input type="date" class="form-control" id="checkin" name="checkin" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="checkout" class="form-label fw-bold">Check-out Date</label>
                                                    <input type="date" class="form-control" id="checkout" name="checkout" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="adults" class="form-label fw-bold">Adults</label>
                                                    <input type="number" class="form-control" id="adults" name="adults" value="1" min="1" required oninput="updateTotalPrice()">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="children" class="form-label fw-bold">Children</label>
                                                    <input type="number" class="form-control" id="children" name="children" value="0" min="0" required oninput="updateTotalPrice()">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="total-price" class="form-label fw-bold">Total Price</label>
                                                    <input type="text" class="form-control" id="total-price" name="total_price" readonly>
                                                </div>
                                            </div>
                                            <input type="hidden" name="room_id" value="<?php echo $room_data['id']; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Book Now</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 px-4">
                <h5>Description</h5>
                <p><?php echo $room_data['description'] ?></p>
            </div>

            <div class="col-12 mt-4 px-4">
                <h5 class="mb-5">Review and Rating</h5>
                <div class="d-flex align-items-center m-2">
                    <img src="images/testimonial/mich.jpg" width="30px">
                    <h6 class="m-0 ms-2">Michael</h6>
                </div>
                <p>As a seasoned traveler, I can confidently say that Hawassa Tourism & Hotel Booking is a true gem. The
                    combination of luxurious accommodations, world-class facilities, and impeccable service
                    is unparalleled.</p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateTotalPrice() {
            const pricePerNight = parseFloat(document.getElementById('room-price').dataset.price);
            const numAdults = parseInt(document.getElementById('adults').value);
            const numChildren = parseInt(document.getElementById('children').value);

            const totalAdults = pricePerNight * numAdults;
            const totalChildren = (pricePerNight * 0.5) * numChildren;

            const totalPrice = totalAdults + totalChildren;
            document.getElementById('total-price').value = totalPrice.toFixed(2) + " USD";
        }

        document.addEventListener('DOMContentLoaded', updateTotalPrice);
    </script>
</body>

</html>