<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Business</title>
    <!-- <link rel="stylesheet" href="<?=ROOT?>/assets/styles/charity_register.css"> -->
    <link rel="stylesheet" href="<?=STYLES?>/charity_register.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoo4pzFf80sXYMtcQUux4CWSCY9nDbvig&libraries=places"></script>
    <script>
        let map, marker;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 6.927079, lng: 79.861244 },
                zoom: 8,
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
<?php echo $this->view('includes/navbar')?>

    <div class="container">
        <div class="left">
        <img src="<?=ASSETS?>/images/register_background.png" class="left-image" alt="Register image">
            <h3>Join the SurplusStays Network</h3>
            <p>Are you a charity organization looking to receive surplus food donations from local businesses? 
                Register with SurplusStays to connect with donors and help feed those in need.
            </p>
        </div>
        <form method="post" class="right" enctype="multipart/form-data">
            <div class="details">
                <div class="steps">
                <div class="step-number"><h3>BUSINESS DETAILS</h3></div>
                    
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
                <input placeholder="ENTER NAME" value='<?=get_var('name')?>' type="text" name="name" class="input" >
                
                <h4>BUSINESS LOGO :</h4>
                <div class="upload-wrapper">
                        <label for="upload-1">
                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview">
                        </label>
                        <input type="file" id="upload-1" name="profile_picture" style="display: none;" accept="image/*">
                    </div>
                <h4>BUSINESS LOCATION :</h4>
                
                <input type="hidden" id="latitude" name="latitude" placeholder="Latitude" readonly required><br>
                <input type="hidden" id="longitude" name="longitude" placeholder="Longitude" readonly required><br>
                <div id="map" style="height: 400px; width: 100%;"></div><br>
                <h4>BUSINESS EMAIL:</h4>
                <input placeholder="ENTER EMAIL" value='<?=get_var('email')?>' type="text" name="email" class="input"> 
                <h4>CONTACT NUMBER :</h4>
                <input placeholder="ENTER CONTACT NUMBER" value='<?=get_var('phone')?>' type="text" name="phone" class="input" >
                <h4>USERNAME :</h4>
                <input placeholder="ENTER USERNAME" value='<?=get_var('username')?>' type="username" name="username" class="input" >
                <h4>PASSWORD :</h4>
                <input placeholder="ENTER A PASSWORD" value="<?=get_var('password')?>" type="text" name="password" class="input">
                <h4>CONFIRM PASSWORD  :</h4>
                <input placeholder="RE-ENTER A PASSWORD" value="<?=get_var('confirm_password')?>" type="text" name="confirm_password" class="input">   
                <p>BY REGISTERING YOU AGREE TO OUR <a style="text-decoration: none;" href="url">TERMS AND CONDITIONS</a> AND <a style="text-decoration: none;" href="url">PRIVACY POLICY</a></p>                  
            </div>
            <button class="register-button" type="submit">REGISTER</button>
</form>
    </div>

<?php echo $this->view('includes/footer')?>

<!-- <script>
    document.getElementById('upload-1').addEventListener('change', function(e) {
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Profile Preview';
            img.style.width = '100px';
            img.style.height = '100px';
            // document.getElementById('profile-pic-preview').innerHTML = img;
            document.getElementById('profile-pic-preview').src=img.src;
            
        }
        reader.readAsDataURL(file);
    }
});
</script> -->
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
