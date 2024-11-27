<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
</head>

<body>
    <!-- navbar -->

    <div class="main-div">
    <?php echo $this->view('includes/navbar')?>
        <div class="sub-div-1">
            <!-- included the admin side panel -->
            <?php require APPROOT."/views/includes/customerSidePanel.view.php"?>
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
                    <div class="customer-order">
                        <label>Shop Name</label>
                        <label>City</label>
                        <label>Ratings</label>
                        <label>Status</label>
                        <label>Action</label>
                        
                    </div>
                   
                   

                    <div class="browse-shop">
                        <img src="<?=ASSETS?>/images/keells.png"/>
                        <!-- <label>Keells Super</label> -->
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
                        <button class="browseShop-btn">Send Request</button>
                    </div>
                    <div class="browse-shop">
                        <img src="<?=ASSETS?>/images/keells.png"/>
                        <!-- <label>Keells Super</label> -->
                        <div>
                            <img src="<?=ASSETS?>/images/location.png"/>
                            <label>Kalutara</label>
                        </div>
                        <div>
                            <img src="<?=ASSETS?>/images/star-rating.png"/>
                            <label>3.0</label>
                        </div>
                        <div class="browse-shop-div">
                            <label class="browse-shop-label1">Open Today</label>
                            <label class="shop-label2">10.00 A.M -22.00 P.M</label>
                        </div>
                        <button class="shop-btn">Send Request</button>
                    </div>
                    <div class="browse-shop">
                        <img src="<?=ASSETS?>/images/keells.png"/>
                        <!-- <label>Keells Super</label> -->
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
        <?php echo $this->view('includes/footer')?>
    </div>
    
</body>

</html>