<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

     <!-- stylesheets -->
    <link rel="stylesheet" href="../../public/assets/styles/CustSidePanel.css"> 
    <link rel="stylesheet" href="../../public/assets/styles/CustTopPanel.css">
</head>


<body style="font-family: 'Outfit', sans-serif;"> 
    <div class="container">
    <div class="side-nav">
        <div class="profile-section">
            <img src="../../public/assets/images/sample_profile_pic.png" alt="Profile Image" class="profile-image">
            <h2>Hi Janitha!</h2>
        </div>
        <ul class="nav-links">
            <li class="nav-item active"><a href="#">Dashboard</a></li>
            <li class="nav-item"><a href="#">Manage Events</a></li>
            <li class="nav-item"><a href="#">Donations</a></li>
            <li class="nav-item"><a href="#">Browse Shops</a></li>
            <li class="nav-item"><a href="#">Reports</a></li>
            <li class="nav-item"><a href="#">Profile</a></li>
        </ul>
    </div>

    <div class="top-nav">
        <div class="top-bar">
            <div class="search-bar">
                <input type="text" placeholder="Search..." />
            </div>
            <div class="notification">
                <img src="../../public/assets/images/Bell.png" alt="Notification Bell" class="bell-icon">
            </div>
        </div>
        <div class="stats">
            <div class="stat-item">
                <img src="../../public/assets/images/profit-growth.png" alt="Events Icon" class="stat-icon">
                <div>
                    <span class="stat-title">Events</span>
                    <span class="stat-value">25</span>
                </div>
            </div>
            <div class="stat-item">
                <img src="../../public/assets/images/manifest.png" alt="Donations Icon" class="stat-icon">
                <div>
                    <span class="stat-title">Donations</span>
                    <span class="stat-value">450</span>
                </div>
            </div>
            <div class="stat-item">
                <img src="../../public/assets/images/box-mark.png" alt="Total Donations Icon" class="stat-icon">
                <div>
                    <span class="stat-title">Total Donations</span>
                    <span class="stat-value">790</span>
                </div>
            </div>
            <div class="stat-item">
                <img src="../../public/assets/images/rating.png" alt="Rating Icon" class="stat-icon">
                <div>
                    <span class="stat-title">Rating</span>
                    <span class="stat-value">4.0/5.0</span>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>