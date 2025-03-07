<aside class="sidePanel">
    <div class="greeting">
        <img class="profile-image" src="<?=ASSETS?>/customerImages/<?=basename(Auth::getPicture())?>" />
        <label>Hi <span class="admin"><?=Auth::getusername()?></span></label>
    </div>
    <div class="buttons">
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer">
            <label>Dashboard</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/customer">
            <label>Browse Shops</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/cart">
            <label>Cart</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/wishlist">
            <label>Wishlist</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/orders">
            <label>Orders</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/manageComplaints">
            <label>Complaints</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/payment-history">
            <label>Payment History</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/customer/profile">
            <label>Profile</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/Logout">
            <label>Logout</label>
        </div>
        
    </div>
    <script src="<?=ROOT?>/assets/js/customerPagesNavigation.js"></script>
</aside>