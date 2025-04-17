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
                                <p><strong>Organization Name:</strong><?= htmlspecialchars($request[0]->organization) ?></p>
                                <p><strong>Contact Number:</strong><?= htmlspecialchars($request[0]->phone) ?></p>
                                <p><strong>email:</strong><?= htmlspecialchars($request[0]->email) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Requested Reason</h3>
                            <div class="items-colomn">
                                <p style="text-align: center;"><?= htmlspecialchars($request[0]->message) ?></p>
                            </div>
                        </div>

                        <div class="section-buttons">
                            <?php if ($request[0]->status === 'Pending') : ?>
                                <form method="POST" action="<?= ROOT ?>/business/updateRequestStatus" id="request-form">
                                    <input type="hidden" name="request_id" value="<?= htmlspecialchars($request[0]->id) ?>">
                                    <input type="hidden" name="status" id="statusInput" >
                                    <div class="button-container">
                                        <button type="button" name="status" value="Accepted" class="btn-green" onclick="showPopupAndSubmit('Accepted')">ACCEPT REQUEST</button>
                                        <button type="button" name="status" value="Rejected" class="btn-red"onclick="showPopupAndSubmit('Rejected')">CANCEL REQUEST</button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <p>You have already set the request status.</p>
                            <?php endif; ?>
                        </div>

                    <?php else : ?>
                        <p>Request not found.</p>
                    <?php endif; ?>

                    <!-- Simple Popup -->
                    <div id="simplePopup" class="popup">
                        <div class="popup-content">
                            <p>Success! <br> Request status have been updated.</p>
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
                            document.getElementById('request-form').submit();
                        }
                    </script>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>
</body>

</html>