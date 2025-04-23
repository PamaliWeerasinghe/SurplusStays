<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/custEditProfile.css">
</head>

<body>
    <!-- navbar -->
    <div class="main-div">
        <?php echo $this->view('includes/navbar')?>
        <div class="sub-div-1">
            <!-- included the admin side panel -->
            <?php require APPROOT."/views/includes/customerSidePanel.view.php"?>
            <div class="dashboard">
                <div class="summary">
                    <div class="top-bar">
                        <div class="search-bar">
                            <!-- <input type="text" placeholder="Search..." /> -->
                        </div>
                        <div class="notification">
                            <!-- <img src="<?=ASSETS?>/images/Bell.png" alt="Notification Bell" class="bell-icon"> -->
                        </div>
                    </div>
                </div>

                <div class="box" style="margin-top:-20%">
    <div class="box-header">Change Password</div>

    <div class="sub-heading" style="background-color:white; padding:10px; padding-left:30px;">
        <?= $cust[0]->fname . ' ' . $cust[0]->lname ?>
    </div>

    <div class="password-form" style="padding:7%">
        <form method="post">
            <?php if (!empty($errors['database'])): ?>
                <div class="error" style="color:red; margin-bottom:15px;"><?= $errors['database'] ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="current-password">Current Password</label>
                <input type="password" id="current-password" name="current-password" required>
                <?php if (!empty($errors['current-password'])): ?>
                    <div class="error" style="color:red; font-size:0.8em;"><?= $errors['current-password'] ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="password" id="new-password" name="new-password" required>
                <?php if (!empty($errors['new-password'])): ?>
                    <div class="error" style="color:red; font-size:0.8em;"><?= $errors['new-password'] ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="reenter-password">Re-enter New Password</label>
                <input type="password" id="reenter-password" name="reenter-password" required>
                <?php if (!empty($errors['reenter-password'])): ?>
                    <div class="error" style="color:red; font-size:0.8em;"><?= $errors['reenter-password'] ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-actions" style="margin-top:20px; display:flex; gap:10px; justify-content:flex-end;">
                <button type="submit" class="save-btn" style="padding:10px 20px; border-radius:4px; cursor:pointer;">
                    Save Changes
                </button>
                <a href="<?= ROOT ?>/customer/profile" class="cancel-btn" style="padding:10px 20px; text-decoration:none; border-radius:4px;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>


                
            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
    </div>

</body>
</html>
