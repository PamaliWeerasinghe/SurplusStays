<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessComplaintDetails.css">
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
                        <h2>Complaint Details</h2>
                    </div>

                    <?php if (!empty($complaint)) : ?>
                        <div class="sub-box">
                            <h3>About Complaint</h3>
                            <div class="items-colomn">
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
                            <?php if(empty($complaint[0]->feedback)) ?>
                            <div class="complaint-response-container">
                                <h3>Respond to Complaint</h3>
                                <form id="myform" method="POST" >
                                    <textarea name="response" placeholder="Write your response here..."></textarea>
                                    <button type="submit">Submit Response</button>
                                    <p class="advise"><strong>Please wait for the admin's reply after submitting.</strong> </p>
                                </form>
                            </div>
                            <?php else :?>
                                <p style="color: red;"><?= htmlspecialchars($complaint[0]->adminReply) ?></p>
                            <?php endif?>

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