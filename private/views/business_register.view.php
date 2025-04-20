<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/styles/business_register.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOjGDz3PRLABXKf8sf5d___lX-RuWo3L4&libraries=places"></script>
    <script>
        let map, marker;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 6.927079, lng: 79.861244 },
                zoom: 8,
            });

            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length === 0) return;

                if (marker) marker.setMap(null);

                const place = places[0];
                if (!place.geometry || !place.geometry.location) return;

                marker = new google.maps.Marker({
                    map,
                    position: place.geometry.location,
                });

                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;

                map.setCenter(place.geometry.location);
                map.setZoom(15);
            });

            google.maps.event.addListener(map, 'click', function(event) {
                const lat = event.latLng.lat();
                const lng = event.latLng.lng();
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;

                if (marker) marker.setMap(null);
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                });
            });
        }
    </script>

</head>

<body onload="initMap()">
    <?php echo $this->view('includes/navbar_unregistered') ?>
    <div class="container">
        <div class="left">
            <img src="<?= ASSETS ?>/images/register_background.png" class="left-image" alt="Register image">
            <h3>Join the SurplusStays Networkt</h3>
            <p>Are you a business looking to make a positive impact by reducing food waste and helping those in need? Register with SurplusStays and start donating your surplus food today.
            </p>
        </div>
        <form method="post" class="right" enctype="multipart/form-data"> <!--enctype="multipart/form-data" allows file uploads-->
            <div class="details">
                <div class="steps">
                    <h4></h4>
                    <div class="step-number">
                        <h3>BUSINESS DETAILS</h3>
                    </div>
                    <p></p>
                </div>
                <?php if (!empty($errors)): ?>
                    <div class="error alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <h4>BUSINESS NAME :</h4>
                <input placeholder="ENTER YOUR BUSINESS NAME" value="<?= get_var('name') ?>" type="text" name="name" class="input">
                <h4>BUSINESS TYPE :</h4>
                <select name="type" class="select">
                    <option <?= get_select('type', '') ?> value="">SELECT THE TYPE</option>
                    <option <?= get_select('type', 'Individual') ?> value="Individual">Individual</option>
                    <option <?= get_select('type', 'Smallbusiness') ?> value="Smallbusiness">Smallbusiness</option>
                    <option <?= get_select('type', 'Supermarket') ?> value="Supermarket">Supermarket</option>
                    <option <?= get_select('type', 'Other') ?> value="Other">Other</option>
                </select>
                <h4>BUSINESS EMAIL:</h4>
                <input placeholder="ENTER AN EMAIL" value="<?= get_var('email') ?>" type="text" name="email" class="input">
                <h4>PHONE NUMBER :</h4>
                <input placeholder="ENTER A PHONE NUMBER" value="<?= get_var('phone') ?>" type="text" name="phone" class="input">
                <h4>BUSINESS LOCATION :</h4>
                <!-- <input placeholder="ENTER YOUR BUSINESS ADDRESS" value="?= get_var('address') ?>" type="text" name="address" class="input"> -->
                <input type="hidden" id="latitude" name="latitude" placeholder="Latitude" readonly required><br>
                <input type="hidden" id="longitude" name="longitude" placeholder="Longitude" readonly required><br>
                <input id="pac-input" class="input" type="text" placeholder="Search for your business location"
                style="margin-top:60px;margin-left:-60px;padding:8px;width:220px;z-index:5;position:absolute;top:10px;left:50%;transform:translateX(-50%);border:1px solid #ccc;border-radius:4px;">

                <div id="map" style="height: 400px; width: 100%;"></div><br>

                <h4>USERNAME :</h4>
                <input placeholder="ENTER A USERNAME" value="<?= get_var('username') ?>" type="username" name="username" class="input">
                <h4>PROFILE PICTURE :</h4>
                <div class="upload-wrapper">
                    <label for="upload-1">
                        <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview">
                    </label>
                    <input type="file" id="upload-1" name="profile_picture" style="display: none;" accept="image/*">
                </div>
                <h4>PASSWORD :</h4>
                <input placeholder="ENTER A PASSWORD" value="<?= get_var('password') ?>" type="text" name="password" class="input">
                <h4>CONFIRM PASSWORD :</h4>
                <input placeholder="RE-ENTER A PASSWORD" value="<?= get_var('confirm_password') ?>" type="text" name="confirm_password" class="input">
                <p>BY REGISTERING YOU AGREE TO OUR <a style="text-decoration: none;" href="url">TERMS AND CONDITIONS</a> AND <a style="text-decoration: none;" href="url">PRIVACY POLICY</a></p>
            </div>
            <button class="register-button">REGISTER NOW</button>
        </form>
    </div>
    <?php echo $this->view('includes/footer') ?>

    <!-- JavaScript to Show Preview -->
    <script>
        document.getElementById('upload-1').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>