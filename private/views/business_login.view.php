<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/styles/register.css">
</head>
<body>
<?php echo $this->view('includes/navbar')?>
    <div class="container">
        <div class="left">
            <img src="<?=ASSETS?>/images/register_background.png" class="left-image" alt="Register image">
            <h3>Welcome Back to SurplusStays!</h3>
            <p>Please sign in to access your account and start making
                a positive impact by connecting with local businesses and surplus food opportunities.
            </p>
        </div>
        <form method="post" class="right">
            <div class="details">
                <?php if (!empty($errors)): ?>
                    <div class="error alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <h4>EMAIL :</h4>
                <input placeholder="ENTER YOUR EMAIL" value="<?=get_var('email')?>" type="email" name="email" class="input">
                
                <h4>PASSWORD :</h4>
                <input placeholder="ENTER YOUR PASSWORD" value="<?=get_var('password')?>" type="password" name="password" class="input">
                <p>FORGOT YOUR PASSWORD? <a href="url">RESET PASSWORD</a> | DON'T HAVE AN ACCOUNT? <a href="url">REGISTER HERE</a></p>                  
            </div>
            <button class="register-button">SIGN IN</button>
        </form>
    </div>
<?php echo $this->view('includes/footer')?>
</body>
</html>