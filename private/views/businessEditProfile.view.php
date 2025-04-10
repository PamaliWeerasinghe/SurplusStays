<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/styles/business_register.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoo4pzFf80sXYMtcQUux4CWSCY9nDbvig&libraries=places&callback=initMap" async defer></script>

    <script>
        let map, marker;

        function initMap() {
            const lat = parseFloat("<?= Auth::getLatitude() ?>");
            const lng = parseFloat("<?= Auth::getLongitude() ?>");
            const position = {
                lat: isNaN(lat) ? 6.927079 : lat,
                lng: isNaN(lng) ? 79.861244 : lng
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: position,
                zoom: 14,
            });

            marker = new google.maps.Marker({
                position: position,
                map: map,
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

<body>
    <?php echo $this->view('includes/navbar_unregistered') ?>

    <div class="container">
        <div class="left">
            <img src="<?= ASSETS ?>/images/register_background.png" class="left-image" alt="Register image">
            <h3>Join the SurplusStays Network</h3>
            <p>Are you a business looking to make a positive impact by reducing food waste and helping those in need? Register with SurplusStays and start donating your surplus food today.</p>
        </div>

        <form method="post" class="right" enctype="multipart/form-data">
            <div class="details">
                <div class="steps">
                    <h3>BUSINESS DETAILS</h3>
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
                <input placeholder="ENTER YOUR BUSINESS NAME" value="<?= get_var('name', $row[0]->name) ?>" type="text" name="name" class="input">

                <h4>BUSINESS TYPE :</h4>
                <select name="type" class="select">
                    <option value="" disabled selected>SELECT THE TYPE</option>
                    <option value="Individual" <?= get_var('type', $row[0]->type) == 'Individual' ? 'selected' : '' ?>>Individual</option>
                    <option value="Smallbusiness" <?= get_var('type', $row[0]->type) == 'Smallbusiness' ? 'selected' : '' ?>>Smallbusiness</option>
                    <option value="Supermarket" <?= get_var('type', $row[0]->type) == 'Supermarket' ? 'selected' : '' ?>>Supermarket</option>
                    <option value="Other" <?= get_var('type', $row[0]->type) == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>

                <h4>BUSINESS EMAIL:</h4>
                <input placeholder="ENTER AN EMAIL" value="<?= get_var('email', $row[0]->email) ?>" type="text" name="email" class="input">

                <h4>PHONE NUMBER :</h4>
                <input placeholder="ENTER A PHONE NUMBER" value="<?= get_var('phone', $row[0]->phone_no) ?>" type="text" name="phone" class="input">

                <h4>BUSINESS LOCATION :</h4>
                <input type="hidden" id="latitude" name="latitude" value="<?= get_var('latitude', $row[0]->latitude ?? '') ?>">
                <input type="hidden" id="longitude" name="longitude" value="<?= get_var('longitude', $row[0]->longitude ?? '') ?>">
                <div id="map" style="height: 400px; width: 100%;"></div><br>

                <h4>USERNAME :</h4>
                <input placeholder="ENTER A USERNAME" value="<?= get_var('username', $row[0]->username) ?>" type="text" name="username" class="input">

                <h4>PROFILE PICTURE :</h4>
                <div class="upload-wrapper">
                    <?php
                    $picturePath = !empty($row[0]->pictures) ? htmlspecialchars($row[0]->pictures) : '';
                    ?>
                    <label for="upload-1">
                        <img 
                            src="<?= $picturePath ? ROOT . $picturePath : ASSETS . '/icons/uploadArea.png' ?>" 
                            alt="Upload Image" 
                            class="upload-icon" 
                            id="profilePreview-1"
                            style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;"
                        >
                        <?php if ($picturePath): ?>
                            <img class="delete-btn" src="<?= ASSETS ?>/icons/delete-button.png" alt="Delete">
                        <?php endif; ?>
                    </label>
                    <input type="file" id="upload-1" name="upload-1" style="display: none;">
                </div>
            </div>

            <button class="register-button">CONFIRM</button>
        </form>
    </div>

    <?php echo $this->view('includes/footer') ?>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('upload-1').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('profilePreview-1');
                    previewImage.src = e.target.result; // Update image source
                    previewImage.style.display = 'block'; // Ensure it's visible
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
