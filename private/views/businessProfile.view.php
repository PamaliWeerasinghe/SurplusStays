<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessProfile.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoo4pzFf80sXYMtcQUux4CWSCY9nDbvig&libraries=places&callback=initMap" async defer></script>
    
    <script>
        let map, marker;

        function initMap() {
            // Get the latitude and longitude from the business profile
            const lat = parseFloat("<?= Auth::getLatitude() ?>");
            const lng = parseFloat("<?= Auth::getLongitude() ?>");

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
                                <img class="img" src="<?= ASSETS ?>/businessImages/<?= basename(Auth::getPicture()) ?>" alt="Business Logo">
                            </div>
                            <div class="text">
                                <h4><?= Auth::getName() ?> ⭐ 4.9/5.0</h4>
                                <p><strong>Business type : </strong> <?= Auth::gettype() ?></p>
                                <p><strong>Phone Number:</strong> <?= Auth::getphone_No() ?></p>
                                <p><strong>Email Address:</strong> <?= Auth::getemail() ?></p>
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
                        <div class="items-colomn">
                            <p><strong>Change Password : </strong> <a href="#">Click here to change password</a></p>
                            <button onclick="window.location.href='<?= ROOT ?>/business/editprofile'">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
</body>

</html>
