<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addis Hotel - Home</title>
    <link rel="stylesheet" href="assets/common.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css " rel="stylesheet">



</head>

<body class="bg-light">

    <?php require ('inc/header.php') ?>

    <!------ carousel ------>
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <img src="images/carousel/hot.jpg" class="d-block img-fluid" alt="Carousel Image">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/hot2.jpg" class="d-block img-fluid" alt="Carousel Image">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/im1.jpg" class="d-block img-fluid" alt="Carousel Image">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/im2.webp" class="d-block img-fluid" alt="Carousel Image">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/im3.jpg" class="d-block img-fluid" alt="Carousel Image">
                </div>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- availability -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow m-10 P-4 rounded">
                <h5 class="mb-4 mt-3">Check Booking Availability</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Check-in</label>
                            <input type="date" class="form-control shadow-none ">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Check-out</label>
                            <input type="date" class="form-control shadow-none ">
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500">Adult</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500">Children</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit"
                                class="btn btn-white text-black shadow-none boarder-black customer-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!------- our rooms ----->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
            <?php
            $room_res = select(
                " SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",
                [1, 0],
                'ii'
            );
            while ($room_data = mysqli_fetch_assoc($room_res)) {

                //get features of room
            
                $fea_q = mysqli_query($con, "SELECT * FROM `features` f
                INNER JOIN `room_features` rfea ON f.id =rfea.features_id
                WHERE rfea.room_id='$room_data[id]'");

                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= "<span class='badge rounded-pill bg-light text-dark  text-wrap me-1 mb-1'> $fea_row[name]</span>";
                }

                //get facilities of room
            
                $fac_q = mysqli_query($con, "SELECT * FROM `facilities` f
                INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                WHERE rfac.room_id='$room_data[id]'");

                $facilities_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark  text-wrap me-1 mb-1'> $fea_row[name]</span>";
                }


                // get thumbnail of images
            
                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
                WHERE `room_id`= '$room_data[id]'
                AND `thumb`='1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                //print room card
            
                echo <<<data
                    <div class="col-lg-4 col-md-6 my-3 ">
                        <div class="card border-0 shadow" style="max-width: 300px; margin: auto;">
                            <img src="$room_thumb" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5>$room_data[name]</h5>
                                <h6 class="mb-3">$room_data[price]USD per night</h6>
                                <div class="features mb-3">
                                    <h6 class="mb-1">Features</h6>
                                    $features_data 
                                </div>
                                <div class="facilities mb-3">
                                    <h6 class="mb-1 mt-3">Facilities</h6>
                                    $facilities_data
                                </div>
                                <div class="guests mb-3">
                                    <h6 class="mb-1 mt-3">Guests</h6>
                                    <span class="badge rounded-pill bg-light text-dark  text-wrap">$room_data[adult] Adults</span>
                                    <span class="badge rounded-pill bg-light text-dark  text-wrap">$room_data[children] children</span>


                                </div>
                                
                                <div class="rating mb-3">
                                    <h6 class="mb-1">Rating</h6>
                                    <span class="badge rounded-pill bg-light">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-evenly mb-1">
                                    <a href="booking.php?id=$room_data[id]" class="btn btn-primary">Book Now</a>
                                    <a href="room_details.php?id=$room_data[id]" class="btn btn-sa btn-outline-dark rounded-0 fw-bold shadow-none">More
                                        details</a>
                                </div>
                            </div>
                    </div>
                </div>
            
                data;
            }
            ?>
            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
            </div>
        </div>
        <!--------- our facilities --------->

        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
        <div class="container">
            <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
                <?php
                $res = mysqli_query($con, 'SELECT * FROM facilities ORDER BY `id` DESC');
                $path = FACILITIES_IMG_PATH;

                while ($row = mysqli_fetch_assoc($res)) {
                    echo <<<data
                        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                            <img src="$path$row[icon]" width="60px">
                            <h5 class="mt-3">$row[name]</h5>
                        </div>
                    data;
                }
                ?>
                <div class="col-lg-12 text-center mt-5">
                    <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More
                        Facilities
                        >>></a>
                </div>
            </div>
        </div>

        <!---------- Testimonials ---------------->
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>
        <div class="container">
            <div class="swiper swiper-testimonials ">
                <div class="swiper-wrapper  bg-white ">
                    <div class="swiper-slide bg-white p-4  ">
                        <div class="profile d-flex  align-items-center m-4">
                            <img src="images/about/fayo.png" width="30px">
                            <h6 class="m-0 ms-2">Faiza</h6>
                        </div>
                        <p> Addis Hotel is now my go-to choice whenever I visit the city."</p>
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                    <div class="swiper-slide bg-white py-2 px-5">
                        <div class="profile d-flex  align-items-center m-4">
                            <img src="images/about/fenet.jpg" width="30px">
                            <h6 class="m-0 ms-2">Fenet</h6>
                        </div>
                        <p>As a seasoned traveler, I can confidently say that Addis Hotel is a true gem. The
                            combination of luxurious accommodations, world-class facilities, and impeccable service
                            is unparalleled. </p>
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                    <div class="swiper-slide bg-white py-2 px-5">
                        <div class="profile d-flex  align-items-center m-4">
                            <img src="images/about/about.png" width="30px">
                            <h6 class="m-0 ms-2">Rediet</h6>
                        </div>
                        <p>I had the pleasure of hosting a corporate event at Addis Hotel, and I must say, the
                            experience was flawless.</p>
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                    <div class="swiper-slide bg-white py-2 px-5">
                        <div class="profile d-flex  align-items-center m-4">
                            <img src="images/about/gelil.jpg" width="30px">
                            <h6 class="m-0 ms-2">Gelila</h6>
                        </div>
                        <p>As a frequent business traveler, I've stayed at many hotels, but Addis Hotel stands out
                            as the best. The level of service and attention to detail is truly remarkable.</p>
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                    <div class="swiper-slide bg-white py-2 px-5">
                        <div class="profile d-flex  align-items-center m-4">
                            <img src="images/about/tse.jpg" width="30px">
                            <h6 class="m-0 ms-2">Tsehay</h6>
                        </div>
                        <p>"My family and I recently stayed at Addis Hotel for a week-long vacation, and it was an
                            absolute delight. The spacious rooms, impressive facilities, and delicious dining
                            options made our trip truly exceptional.</p>
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More
                    >>></a>
            </div>
        </div>

        <!---------- reach us ---------------->
        <?php
        $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
        $values = [1];
        $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
        ?>

        <!-- //height -->
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                    <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="bg-white p-4 rounded mb-4">
                        <h5>Call Us</h5>
                        <a href="tel: +<?php echo $contact_r['pn1'] ?>"
                            class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1'] ?>
                        </a>
                        <br>
                        <?php
                        if ($contact_r['pn2'] != '') {
                            echo <<<data
                                        <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
                                            <i class="bi bi-telephone-fill"></i>+$contact_r[pn2]
                                        </a>
                                    data;
                        }

                        ?>
                    </div>
                    <div class="bg-white p-4 rounded mb-4">
                        <h5>Follow Us</h5>
                        <?php
                        if ($contact_r['tw'] != '') {
                            echo <<<data
                                <a href="$contact_r[tw]" class="d-inline-block mb-3 ">
                                <span class="badge bg-light text-dark fs-6 p-2">
                                <i class="bi bi-twitter me-1">
                                </i>Twitter</span>
                                </a>
                                <br>
                                data;
                        }
                        ?>

                        <a href="<?php $contact_r['fb'] != '' ?>" class="d-inline-block mb-3 ">
                            <span class="badge bg-light text-dark fs-6 p-2">
                                <i class="bi bi-facebook me-1"></i>Facebook</span>
                        </a><br>
                        <a href="<?php $contact_r['insta'] != '' ?>" class="d-inline-block ">
                            <span class="badge bg-light text-dark fs-6 p-2">
                                <i class="bi bi-instagram me-1">
                                </i>Instagram</span>
                        </a><br>
                    </div>

                </div>
            </div>
        </div>

        <?php require ('inc/footer.php') ?>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            </script>
        <script src="assets/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            var swiper = new Swiper(".swiper-container", {
                spaceBetween: 30,
                effect: "fade",
                lickable: true,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                }
            });
            var images = document.querySelectorAll('.swiper-container img');
            images.forEach(function (image) {
                image.style.borderRadius = '16px';
            });
        </script>
        <script>
            var swiper = new Swiper(".swiper-testimonials", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto",
                slidesPerView: "3",
                loop: true,
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    }
                }
            });
        </script>

        <script>
            var swiper = new Swiper(".swiper-container", {
                spaceBetween: 30,
                effect: "fade",
                lickable: true,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                }
            });
        </script>
        <script>
            var swiper = new Swiper(".swiper-testimonials", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto",
                slidesPerView: "3",
                loop: true,
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    }
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            </script>
        <script src="assets/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js "></script>



</body>

</html>