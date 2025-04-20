<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessOrderDetails.css">
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                </div>

                <div class="main-box">
                    <div class="header">
                        <h2>Order Details</h2>
                    </div>

                    <?php if (!empty($order)) : ?>
                        <div class="sub-box">
                            <h3>About Order</h3>
                            <div class="items-colomn">
                                <p><strong>Order ID:</strong> #<?= htmlspecialchars($order[0]->id) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($order[0]->dateTime) ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($order[0]->status) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Customer details</h3>
                            <div class="items-colomn">
                                <p><strong>Name:</strong> <?= htmlspecialchars($order[0]->customer_name) ?></p>
                                <p><strong>Phone:</strong> <?= htmlspecialchars($order[0]->customer_phone) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Ordered Products</h3>
                            <div class="table-box">
                                <table class="order-details-table">
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price per product</th>
                                        <th>Price after discount</th>
                                        <th>Final price</th>
                                    </tr>
                                    <?php foreach ($order as $item) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item->product_name) ?></td>
                                            <td><?= htmlspecialchars($item->qty) ?></td>
                                            <td>Rs. <?= htmlspecialchars($item->price_per_unit) ?></td>
                                            <td>Rs. <?= htmlspecialchars($item->discountPrice) ?></td>
                                            <td>Rs. <?= htmlspecialchars($item->discountPrice) * htmlspecialchars($item->qty) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                                <p><strong>Total Price:</strong> Rs. <?= htmlspecialchars($order[0]->total) ?></p>
                            </div>
                        </div>

                        <div class="section-buttons">
                            <?php if ($order[0]->status === 'Ongoing') : ?>
                                <form action="<?= ROOT ?>/business/updateOrderStatus" method="POST" id="order-form">
                                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order[0]->id) ?>">
                                    <input type="hidden" name="status" id="statusInput">

                                    <div class="button-container">
                                        <button type="button" name="status" value="Completed" class="btn-green" onclick="showPopupAndSubmit('Completed')">ORDER COLLECTED</button>
                                        <button type="button" name="status" value="Not Collected" class="btn-red" onclick="showPopupAndSubmit('Not Collected')">ORDER NOT COLLECTED</button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <p >You have already updated the order status.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Simple Popup -->
                        <div id="simplePopup" class="popup">
                            <div class="popup-content">
                                <p>Success! <br> Order status have been updated.</p>
                                <button class="btn-ok" onclick="redirectToOrders()">OK</button>
                            </div>
                        </div>

                        <script>
                            function showPopupAndSubmit(status) {
                                // Show the popup
                                document.getElementById('simplePopup').style.display = 'block';

                                // Store the status in a hidden input field to submit with the form
                                document.getElementById('statusInput').value = status;
                            }

                            function redirectToOrders() {
                                // Submit the form after closing the popup
                                document.getElementById('order-form').submit();
                            }
                        </script>

                    <?php else : ?>
                        <p>Order not found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>
</body>

</html>