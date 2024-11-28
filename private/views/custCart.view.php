<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../../public/assets/styles/CustSidePanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/CustTopPanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/CustCart.css">
</head>

<body style="font-family: 'Outfit', sans-serif;">
    <div class="container">
        <!-- Sidebar -->
        <div class="side-nav">
            <div class="profile-section">
                <img src="../../public/assets/images/sample_profile_pic.png" alt="Profile Image" class="profile-image">
                <h2>Hi Janitha!</h2>
            </div>
            <ul class="nav-links">
                <li class="nav-item"><a href="#">Dashboard</a></li>
                <li class="nav-item"><a href="#">Browse Shops</a></li>
                <li class="nav-item active"><a href="#">Cart</a></li>
                <li class="nav-item"><a href="#">Wishlist</a></li>
                <li class="nav-item"><a href="#">Orders</a></li>
                <li class="nav-item"><a href="#">View Payment History</a></li>
                <li class="nav-item"><a href="#">Profile</a></li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Top Navigation -->
            <div class="top-nav">
                <div class="top-bar">
                    <div class="search-bar">
                        <input type="text" placeholder="Search..." />
                    </div>
                    <div class="notification">
                        <img src="../../public/assets/images/Bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    Cart - 6 items
                </div>

                <!-- cart items -->

                <div class="row" style="padding:20px;">
                    <div class="column">
                        <div class="cart-item">
                                <img src="<?=assets?>/images/bread_image.jpg" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Bread - RS 200</h3>
                                    <p class="item-expiry">
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
                                <img src="<?=assets?>/images/bread_image.jpg" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Bread - RS 200</h3>
                                    <p class="item-expiry">
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
                                <img src="<?=assets?>/images/bread_image.jpg" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Bread - RS 200</h3>
                                    <p class="item-expiry">
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



                <div class="row" style="padding:20px;">
                    <div class="column">
                        <div class="cart-item">
                                <img src="<?=assets?>/images/bread_image.jpg" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Bread - RS 200</h3>
                                    <p class="item-expiry">
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
                                <img src="<?=assets?>/images/bread_image.jpg" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Bread - RS 200</h3>
                                    <p class="item-expiry">
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
                                <img src="<?=assets?>/images/bread_image.jpg" alt="Bread" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">Bread - RS 200</h3>
                                    <p class="item-expiry">
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


            <!-- Main Content -->

            <div class="box">
                
                <p style="padding:20px">Order summary</p>
                <div style="padding: 30px;">
                    PRICE DETAILS (18 items) <br/><br/>
                    <b>TOTAL MRP /= RS</b> <br/><br/>
                    <p style="font-weight:200">Select payment method<p> <br/>
                    <button class="button1" onclick='window.location.href="http://localhost/surplusstays/public/customer/payment"'>Pay By Card</button>
                <button class="button1">Pay Cash On Pickup</button>
                <br /><br />
                <button class="button2">Place Order</button>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
