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
        <li class="nav-item <?= strpos($current_url, '/customer/index') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/customer/index">Dashboard</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/customer/browseShops') || strpos($current_url, '/charity/createEvent') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/customer/browseShops">Browse Shops</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/customer/cart') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/customer/cart">Cart</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/customer/wishlist') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/customer/wishlist">Wishlist</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/customer/orders') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/customer/orders">Orders</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/customer/manageComplaints') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/customer/manageComplaints">Complaint</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/customer/profile') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/customer/profile">Profile</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/Logout') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/Logout">Logout</a>
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