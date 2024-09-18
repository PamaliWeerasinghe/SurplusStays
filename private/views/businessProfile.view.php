<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<title><?php echo SITENAME ?></title>
<link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/businessProfile.css">
</head>

<body>
    <?php echo $this->view('includes/navbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/businessSidePanel.view.php" ?>
            <div class="dashboard">


                <div class="summary">
                    <div class="notifications"><img src="<?= ASSETS ?>/images/Bell.png" /></div>
                </div>


                <div class="inner-main">
                    <div class="header">
                        <h2>Business Information</h2>
                    </div>

                    <div class="section charity-details">
                        <h3>Business Details</h3>
                        <div class="charity-overview">
                            <div class="image-container">
                                <img class="logo-img" src="<?= ASSETS ?>/images/keels.png" alt="Charity Logo">
                                <!--<div class="overlay">
                                    <div class="camera-icon">
                                        <img src="<?= ASSETS ?>/icons/Camera.png" alt="Camera Icon">
                                    </div>
                                </div>-->
                            </div>
                            <div class="charity-text">
                                <h4>KEELS ORG ⭐ 4.9/5.0</h4>
                                <p><strong>Business type : </strong> supermarket</p>
                                <p><strong>Phone Number:</strong> 0716386868</p>
                                <p><strong>Email Address:</strong> info@keels.lk</p>
                            </div>
                        </div>
                    </div>

                    <div class="section business-address">
                        <h3>Business Address</h3>
                        <div class="charity-info">
                            <p><strong>Street Address:</strong> Keels Org, 208 Bellanthara Rd, Attidiya, Sri Lanka.</p>
                            <p><strong>City:</strong> Colombo</p>
                            </div>
                    </div>

                    <div class="section charity-bank-details">
                        <h3>Charity Details</h3>
                        <div class="charity-info">
                            <p><strong>Owner:</strong> Keels PVT LTD</p>
                            <p><strong>Account Number:</strong> 987654321</p>
                            <p><strong>Account Holder Name:</strong> Saradish</p>
                            <p><strong>Branch:</strong> Matara Branch</p>
                        </div>
                    </div>

                    <div class="section notifications-preferences">
                        <h3>Notifications and Preferences</h3>
                        <div class="charity-info">
                            <label><input class="check" type="checkbox"> Receive notifications for new shops being registered in the website.</label>
                            <label><input class="check" type="checkbox"> Prefer email communication for promotions and updates.</label>
                            <label><input class="check" type="checkbox"> Prefer SMS communication for promotions and updates.</label>
                            <label><input class="check" type="checkbox"> Receive notifications for new donation requests and shop replies via SMS.</label>
                        </div>
                    </div>

                    <div class="section account-security">
                        <h3>Account Security</h3>
                        <div class="charity-info">
                            <p><strong>Change Password:</strong> <a href="#">Click here to change password</a></p>
                            <button>Edit Profile</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
        <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>