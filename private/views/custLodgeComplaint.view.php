<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lodge A Complaint</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../public/assets/styles/CustSidePanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/CustTopPanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/CustLodgeComplaint.css">
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
                        Lodge A Complaint
                    </div>

                    <div class="box-content">
                        <br/>

                        <div class="form-area">
                        <form class="complaint-form">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact Number:</label>
                                <input type="tel" id="contact" placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label for="date">Date Of Order:</label>
                                <div class="date-input-wrapper">
                                <input type="text" id="date" placeholder="DD/MM/YY">
                                <span class="calendar-icon">📅</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shop-name">Shop Name:</label>
                                <input type="text" id="shop-name" placeholder="Shop Name">
                            </div>
                            <div class="form-group">
                                <label for="related-items">Related Items:</label>
                                <input type="text" id="related-items" placeholder="Related Items">
                            </div>
                            <div class="form-group">
                                <label for="complaint">Complaint:</label>
                                <textarea id="complaint" placeholder="Add Complaint Description"></textarea>
                            </div>
                            <button type="submit" class="submit-button">Submit</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>