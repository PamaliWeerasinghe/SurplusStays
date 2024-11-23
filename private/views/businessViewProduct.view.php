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

    <?php
    // Get the images from the pictures array
    $businessPictures = explode(',', $row[0]->pictures);
    ?>

    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">


                <div class="summary">
                    <div class="notifications"><img src="<?= ROOT ?>/assets/images/bell.png" /></div>
                </div>


                <div class="inner-main">
                    <div class="header">
                        <h2>Product Information</h2>
                    </div>

                    <div class="section charity-details">

                        <?php if (($row)): ?>
                            <div class="charity-overview">
                                <div class="image-container">
                                    <img class="logo-img" src="<?= ROOT ?><?= htmlspecialchars($businessPictures[0]) ?>" alt="Business Logo">
                                </div>
                                <div class="charity-text">
                                    <h1><?= $row[0]->name ?></h1>
                                    <p><strong>Category :</strong> <?= $row[0]->category ?></p>
                                    <p><strong>Quantity :</strong> <?= $row[0]->qty ?></p>
                                    <p><strong>Unit Price :</strong> <?= $row[0]->price_per_unit ?></p>
                                    <p><strong>Discount Price :</strong> <?= $row[0]->discount_price ?></p>
                                </div>
                            </div>
                            <div class="images-container">
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
                            <div class="bottom">
                                <p>
                                    <strong>expiration date and time :</strong>
                                    <span class="red-text"><?= $row[0]->expiration_date_time ?></span>
                                </p>

                                <p><strong>Description:</strong></p>
                                <textarea name="description" readonly><?= get_var('description', $row[0]->description) ?></textarea>

                                <button onclick="window.location.href='<?= ROOT ?>/business/editproduct/<?= $row[0]->id ?>'">Edit Product</button>
                            </div>
                        <?php else: ?>
                            <h3>That product was not found</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textareas = document.querySelectorAll("textarea");

            textareas.forEach((textarea) => {
                // Adjust height initially
                adjustHeight(textarea);

                // Adjust height on input
                textarea.addEventListener("input", function() {
                    adjustHeight(this);
                });
            });

            function adjustHeight(textarea) {
                textarea.style.height = "auto"; // Reset height
                textarea.style.height = textarea.scrollHeight + "px"; // Set height to match content
            }
        });
    </script>
</body>

</html>