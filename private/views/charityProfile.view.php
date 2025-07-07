<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityProfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-half">
                <div class="top-bar">
                    <div class="notification">
                        <div class="notification-icon">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </div>
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
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="charity-text">
                                <div class="charity-name">
                                    <h4><?=$currOrg[0]->name?></h4>
                                    <div class="rating">
                                        <span class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                        <span class="score">4.7/5.0</span>
                                    </div>
                                </div>
                                <div class="charity-contact">
                                    <p><i class="fas fa-building"></i> <strong>Username:</strong> <?=$currOrg[0]->username?> </p>
                                    <p><i class="fas fa-phone-alt"></i> <strong>Phone:</strong> <?=$currOrg[0]->phoneNo?></p>
                                    <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <?=$currUser[0]->email?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section business-address">
                        <h3><i class="fas fa-map-marker-alt"></i> Business Address</h3>
                        <div class="charity-info">
                            <p><strong>Street Address:</strong> Dialog Axiata PLC, 475, Union Place, Colombo 02, Sri Lanka.</p>
                            <p><strong>City:</strong><?=$currOrg[0]->city?></p>
                            <p><strong>Postal Code:</strong> <?=$postalCode?></p>
                        </div>
                    </div>

                    <div class="section charity-description">
                        <h3><i class="fas fa-info-circle"></i> Charity Description</h3>
                        <div class="charity-info">
                            <p><?=$currOrg[0]->charity_description?></p>
                        </div>
                    </div>

                    <div class="section notifications-preferences">
                        <h3><i class="fas fa-cog"></i> Notifications and Preferences</h3>
                        <div class="charity-info">
                            <div class="preference-item">
                                <label>
                                    <input class="check" type="checkbox">
                                    <span>Receive notifications for new shops being registered in the website.</span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <label>
                                    <input class="check" type="checkbox">
                                    <span>Prefer email communication for promotions and updates.</span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <label>
                                    <input class="check" type="checkbox">
                                    <span>Prefer SMS communication for promotions and updates.</span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <label>
                                    <input class="check" type="checkbox">
                                    <span>Receive notifications for new donation requests and shop replies via SMS.</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="section account-security">
                        <h3><i class="fas fa-shield-alt"></i> Account Security</h3>
                        <div class="charity-info">
                            <p><strong>Change Password:</strong> <a href="#" class="change-password">Click here to change password</a></p>
                            <button class="edit-profile-btn" onclick="window.location.href='<?= ROOT ?>/charity/editProfile'"><i class="fas fa-edit"></i> Edit Profile</button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>
    
</body>
</html>