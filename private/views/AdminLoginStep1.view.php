<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/styles/register.css">
    <link rel="stylesheet" href="<?= STYLES ?>/errorAlertPopup.css">
</head>
<body>
    
<?php echo $this->view('includes/navbar_unregistered')?>
    <div class="container">
        <div class="left">
        <img src="<?=ASSETS?>/images/register_background.png" class="left-image" alt="Register image">
            <h3>Join the SurplusStays Network</h3>
            <p>Are you a charity organization looking to receive surplus food donations from local businesses? 
                Register with SurplusStays to connect with donors and help feed those in need.
            </p>
        </div>
        
        <div class="right">
            <div class="details">
                <div class="steps">
                    <h4></h4>
                    <div class="step-number"><h3>User Login</h3></div>
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
                <?php if (!empty($successfull)):?>
                    <div class="successfull-alert-popup">
                                <div class="alert-header2">
                                <span>
                                    <?= $successfull ?>
                                    </span>
                                    <span class="close-btn" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
                                    <!-- <span class="alert-title">Successfull</span> -->

                                   
                                        
                                         
                                </div>
                           
                    </div>
                <?php endif; ?>
                
                <form method="post">
                
                <h4>EMAIL ADDRESS :</h4>
                <input value="<?=get_var('email')?>" placeholder="ENTER YOUR EMAIL" type="email" class="input"  name="email" required>
                <h4>PASSWORD :</h4>
                <input value="<?=get_var('password')?>" placeholder="ENTER YOUR PASSWORD" type="password" class="input"  name="password"  required>
                <p><a style="text-decoration: none;" 
                href="<?=LOGIN?>/forgot">
                 Forgot your password ?
                </a></p>
            </div>
            
            <button type="submit" class="register-button">LOG IN</button>
            </form>  
        </div>
        
       
       
    </div>

<?php echo $this->view('includes/footer')?>
<?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
<script>
            // Auto-hide after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.querySelector('.error alert');
                if (alert) {
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 5000);
                }
            });
        </script>