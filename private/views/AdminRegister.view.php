<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/styles/register.css">

</head>
<body>
    
<?php echo $this->view('includes/navbar_unregistered')?>
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
                <!-- <div class="steps">
                    <h4></h4>
                    <div class="step-number"><h3>REGISTER</h3></div>
                    <p></p>
                </div> -->
                <?php if (!empty($errors)): ?>
                    <div class="error alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                
                <h4>EMAIL ADDRESS :</h4>
                <input value="<?=get_var('email')?>" placeholder="ENTER YOUR USERNAME" type="email" class="input"  name="email" required>
                <h4>FULL NAME :</h4>
                <input value="<?=get_var('name')?>" placeholder="ENTER YOUR NAME" type="text" class="input"  name="name" required>
                <h4>PASSWORD :</h4>
                <input value="<?=get_var('password')?>" placeholder="ENTER YOUR PASSWORD" type="password" class="input"  name="password"  required>
                <h4>PROFILE PICTURE</h4>
                    <!-- <div class="file-upload">
                        <img id="previewImage" class="preview" src="" alt="Image Preview">
                        <label for="profile_pic">Choose Image</label>
                        <input id="profile_pic" type="file" name="profile_pic" accept="image/*" onchange="previewImage(this)">
                    </div> -->
                    <input type="file" name="profile_pic" />
         

            </div>
            
            <button type="submit" class="register-button">REGISTER</button>
            </form>  
        </div>
        
       
       
    </div>
   

<?php echo $this->view('includes/footer')?>

<?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
<script src="<?= ROOT ?>/assets/js/adminRegister.js"></script>
