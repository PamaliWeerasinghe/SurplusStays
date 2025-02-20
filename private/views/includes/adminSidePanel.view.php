<aside class="sidePanel">
    <div class="greeting">
        <img src="<?=ASSETS?>/images/sample_profile_pic.png" />
        <label>Hi <span class="admin"><?=  (Auth::logged_in()) ? (Auth::admin()):''?>!</span></label>
    </div>
    <div class="buttons">
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/dashboard">
            <label>Dashboard</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/TrackExpiry">
            <label>Track Expiry</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/Complaints">
            <label>Complaints</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/ManageCustomers">
            <label>Manage Customers</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/ManageBusinesses">
            <label>Manage Businesses</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/ManageCharityOrg">
            <label>Manage Charity Org</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/Reports">
            <label>Reports</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/AdminLogout">
            <label>Logout</label>
        </div>
        <!-- <div class="btn-nonSelected" id="profile" onclick="profile();">
            <label>Profile</label>
        </div> -->
    </div>
    <script src="<?=ROOT?>/assets/js/adminPagesNavigation.js"></script>
</aside>