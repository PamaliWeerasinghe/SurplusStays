<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/CustCart.css">
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
                    <div class="top-bar">
                        <div class="search-bar">
                            <input type="text" placeholder="Search..." />
                        </div>
                        <div class="notification">
                            <img src="<?=ASSETS?>/images/Bell.png" alt="Notification Bell" class="bell-icon">
                        </div>
                    </div>
                </div>
    
                
                <!-- cart -->

                <div class="box" style="margin-top: -20%">
                    <div class="box-header">
                        Cart - 3 items
                    </div>

                    <div class="row" style="padding:50px;">
                    <div class="column">
                        <div class="cart-item">
                                <img src="<?=ASSETS?>/images/bread.png" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Bread - RS 200</h3>
                                    <p class="item-expiry" style="font-size: small;">
                                        Expire - <span class="expiry-date">2024.12.25</span> <span class="expiry-time">12.00AM</span>
                                    </p>
                                    <p class="item-stock">Items Left - 24</p>
                                </div>
                                <div class="item-actions">
                                    <div class="quantity-control">
                                        <button class="quantity-btn">-</button>
                                        <span class="quantity">2</span>
                                        <button class="quantity-btn">+</button>
                                    </div>
                                    <br/>
                                    <button class="remove-btn" style="background-color: red; border-radius: 40px; color:white;">Remove</button>
                                </div>
                            </div>
                    </div>

                    <div class="column">
                        <div class="cart-item">
                                <img src="<?=ASSETS?>/images/chips.png" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Chips - RS 100</h3>
                                    <p class="item-expiry" style="font-size: small;">
                                        Expire - <span class="expiry-date">2024.12.25</span> <span class="expiry-time">12.00AM</span>
                                    </p>
                                    <p class="item-stock">Items Left - 24</p>
                                </div>
                                <div class="item-actions">
                                    <div class="quantity-control">
                                        <button class="quantity-btn">-</button>
                                        <span class="quantity">2</span>
                                        <button class="quantity-btn">+</button>
                                    </div>
                                    <br/>
                                    <button class="remove-btn" style="background-color: red; border-radius: 40px; color:white;">Remove</button>
                                </div>
                            </div>
                    </div>

                    <div class="column">
                        <div class="cart-item">
                                <img src="<?=ASSETS?>/images/rice.png" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Rice - RS 1800</h3>
                                    <p class="item-expiry" style="font-size: small;">
                                        Expire - <span class="expiry-date">2024.12.25</span> <span class="expiry-time">12.00AM</span>
                                    </p>
                                    <p class="item-stock">Items Left - 24</p>
                                </div>
                                <div class="item-actions">
                                    <div class="quantity-control">
                                        <button class="quantity-btn">-</button>
                                        <span class="quantity">2</span>
                                        <button class="quantity-btn">+</button>
                                    </div>
                                    <br/>
                                    <button class="remove-btn" style="background-color: red; border-radius: 40px; color:white;">Remove</button>
                                </div>
                            </div>
                    </div>
                </div>
                </div>

                <br/>
                <br/>

                <!-- payment -->

                <div class="box" style="padding-left: 40px;">
                
                <p style="padding:20px">Order summary</p>
                <div style="padding: 30px;">
                    PRICE DETAILS (6 items) <br/><br/>
                    <b>TOTAL MRP 2300/= RS</b> <br/><br/>
                    <p style="font-weight:200">Select payment method<p> <br/>
                    <button class="button1" onclick='window.location.href="http://localhost/surplusstays/public/customer/payment"'>Pay By Card</button>
                <button class="button1">Pay Cash On Pickup</button>
                <br /><br />
                <button class="button2">Place Order</button>

                </div>
            </div>
               


            </div>
            
        </div>
        <?php echo $this->view('includes/footer')?>
    </div>
    
</body>

</html>