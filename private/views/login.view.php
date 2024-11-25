<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/styles/register.css">
<body>
<?php echo $this->view('includes/navbar')?>

    <div class="container">
        <div class="left">
        <img src="<?=ASSETS?>/images/register_background.png" class="left-image" alt="Register image">
            <h3>Login with Surplus Stays</h3>
            <p>Join our community and start making a difference today. 
                Whether you're a business looking to donate surplus food or a customer wanting to purchase quality surplus items, 
                registering with SurplusStays is easy and free!
            </p>
        </div>
        <div class="right">
            <button class="register-button">Customer Login</button>
            <button class="register-button">Business Login</button>
            <button class="register-button" onclick="window.location.href='<?=ROOT?>/login/charityLogin'">Charity Login</button>
                <p>Don't have an account? <a href='<?=ROOT?>/register'>SIGN UP HERE</a></p>
            </div>
        </div>
    </div>

<?php echo $this->view('includes/footer')?>
</body>
</html>
