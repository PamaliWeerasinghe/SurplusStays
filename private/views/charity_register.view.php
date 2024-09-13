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
        <div class="right">
            <div class="details">
                <div class="steps">
                    <h4>STEP</h4>
                    <div class="step-number"><h3>1</h3></div>
                    <p>ORGANIZATION DETAILS</p>
                </div>
                <h4>ORGANIZATION NAME :</h4>
                <input placeholder="ENTER YOUR ORGANIZATION NAME" type="text" class="input" >
                <h4>ORGANIZATION TYPE :</h4>
                <input placeholder="ENTER YOUR ORGANIZATION TYPE" type="text" class="input">
                <h4>EMAIL OR PHONE NUMBER :</h4>
                <input placeholder="ENTER AN EMAIL OR PHONE NUMBER" type="text" class="input">           
            </div>
            <button class="register-button" onclick="window.location.href='<?=ROOT?>/charity_register'">NEXT</button>
        </div>
    </div>

<?php echo $this->view('includes/footer')?>
</body>
</html>
