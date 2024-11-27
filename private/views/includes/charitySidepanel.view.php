<link rel="stylesheet" href="<?=STYLES?>/charitySidePanel.css"> 

<?php
// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];
?>

<div class="side-nav">
    <div class="profile-section">
        <img src="<?=ASSETS?>/images/sample_profile_pic.png" alt="Profile Image" class="profile-image">
        <h2>Hi <?=Auth::getusername()?></h2>
    </div>
    <ul class="nav-links">
        <li class="nav-item <?= strpos($current_url, '/charity/index') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity">Dashboard</a>
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
        <li class="nav-item <?= strpos($current_url, '/charity/reports') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/reports">Reports</a>
        </li>
        <li class="nav-item <?= strpos($current_url, '/charity/profile') == true ? 'active' : '' ?>">
            <a href="<?=ROOT?>/charity/profile">Profile</a>
        </li>
    </ul>
</div>
