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
        <!-- <div class="right">
            <div class="details">
                <div class="steps">
                    <h4>STEP</h4>
                    <div class="step-number"><h3>1</h3></div>
                    <p>PERSONAL INFORMATION</p>
                </div>
                <h4>FULL NAME :</h4>
                <input placeholder="ENTER YOUR FULL NAME" type="text" class="input" required>
                <h4>EMAIL ADDRESS :</h4>
                <input placeholder="ENTER YOUR EMAIL ADDRESS" type="email" class="input" required>
                        
            </div>
            <button class="register-button" onclick="window.location.href='<?=ROOT?>/charity_register'">RECEIVE VERIFICATION CODE</button>
        </div> -->
        <!-- Enter the verification code -->
        <div class="right">
            <div class="details">
                <div class="steps">
                    <h4>STEP</h4>
                    <div class="step-number"><h3>2</h3></div>
                    <p>VERIFICATION CODE</p>
                </div>
                <h4>VERIFICATION CODE :</h4>
                <input placeholder="ENTER VERIFICATION CODE" type="text" class="input" required>
                
                        
            </div>
            <button class="register-button" onclick="window.location.href='<?=ROOT?>/charity_register'">SIGN IN</button>
        </div>
    </div>

<?php echo $this->view('includes/footer')?>
<?php require APPROOT.'/views/includes/htmlFooter.view.php'?>