<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/styles/charity_register.css">
</head>
<body>
<?php echo $this->view('includes/navbar_unregistered')?>

    <div class="container">
        <div class="left">
        <img src="<?=ASSETS?>/images/register_background.png" class="left-image" alt="Register image">
            <h3>Join the SurplusStays Network</h3>
            <p>Welcome to SurplusStays! Register now to start accessing surplus food 
                from local businesses and contribute to a more sustainable future.
            </p>
        </div>
        <form method="post" class="right" enctype="multipart/form-data"> <!--enctype="multipart/form-data" allows file uploads-->
            <div class="details">
                <div class="steps">
                    <h4></h4>
                    <div class="step-number"><h3>PERSONAL AND LOGIN INFORMATION</h3></div>
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

                <h4>FIRST NAME :</h4>
                <input placeholder="ENTER YOUR FIRST NAME" value="<?=get_var('fname')?>" type="text" name="fname" class="input" >
                <h4>LAST NAME :</h4>
                <input placeholder="ENTER YOUR LAST NAME" value="<?=get_var('lname')?>" type="text" name="lname" class="input">
                <h4>EMAIL ADDRESS:</h4>
                <input placeholder="ENTER AN EMAIL" value="<?=get_var('email')?>" type="text" name="email" class="input"> 
                <h4>PHONE NUMBER :</h4>
                <input placeholder="ENTER A PHONE NUMBER" value="<?=get_var('phone')?>" type="text" name="phone" class="input" >
                <h4>USERNAME :</h4>
                <input placeholder="ENTER A USERNAME" value="<?=get_var('username')?>" type="username" name="username" class="input" >
                <h4>PROFILE PICTURE :</h4>
                    <div class="upload-wrapper">
                        <label for="upload-1">
                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview">
                        </label>
                        <input type="file" id="upload-1" name="profile_picture" style="display: none;" accept="image/*">
                    </div>
                <h4>PASSWORD :</h4>
                <input placeholder="ENTER A PASSWORD" value="<?=get_var('password')?>" type="text" name="password" class="input">
                <h4>CONFIRM PASSWORD  :</h4>
                <input placeholder="RE-ENTER A PASSWORD" value="<?=get_var('confirm_password')?>" type="text" name="confirm_password" class="input">   
                <p>BY REGISTERING YOU AGREE TO OUR <a style="text-decoration: none;" href="url">TERMS AND CONDITIONS</a> AND <a style="text-decoration: none;" href="url">PRIVACY POLICY</a></p>                  
            </div>
            <button class="register-button">REGISTER NOW</button>
</form>
    </div>

<?php echo $this->view('includes/footer')?>

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
