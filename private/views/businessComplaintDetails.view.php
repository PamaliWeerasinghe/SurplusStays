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


                        <div class="complaint-response-container">
                            <h3>Customer Explanation</h3>
                            <p><?= htmlspecialchars($complaint[0]->description) ?></p>
                        </div>




                        <?php if ($complaint[0]->status === 'Pending') : ?>
                            <div class="complaint-response-container">
                                <h3>Respond to Complaint</h3>
                                <form id="myform" method="POST" action="" autocomplete="off">
                                    <textarea name="response" placeholder="Write your response here..."></textarea>
                                    <button type="submit">Submit Response</button>
                                    <p class="advise"><strong>Please wait for the admin's reply after submitting.</strong> </p>
                                </form>
                            </div>
                        <?php else : ?>
                            <div class="complaint-response-container">
                                <h3>Admin Response</h3>
                                <p style="color: red;"><?= htmlspecialchars($complaint[0]->adminReply) ?></p>
                            </div>
                        <?php endif; ?>

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