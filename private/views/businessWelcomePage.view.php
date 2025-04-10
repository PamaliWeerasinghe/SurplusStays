<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessDashboard.css">
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
</head>

<body>
    <div class="main-div">
        <?php echo $this->view('includes/businessNavbar') ?>
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">

                <!-- Summary section -->
                <div class="summary">
                    <div class="mini-boxes">
                        <div class="mini-box">
                            <div class="mini-box-1">
                                <img src="<?= ASSETS ?>/images/donate.png" />
                            </div>
                            <div class="mini-box-2">
                                <label class="summaries-2-label1">Donations</label>
                                <label class="summaries-2-label2"><?= $requestcount ?></label>
                            </div>
                        </div>
                        <div class="mini-box">
                            <div class="mini-box-1">
                                <img src="<?= ASSETS ?>/images/manifesto.png" />
                            </div>
                            <div class="mini-box-2">
                                <label class="summaries-2-label1">Orders</label>
                                <label class="summaries-2-label2"><?= $ordercount ?></label>
                            </div>
                        </div>
                        <div class="mini-box">
                            <div class="mini-box-1">
                                <img src="<?= ASSETS ?>/images/box.png" />
                            </div>
                            <div class="mini-box-2">
                                <label class="summaries-2-label1">Products</label>
                                <label class="summaries-2-label2"><?= $productcount ?></label>
                            </div>
                        </div>
                        <div class="mini-box">
                            <div class="mini-box-1">
                                <img src="<?= ASSETS ?>/images/ratinglike.png" />
                            </div>
                            <div class="mini-box-2">
                                <label class="summaries-2-label1">Rating</label>
                                <label class="summaries-2-label2">4.7/5.0</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order status chart -->
                <div class="admin-order-status">
                    <div class="order">
                        <label>Order Status</label>
                    </div>
                    
                    <div class="order-status-chart">
                        <div class="chart">
                            <div class="bar" style="--value: 70%;"></div>
                            <div class="bar" style="--value: 50%;"></div>
                            <div class="bar" style="--value: 30%;"></div>
                            <div class="bar" style="--value: 100%;"></div>
                            <div class="bar" style="--value: 60%;"></div>
                            <div class="bar" style="--value: 80%;"></div>
                            <div class="bar" style="--value: 50%;"></div>
                        </div>
                        <div class="day-block">
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                            <div class="day">Sun</div>
                        </div>
                    </div>
                </div>

                <!-- Top Sales Products -->
                <div class="product-status">
                    <div>
                        <label>Top Sales Products</label>
                    </div>

                    <div class="product-row" id="productRow">
                        <?php if ($rows): ?>
                            <?php foreach ($rows as $row): ?>
                                <?php
                                $productPictures = explode(',', $row->pictures);
                                $productImage = isset($productPictures[0]) ? $productPictures[0] : 'product_placeholder.png';
                                ?>
                                <div class="product-item" style="display: none;" onclick="window.location.href='<?= ROOT ?>/business/viewProduct/<?= $row->id ?>'">
                                    <div>
                                        <img src="<?= ROOT ?><?= htmlspecialchars($productImage) ?>" alt="product-image">
                                    </div>
                                    <div class="product-item-colomn">
                                        <label class="product-item-1"><?= mb_strimwidth($row->name, 0, 15, '...') ?></label>
                                        <label class="product-item-2">Rs <?= $row->price_per_unit ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <h4>No products found</h4>
                        <?php endif; ?>
                    </div>

                    <div class="pagination">
                        <img src="<?= ASSETS ?>/images/back.png" id="prevBtn" style="cursor: pointer;" />
                        <img src="<?= ASSETS ?>/images/next.png" id="nextBtn" style="cursor: pointer;" />
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="recent-orders">
                    <div>
                        <label>Recent Orders</label>
                    </div>

                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)) : ?>
                                <?php foreach ($orders as $order) : ?>
                                    <tr onclick="window.location.href='<?= ROOT ?>/business/viewOrder/<?= $order->id ?>'">
                                        <td><?= htmlspecialchars($order->dateTime) ?></td>
                                        <td><?= htmlspecialchars($order->Customer) ?></td>
                                        <td><?= htmlspecialchars($order->Products) ?></td>
                                        <td>
                                            <span class="order-status <?= strtolower(str_replace(' ', '-', $order->status)) ?>">
                                                <?= htmlspecialchars($order->status) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" style="text-align: center;">No Orders Found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>


                    <div class="pagination">
                        <img src="<?= ASSETS ?>/images/back.png" id="orderPrevBtn" style="cursor: pointer;" />
                        <img src="<?= ASSETS ?>/images/next.png" id="orderNextBtn" style="cursor: pointer;" />
                    </div>


                </div>

            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>

    <script>
        // Product Pagination
        const itemsPerPage = 4;
        let currentPage = 0;

        const products = document.querySelectorAll(".product-item");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        function showProducts() {
            const start = currentPage * itemsPerPage;
            const end = start + itemsPerPage;
            products.forEach((item, index) => {
                item.style.display = (index >= start && index < end) ? "flex" : "none";
            });
        }

        prevBtn?.addEventListener("click", () => {
            if (currentPage > 0) {
                currentPage--;
                showProducts();
            }
        });

        nextBtn?.addEventListener("click", () => {
            if ((currentPage + 1) * itemsPerPage < products.length) {
                currentPage++;
                showProducts();
            }
        });

        showProducts();

        // Orders Pagination
        const orderItemsPerPage = 4;
        let orderCurrentPage = 0;

        const orderRows = document.querySelectorAll(".order-table tbody tr");
        const orderPrevBtn = document.getElementById("orderPrevBtn");
        const orderNextBtn = document.getElementById("orderNextBtn");

        function showOrders() {
            const start = orderCurrentPage * orderItemsPerPage;
            const end = start + orderItemsPerPage;
            orderRows.forEach((row, index) => {
                row.style.display = (index >= start && index < end) ? "table-row" : "none";
            });
        }

        orderPrevBtn?.addEventListener("click", () => {
            if (orderCurrentPage > 0) {
                orderCurrentPage--;
                showOrders();
            }
        });

        orderNextBtn?.addEventListener("click", () => {
            if ((orderCurrentPage + 1) * orderItemsPerPage < orderRows.length) {
                orderCurrentPage++;
                showOrders();
            }
        });

        showOrders();
    </script>

</body>

</html>