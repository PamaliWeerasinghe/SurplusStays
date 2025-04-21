<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<?php require APPROOT . '/views/customerRemoveFromWishlist.view.php' ?>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/CustWishlist.css">
   
</head>

<body>
    <!-- navbar -->
    <div class="main-div">
        <?php echo $this->view('includes/navbar')?>
        <div class="sub-div-1">
            <?php require APPROOT."/views/includes/customerSidePanel.view.php"?>
            <div class="dashboard">
                <div class="summary">
                    <div class="top-bar">
                        <div class="search-bar">
                            <!-- Search bar content -->
                        </div>
                        <div class="notification">
                            <!-- Notification content -->
                        </div>
                    </div>
                </div>

                <div class="box"style="margin-top: -28%;margin-bottom: 10%;">
                    <div class="box-header">
                        ORDERS PLACED - <?= $order_count ?> <?= $order_count == 1 ? 'order' : 'orders' ?>
                    </div>

                    <div class="wishlist-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Total</th>
                                    <th>Order Status</th>
                                    <th></th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                <tr id="card-item-<?= $order->id ?>">
                                    <td>
                                        <div class="product-card">
                                           
                                            <div class="product-info">
                                                <div class="product-details">
                                                    <p style="color: black;">Ref No : <strong>#<?=$order->id?></strong><br/>
                                                   
                                                </div>
                                               
                                                <h3 class="product-title"><?= $order->dateTime ?></h3>
                                               
                                                <?php 
                                                if($order->paymentMethod=="Collected"){
                                                    ?>
                                                         <p class="category">Collecting</p>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <p class="category">Online Payment</p>
                                                    <?php

                                                }
                                                
                                                
                                                ?>
                                                
                                                
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        Rs <?= number_format($order->total, 2) ?>
                                    </td>
                                        
                                    <td>
                                        <!-- <div class="product-status">
                                            <?php if ($item->qty_avail > 0): ?>
                                                <span class="in-stock">In Stock</span>
                                            <?php elseif ($item->qty_avail == 0): ?>
                                                <span class="out-of-stock">Out of Stock</span>
                                            <?php else: ?>
                                                <span class="unknown-status">Status Unknown</span>
                                            <?php endif; ?>
                                        </div> -->
                                    </td>

                                    <td>
                                        <button class="add-to-cart-button" onclick="window.location.href='<?= ROOT ?>/Customer/viewOrder/<?=$order->id?>'">View Items</button>
                                    </td>

                                    
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
    </div>

   

    <!-- popup for add to cart -->
    <div class="cart-popup-container" id="cart-popup-container">
    <div class="cart-popup" id="cart-popup">
        <span class="popup-close-btn" onclick="hideCartPopup()">&times;</span>
        <input type="hidden" id="popupRowID"/>
        
        <div class="popup-product-row">
            <div class="popup-product-image">
                <img src="" id="addToCartImage">
            </div>
            <div class="popup-product-info">
                <p class="popup-category" id="bus_name"></p>
                <h3 class="popup-product-title" id="product_name"></h3>
                <div class="popup-product-details">
                    <p class="popup-expiry-label">Expires On:</p>
                    <p class="popup-expiry-date" id="expires_in"></p>
                </div>
            </div>
        </div>
        
        <div class="popup-action-row">
            <div class="popup-quantity-selector">
                <button class="quantity-btn minus">-</button>
                <input type="number" min="1" value="1" class="quantity-input" id="quantity-input-1">
                
                <button class="quantity-btn plus">+</button>
            </div>
            <div class="popup-action-buttons">
                <form action="" method="POST" id="AddToCartFromWishlist">
                    <input type="hidden" id="watchlist_id"/>
                    <input type="hidden" id="selected-Qty"/>
                    <button class="popup-confirm-btn" onclick="insertToCart()" type="submit">Add to Cart</button>
                    <button type="button" class="popup-cancel-btn" onclick="hideCartPopup()">Cancel</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

    <script src="<?=ROOT?>/assets/js/customerWishlist.js"></script>
</body>
</html>