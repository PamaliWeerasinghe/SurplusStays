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
                </div>

                <div class="main-box">
                    <div class="header">
                        <h2>Edit product</h2>
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
                            <input type="text" value="<?= get_var('product-name', $row[0]->name) ?>" name="product-name" placeholder="Enter The Product Name (E.G., Fresh Apples, Baked Bread)">
                        </div>

                        <div class="input-group">
                            <label>Category :</label>
                            <select name="category">
                                <option value="" disabled>Select Category</option>
                                <option value="Diary" <?= get_var('category', $row[0]->category) === 'Diary' ? 'selected' : '' ?>>Diary</option>
                                <option value="Bakery" <?= get_var('category', $row[0]->category) === 'Bakery' ? 'selected' : '' ?>>Bakery</option>
                                <option value="Desserts" <?= get_var('category', $row[0]->category) === 'Desserts' ? 'selected' : '' ?>>Desserts</option>
                                <option value="Frozen foods" <?= get_var('category', $row[0]->category) === 'Frozen foods' ? 'selected' : '' ?>>Frozen foods</option>
                                <option value="Beverages" <?= get_var('category', $row[0]->category) === 'Beverages' ? 'selected' : '' ?>>Beverages</option>
                                <option value="Snacks" <?= get_var('category', $row[0]->category) === 'Snacks' ? 'selected' : '' ?>>Snacks</option>
                                <option value="Prepared Foods" <?= get_var('category', $row[0]->category) === 'Prepared Foods' ? 'selected' : '' ?>>Prepared Foods</option>
                                <option value="Fruits & Vegetables" <?= get_var('category', $row[0]->category) === 'Fruits & Vegetables' ? 'selected' : '' ?>>Fruits & Vegetables</option>
                                <option value="Other" <?= get_var('category', $row[0]->category) === 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>


                        </div>

                        <div class="input-group">
                            <label>Description :</label>
                            <textarea name="description" placeholder="Provide A Brief Description Of The Product"><?= get_var('description', $row[0]->description) ?></textarea>
                        </div>

                        <div class="input-group">
                            <label>Quantity Available :</label>
                            <input type="number" value="<?= get_var('quantity', $row[0]->qty) ?>" min="0" value="0" name="quantity">
                        </div>

                        <div class="input-group">
                            <label>Price Per Unit :</label>
                            <input type="number" value="<?= get_var('price-per-unit', $row[0]->price_per_unit) ?>" placeholder="Enter The Price Per Unit" min="0" step="0.01" name="price-per-unit">
                        </div>

                        <div class="input-group">
                            <label>Expiration Date And Time :</label>
                            <input type="datetime-local" value="<?= get_var('expiration', $row[0]->expiration_dateTime) ?>" name="expiration">
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

                        <?php
                        $percentage = (($row[0]->price_per_unit - $row[0]->discountPrice) / $row[0]->price_per_unit) * 100;
                        ?>

                        <div class="input-group">
                            <label>Discount Percentage Added:<small>(Optional)<small></label>
                            <input type="number" value="<?= get_var('discount', $percentage) ?>" placeholder="Enter discount percentage (20 for 20%)" min="0" step="0.01" max="100" name="discount">
                        </div>

                        <div class="button-group">
                            <a href="<?= ROOT ?>/business/myproducts">
                                <button type="button" class="btn-cancel">Cancel</button>
                            </a>
                            <button type="submit" class="btn-create">Update Product</button>
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessRequestDetails.css">
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
                        <h2>Request Details</h2>
                    </div>

                    <?php if (!empty($request)) : ?>
                        <div class="sub-box">
                            <h3>About Request</h3>
                            <div class="items-colomn">
                                <p><strong>Order ID:</strong> #<?= htmlspecialchars($request[0]->id) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($request[0]->date) ?></p>
                                <p><strong>Title:</strong> <?= htmlspecialchars($request[0]->title) ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($request[0]->status) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Organization Details</h3>
                            <div class="items-colomn">
                                <p><strong>Organization Name:</strong> <?= htmlspecialchars($request[0]->organization) ?></p>
                                <p><strong>Contact Number:</strong> <?= htmlspecialchars($request[0]->phone) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($request[0]->email) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Requested Reason</h3>
                            <div class="items-colomn">
                                <p style="text-align: center;"><?= htmlspecialchars($request[0]->message) ?></p>
                            </div>
                        </div>

                        <div class="section-buttons">
                            <?php if ($request[0]->status == 'pending') : ?>
                                <form method="POST" action="<?= ROOT ?>/business/updateRequestStatus" id="request-form">
                                    <input type="hidden" name="request_id" value="<?= htmlspecialchars($request[0]->id) ?>">
                                    <input type="hidden" name="status" id="statusInput">
                                    <div class="feedbacktext">
                                        <textarea name="feedback" placeholder="Enter some message" rows="4" cols="50"></textarea>
                                    </div>
                                    <div class="button-container">
                                        <button type="button" name="status" value="accepted" class="btn-green" onclick="showPopupAndSubmit('Accepted')">ACCEPT REQUEST</button>
                                        <button type="button" name="status" value="rejected" class="btn-red" onclick="showPopupAndSubmit('Rejected')">CANCEL REQUEST</button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <p>You have already set the request status.</p>
                            <?php endif; ?>
                        </div>

                    <?php else : ?>
                        <p>Request not found.</p>
                    <?php endif; ?>

                    <!-- Simple Popup -->
                    <div id="simplePopup" class="popup">
                        <div class="popup-content">
                            <p>Success! <br> Request status have been updated.</p>
                            <button class="btn-ok" onclick="redirectToOrders()">OK</button>
                        </div>
                    </div>

                    <script>
                        function showPopupAndSubmit(status) {
                            // Show the popup
                            document.getElementById('simplePopup').style.display = 'block';

                            // Store the status in a hidden input field to submit with the form
                            document.getElementById('statusInput').value = status;
                        }

                        function redirectToOrders() {
                            // Submit the form after closing the popup
                            document.getElementById('request-form').submit();
                        }
                    </script>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>
