<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/CustEditProfile.css">
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
                    <div class="box-header">Edit Profile</div>

                    <div class="profile-form-container">
                        <h3>Account Details</h3>
                        <form method="post" class="right" enctype="multipart/form-data">
                            <!-- Personal Information Section -->
                            <div class="form-section">
                                <br/>
                                <h3>Personal Information</h3>
                                
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input placeholder="First Name" value="<?=get_var('fname')?>" type="text" name="fname" class="input">
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input placeholder="Last Name" value="<?=get_var('lname')?>" type="text" name="lname" class="input">
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input placeholder="Email Address" value="<?=get_var('email')?>" type="text" name="email" class="input">
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input placeholder="Phone Number" value="<?=get_var('phone')?>" type="text" name="phone" class="input">
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input placeholder="Username" value="<?=get_var('username')?>" type="text" name="username" class="input">
                                </div>
                                
                                <h4>PROFILE PICTURE :</h4>
                                <div class="upload-wrapper">
                                    <label for="upload-1">
                                        <img src="<?=ASSETS?>/customerImages/upload_image.png" alt="Upload Image" class="upload-icon" id="profilePreview" style="width: 100px; height:100px;">
                                    </label>
                                    <input type="file" id="upload-1" name="profile_pic" style="display: none;" accept="image/*">
                                </div>
                            </div>
                            <div class="end-btns">
                                <button type="submit" class="save-btn">Save Changes</button>
                                <a href="<?= ROOT ?>/customer/profile" class="cancel-btn">Cancel</a>
                                
                            </div>
                        </form>
                        <br/><br/>

                        <form method="post" action="<?= ROOT ?>/customer/deleteAccount" method="post">
                            <h3>Account Deletion</h3>
                            <p class="warning-text">Are you sure you want to delete your account? All order history and payment history will be permanently deleted.</p>
                            <span>
                                <input type="checkbox" name="confirm_delete" required>
                                <span>Yes, I understand and want to permanently delete my account.</span>
                            </span>
                            <br/><br/><br/>
                            <div style="text-align: right;">
                                <div style="display: inline-block; margin-left: 10px;">
                                    <button type="submit" name="delete_account" class="save-btn" style="background-color: #ce4545">Delete Account</button>
                                </div>
                                <div style="display: inline-block; margin-left: 10px;">
                                    <a href="<?= ROOT ?>/customer/profile" class="cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    
                </div>

                
            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
    </div>

    <script>
        document.getElementById('upload-1').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>