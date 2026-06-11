<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hawassa Tourism & Hotel Booking - Facilities</title>
    <link rel="stylesheet" href="assets/common.css">
    <?php require('inc/links.php') ?>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css " rel="stylesheet">

    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>

</head>

<body class="bg-light">
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Our Facilities</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Welcome to Hawassa tourism hotel, where luxury meets comfort. 
            We pride ourselves<br> on providing an exceptional guest experience through our
             wide range of<br> facilities and services. Whether you're here for business or
              leisure, we ensure your stay<br> is memorable and convenient.</p>
    </div>

    <div class="container">
        <div class="row">
            <?php
                $res = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while($row = mysqli_fetch_assoc($res)){
                    echo<<<data
                        <div class="col-lg-4 md-6 mb-5 px-4">
                            <div class="bg-white ronded shadow p-4 border-top border-4 border-dark pop">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="$path$row[icon]" width="40px">
                                    <h5 class="m-0 ms-3">$row[name]</h5>
                                </div>
                                <p>$row[description]</p>
                            </div>
                        </div>
                    data;
                }
            ?>

         
           
          
            
          
        </div>
    </div>


    <?php require('inc/footer.php') ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js "></script>


</body>

</html>