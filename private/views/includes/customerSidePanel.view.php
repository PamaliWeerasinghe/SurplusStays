<aside class="sidePanel">
    <div class="greeting">
        <img class="profile-image" src="<?=ASSETS?>/customerImages/<?=basename(Auth::getPicture())?>" />
        <label>Hi <span class="admin"><?=Auth::getusername()?></span></label>
    </div>
    <div class="buttons">
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer">
            <label>Dashboard</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/TrackExpiry">
            <label>Browse Shops</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/Complaints">
            <label>Cart</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/ManageCustomers">
            <label>Wishlist</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/orders">
            <label>Orders</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/manageComplaints">
            <label>Complaints</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/ManageCharityOrg">
            <label>Payment History</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/admin/Reports">
            <label>Profile</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/Logout">
            <label>Logout</label>
        </div>
        
    </div>
    <script src="<?=ROOT?>/assets/js/customerPagesNavigation.js"></script>
</aside>