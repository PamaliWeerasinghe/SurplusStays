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
                <div class="summary">

                    <div class="mini-boxes">
                        <div class="mini-box">
                            <div class="mini-box-inner-1">
                                <img src="<?= ASSETS ?>/images/donate.png" />
                            </div>
                            <div class="mini-box-inner-2">
                                <label>Donations</label>
                                <label><?= $requestcount ?></label>
                            </div>
                        </div>
                        <div class="mini-box">
                            <div class="mini-box-inner-1">
                                <img src="<?= ASSETS ?>/images/manifesto.png" />
                            </div>
                            <div class="mini-box-inner-2">
                                <label>Orders</label>
                                <label><?= $ordercount ?></label>
                            </div>
                        </div>
                        <div class="mini-box">
                            <div class="mini-box-inner-1">
                                <img src="<?= ASSETS ?>/images/box.png" />
                            </div>
                            <div class="mini-box-inner-2">
                                <label>Products</label>
                                <label><?= $productcount ?></label>
                            </div>
                        </div>
                        <div class="mini-box">
                            <div class="mini-box-inner-1">
                                <img src="<?= ASSETS ?>/images/ratinglike.png" />
                            </div>
                            <div class="mini-box-inner-2">
                                <label>Rating</label>
                                <label>4.7/5.0</label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Order status bar chart -->
                <div class="order-status">
                    <div class="order">
                        <label>Order Status For this week</label>
                    </div>

                    <div class="order-status-chart">
                        <div class="chart" id="orderChart"></div>
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
                                <div class="product-item" onclick="window.location.href='<?= ROOT ?>/business/viewProduct/<?= $row->id ?>'">
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
                        <img src="<?= ASSETS ?>/images/back.png" id="productPrevBtn" style="cursor: pointer;" />
                        <img src="<?= ASSETS ?>/images/next.png" id="productNextBtn" style="cursor: pointer;" />
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

        //pagination for top selling products section

        const rowsPerPage = 4;
        let currentPage = 1;

        const rows = Array.from(document.querySelectorAll('.product-item'));
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        function showPage(page) {
            rows.forEach((row, index) => {
                row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? '' : 'none';
            });
        }

        // Initial display
        showPage(currentPage);

        // Event listeners
        document.getElementById('productNextBtn').addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        });

        document.getElementById('productPrevBtn').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });

        //pagination for recent orders section

        const orderItemsPerPage = 4;
        let orderCurrentPage = 1; 

        const orderRows = Array.from(document.querySelectorAll(".order-table tbody tr"));
        const orderPrevBtn = document.getElementById("orderPrevBtn");
        const orderNextBtn = document.getElementById("orderNextBtn");

        const orderTotalPages = Math.ceil(orderRows.length / orderItemsPerPage);

        function showOrders(page) {
            orderRows.forEach((row, index) => {
                row.style.display = (index >= (page - 1) * orderItemsPerPage && index < page * orderItemsPerPage) ? "table-row" : "none";
            });
        }

        // Initial display
        showOrders(orderCurrentPage);

        // Event listeners
        orderPrevBtn?.addEventListener("click", () => {
            if (orderCurrentPage > 1) {
                orderCurrentPage--;
                showOrders(orderCurrentPage);
            }
        });

        orderNextBtn?.addEventListener("click", () => {
            if (orderCurrentPage < orderTotalPages) {
                orderCurrentPage++;
                showOrders(orderCurrentPage);
            }
        });
    
        //JS for bar chart

        // Get weekly data from PHP
        const weeklyData = <?= json_encode($weeklyStats) ?>;

        // Define the week days and prepare a map with default zero counts
        const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        const orderData = {};

        daysOfWeek.forEach(day => {
            orderData[day] = 0; // default value
        });

        // Fill orderData with actual values from backend
        weeklyData.forEach(item => {
            orderData[item.day] = item.order_count;
        });

        // Get chart container
        const chart = document.getElementById("orderChart");
        chart.innerHTML = ""; // Clear existing bars

        // Create bars for each day
        daysOfWeek.forEach(day => {
            const bar = document.createElement("div");
            bar.className = "bar";

            const orders = orderData[day]; // how many orders that day
            const barHeight = Math.min(orders * 20, 100); // scale height, max 100%

            bar.style.setProperty("--value", `${barHeight}%`);
            chart.appendChild(bar);
        });
    </script>

</body>
</html>