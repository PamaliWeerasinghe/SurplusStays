<aside class="sidePanel">
    <div class="greeting">
        <img src="<?=ASSETS?>/images/sample_profile_pic.png" />
        <label>Hi <span class="admin"> <?=Auth::getusername()?></span></label>
    </div>
    <div class="buttons">
        <div class="btn-nonSelected" data-path="/surplusstays/public/business/dashboard">
            <label>Dashboard</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/business/myproducts">
            <label>My Products</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/business/orders">
            <label>Orders</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/business/requests">
            <label>Requests</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/business/complains">
            <label>Complains</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/business/reports">
            <label>Reports</label>
        </div>
        <div class="btn-nonSelected" data-path="/surplusstays/public/business/profile">
            <label>Profile</label>
        </div>
        <!--<div class="btn-nonSelected" id="profile" onclick="profile();">
            <label>Profile</label>
        </div>-->
    </div>
    <script src="<?=ROOT?>/assets/js/businessPagesNavigation.js"></script>
</aside>