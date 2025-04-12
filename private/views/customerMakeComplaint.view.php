<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<?php require APPROOT . '/views/adminReplyToCustomer.view.php' ?>
<link rel="stylesheet" href="<?= STYLES ?>/adminSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/admin.css">
<link rel="stylesheet" href="<?= STYLES ?>/adminSeeComplains.css">
<link rel="stylesheet" href="<?= STYLES ?>/customerMakeComplain.css">
<link rel="stylesheet" href="<?= STYLES ?>/errorAlertPopup.css">
</head>

<body>
    <?php echo $this->view('includes/navbar') ?>
   
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="complain-error-div">
                        <?php if (!empty($errors)) : ?>
                            <div class="error-alert-popup">
                                <div class="alert-header1">
                                    <span class="close-btn" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
                                    <span class="alert-title">Error</span>

                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            </div>

                    </div>



                    <div class="seecomplain-status">
                        <form method="post" enctype="multipart/form-data">
                            <div class="seecomplain-bar">
                                <label></label>
                                <label>Ord. No :
                                    <select onchange="loadOrderItems();" id="orderID" name='orderid'>
                                        <option value="oid">Order ID</option>
                                        <?php foreach ($orders as $order): ?>
                                            <option value="<?= $order->id ?>"><?= $order->id ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </label>

                            </div>
                            <div class="see-product">
                                <div class="main-img-details">

                                    <div class="see-product-details">
                                        <h2>Shop Name : </h2><label id="shopName"></label>
                                        <input type="hidden" id="shopID" name="shopID" />
                                        <div style="width: 100%;">
                                            <h2>Select Item</h2>
                                            <select style="width: 100%;" id="orderItems" name="orderitem">
                                                <option value="selectItem">Select Item</option>

                                            </select>
                                        </div>
                                        <div style="width: 100%;">
                                            <h3>Customer Complaint</h3>
                                            <textarea style="width: 100%; height: 20vh;" name="complaint" id="complaint" value='<?= get_var('complaint') ?>'></textarea>
                                        </div>
                                        <div>
                                        </div>
                                    </div>


                                </div>
                                <div class="sub-img">

                                    <div class="img-container">
                                        <div class="upload-wrapper">
                                            <label for="upload-1">
                                                <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                            </label>
                                            <input type="file" id="upload-1" name="complaintImg1" style="display: none;" accept="image/*" value='<?= get_file('complaintImg1') ?>'>
                                        </div>
                                        <div class="upload-wrapper">
                                            <label for="upload-2">
                                                <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-2">
                                            </label>
                                            <input type="file" id="upload-2" name="complaintImg2" style="display: none;" accept="image/*" value='<?= get_file('complaintImg2') ?>'>
                                        </div>
                                        <div class="upload-wrapper">
                                            <label for="upload-2">
                                                <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-3">
                                            </label>
                                            <input type="file" id="upload-3" name="complaintImg3" style="display: none;" accept="image/*" value='<?= get_file('complaintImg3') ?>'>
                                        </div>
                                        <div class="upload-wrapper">
                                            <label for="upload-2">
                                                <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-4">
                                            </label>
                                            <input type="file" id="upload-4" name="complaintImg4" style="display: none;" accept="image/*" value='<?= get_file('complaintImg4') ?>'>
                                        </div>
                                        <div class="upload-wrapper">
                                            <label for="upload-2">
                                                <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-5">
                                            </label>
                                            <input type="file" id="upload-5" name="complaintImg5" style="display: none;" accept="image/*" value='<?= get_file('complaintImg5') ?>'>
                                        </div>



                                    </div>

                                    <!-- <img src="<?= ASSETS ?><?= $complaint_imgs[2]->path ?>" id="complaintImg<?= $complaint_imgs[2]->id ?>"/> -->
                                </div>
                                <div class="business-response-area-btn">
                                    <button class="complain-btn1" type="submit">Complain</button>

                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
        <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>
        <script>
            // Auto-hide after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.querySelector('.error-alert-popup');
                if (alert) {
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 5000);
                }
            });
        </script>
        <script src="<?= ROOT ?>/assets/js/adminManageCustomers.js"></script>