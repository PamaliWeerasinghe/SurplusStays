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
    <!-- navbar -->

    <div class="main-div">
        <?php echo $this->view('includes/businessNavbar') ?>
        <div class="sub-div-1">
            <!-- included the business side panel -->
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2">
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?= ASSETS ?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?= ASSETS ?>/images/Bell.png" class="bell" />
                    </div>
                    <div class="add-buyer">
                        <button class="add-complain-btn" onclick="window.location.href='<?= ROOT ?>/business/addproduct'">+ Add Product</button>
                    </div>


                </div>
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <label>Products</label>
                        <div>
                            <select>
                                <option>Quantity by count</option>
                                <option>less than 10</option>
                                <option>less than 50</option>
                                <option>More than 50</option>
                            </select>
                            <select>
                                <option>Expiery date</option>
                                <option>This week</option>
                                <option>This month</option>
                            </select>

                        </div>



                    </div>

                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Expiration date/time</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>
                                    <?php
                                    // Get the first image from the pictures array
                                    $productPictures = explode(',', $row->pictures); // Assuming $row->pictures is a comma-separated string
                                    $productImage = isset($productPictures[0]) ? $productPictures[0] : 'product_placeholder.png'; // Use placeholder if no image
                                    ?>
                                    <tr onclick="window.location.href='<?= ROOT ?>/business/viewProduct/<?= $row->id ?>'">
                                        <td>
                                            <div class="event-name">

                                                <img src="<?= ROOT ?><?= htmlspecialchars($productImage) ?>" alt="product" class="event-img">
                                                <h3><?= mb_strimwidth($row->name, 0, 20, '...') ?></h3>

                                            </div>
                                        </td>

                                        <td><?= $row->qty ?></td>
                                        <td><?= $row->price_per_unit ?></td>
                                        <td><?= $row->expiration_date_time ?></td>

                                        <td>
                                            <div style="display: inline-block; margin-right: 10px;">
                                                <a href="<?= ROOT ?>/business/editproduct/<?= $row->id ?>">
                                                    <button class="completed">Edit</button>
                                                </a>
                                            </div>

                                            <div style="display: inline-block;">
                                                <form action="<?= ROOT ?>/business/deleteproduct/<?= $row->id ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                    <button type="submit" class="take-action">Delete</button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">
                                        <h4>No products found</h4>
                                    </td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>



                </div>

            </div>


        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>

    <script>
        document.querySelectorAll('.completed, .take-action').forEach(button => {
            button.addEventListener('click', event => {
                event.stopPropagation();
            });
        });
    </script>


</body>

</html>