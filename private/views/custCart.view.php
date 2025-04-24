<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/CustCart.css">
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
                <h2>Cart</h2>
                <h2><?= count($cartRows) ?> Products</h2>
                </div>

                <div class="complaints-status">
                    <div class="cart-container">
                   

                        <div class="cart-grid">
                            <?php foreach ($cartRows as $cartItem): ?>
                                <?php
                                    // Find the corresponding product based on products_id
                                    $product = null;
                                    foreach ($productRows as $p) {
                                        if ($p->id == $cartItem->products_id) {
                                            $product = $p;
                                            break;
                                        }
                                    }
                                    if (!$product) continue;
                                    $isOutOfStock = $product->qty == 0 ;
                                ?>
                                <div class="product-card">
                                <img src="<?= ROOT ?>/<?= explode(',', $product->pictures)[0] ?>" alt="<?= $product->name ?>">
                                    <h3><?= $product->name ?></h3>
                                    <p class="price">Rs <?= $product->discountPrice ?></p>
                                    <p class="details">
                                        Expire: <?= date('Y-m-d, h:iA', strtotime($product->expiration_dateTime)) ?><br>
                                        <?= $isOutOfStock ? '<span class="out-stock">Out of Stock</span>' : "Items Left: {$product->qty}" ?>
                                    </p>
                                    <form method="post" action="<?=ROOT?>/customer/addToCart" class="addToCart">
                                        
                                        <input type="number" name="qty" value="<?= $cartItem->qty ?>" min="1" max="<?= $product->qty + $cartItem->qty ?>">
                                        <input type="hidden" name="original_qty" value="<?= $cartItem->qty ?>">
                                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                        <input type="hidden" name="business_id" value="<?= $product->business_id ?>">
                                        <button type="submit">Update</button>
                                    </form>
                                    <form method="post" action="<?=ROOT?>/customer/removeCartItem" class="removeCartItem">
                                        <input type="hidden" name="cart_id" value="<?= $cartItem->id ?>">
                                        <button type="submit">Remove</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="complaints-status">
                <div class="order-summary-container">
                    <h3>Order Summary</h3>
                    <div class="price-details">
                        <p><strong>PRICE DETAILS (<?php echo array_sum(array_column($cartRows, 'qty')); ?> Items)</strong></p>

                        <?php
                            $total = 0;
                            foreach ($cartRows as $cartRow) {
                                foreach ($productRows as $product) {
                                    if ($product->id == $cartRow->products_id) {
                                        $itemTotal = $cartRow->qty * $product->discountPrice;
                                        $total += $itemTotal;
                                        ?>
                                        <div class="summary-line">
                                            <span><?= $product->name ?> x <?= $cartRow->qty ?></span>
                                            <span>Rs <?= number_format($itemTotal, 2) ?></span>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        ?>
                        <hr>
                        <div class="summary-line">
                            <span><strong>Total MRP</strong></span>
                            <span><strong>Rs <?= number_format($total, 2); ?></strong></span>
                        </div>
                    </div>
                    <div class="payment-method">
                        <p>Select Payment Method</p>
                        <div class="payment-buttons">
                            <!-- Cash On Pickup form -->
                            <form method="post" action="<?= ROOT ?>/customer/placeOrder">
                                <input type="hidden" name="payment_method" value="cash_on_pickup">
                                <?php foreach ($cartRows as $cartItem): ?>
                                    <input type="hidden" name="cart[<?= $cartItem->id ?>][id]" value="<?= $cartItem->id ?>">
                                    <input type="hidden" name="cart[<?= $cartItem->id ?>][products_id]" value="<?= $cartItem->products_id ?>">
                                    <input type="hidden" name="cart[<?= $cartItem->id ?>][customer_id]" value="<?= $cartItem->customer_id ?>"> <!-- Assuming you have customer ID variable -->
                                    <input type="hidden" name="cart[<?= $cartItem->id ?>][qty]" value="<?= $cartItem->qty ?>">
                                    <input type="hidden" name="cart[<?= $cartItem->id ?>][business_id]" value="<?= $cartItem->business_id ?>">
                                    <input type="hidden" name="businessID" value="<?= $cartItem->business_id ?>">
                                    <input type="hidden" name="total" value="<?= $total ?>">
                                <?php endforeach; ?>

                                <div class="payment-method">
                                    <button type="submit" class="place-order">Cash On Pickup</button>
                                </div>
                            </form>
                            <button class="place-order">Cash On Pickup</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>

    <script>
        window.addEventListener('load', adjustContainerHeight);
        window.addEventListener('resize', adjustContainerHeight);

        function adjustContainerHeight() {
            const complaintStatuses = document.querySelectorAll('.complaints-status');
            const container = document.querySelector('.container');
            const containerright = document.querySelector('.container-right');

            if (complaintStatuses.length && container) {
            let totalHeight = 0;
            complaintStatuses.forEach(el => {
                totalHeight += el.offsetHeight;
            });
            container.style.height = totalHeight + 300 + 'px';
            containerright.style.height = totalHeight + 300 +'px';
            }
        }
    </script>

    
    
</body>

</html>