<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/styles/register.css">
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
                    <div class="step-number"><h3>3</h3></div>
                    <p>LOGIN INFORMATION</p>
                </div>
                <h4>USERNAME :</h4>
                <input placeholder="ENTER A USERNAME" type="username" name="username" class="input" >
                <h4>PASSWORD :</h4>
                <input placeholder="ENTER A PASSWORD" type="text" name="password" class="input">
                <h4>CONFIRM PASSWORD  :</h4>
                <input placeholder="RE-ENTER A PASSWORD" type="text" name="password" class="input">   
                <p>BY REGISTERING YOU AGREE TO OUR <a href="url">TERMS AND CONDITIONS</a> AND <a href="url">PRIVACY POLICY</a></p>        
            </div>
            <button class="register-button">REGISTER NOW</button>
        </form>
        
    </div>

<?php echo $this->view('includes/footer')?>
</body>
</html>
