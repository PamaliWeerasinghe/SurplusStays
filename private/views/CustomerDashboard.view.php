<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
</head>

<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php require APPROOT."/views/includes/customerSidePanel.view.php"?>
        <div class="container-right">
            <div class="dashboard">
                <div class="summary">
                    <div class="summary-blocks123">
                        <h2>Shops</h2>
                        <div class="summary-details1">
                            <input type="text" placeholder="Search Shops..."/>
                            <!-- <img src="<?=ASSETS?>/images/Search.png"/> -->
                        </div>
                        <div class="summary-filter">
                            <label>Filter By : </label>
                            <select>
                                <option>Date Added</option>
                            </select>
                        </div>
                        <button>Locate Nearby Shops</button>
                    </div>
                </div>
                <div class="admin-order-status">
                    <div class="order">
                        <h2>Store Locator</h2>
                    </div>
                    <div class="location">
                            <input type="text" class="location-address" placeholder="No.908, GalleRoad, Katukurunda, Kalutara"/>
                            <select class="location-distance">
                                <option>Distance</option>
                            </select>
                            <button class="location-btn">Search</button>
                    </div>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=YourMapURL"width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>

                    <div class="shop">
                        <img src="<?=ASSETS?>/images/keells.png"/>
                        <label>Keells Super</label>
                    <div>
                        <img src="<?=ASSETS?>/images/location.png"/>
                            <label>Kalutara</label>
                        </div>
                        <div>
                            <img src="<?=ASSETS?>/images/star-rating.png"/>
                            <label>3.0</label>
                        </div>
                        <div>
                            <label class="shop-label1">Open Today</label>
                            <label class="shop-label2">10.00 A.M -22.00 P.M</label>
                        </div>
                            <button class="shop-btn">Send Request</button>
                    </div>
                    <div class="shop">
                        <img src="<?=ASSETS?>/images/keells.png"/>
                        <label>Keells Super</label>
                        <div>
                            <img src="<?=ASSETS?>/images/location.png"/>
                            <label>Kalutara</label>
                        </div>
                        <div>
                            <img src="<?=ASSETS?>/images/star-rating.png"/>
                            <label>3.0</label>
                        </div>
                        <div>
                            <label class="shop-label1">Open Today</label>
                            <label class="shop-label2">10.00 A.M -22.00 P.M</label>
                        </div>
                        <button class="shop-btn">Send Request</button>
                    </div>
                    <div class="shop">
                        <img src="<?=ASSETS?>/images/keells.png"/>
                        <label>Keells Super</label>
                        <div>
                            <img src="<?=ASSETS?>/images/location.png"/>
                            <label>Kalutara</label>
                        </div>
                        <div>
                            <img src="<?=ASSETS?>/images/star-rating.png"/>
                            <label>3.0</label>
                        </div>
                    <div>
                    <label class="shop-label1">Open Today</label>
                    <label class="shop-label2">10.00 A.M -22.00 P.M</label>
                </div>
                <button class="shop-btn">Send Request</button>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    <?php echo $this->view('includes/footer')?>
    
</body>

</html>