</body>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessOrderDetails.css">
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
                        <h2>Order Details</h2>
                    </div>

                    <?php if (!empty($order)) : ?>
                        <div class="sub-box">
                            <h3>About Order</h3>
                            <div class="items-colomn">
                                <p><strong>Order ID:</strong> #<?= htmlspecialchars($order[0]->id) ?></p>
                                <p><strong>Date:</strong> <?= htmlspecialchars($order[0]->dateTime) ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($order[0]->status) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Customer details</h3>
                            <div class="items-colomn">
                                <p><strong>Name:</strong> <?= htmlspecialchars($order[0]->customer_name) ?></p>
                                <p><strong>Phone:</strong> <?= htmlspecialchars($order[0]->customer_phone) ?></p>
                            </div>
                        </div>

                        <div class="sub-box">
                            <h3>Ordered Products</h3>
                            <div class="table-box">
                                <table class="order-details-table">
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price per product</th>
                                        <th>Price after discount</th>
                                        <th>Final price</th>
                                    </tr>
                                    <?php foreach ($order as $item) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item->product_name) ?></td>
                                            <td><?= htmlspecialchars($item->qty) ?></td>
                                            <td>Rs. <?= htmlspecialchars($item->price_per_unit) ?></td>
                                            <td>Rs. <?= htmlspecialchars($item->discountPrice) ?></td>
                                            <td>Rs. <?= htmlspecialchars($item->discountPrice) * htmlspecialchars($item->qty) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                                <p><strong>Total Price:</strong> Rs. <?= htmlspecialchars($order[0]->total) ?></p>
                            </div>
                        </div>

                        <div class="section-buttons">
                            <?php if ($order[0]->status === 'Ongoing') : ?>
                                <form action="<?= ROOT ?>/business/updateOrderStatus" method="POST" id="order-form">
                                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order[0]->id) ?>">
                                    <input type="hidden" name="status" id="statusInput">

                                    <div class="button-container">
                                        <button type="button" name="status" value="Completed" class="btn-green" onclick="showPopupAndSubmit('Completed')">ORDER COLLECTED</button>
                                        <button type="button" name="status" value="Not Collected" class="btn-red" onclick="showPopupAndSubmit('Not Collected')">ORDER NOT COLLECTED</button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <p>You have already updated the order status.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Simple Popup -->
                        <div id="simplePopup" class="popup">
                            <div class="popup-content">
                                <p>Success! <br> Order status have been updated.</p>
                                <button class="btn-ok" onclick="redirectToOrders()">OK</button>
                            </div>
                        </div>

                        <script>
                            function showPopupAndSubmit(status) {
                                // Show the popup
                                document.getElementById('simplePopup').style.display = 'block';

                                // Store the status in a hidden input field to submit with the form
                                document.getElementById('statusInput').value = status;
                            }

                            function redirectToOrders() {
                                // Submit the form after closing the popup
                                document.getElementById('order-form').submit();
                            }
                        </script>

                    <?php else : ?>
                        <p>Order not found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>
</body>

</html>