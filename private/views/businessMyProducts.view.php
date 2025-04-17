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
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="add-product">
                        <button class="add-product-button" onclick="window.location.href='<?= ROOT ?>/business/addproduct'">+ Add Product</button>
                    </div>
                </div>

                <div class="main-box">
                    <div class="header">
                        <label>Products</label>

                        <div class="search-and-filter">
                            <div>
                                <input type="text" id="productSearch" class="search" placeholder="Search by Product Name..." onkeyup="searchByName()" />
                            </div>

                            <form method="GET" action="<?= ROOT ?>/business/myproducts">
                                <select name="filter" onchange="this.form.submit()">
                                    <option value="">Filter the products</option>
                                    <option value="Expiration" <?= ($_GET['filter'] ?? '') === 'Expiration' ? 'selected' : '' ?>>By Expiration Date</option>
                                    <option value="Quantity" <?= ($_GET['filter'] ?? '') === 'Quantity' ? 'selected' : '' ?>>By Quantity</option>
                                    <option value="Price" <?= ($_GET['filter'] ?? '') === 'Price' ? 'selected' : '' ?>>By Price</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <table class="main-table">
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
                                    <tr class="product-row" onclick="window.location.href='<?= ROOT ?>/business/viewProduct/<?= $row->id ?>'">
                                        <td>
                                            <div class="product-wrap">
                                                <img src="<?= ROOT ?><?= htmlspecialchars($productImage) ?>" alt="product">
                                                <h3 class="product-name"><?= mb_strimwidth($row->name, 0, 15, '...') ?></h3>
                                            </div>
                                        </td>
                                        <td><?= $row->qty ?></td>
                                        <td>Rs <?= $row->price_per_unit ?></td>
                                        <td><?= $row->expiration_date_time ?></td>
                                        <td>
                                            <div class="inline">
                                                <div>
                                                    <a href="<?= ROOT ?>/business/editproduct/<?= $row->id ?>">
                                                        <button class="editbutton">Edit</button>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form id="deleteForm<?= $row->id ?>" action="<?= ROOT ?>/business/deleteproduct/<?= $row->id ?>" method="post">
                                                        <button class="deletebutton" type="button" data-form-id="deleteForm<?= $row->id ?>">Delete</button>
                                                    </form>
                                                </div>
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
                    <div class="pagination">
                        <img src="<?= ASSETS ?>/images/back.png" id="PrevBtn" />
                        <img src="<?= ASSETS ?>/images/next.png" id="NextBtn" />
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>

    <!-- Simple Delete Confirmation Popup -->
    <div id="deletePopup" class="popup">
        <div class="popup-content">
            <p>Are you sure you want to delete this product?</p>
            <div class="button-container">
                <button class="btn-ok" id="confirmDelete">Yes, Delete</button>
                <button class="btn-cancel" id="cancelDelete">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        /* deleteform popup */
        let deleteForm = null;

        document.querySelectorAll('.deletebutton').forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();
                deleteForm = document.getElementById(button.dataset.formId);
                document.getElementById('deletePopup').style.display = 'block';
            });
        });

        document.getElementById('confirmDelete').addEventListener('click', () => {
            if (deleteForm) deleteForm.submit();
        });

        document.getElementById('cancelDelete').addEventListener('click', () => {
            document.getElementById('deletePopup').style.display = 'none';
        });

        /* stop the viewProduct page when clicking edit and delete */

        document.querySelectorAll('.editbutton, .deletebutton').forEach(button => {
            button.addEventListener('click', event => {
                event.stopPropagation();
            });
        });

        /* pagination */

        const rowsPerPage = 10;
        let currentPage = 1;

        const rows = Array.from(document.querySelectorAll('.product-row'));
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        function showPage(page) {
            rows.forEach((row, index) => {
                row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? '' : 'none';
            });
        }

        // Initial display
        showPage(currentPage);

        // Event listeners
        document.getElementById('NextBtn').addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        });

        document.getElementById('PrevBtn').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });

        /* search by name */

        function searchByName() {
            let input = document.getElementById("productSearch").value.toUpperCase();
            let rows = document.querySelectorAll(".product-row");

            rows.forEach(row => {
                let productName = row.querySelector(".product-name").textContent.toUpperCase();
                row.style.display = productName.includes(input) ? "" : "none";
            });
        }
    </script>

</body>
</html>