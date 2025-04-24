<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessRequestDetails.css">
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
                        <h2>Request Details</h2>
                    </div>

                    <?php if (!empty($request)) : ?>
                        <div class="sub-box">
                            <h3>About Request</h3>
                            <div class="items-colomn">
                                <p><strong>Order ID:</strong> #<?= htmlspecialchars($request[0]->id) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($request[0]->date) ?></p>
                                <p><strong>Title:</strong> <?= htmlspecialchars($request[0]->title) ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($request[0]->status) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Organization Details</h3>
                            <div class="items-colomn">
                                <p><strong>Organization Name:</strong> <?= htmlspecialchars($request[0]->organization) ?></p>
                                <p><strong>Contact Number:</strong> <?= htmlspecialchars($request[0]->phone) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($request[0]->email) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Requested Reason</h3>
                            <div class="items-colomn">
                                <p style="text-align: center;"><?= htmlspecialchars($request[0]->message) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Take Action</h3>
                            <div class="section-buttons">
                                <?php if ($request[0]->status == 'pending') : ?>
                                    <form method="POST" action="<?= ROOT ?>/business/updateRequestStatus" id="request-form">
                                        <input type="hidden" name="request_id" value="<?= htmlspecialchars($request[0]->id) ?>">
                                        <div class="table-box">
                                            <table class="order-details-table">
                                                <tr>
                                                    <th>Requested Products</th>
                                                    <th>Quantity in stock</th>
                                                    <th>Wish To Donate</th>
                                                </tr>
                                                <?php foreach ($donationItems as $item) : ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($item->name) ?></td>
                                                        <td><?= htmlspecialchars($item->qty) ?></td>
                                                        <td><input type="number" name="quantity"></td>
                                                        
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        </div>
                                            <div class="feedbacktext">
                                                <textarea name="feedback" placeholder="Enter some message" rows="4" cols="50"></textarea>
                                            </div>
                                            <div class="button-container">
                                                <button type="submit" name="status" value="accepted" class="btn-green">ACCEPT REQUEST</button>
                                                <button type="submit" name="status" value="rejected" class="btn-red">CANCEL REQUEST</button>
                                            </div>
                                    </form>
                                <?php else : ?>
                                    <p>You have already set the request status.</p>
                                <?php endif; ?>
                            </div>
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