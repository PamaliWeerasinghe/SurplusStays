<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessRequestDetails.css" />
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

                    <?php if (!empty($request)) : ?>
                        <div class="section-main">
                            <h3>Request Details</h3>
                            <div class="inside">
                                <p><strong>Order ID:</strong> #<?= htmlspecialchars($request[0]->id) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($request[0]->dateTime) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($request[0]->organization) ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($request[0]->status) ?></p>
                            </div>
                        </div>

                        <div class="section">
                            <h3>Request Details</h3>
                            <div class="inside">
                                <p style="text-align: center;"><?= htmlspecialchars($request[0]->reason) ?></p>
                            </div>
                        </div>

                        <div class="section">
                            <h3>Requsted Products</h3>
                            <div class="inside-table">
                                <table class="order-details-table">
                                    <tr>
                                        <th>ProductID</th>
                                        <th>product</th>
                                        <th>Requsted Amount</th>
                                    </tr>
                                    <?php foreach ($request as $item) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item->productid) ?></td>
                                            <td><?= htmlspecialchars($item->productname) ?></td>
                                            <td><?= htmlspecialchars($item->quantity) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                                
                            </div>
                        </div>

                        <div class="section-buttons">
                            <?php if ($request[0]->status === 'Pending') : ?>
                                <form action="<?= ROOT ?>/business/updateRequestStatus" method="POST">
                                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($request[0]->id) ?>">
                                    <div class="button-container">
                                        <button type="submit" name="status" value="COMPLETED" class="btn-success"> ✔ ACCEPT REQUEST</button>
                                        <button type="submit" name="status" value="CANCELLED" class="btn-danger">❌ CANCEL REQUEST</button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <p style="color: green; font-weight: bold; text-align: center;">You have already set the request status.</p>
                            <?php endif; ?>
                        </div>

                    <?php else : ?>
                        <p>Request not found.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>

</body>

</html>