<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityProfile.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-half">
                <div class="top-bar">
                    <div class="notification">
                        <img src="<?=ASSETS?>/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>
                <div class="charity-info-card">
                    <div class="header">
                        <h2>Charity Information</h2>
                    </div>
                    
                    <div class="section charity-details">
                        <h3>Charity Details</h3>
                        <div class="charity-overview">
                            <div class="image-container">
                            <img class="logo-img" src="<?=ASSETS?>/charityImages/<?=$currUser[0]->profile_pic?>" alt="Charity Logo">
                                <div class="overlay">
                                    <div class="camera-icon">
                                        <img src="<?=ASSETS?>/icons/Camera.png" alt="Camera Icon">
                                    </div>
                                </div>
                            </div>
                            <div class="charity-text">
                                <h4><?=Auth::getName()?> ⭐ 4.7/5.0</h4>
                                <p><strong>Owner:</strong> Dialog Axiata Foundation</p>
                                <p><strong>Phone Number:</strong> <?=$currOrg[0]->phoneNo?></p>
                                <p><strong>Email Address:</strong> <?=$currUser[0]->email?></p>
                            </div>
                        </div>
                    </div>

                    <div class="section business-address">
                        <h3>Business Address</h3>
                        <div class="charity-info">
                            <p><strong>Street Address:</strong> Dialog Axiata PLC, 475, Union Place, Colombo 02, Sri Lanka.</p>
                            <p><strong>City:</strong> Colombo</p>
                            <p><strong>Postal Code:</strong> 12000</p>
                        </div>
                    </div>

                    <div class="section charity-description">
                        <h3>Charity Description</h3>
                        <div class="charity-info">
                            <p>
                            <?=Auth::getCharity_description()?>
                            </p>
                        </div>
                    </div>

                    <div class="section charity-bank-details">
                        <h3>Charity Details</h3>
                        <div class="charity-info">
                            <p><strong>Owner:</strong> Dialog Axiata Foundation</p>
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
    </div>
    <?php echo $this->view('includes/footer')?>
    
</body>
</html>