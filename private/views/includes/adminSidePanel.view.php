<aside class="sidePanel">
    <div class="greeting">
        <img src="<?=ASSETS?>/images/sample_profile_pic.png" />
        <label>Hi <span class="admin">Pamali!</span></label>
    </div>
    <div class="buttons">
        <div class="btn-Selected" id="dashboard" onclick="dashboard();"
        data-path="/surplusstays/admin/dashboard">
            <label>Dashboard</label>
        </div>
        <div class="btn-nonSelected" id="trackExpiry" onclick="trackExpiry();"
        data-path="/surplusstays/admin/TrackExpiry">
            <label>Track Expiry</label>
        </div>
        <div class="btn-nonSelected" id="complaints" onclick="complaints();">
            <label>Complaints</label>
        </div>
        <div class="btn-nonSelected" id="manageCustomers" onclick="manageCustomers();">
            <label>Manage Customers</label>
        </div>
        <div class="btn-nonSelected" id="manageBusinesses" onclick="manageBusinesses();">
            <label>Manage Businesses</label>
        </div>
        <div class="btn-nonSelected" id="manageCharity" onclick="manageCharity();">
            <label>Manage Charity Org</label>
        </div>
        <div class="btn-nonSelected" id="reports" onclick="reports();">
            <label>Reports</label>
        </div>
        <div class="btn-nonSelected" id="profile" onclick="profile();">
            <label>Profile</label>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/adminPagesNavigation.js"></script>
</aside>