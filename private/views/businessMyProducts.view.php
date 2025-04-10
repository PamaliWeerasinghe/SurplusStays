<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessMyProducts.css">
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css">
</head>

<body>
    <!-- Navbar -->
    <?php echo $this->view('includes/businessNavbar') ?>

    <div class="main-div">
        <div class="sub-div-1">
            <!-- Side Panel -->
            <?php echo $this->view('includes/businessSidePanel') ?>

            <div class="dashboard">
                <div class="summary">
                    
                    <div class="add-buyer">
                        <button class="add-complain-btn" onclick="window.location.href='<?= ROOT ?>/business/addproduct'">+ Add Product</button>
                    </div>
                </div>

                <div class="Business-complaints-order-status">
                    <div class="order">
                        <label>Products</label>
                        <form method="GET" action="<?= ROOT ?>/business/myproducts">
                            <select name="filter" onchange="this.form.submit()">
                                <option value="">Filter the products</option>
                                <option value="Expiration" <?= ($_GET['filter'] ?? '') === 'Expiration' ? 'selected' : '' ?>>By Expiration Date</option>
                                <option value="Quantity" <?= ($_GET['filter'] ?? '') === 'Quantity' ? 'selected' : '' ?>>By Quantity</option>
                                <option value="Price" <?= ($_GET['filter'] ?? '') === 'Price' ? 'selected' : '' ?>>By Price</option>
                            </select>
                        </form>

                    </div>

                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Expiration Date/Time</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>
                                    <?php
                                    $productPictures = explode(',', $row->pictures); // Get images
                                    $productImage = isset($productPictures[0]) ? $productPictures[0] : 'product_placeholder.png';
                                    ?>
                                    <tr onclick="window.location.href='<?= ROOT ?>/business/viewProduct/<?= $row->id ?>'">
                                        <td>
                                            <div class="event-name">
                                                <img src="<?= ROOT ?><?= htmlspecialchars($productImage) ?>" alt="product" class="event-img">
                                                <h3><?= mb_strimwidth($row->name, 0, 20, '...') ?></h3>
                                            </div>
                                        </td>
                                        <td><?= $row->qty ?></td>
                                        <td>Rs <?= $row->price_per_unit ?></td>
                                        <td><?= $row->expiration_date_time ?></td>
                                        <td>
                                            <div style="display: inline-block; margin-right: 10px;">
                                                <a href="<?= ROOT ?>/business/editproduct/<?= $row->id ?>">
                                                    <button class="completed">Edit</button>
                                                </a>
                                            </div>
                                            <div style="display: inline-block;">
                                                <form id="deleteForm<?= $row->id ?>" action="<?= ROOT ?>/business/deleteproduct/<?= $row->id ?>" method="post">
                                                    <button type="button" class="take-action" data-form-id="deleteForm<?= $row->id ?>">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">
                                        <h4>No products found</h4>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php echo $this->view('includes/footer') ?>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirm Deletion</h3>
            <p>Are you sure you want to delete this product?</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="modal-button confirm">Yes, Delete</button>
                <button id="cancelDelete" class="modal-button cancel">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let deleteForm = null;

        document.querySelectorAll('.take-action').forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault(); // Prevent form submission
                deleteForm = document.getElementById(button.dataset.formId); // Store form reference
                document.getElementById('deleteModal').style.display = 'block'; // Show modal
            });
        });

        document.getElementById('confirmDelete').addEventListener('click', () => {
            if (deleteForm) deleteForm.submit(); // Submit the form
        });

        document.getElementById('cancelDelete').addEventListener('click', () => {
            document.getElementById('deleteModal').style.display = 'none'; // Hide modal
        });

        //stop the viewProduct page when clicking edit and delete
        document.querySelectorAll('.completed, .take-action').forEach(button => {
            button.addEventListener('click', event => {
                event.stopPropagation();
            });
        });
    </script>
</body>

</html>