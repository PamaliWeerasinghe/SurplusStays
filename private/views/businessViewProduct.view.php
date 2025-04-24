<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessViewProduct.css">
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
                        <h2>Product Information</h2>
                    </div>

                    <div class="product-details">
                        <?php if (($row)): ?>

                            <?php
                            // Get the images from the pictures array
                            $businessPictures = explode(',', $row[0]->pictures);
                            ?>

                            <div class="details-section">

                                <img class="logo-img" src="<?= ROOT ?><?= htmlspecialchars($businessPictures[0]) ?>" alt="Business Logo">

                                <div class="details-text">
                                    <h1><?= $row[0]->name ?></h1>
                                    <p><strong>Category :</strong> <?= $row[0]->category ?></p>
                                    <p><strong>Quantity :</strong> <?= $row[0]->qty ?></p>
                                    <p><strong>Unit Price :</strong> <?= $row[0]->price_per_unit ?></p>
                                    <p><strong>Price after applied discount percentage :</strong> <?= $row[0]->discountPrice ?></p>
                                    <p>
                                        <strong>expiration date and time :</strong>
                                        <span class="red-text"><?= $row[0]->expiration_dateTime ?></span>
                                    </p>

                                    <p><strong>Description:</strong><?= $row[0]->description ?></p>
                                </div>
                            </div>
                            <div class="images-section">
                                <?php if (!empty($businessPictures[1])): ?>
                                    <img src="<?= ROOT ?><?= htmlspecialchars($businessPictures[1]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                <?php else: ?>
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                <?php endif; ?>
                                <?php if (!empty($businessPictures[2])): ?>
                                    <img src="<?= ROOT ?><?= htmlspecialchars($businessPictures[2]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                <?php else: ?>
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                <?php endif; ?>

                            </div>

                            <button onclick="window.location.href='<?= ROOT ?>/business/editproduct/<?= $row[0]->id ?>'">Edit Product</button>
                            
                        <?php else: ?>
                            <h3>The product was not found</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>


</body>

</html>