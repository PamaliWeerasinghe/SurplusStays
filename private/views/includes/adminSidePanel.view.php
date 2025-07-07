<link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css"> 

<?php
// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];
?>

<div class="side-nav">
    <div class="profile-section">
        <div class="profile-container">
            <img src="<?=ASSETS?>/adminImages/<?=$_SESSION['USER_PIC']?>" alt="Profile Image" class="profile-image">
        </div>
        <h2 class="welcome-text">Hi <?=  (Auth::logged_in()) ?$_SESSION['USER']->name:''?></h2>
    </div>
    <ul class="nav-links">
        <li class="nav-item <?= strpos($current_url, '/admin/dashboard') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/admin/dashboard">Dashboard</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/admin/TrackExpiry') || strpos($current_url, '/charity/createEvent') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/admin/TrackExpiry">Track Expiry</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/admin/Complaints') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/admin/Complaints">Complaints</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/admin/ManageCustomers') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/admin/ManageCustomers">Manage Customers</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/admin/ManageBusinesses') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/admin/ManageBusinesses">Manage Business</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/admin/ManageCharityOrg') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/admin/ManageCharityOrg">Manage Charity</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/admin/Reports') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/admin/Reports">Reports</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/admin/AdminLogout') == true ? 'active' : '' ?>">
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