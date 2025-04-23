<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/customer.css">
    <link rel="stylesheet" href="<?= STYLES ?>/customerDashboard.css">
    <link rel="stylesheet" href="<?= STYLES ?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?= STYLES ?>/custProfile.css">
</head>
<body>
    <div class="main-div">
        <?php echo $this->view('includes/charitynavbar') ?>
        <div class="sub-div-1">
            <?php require APPROOT."/views/includes/customerSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="top-bar">
                        <div class="search-bar">
                            <!-- <input type="text" placeholder="Search..." /> -->
                        </div>
                        <div class="notification">
                            <!-- <img src="<?= ASSETS ?>/images/Bell.png" alt="Notification Bell" class="bell-icon"> -->
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">Profile</div>

                    <div class="profile-content">
                        <div class="profile-grid">
                            <div class="profile-avatar">
                                <div class="avatar-frame">
                                    <img src="<?= ASSETS ?>/customerImages/<?= !empty($user[0]->profile_pic) ? basename($user[0]->profile_pic) : 'keels.jpg' ?>" 
                                         alt="profile picture" 
                                         class="profile-pic">
                                </div>
                                <div class="profile-username">@<?= $cust[0]->username ?? '' ?></div>
                            </div>
                            
                            <div class="profile-details">
                                <div class="detail-row">
                                    <span class="detail-label">Full Name:</span>
                                    <span class="detail-text"><?= $cust[0]->fname ?? '' ?> <?= $cust[0]->lname ?? '' ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Email Address:</span>
                                    <span class="detail-text"><?= $user[0]->email ?? '' ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Phone Number:</span>
                                    <span class="detail-text"><?= $cust[0]->phoneNo ?? '' ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Member Since:</span>
                                    <span class="detail-text"><?= !empty($user[0]->reg_date) ? date('F j, Y', strtotime($user[0]->reg_date)) : 'Not available' ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="profile-actions">
                            <a href="<?= ROOT ?>/customer/editProfile" class="profile-btn edit-btn">
                                <svg class="icon" viewBox="0 0 24 24" width="18" height="18">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                                Edit Profile
                            </a>
                            <button class="profile-btn change-password-btn" onclick="window.location.href='<?= ROOT ?>/customer/changepassword'">
                                <svg class="icon" viewBox="0 0 24 24" width="18" height="18">
                                    <path fill="currentColor" d="M12,3A4,4 0 0,0 8,7V8H7A1,1 0 0,0 6,9V19A1,1 0 0,0 7,20H17A1,1 0 0,0 18,19V9A1,1 0 0,0 17,8H16V7A4,4 0 0,0 12,3M12,5A2,2 0 0,1 14,7V8H10V7A2,2 0 0,1 12,5Z" />
                                </svg>
                                Change Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>
</body>
</html>
