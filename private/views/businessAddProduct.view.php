<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<title><?php echo SITENAME ?></title>
<link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/businessAddProduct.css">
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/businessSidePanel.view.php" ?>
            <div class="dashboard">


                <div class="summary">
                    <div class="notifications"><img src="<?= ASSETS ?>/images/Bell.png" /></div>
                </div>


                <div class="inner-main">
                    <div class="header">
                        <h2>Add New Product</h2>
                    </div>

                    <form method="POST">

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
                            <input type="text" value="<?= get_var('product-name') ?>" name="product-name" placeholder="Enter The Product Name (E.G., Fresh Apples, Baked Bread)">
                        </div>

                        <div class="input-group">
                            <label for="category">Category :</label>
                            

                            <select name="category">
                                <option value="" disabled <?= get_var('category') === '' ? 'selected' : '' ?>>Select Category</option>
                                <option value="Fast foods" <?= get_var('category') === 'Fast foods' ? 'selected' : '' ?>>Fast foods</option>
                                <option value="Snack" <?= get_var('category') === 'Snack' ? 'selected' : '' ?>>Snack</option>
                                <option value="Drinks" <?= get_var('category') === 'Drinks' ? 'selected' : '' ?>>Drinks</option>
                                <option value="Other" <?= get_var('category') === 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>

                        </div>


                        <div class="input-group">
                            <label for="description">Description :</label>
                            <textarea name="description" placeholder="Provide A Brief Description Of The Product"><?= get_var('description') ?></textarea>

                        </div>

                        <div class="input-group">
                            <label for="quantity">Quantity Available :</label>
                            <input type="number" value="<?= get_var('quantity') ?>" min="0" value="0" name="quantity">
                        </div>

                        <div class="input-group">
                            <label for="price">Price Per Unit :</label>
                            <input type="number" value="<?= get_var('price-per-unit') ?>" placeholder="Enter The Price Per Unit" min="0" step="0.01" name="price-per-unit">
                        </div>

                        <div class="input-group">
                            <label for="expiration">Expiration Date And Time :</label>
                            <input type="datetime-local" value="<?= get_var('expiration') ?>" name="expiration">
                        </div>


                        <div class="input-group upload-group">
                            <label>Upload Images : <small>You Can Add Up To 3 Images.</small></label>
                            <div class="upload-wrapper">
                                <label for="upload-1">
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                </label>
                                <input type="file" id="upload-1" name="upload-1" style="display: none;">

                                <label for="upload-2">
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-2">
                                </label>
                                <input type="file" id="upload-2" name="upload-2" style="display: none;">

                                <label for="upload-3">
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-3">
                                </label>
                                <input type="file" id="upload-3" name="upload-3" style="display: none;">

                            </div>
                        </div>

                        <div class="input-group">
                            <label>Add Discount Price : <span>(Optional)</span></label>

                            <input type="number" value="<?= get_var('discount') ?>" placeholder="Eg: Rs 12.50" min="0" step="0.01" name="discount">

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
        </script>
        <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>