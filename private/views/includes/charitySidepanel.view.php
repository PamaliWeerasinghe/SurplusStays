<link rel="stylesheet" href="<?=STYLES?>/charitySidePanel.css"> 

<?php
// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];
?>

<div class="side-nav">
    <div class="profile-section">
        <div class="profile-container">
            <img src="<?=ASSETS?>/charityImages/<?=basename(Auth::getUserPicture())?>" alt="Profile Image" class="profile-image">
        </div>
        <h2 class="welcome-text">Hi <?=Auth::getusername()?></h2>
    </div>
    <ul class="nav-links">
        <li class="nav-item <?= strpos($current_url, '/charity/index') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/index">Dashboard</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/charity/manage_events') || strpos($current_url, '/charity/createEvent') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/manage_events">Manage Events</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/charity/donations') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/donations">Donations</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/charity/browse_shops') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/browse_shops">Browse Shops</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/charity/browse_charities') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/browse_charities">Browse Charities</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/charity/reports') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/reports">Reports</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/charity/favourites') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/favourites">Favourites</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/charity/profile') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/profile">Profile</a>
        </li>
    </ul>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add subtle animations when page loads
    document.querySelectorAll('.nav-item').forEach(function(item, index) {
        setTimeout(() => {
            item.style.opacity = '1';
        }, 100 * index);
    });
    
    // Add hover effect
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(-3px)';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(0)';
            }
        });
    });
});
</script>