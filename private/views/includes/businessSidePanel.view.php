<aside class="sidePanel">
    <div class="greeting">
        <img src="<?= ASSETS ?>/businessImages/<?= basename(Auth::getPicture()) ?>" alt="Profile Image" class="profile-image">
        <label>Hi <span class="admin"> <?= Auth::getusername() ?></span></label>
    </div>
    <div class="buttons">
        <div class="btn-nonSelected" data-path="/SurplusStays/public/business">
            <label>Dashboard</label>
        </div>
        <div class="btn-nonSelected" data-path="/SurplusStays/public/business/myproducts">
            <label>My Products</label>
        </div>
        <div class="btn-nonSelected" data-path="/SurplusStays/public/business/orders">
            <label>Orders</label>
        </div>
        <div class="btn-nonSelected" data-path="/SurplusStays/public/business/requests">
            <label>Requests</label>
        </div>
        <div class="btn-nonSelected" data-path="/SurplusStays/public/business/complains">
            <label>Complains</label>
        </div>
        <div class="btn-nonSelected" data-path="/SurplusStays/public/business/reports">
            <label>Reports</label>
        </div>
        <div class="btn-nonSelected" data-path="/SurplusStays/public/business/profile">
            <label>Profile</label>
        </div>
        <!--<div class="btn-nonSelected" id="profile" onclick="profile();">
            <label>Profile</label>
        </div>-->
    </div>
    <script src="<?= ROOT ?>/assets/js/businessPagesNavigation.js"></script>
</aside>