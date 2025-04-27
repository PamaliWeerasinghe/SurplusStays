<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessorders.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                    
                    <div class="order-status-cards">
                        <div class="order-card all" onclick="filterByStatus('all')">
                            <h3>All</h3>
                        </div>
                        <div class="order-card not-collected" onclick="filterByStatus('not-collected')">
                            <h3>Not Collected</h3>

                        </div>
                        <div class="order-card ongoing" onclick="filterByStatus('ongoing')">
                            <h3>Ongoing</h3>

                        </div>
                        <div class="order-card completed" onclick="filterByStatus('completed')">
                            <h3>Completed</h3>
                        </div>
                    </div>
                </div>

                <div class="main-box">
                    <div class="header">
                        <label>Orders</label>
                        <div>
                            <input class="search" type="text" id="orderSearch"  placeholder="Search by Order ID..." onkeyup="filterOrders()" />
                        </div>
                    </div>

                    
                    <table class="main-table">
                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)) : ?>
                                <?php foreach ($orders as $order) : ?>
                                    <tr class="order-row"
                                        data-status="<?= strtolower(str_replace(' ', '-', $order->status)) ?>"
                                        onclick="window.location.href='<?= ROOT ?>/business/viewOrder/<?= $order->id ?>'">
                                        <td class="order-id">#<?= htmlspecialchars($order->id) ?></td>
                                        <td><?= htmlspecialchars($order->dateTime) ?></td>
                                        <td><?= htmlspecialchars($order->Customer) ?></td>
                                        <td><?= htmlspecialchars($order->Products) ?></td>
                                        <td>
                                            <span class="order-status <?= strtolower(str_replace(' ', '-', $order->status)) ?>">
                                                <?= htmlspecialchars($order->status) ?>
                                            </span>
                                        </td>
                                        <td>Rs. <?= htmlspecialchars($order->total) ?> <br />View Full Details</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" >No Orders Found</td>
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

    
    <script>
        

        const rowsPerPage = 10;
        let currentPage = 1;

        const rows = Array.from(document.querySelectorAll('.order-row'));
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        function showPage(page) {
            rows.forEach((row, index) => {
                row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? '' : 'none';
            });
        }

        
        showPage(currentPage);

        
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

        

        function filterOrders() {
            let input = document.getElementById("orderSearch").value.toUpperCase();
            let rows = document.querySelectorAll(".order-row");

            rows.forEach(row => {
                let orderId = row.querySelector(".order-id").textContent.toUpperCase();
                row.style.display = orderId.includes(input) ? "" : "none";
            });
        }

        

        function filterByStatus(status) {
            let rows = document.querySelectorAll(".order-row");

            rows.forEach(row => {
                let rowStatus = row.getAttribute("data-status");
                row.style.display = (status === "all" || rowStatus === status) ? "" : "none";
            });
        }
    </script>

</body>
</html>