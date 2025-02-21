<aside class="sidePanel">
    <div class="greeting">
        <img src="<?= ASSETS ?>/businessImages/<?= basename(Auth::getPicture()) ?>" alt="Profile Image" class="profile-image">
        <label>Hi <span class="admin"> <?= Auth::getusername() ?></span></label>
    </div>
    <div class="buttons">
        <div class="btn-nonSelected" data-path="<?= SIDEPANELBUSINESS ?>">
            <label>Dashboard</label>
        </div>
        <div class="btn-nonSelected" data-path="<?= SIDEPANELBUSINESS ?>/myproducts">
            <label>My Products</label>
        </div>
        <div class="btn-nonSelected" data-path="<?= SIDEPANELBUSINESS ?>/orders">
            <label>Orders</label>
        </div>
        <div class="btn-nonSelected" data-path="<?= SIDEPANELBUSINESS ?>/requests">
            <label>Requests</label>
        </div>
        <div class="btn-nonSelected" data-path="<?= SIDEPANELBUSINESS ?>/complains">
            <label>Complains</label>
        </div>
        <div class="btn-nonSelected" data-path="<?= SIDEPANELBUSINESS ?>/reports">
            <label>Reports</label>
        </div>
        <div class="btn-nonSelected" data-path="<?= SIDEPANELBUSINESS ?>/profile">
            <label>Profile</label>
        </div>
        <!--<div class="btn-nonSelected" id="profile" onclick="profile();">
            <label>Profile</label>
        </div>-->
    </div>
    <script src="<?= ROOT ?>/assets/js/businessPagesNavigation.js"></script>
</aside>