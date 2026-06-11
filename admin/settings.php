<?php
require ('inc/essentials.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel - Dasboard</title>
    <?php require ('inc/links.php'); ?>
    <link rel="stylesheet" href="assets/common.css">

    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css " rel="stylesheet">
    <style>
        #dashboard-menu {
            position: fixed;
            height: 100%;
        }

        @media screen and (max-width: 991px) {
            #dashboard-menu {
                height: auto;
                width: 100%;
            }

            #main-content {
                margin-top: 60px;
            }

        }
    </style>
</head>

<body class="bg-light">

    <div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
        <h3 class="mb-0 h-font">ADDIS HOTEL BOOKING WEBSITE</h3>
        <a href="logout.php" class="btn btn-light btn-sm">LOG OUT</a>
    </div>

    <?php require ('inc/header.php') ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4">
                <h3 class="mb-4">SETTINGS</h3>
                <!---------------General setting section----------->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#general-s"><i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                        <p class="card-text" id="site_about"></p>

                    </div>
                </div>

                <!-------------General settings modal --------->
                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>

                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Site title</label>
                                        <input type="text" name="site_title" id="site_title_inp"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">About us</label>
                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none"
                                            rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about"
                                        class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="submit" onclick="upd_general(site_title.value, site_about.value)"
                                        class="btn btn-primary text-white bg-dark shadow-none">SUBMIT</button>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>

                <!------------shutdown section------>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">shutdown website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox"
                                        id="shutdown-toggle">

                                </form>
                            </div>

                        </div>

                        <p class="card-text" id="site_about">No Customer wii be allowed to book hotel room, when
                            shutdown mode is turned on.</p>

                    </div>
                </div>

                <!------------Management Team section----------->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Managment Team</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#team-s"><i class="bi bi-plus-square"></i> Add
                            </button>

                        </div>
                        <div class="row" id="team-data">
                            <div class="col-md-2 mb-3">
                                <div class="card bg-dark text-white">
                                    <img src="../images/about/team.jpg" class="card-img">
                                    <div class="card-img-overlay text-end">
                                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                                            <i class="bi bi-trash"></i>Delete
                                        </button>

                                    </div>
                                    <p class="card-text text-center px-3 py-2">Random name</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!----------Management team modal --------------->
                <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="team_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Team Member</h5>

                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="member_name" id="member_name_inp"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" name="member_picture" id="member_picture_inp"
                                            accept=".jbg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="member_name.value='', member_picture.value=''"
                                        class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="submit" onclick="upd_general(site_title.value, site_about.value)"
                                        class="btn btn-primary text-white bg-dark shadow-none">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-----------Contact details section----------->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#contacts-s"><i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"> megenaga,Hawassa,Ethiopia</p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                    <p class="card-text mb-1"><i class="bi bi-telephone-fill">++111 2222 333
                                            3444</i><span id="pn1"></span>
                                    </p>
                                    <p class="card-text"><i class="bi bi-telephone-fill">++111 2222 333 3444</i><span
                                            id="pn2"></span></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                                    <p class="card-text" id="email"> addisstay@gmail.com</p>
                                </div>
                                <!-- Social -->
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                    <p class="card-text"><i class="bi bi-twitter"></i><span id="tw"></span>
                                    </p>
                                    <p class="card-text"><i class="bi bi-facebook"></i><span id="fb"></span></p>
                                    <p class="card-text"><i class="bi bi-instagram"></i><span id="insta"></span></p>
                                </div>
                                <div class="mb-4">
                                    <iframe id="iframe" class="border p-2 w-100"
                                        loading="lazy">https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d252230.23036287102!2d38.778145!3d8.963177!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85cef5ab402d%3A0x8467b6b037a24d49!2sAddis%20Ababa%2C%20Ethiopia!5e0!3m2!1sen!2sus!4v1716723032939!5m2!1sen!2sus</iframe>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-------------contacts details modal --------->
                <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Settings</h5>

                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input type="text" name="address" id="address_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Google Map link</label>
                                                    <input type="text" name="gmap" id="gmap_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Phone Numbers (with country
                                                        code)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" name="pn1" id="pn1_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" name="pn1" id="pn1_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Email</label>
                                                    <input type="email" name="email" id="email_inp"
                                                        class="form-control shadow-none" required>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-twitter"></i></span>
                                                        <input type="text" name="tw" id="tw_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-facebook"></i></span>
                                                        <input type="text" name="fb" id="fb_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-instagram"></i></span>
                                                        <input type="text" name="insta" id="insta_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">iFrame Src</label>
                                                    <input type="text" name="iframe" id="iframe_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" onclick="contacts_inp(contacts_data)"
                                            class="btn text-secondary shadow-none"
                                            data-bs-dismiss="modal">CANCEL</button>
                                        <button type="submit" onclick="upd_general(site_title.value, site_about.value)"
                                            class="btn btn-primary text-white bg-dark shadow-none">SUBMIT</button>
                                    </div>
                                </div>
                        </form>



                    </div>
                </div>





            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>



    <script>
        let general_data, contacts_data;

        let general_s_form = document.getElementById('general_s_form');
        let site_title_inp = document.getElementById('site_title_inp');
        let site_about_inp = document.getElementById('site_about_inp');
        let contacts_s_form = document.getElementById('contacts_s_form');

        let team_s_form = document.getElementById('team_s_form');
        let member_name_inp = document.getElementById('member_name_inp');
        let member_picture_inp = document.getElementById('member_picture_inp');




        function get_general() {
            let site_title = document.getElementById('site_title');
            let site_about = document.getElementById('site_about');



            let shutdown_toggle = document.getElementById('shutdown-toggle');


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Check if the response starts with an HTML tag
                    if (xhr.responseText.trim().startsWith('<')) {
                        // Handle the HTML response
                        console.error('Server returned an HTML response instead of JSON');
                        // You can display an error message or redirect the user
                    } else {
                        try {
                            // Try to parse the response as JSON
                            general_data = JSON.parse(xhr.responseText);

                            site_title.innerText = general_data.site_title;
                            site_about.innerText = general_data.site_about;
                            site_title_inp.value = general_data.site_title;
                            site_about_inp.value = general_data.site_about;

                            if (general_data.shutdown == 0) {
                                shutdown_toggle.checked = false;
                                shutdown_toggle.value = 0;
                            } else {
                                shutdown_toggle.checked = true;
                                shutdown_toggle.value = 1;
                            }
                        } catch (e) {
                            // If the response is not valid JSON, handle the error
                            console.error('Error parsing response as JSON:', e);
                            console.log('Response:', xhr.responseText);
                            // You can display an error message or take other appropriate actions
                        }
                    }
                } else {
                    console.error('Error:', xhr.status);
                }
            }

            xhr.send('get_general');
        }

        general_s_form.addEventListener('submit', function (e) {
            e.preventDefault();
            upd_general(site_title_inp.value, site_about_inp.value);
        })

        function upd_general(site_title_val, site_about_val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                var myModal = document.getElementById('general-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'changes saved!')
                    get_general();
                } else {
                    alert('error', 'no changes made!')

                }
            }
            xhr.send('site_title=' + site_title_val + '&site_about=' + site_about_val + '&upd_general');
        }

        function upd_shutdown(val) {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText == 1 && general_data.shutdown == 0) {
                    alert('success', 'Site has been shutdown!');

                } else {
                    alert('Success', 'Shutdown made off!');

                }
                get_general();
            }
            xhr.send('upd_shutdown=' + val);
        }

        function get_contacts() {

            let contacts_p_id = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'tw'];
            let iframe = document.getElementById('iframe');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.responseType = 'json';
            xhr.onload = function () {
                contacts_data = JSON.parse(this.responseText);
                contacts_data = Object.values(contacts_data);

                for (i = 0; i < contacts_p_id.length; i++) {
                    document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];
                }
                iframe.src = contacts_data[9];
                contacts_inp(contacts_data);



            }

            xhr.send('get_contacts');


        }
        function contacts_inp(data) {
            let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'insta_inp', 'tw_inp', 'iframe_inp'];

            for (i = 0; i < contacts_inp_id.length; i++) {
                document.getElementById(contacts_inp_id[i]).value = data[i + 1];
            }

        }
        contacts_s_form.addEventListener('submit', function (e) {
            e.preventDefault();
            upd_contacts();
        });



        function upd_contacts() {
            let index = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'tw', 'iframe'];
            let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'insta_inp', 'tw_inp', 'iframe_inp'];
            let data_str = "";
            for (i = 0; i < index.length; i++) {
                data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';
            }
            data_str += "upd_contacts";

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                var myModal = document.getElementById('contacts-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 1) {
                    alert('success', 'Changes saved!');
                    get_contacts();

                } else {
                    alert('Success', 'No changes made!');

                }

            }

            xhr.send(data_str);

        }


        team_s_form.addEventListener('submit', function (e) {
            e.preventDefault();
            add_member();
        })

        function add_member() {
            let data = new FormData();
            data.append('name', member_name_inp.value);
            data.append('picture', member_picture_inp.files[0]);
            data.append('add_member', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById('team-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 'inv_img') {
                    alert('error', 'Only JPG and PNG images are allowed');
                } else if (this.responseText == 'inv_size') {
                    alert('error', 'Images should be less than 2MB!');
                } else if (this.responseText == 'upd_failed') {
                    alert('error', 'Image upload failed. Server Down!');
                } else {
                    alert('Success', 'New member added!');
                    member_name_inp.value = '';
                    member_picture_inp.value = '';
                    get_members(); // to display the new member on the dashboard
                }
            }

            xhr.send(data);
        }

        window.onload = function () {
            get_general();
            get_contacts();
        }


        function get_members() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('team-data').innerHTML = this.responseText;


            }



            xhr.send('get_members');
        }

        function rem_member(va1) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText == 1) {
                    alert('success', 'Member removed!');
                    get_members();
                }
                else {
                    alert('error', 'Server down!');
                }

            }

            xhr.send('rem_members=' + val);

        }


        window.onload = function () {
            get_general();
            get_contacts();
            get_members();

        }

    </script>

    <div id="alert-container" data-bs-class="<?php echo $bs_Class; ?>" data-msg="<?php echo $msg; ?>"></div>

    <script>
        function alert(type, msg) {
            let alertContainer = document.getElementById('alert-container');
            let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
            let element = document.createElement('div');
            element.innerHTML = ` <div class="alert ${$bs_Class} alert-warning alert-dismissible fade show custom-alert" role="alert><strong  class="me-3">${$msg}</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
            document.body.append(element);
        }
    </script>
</body>

</html>