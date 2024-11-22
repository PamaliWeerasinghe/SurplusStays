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
                <input placeholder="ENTER YOUR ORGANIZATION NAME" value='<?=$rows->name?>' type="text" name="name" class="input" >
                <h4>ORGANIZATION LOGO :</h4>
                <input placeholder="ADD ORGANIZATION OF THE LOGO" value="<?=get_var('logo')?>" type="file" name="logo" class="input" >
                <h4>ORGANIZATION CITY :</h4>
                <input placeholder="ENTER YOUR ORGANIZATION CITY" value='<?=$rows->name?>' type="text" name="city" class="input">
                <h4>ORGANIZATION EMAIL:</h4>
                <input placeholder="ENTER AN EMAIL" value='<?=$rows->email?>' type="text" name="email" class="input"> 
                <h4>PHONE NUMBER :</h4>
                <input placeholder="ENTER A PHONE NUMBER" value='<?=$rows->phoneNo?>' type="text" name="phone" class="input" >
                <h4>ORGANIZATION DESCRIPTION :</h4>
                <input placeholder="ENTER A BRIEF DESCRIPTION ABOUT THE ORGANIZATION" value='<?=$rows->charity_description?>' type="text" name="description" class="input"> 
                <h4>USERNAME :</h4>
                <input placeholder="ENTER A USERNAME" value='<?=$rows->username?>' type="username" name="username" class="input" >
                <h4>PASSWORD :</h4>
                <input placeholder="ENTER NEW PASSWORD" value="<?=get_var('password')?>" type="text" name="password" class="input">
                <h4>CONFIRM PASSWORD  :</h4>
                <input placeholder="RE-ENTER NEW PASSWORD" value="<?=get_var('confirm_password')?>" type="text" name="confirm_password" class="input">   
                                  
            </div>
            <button class="register-button" type="submit">UPDATE</button>
</form>
    </div>

<?php echo $this->view('includes/footer')?>
</body>
</html>
