<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
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
                    <p>PERSONAL INFORMATION</p>
                </div>
                <?php if(count($errors)>0): ?>
                <div class="alert">
                    <div>
                        <strong>Errors:</strong>
                        <button type="button">&times;</button>
                    </div>
                    <?php foreach($errors as $error):?>
                        <div>
                            <?=$error?>
                        </div>
                    <?php endforeach ?>
                </div>
                <?php endif; ?>
                <form method="post">
                <h4>FULL NAME :</h4>
                <input value="<?=get_var('fullName')?>" placeholder="ENTER YOUR FULL NAME" type="text" class="input"  name="fullName"  required>
                <h4>EMAIL ADDRESS :</h4>
                <input value="<?=get_var('email')?>" placeholder="ENTER YOUR EMAIL ADDRESS" type="email" class="input"  name="email" required>
               
            </div>
            <button type="submit" class="register-button">RECEIVE VERIFICATION CODE</button>
            </form>  
        </div>
        
       
       
    </div>

<?php echo $this->view('includes/footer')?>
<?php require APPROOT.'/views/includes/htmlFooter.view.php'?>