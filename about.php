<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hawassa Tourism & Hotel Booking - ABOUT</title>
    <link rel="stylesheet" href="assets/common.css">
    <?php require('inc/links.php') ?>
    <style>
        .box {
            border-top-color: var(--teal) !important;
        }

        .swiper-container {
            height: 300px;
            /* Adjust the height as needed */
        }

        .swiper-slide img {
            height: 100%;
            width: auto;
        }
    </style>

</head>

<body class="bg-light">
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Dedicated to Excellence in Hospitality<br>
At Hawassa Tourism & Hotel Booking, our success is driven by a team of experienced and passionate professionals<br> dedicated to delivering exceptional service and unforgettable experiences. Meet the people who make it all possible:</p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Tsehay Goremes – General Manager</h3>
                <p>
                   With over 20 years of experience in the hospitality industry, Tsehay Goremes leads our team with a vision for excellence and innovation. His commitment to creating a welcoming and luxurious environment for all guests is reflected in every aspect of our hotel operations. Tsehay’s leadership has been instrumental in establishing Hawassa Tourism & Hotel Booking as a premier destination in the Hawassa region.
                </p>
            </div>
            <div class="col lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/about/about1.jpg" class="w-100">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/hotel.svg" width="70px">
                    <h4 class="mt-3">100+ ROOMS</h4>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/customers.svg" width="70px">
                    <h4 class="mt-3">200+CUSTOMERS</h4>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/rating.svg" width="70px">
                    <h4 class="mt-3">150+ RATINGS</h4>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/staff.svg" width="70px">
                    <h4 class="mt-3">200+ STAFS</h4>
                </div>

            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">MANGEMENT TEAM</h3>

    <div class="container px-4">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper mb-5">
            <div class="swiper-slide text-center overflow-hidden rounded">
                <!-- <img src="images/about/fenet.jpg" class="w-10"> -->
                <h1 class="mt-2" style="color: red;"></h5>
            </div>
            <div class="swiper-slide text-center overflow-hidden rounded">
                <!-- <img src="images/about/fayo.png" class="w-10"> -->
                <h5 class="mt-2" style="color: red;"></h5>
            </div>
            <div class="swiper-slide text-center overflow-hidden rounded">
                <!-- <img src="images/about/gelil.jpg" class="w-100"> -->
                <h5 class="mt-2"></h5>
            </div>
            <div class="swiper-slide text-center overflow-hidden rounded">
                <!-- <img src="images/about/tse.jpg" class="w-100"> -->
                <h5 class="mt-2"></h5>
            </div>
        </div>

        <div class="swiper-pagination"></div>
    </div>
</div>


    <?php require('inc/footer.php') ?>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper-->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPreview: 4,
            spaceBetween: 40,
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPreview: 1,
                },
                640: {
                    slidesPreview: 1,
                },
                768: {
                    slidesPreview: 3,
                },
                1024: {
                    slidesPreview: 3,
                },
            }
        });
    </script>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js "></script>


</body>

</html>