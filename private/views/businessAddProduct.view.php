<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<title><?php echo SITENAME ?></title>
<link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/businessAddProduct.css">
</head>

<body>
    <?php echo $this->view('includes/navbar') ?>
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

                    <form action="#" method="POST">

                        <div class="input-group">
                            <label for="product-name">Product Name :</label>
                            <input type="text" id="product-name" name="product-name" placeholder="Enter The Product Name (E.G., Fresh Apples, Baked Bread)">
                        </div>

                        <div class="input-group">
                            <label for="category">Category :</label>
                            <select id="category" name="category">
                                <option value="" disabled selected>Select Category</option>
                                <option value="Goal 1">Fast foods</option>
                                <option value="Goal 2">Snack</option>
                                <option value="Goal 3">Drinks</option>
                            </select>
                        </div>


                        <div class="input-group">
                            <label for="description">Description :</label>
                            <textarea id="description" name="description" placeholder="Provide A Brief Description Of The Product"></textarea>
                        </div>

                        <div class="input-group">
                            <label for="quantity">Quantity Available :</label>
                            <input type="number" id="quantity" min="0" value="0">
                        </div>

                        <div class="input-group">
                            <label for="price">Price Per Unit :</label>
                            <input type="number" id="price" placeholder="Enter The Price Per Unit" min="0" step="0.01">
                        </div>

                        <div class="input-group">
                            <label for="expiration">Expiration Date And Time :</label>
                            <input type="datetime-local" id="expiration" name="expiration">
                        </div>


                        <div class="input-group upload-group">
                            <label>Upload Images : <small>You Can Add Up To 3 Images.</small></label>
                            <div class="upload-wrapper">
                                <label for="upload-1">
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon">
                                </label>
                                <input type="file" id="upload-1" name="upload-1" style="display: none;">

                                <label for="upload-2">
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon">
                                </label>
                                <input type="file" id="upload-2" name="upload-2" style="display: none;">

                                <label for="upload-3">
                                    <img src="<?= ASSETS ?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon">
                                </label>
                                <input type="file" id="upload-3" name="upload-3" style="display: none;">

                            </div>
                        </div>

                        <div class="input-group">
                            <label>Add Discount Price : <span>(Optional)</span></label>

                            <input type="number" id="discount-value" placeholder="Eg: Rs 12.50" min="0" step="0.01">

                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-create">Add Product</button>
                            <button type="reset" class="btn-clear">Clear All</button>
                            <button type="button" class="btn-cancel">Cancel</button>
                        </div>
                    </form>


                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
        <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>