<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=STYLES?>/CustWishlist.css">
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
                    <h2>WISHLIST - <?= $item_count ?> <?= $item_count == 1 ? 'item' : 'items' ?></h2>
                </div>

                <div class="complaints-status">
                    <div class="wishlist-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Stock Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($data as $item): ?>
                                <tr id="card-item-<?= $item['product_id'] ?>">
                                    <td>
                                        <div class="product-card">
                                            <div class="product-image">
                                                <img src="<?= ROOT . '/' . explode(',', $item['image'])[0] ?>">
                                            </div>
                                            <div class="product-info">
                                                <p class="category"><?= $item['business_name'] ?></p>
                                                <h3 class="product-title"><?= $item['product_id'] ?></h3>
                                                <div class="product-details">
                                                    <p class="expiry-label">Expiry:</p>
                                                    <p class="expiry-date"><?= $item['expiry'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="price-column">
                                        Rs <?= number_format((float)($item['price'] ?? 0), 2) ?>
                                    </td>

                                    <td>
                                        <div class="product-status">
                                            <?php if ($item['qty'] > 0): ?>
                                                <span class="in-stock">In Stock</span>
                                            <?php elseif ($item['qty'] == 0): ?>
                                                <span class="out-of-stock">Out of Stock</span>
                                            <?php else: ?>
                                                <span class="unknown-status">Status Unknown</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    <td>
                                        <button class="add-to-cart-button" onclick="openAddToCartPopup(<?= $item['product_id'] ?>)">
                                            <span>Add to Cart</span>
                                        </button>
                                    </td>

                                    <td>
                                        <div class="delete-container">
                                            <img src="<?= ASSETS ?>/images/delete.png" class="delete-btn" onclick="openDeletePopup(<?= $item['product_id'] ?>)">
                                        </div>
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

    <?php echo $this->view('includes/footer')?>
    <script src="<?=ROOT?>/assets/js/customerWishlist.js"></script>
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