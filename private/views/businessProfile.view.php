<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessProfile.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOjGDz3PRLABXKf8sf5d___lX-RuWo3L4&libraries=places&callback=initMap" async defer></script>

    <script>
        let map, marker;

        function initMap() {
            // Get the latitude and longitude from the business profile
            const lat = parseFloat("<?= $currbusiness[0]->latitude ?>");
            const lng = parseFloat("<?= $currbusiness[0]->longitude ?>");

            // Default to the business location or use a fallback location
            const position = {
                lat: isNaN(lat) ? 6.927079 : lat, // Default lat if invalid
                lng: isNaN(lng) ? 79.861244 : lng // Default lng if invalid
            };

            // Initialize the map
            map = new google.maps.Map(document.getElementById("map"), {
                center: position,
                zoom: 14,
            });

            // Place a marker on the map
            marker = new google.maps.Marker({
                position: position,
                map: map,
            });
        }
    </script>
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">

                </div>


                <div class="main-box">
                    <div class="header">
                        <h2>Business Information</h2>
                    </div>

                    <div class="sub-box">
                        <h3>Business Details</h3>
                        <div class="items-row">
                            <div class="image-container">
                                <img class="img" src="<?= ASSETS ?>/businessImages/<?= basename(Auth::getUserPicture()) ?>" alt="Business Logo">
                            </div>
                            <div class="text">
                                <h4><?= $currbusiness[0]->name ?> ⭐ <?=$rating?>/5.0</h4>
                                <p><strong>Business type : </strong> <?= $currbusiness[0]->type ?></p>
                                <p><strong>Phone Number:</strong> <?= $currbusiness[0]->phoneNo ?></p>
                                <p><strong>Email Address:</strong> <?= $curruser[0]->email ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="sub-box">
                        <h3>Business Location</h3>
                        <div class="items-colomn">
                            <p><strong>Location:</strong></p>
                            <div id="map" style="height: 200px; width: 100%;"></div><br>
                        </div>
                    </div>

                    <div class="sub-box">
                        <h3>Account Security</h3>
                        <div class="button-group">
                        
                            <button onclick="window.location.href='<?= ROOT ?>/business/editprofile'">Edit Profile</button>
                            <button onclick="window.location.href='<?= ROOT ?>/business/changepassword/<?= $curruser[0]->id ?>'">Change Password</button>
                            <form id="deleteForm<?= $curruser[0]->id ?>" action="<?= ROOT ?>/business/deleteprofile/<?= $curruser[0]->id ?>" method="post">

                                <button class="deletebutton" type="button" data-form-id="deleteForm<?= $curruser[0]->id ?>">Delete Profile</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Simple Delete Confirmation Popup -->
        <div id="deletePopup" class="popup">
            <div class="popup-content">
                <p>Confirm Profile Deletion</p>
                <p>Are you certain you wish to permanently delete this profile? This action cannot be undone.</p>
                <div class="button-container">
                    <button class="btn-ok" id="confirmDelete">Confirm Deletion</button>
                    <button class="btn-cancel" id="cancelDelete">Cancel</button>
                </div>
            </div>
        </div>

        <script>
            /* deleteform popup */
            let deleteForm = null;

            document.querySelectorAll('.deletebutton').forEach(button => {
                button.addEventListener('click', event => {
                    event.preventDefault();
                    deleteForm = document.getElementById(button.dataset.formId);
                    document.getElementById('deletePopup').style.display = 'block';
                });
            });

            document.getElementById('confirmDelete').addEventListener('click', () => {
                if (deleteForm) deleteForm.submit();
            });

            document.getElementById('cancelDelete').addEventListener('click', () => {
                document.getElementById('deletePopup').style.display = 'none';
            });
        </script>
        <?php echo $this->view('includes/footer') ?>
</body>

</html>