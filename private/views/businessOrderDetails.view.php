<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessOrderDetails.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                </div>

                <div class="main-header">

                    <?php if (!empty($order)) : ?>
                        <div class="section-main">
                            <h3>Order Details</h3>
                            <div class="inside">
                                <p><strong>Order ID:</strong> #<?= htmlspecialchars($order[0]->id) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($order[0]->dateTime) ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($order[0]->status) ?></p>
                            </div>
                        </div>

                        <div class="section">
                            <h3>Customer Details</h3>
                            <div class="inside">
                                <p><strong>Name:</strong> <?= htmlspecialchars($order[0]->customer_name) ?></p>

                                <p><strong>Phone:</strong> <?= htmlspecialchars($order[0]->customer_phone) ?></p>
                            </div>
                        </div>

                        <div class="section">
                            <h3>Product Details</h3>
                            <div class="inside-table">
                                <table class="order-details-table">
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price per product</th>
                                        <th>Total price</th>
                                    </tr>
                                    <?php foreach ($order as $item) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item->product_name) ?></td>
                                            <td><?= htmlspecialchars($item->qty) ?></td>
                                            <td>Rs. <?= htmlspecialchars($item->price_per_unit) ?></td>
                                            <td>Rs. <?= htmlspecialchars($item->price_per_unit) * htmlspecialchars($item->qty) ?></td>
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
                                        <button type="button" name="status" value="Completed" class="btn-success" onclick="showPopupAndSubmit('Completed')">✔ ORDER COLLECTED</button>
                                        <button type="button" name="status" value="Not Collected" class="btn-danger" onclick="showPopupAndSubmit('Not Collected')">❌ ORDER NOT COLLECTED</button>


                                    </div>
                                </form>
                            <?php else : ?>
                                <p style="color: green; font-weight: bold; text-align: center;">You have already updated the order status.</p>
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

                        <style>
                            /* Simple Popup Style */
                            /* Darken the outer part */
                            .popup {
                                display: none;
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background-color: rgba(0, 0, 0, 0.7);
                                /* Dark overlay */
                                z-index: 1000;
                                text-align: center;
                            }

                            /* Centered white popup box */
                            .popup-content {
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                background-color: white;
                                /* White background */
                                padding: 20px;
                                border-radius: 10px;
                                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
                                width: 300px;
                            }

                            .btn-ok {
                                background-color: #28a745;
                                border: none;
                                padding: 10px 20px;
                                color: white;
                                font-size: 16px;
                                border-radius: 5px;
                                cursor: pointer;
                            }

                            .btn-ok:hover {
                                background-color: #218838;
                            }
                        </style>
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