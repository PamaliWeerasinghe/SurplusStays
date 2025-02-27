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
                                <p><strong>Email:</strong> <?= htmlspecialchars($order[0]->customer_email) ?></p>
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
                                <form action="<?= ROOT ?>/business/updateOrderStatus" method="POST">
                                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order[0]->id) ?>">
                                    <div class="button-container">
                                        <button type="submit" name="status" value="COMPLETED" class="btn-success"> ✔ ORDER COLLECTED</button>
                                        <button type="submit" name="status" value="NOT COLLECTED" class="btn-danger">❌ ORDER NOT COLLECTED</button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <p style="color: green; font-weight: bold; text-align: center;">You have already updated the order status.</p>
                            <?php endif; ?>
                        </div>

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