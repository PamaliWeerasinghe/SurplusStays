<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/businessMyProducts.css" />
<link rel="stylesheet" href="<?= STYLES ?>/business.css">
</head>

<body>

    <div class="main-div">
        <?php echo $this->view('includes/businessNavbar') ?>
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/businessSidePanel.view.php" ?>
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
                            <select>
                                <option>Date added</option>
                                <option>september</option>
                                <option>octomber</option>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td>
                                            <div class="event-name">
                                                <img src="<?= ASSETS ?>/images/pasta.png" alt="Event" class="event-img">
                                                <h3><?= $row->name ?></h3>
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

                    <div class="arrow-div">
                        <div class="arrows">
                            <img src="<?= ASSETS ?>/images/Arrow right-circle.png" />
                            <img src="<?= ASSETS ?>/images/Arrow right-circle-bold.png" />

                        </div>
                    </div>

                </div>

            </div>


        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>


    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>