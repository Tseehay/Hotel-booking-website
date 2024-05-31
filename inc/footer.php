<footer class="footer">
    <div class="container-fluid bg-white mt-5">
        <div class="row">
            <div class="col-lg-4 p-4">
                <h3 class="h-font fw-bold fs-3 mb-2">ADDIS HOTEL</h3>
                <p class="text">
                    Welcome to Addis Hotel, a premier destination for travelers seeking a blend of comfort,
                    convenience, and exceptional service. Nestled in the vibrant heart of the city.
                </p>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">LINKS</h5>
                <a href="index.php" class="d-inline-block mb-2 text-dark text-alignment -flex text-decoration-none">Home</a><br>
                <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
                <a href="facilities" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
                <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
                <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About us</a>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Follow Us</h5>
                <?php 
                    if($contact_r['tw']!=''){
                        echo<<<data
                        <a href="$contact_r[tw]" class="d-inline-block mb-2 text-dark text-alignment -flex text-decoration-none"><i
                        class="bi bi-twitter me-1"></i>Twitter</a><br>
                        data;
                    }
                ?>
                <a href="<?php $contact_r['fb']!=''?>" class="d-inline-block mb-2 text-dark text-decoration-none"><i
                        class="bi bi-facebook me-1"></i>facebook</a><br>
                <a href="<?php $contact_r['insta']!=''?>" class="d-inline-block mb-2 text-dark text-decoration-none"><i
                        class="bi bi-instagram me-1"></i>Instagram</a><br>
            </div>
        </div>
    </div>
    <footer class="text-center bg-dark text-white p-4 m-0 ">Designed and Developed by Addis Hotel</footer>
    <script>
        function setACtive(){
           let  navbar = document.getElemenById('nav_bar');
           let a_tags = navbar.getElementsByTagName('a');
           
           for(i=0; i < a_tags.length; i++){
            let file = a_tags[i].herf.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name)>= 0){
                a_tags[i].classList.add('active');
            }
           }
        }
        setActive();
    </script>
</footer>