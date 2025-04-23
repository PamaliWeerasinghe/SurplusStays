<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Account Password</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../public/assets/styles/CustSidePanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/CustTopPanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/custChangePassword.css">
</head>


<body style="font-family:Outfit, sans-serif">
    <div class="container">
        <!-- sidebar -->
        <div class="side-nav">
            <div class="profile-section">
                <img src="../../public/assets/images/sample_profile_pic.png" alt="Profile Image" class="profile-image">
                <h2>Hi Janitha!</h2>
            </div>
            <ul class="nav-links">
                <li class="nav-item "><a href="#">Dashboard</a></li>
                <li class="nav-item"><a href="#">Manage Events</a></li>
                <li class="nav-item"><a href="#">Donations</a></li>
                <li class="nav-item"><a href="#">Browse Shops</a></li>
                <li class="nav-item active"><a href="#">Orders</a></li>
                <li class="nav-item"><a href="#">Reports</a></li>
                <li class="nav-item"><a href="#">Profile</a></li>
            </ul>
        </div>

        <!-- main content area -->
        <div class="main-content">
            <div class="top-nav">
                <div class="search-bar">
                    <br/><br/>
                    <input type="text" placeholder="Search..." />
                </div>
                <div class="notification">
                    <br/><br/>
                    <img src="../../public/assets/images/Bell.png" alt="Notification Bell" class="bell-icon">
                </div>
            </div>


            <!-- main content -->
            <div class="content">
                <div class="box">
                    <div class="box-header">
                        Change password
                    </div>

                    <div class="box-content">
                        <br/>
                        <div class="name-area">
                            JANITHA CHATHUNI
                        </div>
                        
                        <div class="form-area">
                            <form class="password-form">
                                <div class="input-group">
                                    <label for="current-password">Current Password :</label>
                                    <input type="password" id="current-password" placeholder="Enter Current Password">
                                </div>
                                <div class="input-group">
                                    <label for="new-password">New Password :</label>
                                    <input type="password" id="new-password" placeholder="Enter New Password">
                                </div>
                                <div class="input-group">
                                    <label for="reenter-password">Re-Enter New Password :</label>
                                    <input type="password" id="reenter-password" placeholder="Re-enter New Password">
                                </div>
                                <div class="button-group">
                                    <button type="submit" class="save-btn">Save Password</button>
                                    <button type="button" class="cancel-btn">Cancel</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>