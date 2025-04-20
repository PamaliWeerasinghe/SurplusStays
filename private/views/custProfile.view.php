<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/custProfile.css">




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
                            <input type="text" placeholder="Search..." />
                        </div>
                        <div class="notification">
                            <img src="<?=ASSETS?>/images/Bell.png" alt="Notification Bell" class="bell-icon">
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        Profile
                    </div>

                    <div class="row" style="display: flex; justify-content: flex-start; align-items: left;">
                        <!-- Image Column -->
                        <div class="column" style="width: 40%; text-align: center;">
                            <img src="<?=ASSETS?>/images/profilepic.jpg" alt="profile picture" class="profile-pic" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                            <p>@username</p>
                        </div>
                        <!-- Details Column -->
                        <div class="column" style="margin-left: 50px; width: 50%; display: flex; flex-direction: column; justify-content: left;">
                            <p><b>Name</b>: Janitha Chathuni</p>
                            <p><b>Email</b>: abc@gmail.com</p>
                            <p><b>Phone Number</b>: 0 123 456 789</p>
                        </div>
                    </div>

                    <div style="padding: 50px; padding-left: 150px; align-items: centre;">
                        <button class="profile-btn">Edit Profile</button>
                        <button class="profile-btn" onclick='window.location.href="http://localhost/surplusstays/public/customer/changepassword"'>Change Password</a></button>
                    </div>


                </div>


            </div>
            
        </div>
        <?php echo $this->view('includes/footer')?>
    </div>
    
</body>

</html>