<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessEditProduct.css">
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">

                <div class="summary">
                    <div class="notifications"><img src="<?= ROOT ?>/assets/images/bell.png" /></div>
                </div>

                <div class="inner-main">
                    <div class="header">
                        <h2>Edit Product</h2>
                    </div>

                    <?php if ($row): ?>

                        <form method="POST" enctype="multipart/form-data">

                            <?php if (!empty($errors)): ?>
                                <div class="error alert">
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="input-group">
                                <label for="product-name">Product Name :</label>
                                <input type="text" value="<?= get_var('product-name', $row[0]->name) ?>" name="product-name" placeholder="Enter The Product Name (E.G., Fresh Apples, Baked Bread)">
                            </div>

                            <div class="input-group">
                                <label for="category">Category :</label>
                                <select value="<?= get_var('category', $row[0]->category) ?>" name="category">
                                    <option value="" disabled>Select Category</option>
                                    <option value="Fast foods">Fast foods</option>
                                    <option value="Snack">Snack</option>
                                    <option value="Drinks">Drinks</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="input-group">
                                <label for="description">Description :</label>
                                <textarea name="description" placeholder="Provide A Brief Description Of The Product"><?= get_var('description', $row[0]->description) ?></textarea>
                            </div>

                            <div class="input-group">
                                <label for="quantity">Quantity Available :</label>
                                <input type="number" value="<?= get_var('quantity', $row[0]->qty) ?>" min="0" name="quantity">
                            </div>

                            <div class="input-group">
                                <label for="price">Price Per Unit :</label>
                                <input type="number" value="<?= get_var('price-per-unit', $row[0]->price_per_unit) ?>" placeholder="Enter The Price Per Unit" min="0" step="0.01" name="price-per-unit">
                            </div>

                            <div class="input-group">
                                <label for="expiration">Expiration Date And Time :</label>
                                <input type="datetime-local" value="<?= get_var('expiration', $row[0]->expiration_date_time) ?>" name="expiration">
                            </div>

                            <div class="input-group upload-group">
                                <label>Upload Images : <small>You Can Add Up To 3 Images.</small></label>
                                <div class="upload-wrapper">
                                    <?php
                                    // Get the images from the pictures array
                                    $productPictures = explode(',', $row[0]->pictures);
                                    ?>
                                    <label for="upload-1">
                                        <?php if (!empty($productPictures[0])): ?>
                                            <img src="<?= ROOT ?><?= htmlspecialchars($productPictures[0]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                            <img class="delete-btn" src="<?= ASSETS ?>/icons/delete-button.png" alt="">
                                        <?php else: ?>
                                            <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                        <?php endif; ?>
                                    </label>
                                    <input type="file" id="upload-1" name="upload-1" style="display: none;">

                                    <label for="upload-2">
                                        <?php if (!empty($productPictures[1])): ?>
                                            <img src="<?= ROOT ?><?= htmlspecialchars($productPictures[1]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-2">
                                            <img class="delete-btn" src="<?= ASSETS ?>/icons/delete-button.png" alt="">
                                        <?php else: ?>
                                            <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-2">
                                        <?php endif; ?>
                                    </label>
                                    <input type="file" id="upload-2" name="upload-2" style="display: none;">

                                    <label for="upload-3">
                                        <?php if (!empty($productPictures[2])): ?>
                                            <img src="<?= ROOT ?><?= htmlspecialchars($productPictures[2]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-3">
                                            <img class="delete-btn" src="<?= ASSETS ?>/icons/delete-button.png" alt="">
                                        <?php else: ?>
                                            <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-3">
                                        <?php endif; ?>
                                    </label>
                                    <input type="file" id="upload-3" name="upload-3" style="display: none;">
                                </div>
                            </div>

                            <div class="input-group">
                                <label>Add Discount Price : <span>(Optional)</span></label>
                                <input type="number" value="<?= get_var('discount', $row[0]->discount_price) ?>" placeholder="Eg: Rs 12.50" min="0" step="0.01" name="discount">
                            </div>

                            <div class="button-group">
                                <a href="<?= ROOT ?>/business/myproducts">
                                    <button type="button" class="btn-cancel">Cancel</button>
                                </a>
                                <button type="submit" class="btn-create">Save</button>
                            </div>

                        </form>

                    <?php else: ?>
                        <p>The product was not found.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>

    <!-- JavaScript to Show Preview -->
    <script>
        document.getElementById('upload-1').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview-1').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        document.getElementById('upload-2').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview-2').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        document.getElementById('upload-3').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview-3').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.querySelectorAll('.delete-btn').forEach((btn, index) => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                // Find the associated image and set the input to empty
                let uploadInput = document.getElementById('upload-' + (index + 1));
                uploadInput.value = ''; // Clear the file input
                // Hide the image preview and the delete button
                let imagePreview = document.getElementById('profilePreview-' + (index + 1));
                imagePreview.src = '<?= ASSETS ?>/icons/uploadArea.png'; // Reset the preview image
                this.style.display = 'none'; // Hide the delete button
            });
        });
    </script>
</body>

</html>