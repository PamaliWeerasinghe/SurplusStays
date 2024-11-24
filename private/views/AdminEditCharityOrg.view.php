<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Charity</title>
    <!-- <link rel="stylesheet" href="<?=ROOT?>/assets/styles/charity_register.css"> -->
    <link rel="stylesheet" href="<?=STYLES?>/charity_register.css">
</head>
<body>
<?php echo $this->view('includes/navbar')?>

    <div class="container">
        <div class="left">
        <img src="<?=ASSETS?>/images/register_background.png" class="left-image" alt="Register image">
            <h3>Join the SurplusStays Networkt</h3>
            <p>Are you a charity organization looking to receive surplus food donations from local businesses? 
                Register with SurplusStays to connect with donors and help feed those in need.
            </p>
        </div>
        <form method="post" class="right" enctype="multipart/form-data">
            <div class="details">
                <div class="steps">
                    
                    <h3><b>ORGANIZATION DETAILS</b></h3>
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

                <h4>ORGANIZATION NAME :</h4>
                <input placeholder="<?=$rows->name?>" value='<?=get_var('name')?>' type="text" name="name" class="input" >
                
                <h4>ORGANIZATION LOGO :</h4>
                <!-- <input placeholder="ADD ORGANIZATION OF THE LOGO" value="<?=get_var('logo')?>" type="file" name="logo" class="input" > -->
                <!-- <div class="img-container">
                <div id="profile-pic-preview" class="preview-container">
                    <p class="preview-placeholder">No image selected</p>
                    
                </div>
                   
                    <input type="file" id="profilePic" accept="image/*"/>
                
                
                </div> -->
                <div class="upload-container">
                        <div class="logo-icon-preview">
                        <img src="<?=$rows->picture?>" alt="Profile Picture" id="profile-pic-preview">
                        <input type="file" id="profilePic" name="file" />
                        </div>
                       
                        
                </div>

                <h4>ORGANIZATION CITY :</h4>
                <input placeholder="<?=$rows->city?>" value='<?=get_var('city')?>' type="text" name="city" class="input">
                <h4>ORGANIZATION EMAIL:</h4>
                <input placeholder="<?=$rows->email?>" value='<?=get_var('email')?>' type="text" name="email" class="input"> 
                <h4>PHONE NUMBER :</h4>
                <input placeholder="<?=$rows->phoneNo?>" value='<?=get_var('phone')?>' type="text" name="phone" class="input" >
                <h4>ORGANIZATION DESCRIPTION :</h4>
                <input placeholder="<?=$rows->charity_description?>" value='<?=get_var('description')?>' type="text" name="description" class="input"> 
                <h4>USERNAME :</h4>
                <input placeholder="<?=$rows->username?>" value='<?=get_var('username')?>' type="username" name="username" class="input" >
                <h4>PASSWORD :</h4>
                <input placeholder="ENTER NEW PASSWORD" value="<?=get_var('password')?>" type="text" name="password" class="input">
                <h4>CONFIRM PASSWORD  :</h4>
                <input placeholder="RE-ENTER NEW PASSWORD" value="<?=get_var('confirm_password')?>" type="text" name="confirm_password" class="input">   
                                  
            </div>
            <button class="register-button" type="submit">UPDATE</button>
</form>
    </div>

<?php echo $this->view('includes/footer')?>

<script>
    document.getElementById('profilePic').addEventListener('change', function(e) {
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
</script>


</body>
</html>
