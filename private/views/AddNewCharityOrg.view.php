<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <form method="post" class="right">
            <div class="details">
                <div class="steps">
                    <h4>STEP</h4>
                    <div class="step-number"><h3>1</h3></div>
                    <p>ORGANIZATION DETAILS</p>
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
                <input placeholder="ENTER YOUR ORGANIZATION NAME" value="<?=get_var('name')?>" type="text" name="name" class="input" >
                <h4>ORGANIZATION LOGO :</h4>
                <input placeholder="ADD ORGANIZATION OF THE LOGO" value="<?=get_var('logo')?>" type="file" name="logo" class="input" >
                <h4>ORGANIZATION CITY :</h4>
                <input placeholder="ENTER YOUR ORGANIZATION CITY" value="<?=get_var('city')?>" type="text" name="city" class="input">
                <h4>ORGANIZATION EMAIL:</h4>
                <input placeholder="ENTER AN EMAIL" value="<?=get_var('email')?>" type="text" name="email" class="input"> 
                <h4>PHONE NUMBER :</h4>
                <input placeholder="ENTER A PHONE NUMBER" value="<?=get_var('phone')?>" type="text" name="phone" class="input" >
                <h4>ORGANIZATION DESCRIPTION :</h4>
                <input placeholder="ENTER A BRIEF DESCRIPTION ABOUT THE ORGANIZATION" value="<?=get_var('description')?>" type="text" name="description" class="input"> 
                <h4>USERNAME :</h4>
                <input placeholder="ENTER A USERNAME" value="<?=get_var('username')?>" type="username" name="username" class="input" >
                <h4>PASSWORD :</h4>
                <input placeholder="ENTER A PASSWORD" value="<?=get_var('password')?>" type="text" name="password" class="input">
                <h4>CONFIRM PASSWORD  :</h4>
                <input placeholder="RE-ENTER A PASSWORD" value="<?=get_var('confirm_password')?>" type="text" name="confirm_password" class="input">   
                <p>BY REGISTERING YOU AGREE TO OUR <a href="url">TERMS AND CONDITIONS</a> AND <a href="url">PRIVACY POLICY</a></p>                  
            </div>
            <button class="register-button" type="submit">REGISTER NOW</button>
</form>
    </div>

<?php echo $this->view('includes/footer')?>
</body>
</html>
