<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessAddProduct.css">
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
                        <h2>Add New Product</h2>
                    </div>

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
                            <label>Product Name :</label>
                            <input type="text" pattern="[A-Za-z\s]*" title="Only letters and spaces are allowed" value="<?= get_var('product-name') ?>" name="product-name" placeholder="Enter The Product Name (E.G., Fresh Apples, Baked Bread)">
                        </div>

                        <div class="input-group">
                            <label>Category :</label>
                            <select name="category">
                                <option value="" disabled <?= get_var('category') === '' ? 'selected' : '' ?>>Select Category</option>
                                <option value="Diary" <?= get_var('category') === 'Diary' ? 'selected' : '' ?>>Diary</option>
                                <option value="Bakery" <?= get_var('category') === 'Bakery' ? 'selected' : '' ?>>Bakery</option>
                                <option value="Desserts" <?= get_var('category') === 'Desserts' ? 'selected' : '' ?>>Desserts </option>
                                <option value="Frozen foods" <?= get_var('category') === 'Frozen foods' ? 'selected' : '' ?>>Frozen foods</option>
                                <option value="Beverages" <?= get_var('category') === 'Beverages' ? 'selected' : '' ?>>Beverages</option>
                                <option value="Snacks" <?= get_var('category') === 'Snacks' ? 'selected' : '' ?>>Snacks</option>
                                <option value="Prepared Foods" <?= get_var('category') === 'Prepared Foods' ? 'selected' : '' ?>>Prepared Foods</option>
                                <option value="Fruits & Vegetables" <?= get_var('category') === 'Fruits & Vegetables' ? 'selected' : '' ?>>Fruits & Vegetables</option>
                                <option value="Other" <?= get_var('category') === 'Other' ? 'selected' : '' ?>>Other</option>
                                
                            </select>
                        </div>

                        <div class="input-group">
                            <label>Description :</label>
                            <textarea name="description" placeholder="Provide A Brief Description Of The Product"><?= get_var('description') ?></textarea>
                        </div>

                        <div class="input-group">
                            <label>Quantity Available :</label>
                            <input type="number" value="<?= get_var('quantity') ?>" min="0" value="0" name="quantity">
                        </div>

                        <div class="input-group">
                            <label>Price Per Unit :</label>
                            <input type="number" value="<?= get_var('price-per-unit') ?>" placeholder="Enter The Price Per Unit" min="0" step="0.01" name="price-per-unit">
                        </div>

                        <div class="input-group">
                            <label>Expiration Date And Time :</label>
                            <input type="datetime-local" value="<?= get_var('expiration') ?>" name="expiration">
                        </div>

                        <div class="input-group upload-group">
                            <label>Upload Images : <small>You Can Add Up To 3 Images.</small></label>
                            <div class="upload-wrapper">
                                <!-- First Image Upload -->
                                <label for="upload-1">
                                    <img src="<?= isset($uploadedPictures[0]) ? ROOT . $uploadedPictures[0] : ASSETS . '/icons/uploadArea.png' ?>"
                                        alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                </label>
                                <input type="file" id="upload-1" name="upload-1" style="display: none;">

                                <!-- Second Image Upload -->
                                <label for="upload-2">
                                    <img src="<?= isset($uploadedPictures[1]) ? ROOT . $uploadedPictures[1] : ASSETS . '/icons/uploadArea.png' ?>"
                                        alt="Upload Image" class="upload-icon" id="profilePreview-2">
                                </label>
                                <input type="file" id="upload-2" name="upload-2" style="display: none;">

                                <!-- Third Image Upload -->
                                <label for="upload-3">
                                    <img src="<?= isset($uploadedPictures[2]) ? ROOT . $uploadedPictures[2] : ASSETS . '/icons/uploadArea.png' ?>"
                                        alt="Upload Image" class="upload-icon" id="profilePreview-3">
                                </label>
                                <input type="file" id="upload-3" name="upload-3" style="display: none;">
                            </div>
                        </div>

                        <?php foreach ($uploadedPictures as $path): ?>
                            <input type="hidden" name="uploadedPictures[]" value="<?= $path ?>">
                        <?php endforeach; ?>

                        <div class="input-group">
                            <label>Add Discount Percentage :<small>(Optional)<small></label>
                            <input type="number" value="<?= get_var('discount') ?>" placeholder="Enter discount percentage (20 for 20%)" min="0" step="0.01" max="100" name="discount">
                        </div>

                        <div class="button-group">
                            <a href="<?= ROOT ?>/business/myproducts">
                                <button type="button" class="btn-cancel">Cancel</button>
                            </a>
                            <button type="reset" class="btn-clear">Clear All</button>
                            <button type="submit" class="btn-create">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>

        <!-- JavaScript to Show Preview -->
        <script>
            // First Image Preview
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

            // Second Image Preview
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

            // Third Image Preview
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

        /* handle image uploaders when  clear-all button is clicked */ 

        // Handle "Clear All" manually for custom elements
        document.querySelector('form').addEventListener('reset', function () {
        // Reset image previews to default upload icons
        document.getElementById('profilePreview-1').src = "<?= ASSETS ?>/icons/uploadArea.png";
        document.getElementById('profilePreview-2').src = "<?= ASSETS ?>/icons/uploadArea.png";
        document.getElementById('profilePreview-3').src = "<?= ASSETS ?>/icons/uploadArea.png";

        // Clear file input fields
        document.getElementById('upload-1').value = "";
        document.getElementById('upload-2').value = "";
        document.getElementById('upload-3').value = "";

        });

        </script>

</body>

</html>