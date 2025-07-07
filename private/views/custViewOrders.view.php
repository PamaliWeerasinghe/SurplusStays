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
                                <th>Payment</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                            <tr id="card-item-<?= $order->id ?>">
                                <td>#<?= $order->id ?><br><small><?= $order->dateTime ?></small></td>
                                <td>Rs <?= number_format($order->total, 2) ?></td>
                                <td><?= $order->paymentMethod ?></td>
                                <td><?= $order->order_status ?></td>
                                <td>
                                    <button onclick="window.location.href='<?= ROOT ?>/Customer/viewOrder/<?= $order->id ?>'">
                                        View Items
                                    </button>
                                </td>
                                <td>
                                    <?php if (isset($order->rating)): ?>
                                        <div class="rating-display">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <span class="star" style="color:<?= $i <= $order->rating ? '#FFD700' : '#ccc' ?>">&#9733;</span>
                                            <?php endfor; ?>
                                        </div>
                                        <button 
                                            class="edit-btn"
                                            title="Edit rating"
                                            data-order="<?= $order->id ?>"
                                            data-business="<?= $order->business_id ?>"
                                            data-current-rating="<?= $order->rating ?>"
                                            data-rating_id="<?= $order->rating_id ?>"
                                        >Edit Rating</button>
                                    <?php else: ?>
                                        <button 
                                            class="add-btn"
                                            title="Add rating"
                                            data-order="<?= $order->id ?>"
                                            data-business="<?= $order->business_id ?>"
                                        >Rate Shop</button>
                                    <?php endif; ?>
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

    <div class="modal-overlay" id="productModal">
        <div class="modal-content">
            <span class="close-button" id="modalCloseAdd">&times;</span>
            <div class="modal-details">
                <h2>Add Rating</h2>
                <form method="POST" action="<?=ROOT?>/customer/rateShop">
                    <div class="quantity-selector">      
                        <div class="star-rating">
                            <input type="hidden" name="rating" id="addRatingValue" value="5">
                            <div class="stars" id="addStars">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                        </div>
                        <input type="hidden" name="order_id" id="addOrderId">
                        <input type="hidden" name="business_id" id="addBusinessId">             
                    </div>
                    <button type="submit" class="add-cart-button">Rate</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="productModal2">
        <div class="modal-content">
            <span class="close-button" id="modalCloseEdit">&times;</span>
            <div class="modal-details">
                <h2>Edit Rating</h2>
                <form method="POST" action="<?=ROOT?>/customer/editShopRating">
                    <div class="quantity-selector">      
                        <div class="star-rating">
                            <input type="hidden" name="rating" id="editRatingValue" value="5">
                            <div class="stars" id="editStars">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                        </div>
                        <input type="hidden" name="order_id" id="editOrderId">
                        <input type="hidden" name="business_id" id="editBusinessId">
                        <input type="hidden" name="rating_id" id="ratingIdValue">                
                    </div>
                    <button type="submit" class="add-cart-button">Edit Rating</button>
                </form>
            </div>
        </div>
    </div>

    <?php echo $this->view('includes/footer')?>
    <script>
        // Add Rating Modal
        document.querySelectorAll('.add-btn').forEach(button => {
            button.addEventListener('click', () => {
                const orderId = button.dataset.order;
                const businessId = button.dataset.business;

                document.getElementById('addOrderId').value = orderId;
                document.getElementById('addBusinessId').value = businessId;
                document.getElementById('addRatingValue').value = 5;
                updateStars('addStars', 5);

                document.getElementById('productModal').style.display = 'block';
            });
        });

        // Edit Rating Modal
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const orderId = button.dataset.order;
                const businessId = button.dataset.business;
                const currentRating = parseInt(button.dataset.currentRating || 5);
                const ratingId = button.dataset.rating_id;

                document.getElementById('editOrderId').value = orderId;
                document.getElementById('editBusinessId').value = businessId;
                document.getElementById('editRatingValue').value = currentRating;
                document.getElementById('ratingIdValue').value = ratingId;
                updateStars('editStars', currentRating);

                document.getElementById('productModal2').style.display = 'block';
            });
        });

        // Close buttons
        document.getElementById('modalCloseAdd').addEventListener('click', () => {
            document.getElementById('productModal').style.display = 'none';
        });

        document.getElementById('modalCloseEdit').addEventListener('click', () => {
            document.getElementById('productModal2').style.display = 'none';
        });

        // Star interactivity for both modals
        function updateStars(containerId, rating) {
            const stars = document.querySelectorAll(`#${containerId} .star`);
            stars.forEach(star => {
                star.classList.toggle('selected', parseInt(star.dataset.value) <= rating);
            });

            stars.forEach(star => {
                star.onclick = () => {
                    const val = parseInt(star.dataset.value);
                    document.getElementById(containerId.includes('edit') ? 'editRatingValue' : 'addRatingValue').value = val;
                    updateStars(containerId, val);
                };
                star.onmouseover = () => updateStars(containerId, parseInt(star.dataset.value));
                star.onmouseout = () => {
                    const currentVal = document.getElementById(containerId.includes('edit') ? 'editRatingValue' : 'addRatingValue').value;
                    updateStars(containerId, parseInt(currentVal));
                };
            });
        }

        // Initialize stars once
        updateStars('addStars', 5);
        updateStars('editStars', 5);

        
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

    <script src="<?=ROOT?>/assets/js/customerWishlist.js"></script>

</body>

   

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