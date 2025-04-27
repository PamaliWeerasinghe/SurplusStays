<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessEditProfile.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOjGDz3PRLABXKf8sf5d___lX-RuWo3L4&libraries=places&callback=initMap" async defer></script>

    <script>
        let map, marker;

        function initMap() {
            const lat = parseFloat("<?=$currbusiness[0]->latitude?>");
            const lng = parseFloat("<?= $currbusiness[0]->longitude ?>");
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
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                </div>

                <div class="main-box">
                    <div class="header">
                        <h2>Edit Profile</h2>
                    </div>

                    <form method="POST" enctype="multipart/form-data">

                        <?php if (!empty($errors)): ?>
                            <div class="error alert">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="input-group">
                            <label>Business Name :</label>
                            <input placeholder="ENTER YOUR BUSINESS NAME" value="<?= get_var('name', $currbusiness[0]->name) ?>" type="text" name="name">
                        </div>

                        <div class="input-group">
                            <label>Business Type :</label>
                            <select name="type">
                                <option value="" disabled>SELECT THE TYPE</option>
                                <option value="Individual" <?= get_var('type', $currbusiness[0]->type) == 'Individual' ? 'selected' : '' ?>>Individual</option>
                                <option value="Smallbusiness" <?= get_var('type', $currbusiness[0]->type) == 'Smallbusiness' ? 'selected' : '' ?>>Smallbusiness</option>
                                <option value="Supermarket" <?= get_var('type', $currbusiness[0]->type) == 'Supermarket' ? 'selected' : '' ?>>Supermarket</option>
                                <option value="Bakery" <?= get_var('type', $currbusiness[0]->type) == 'Bakery' ? 'selected' : '' ?>>Bakery</option>
                                <option value="Other" <?= get_var('type', $currbusiness[0]->type) == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>


                        </div>

                        <div class="input-group">
                            <label>Email :</label>
                            <input placeholder="ENTER AN EMAIL" value="<?= $curruser[0]->email?>" type="text" name="email" disabled>
                        </div>

                        <div class="input-group">
                            <label>Phone Number :</label>
                            <input placeholder="ENTER A PHONE NUMBER" value="<?= get_var('phone', $currbusiness[0]->phoneNo) ?>" type="text" name="phone">
                        </div>

                        <div class="input-group">
                            <label>Business Location :</label>
                            <input type="hidden" id="latitude" name="latitude" value="<?= get_var('latitude', $currbusiness[0]->latitude ?? '') ?>">
                            <input type="hidden" id="longitude" name="longitude" value="<?= get_var('longitude', $currbusiness[0]->longitude ?? '') ?>">
                            <div id="map" style="height: 400px; width: 100%;"></div><br>
                        </div>

                        <div class="input-group">
                            <label>Username :</label>
                            <input placeholder="ENTER A USERNAME" value="<?= get_var('username', $currbusiness[0]->username) ?>" type="text" name="username">
                        </div>

                        <div class="input-group">
                        <label for="expiration">Profile Picture :</label>
                        <div class="upload-wrapper">
                            <label for="upload-1">
                                <?php if (!empty($curruser[0]->profile_pic)): ?>
                                    <img src="<?= ASSETS ?>/businessImages/<?= $curruser[0]->profile_pic ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                <?php else: ?>
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                <?php endif; ?>
                            </label>
                            <input type="file" id="upload-1" name="upload-1" style="display: none;">
                        </div>
                        </div>

                        <div class="button-group">
                            <a href="<?= ROOT ?>/business/profile">
                                <button type="button" class="btn-cancel">Cancel</button>
                            </a>
                            <button type="submit" class="btn-create">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>

        
        <script>

            document.getElementById('upload-1').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewImage = document.getElementById('profilePreview-1');
                        previewImage.src = e.target.result; 
                        
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>

</body>
</html>