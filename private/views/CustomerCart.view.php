<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/custCart.css">
</head>

<body>
    <div class="main-div">
        <?php echo $this->view('includes/navbar')?>
        <div class="sub-div-1">
            <?php require APPROOT."/views/includes/customerSidePanel.view.php"?>
            <div class="dashboard">
                <div class="summary">
                    <div class="top-bar">
                        <div class="search-bar"></div>
                        <div class="notification"></div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        Cart - <?= $item_count ?> <?= $item_count == 1 ? 'item' : 'items' ?>
                    </div>
                    <div class="orders-container">
                        <div class="orders-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Price After Discount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_view as $cart_view): 
                                        $total_price = $cart_view->product_price * $cart_view->cart_quantity;
                                        $total_price_after_discount = $cart_view->product_discount_price * $cart_view->cart_quantity;
                                    ?>
                                    <tr id="cart-item-<?= $cart_view->cart_id ?>">
                                        <td>
                                            <div class="product-card">
                                                <div>
                                                    <img src="<?=ASSETS?>/images/<?= $cart_view->product_image ?>">
                                                </div>
                                                <div class="product-info">
                                                    <p class="category"><?= $cart_view->business_name ?></p>
                                                    <h3 class="product-title"><?= $cart_view->product_name?></h3>
                                                    <div class="product-details">
                                                        <p style="color: black;"><strong>Expiry:</strong><br/>
                                                        <p style="color:red"><strong><?= $cart_view->product_expiry ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rs <?= number_format($cart_view->product_price, 2) ?></td>
                                        <td>
                                            <div class="quantity-control">
                                                <button class="quantity-btn minus" data-cart-id="<?= $cart_view->cart_id ?>">-</button>
                                                <span class="quantity" id="quantity-<?= $cart_view->cart_id ?>"><?=$cart_view->cart_quantity?></span>
                                                <button class="quantity-btn plus" data-cart-id="<?= $cart_view->cart_id ?>">+</button>
                                            </div>
                                        </td>
                                        <td><b>Rs <?= number_format($total_price, 2) ?></b></td>
                                        <td><b>Rs <?= number_format($total_price_after_discount, 2) ?></b></td>
                                        <td>
                                            <img src="<?=ASSETS?>/images/delete.png" class="delete-btn" onclick="openPopUp(<?= $cart_view->cart_id ?>)">
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
        <?php echo $this->view('includes/footer')?>
    </div>

    <!-- Popup Container -->
    <div class="popup-container" id="popup-container">
        <div class="popup" id="popup">
            <h2>Are You Sure?</h2>
            <p>This product will be removed from your cart.</p>
            <input type="hidden" id="popupRowID"/>
            <form action="confirmDelete" method="POST">
                <div class="popup-btn-div">
                    <button type="submit" class="popup-yes-button">Yes</button>
                    <button type="button" class="popup-close-button" onclick="hideDeletePopup()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const popup = document.getElementById("popup");
        const popupContainer = document.getElementById("popup-container");

        function openPopUp(rowId) {
            popupContainer.classList.add("open-popup-container");
            popup.classList.add("open-popup");
            document.getElementById('popupRowID').value = rowId;
            const form = document.querySelector("#popup form");
            form.action = `http://localhost/surplusstays/public/Customer/removeFromCart/${rowId}`;
        }

        function hideDeletePopup() {
            popupContainer.classList.remove("open-popup-container");
            popup.classList.remove("open-popup");
        }
    </script>
</body>
</html>