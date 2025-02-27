<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessComplaintDetails.css" />
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

                    <?php if (!empty($complaint)) : ?>
                        <div class="section-main">
                            <h3>Complaint Details</h3>
                            <div class="inside">
                                <p><strong>Complaint ID:</strong> #<?= htmlspecialchars($complaint[0]->id) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($complaint[0]->dateTime) ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($complaint[0]->status) ?></p>
                                <p><strong>Customer Name:</strong> <?= htmlspecialchars($complaint[0]->customer_name) ?></p>
                            </div>
                        </div>

                        <div class="section">
                            <h3>Complaint Details</h3>
                            <p><?= htmlspecialchars($complaint[0]->description) ?></p>
                            <p class="advise"><strong>Treat every complaint as an opportunity to improve your business and build customer loyalty.</strong> </p>
                        </div>

                    <?php else : ?>
                        <p>Complaint not found.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>

</body>

</html>