<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/CustViewOrders.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/customerSidePanel')?>
        <div class="container-right">
            <div class="top-nav">
                <div class="top-bar">
                </div>
                <div class="searchWelcome">
                <h2> ORDERS PLACED - <?= $order_count ?> <?= $order_count == 1 ? 'order' : 'orders' ?>
                </h2>
                </div>

                <div class="complaints-status">
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
                                                            <p class="category"><?= $order->status ?></p>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <p class="category"><?= $order->paymentMethod ?></p>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="order-total">
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
        </div>
    </div>

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




    <?php echo $this->view('includes/footer')?>
    <script src="<?=ROOT?>/assets/js/customerWishlist.js"></script>

</body>

</html>