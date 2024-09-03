<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/charity_dashboard.css">
</head>
<body>
    <?php echo $this->view('includes/navbar')?>

    <div class="container">
    <?php echo $this->view('includes/sidepanel')?>
    <div class="top-nav">
        <div class="top-bar">
            <div class="search-bar">
                <input type="text" placeholder="Search..." />
            </div>
            <div class="notification">
                <img src="../../SURPLUSSTAYS/public/assets/images/bell.png" alt="Notification Bell" class="bell-icon">
            </div>
        </div>
        <div class="stats">
            <div class="stat-item">
                <img src="../../SURPLUSSTAYS/public/assets/images/profit-growth.png" alt="Events Icon" class="stat-icon">
                <div>
                    <span class="stat-title">Events</span>
                    <span class="stat-value">25</span>
                </div>
            </div>
            <div class="stat-item">
                <img src="../../SURPLUSSTAYS/public/assets/images/manifest.png" alt="Donations Icon" class="stat-icon">
                <div>
                    <span class="stat-title">Donations</span>
                    <span class="stat-value">450</span>
                </div>
            </div>
            <div class="stat-item">
                <img src="../../SURPLUSSTAYS/public/assets/images/box-mark.png" alt="Total Donations Icon" class="stat-icon">
                <div>
                    <span class="stat-title">Total Donations</span>
                    <span class="stat-value">790</span>
                </div>
            </div>
            <div class="stat-item">
                <img src="../../SURPLUSSTAYS/public/assets/images/rating.png" alt="Rating Icon" class="stat-icon">
                <div>
                    <span class="stat-title">Rating</span>
                    <span class="stat-value">4.0/5.0</span>
                </div>
            </div>
        </div>
    </div>
    
    </div>
    <?php echo $this->view('includes/footer')?>
    
</body>
</html>