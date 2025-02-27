<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessrequests.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                    <!-- Request Status Cards -->
                    <div class="order-status-cards">
                        <div class="order-card all" onclick="filterByStatus('all')">
                            <h3>All</h3>
                        </div>
                        <div class="order-card pending" onclick="filterByStatus('Pending')">
                            <h3>Pending</h3>

                        </div>
                        <div class="order-card donated" onclick="filterByStatus('Donated')">
                            <h3>Donated</h3>

                        </div>
                        <div class="order-card cancelled" onclick="filterByStatus('Cancelled')">
                            <h3>Cancelled</h3>

                        </div>
                    </div>
                </div>


                <div class="order-status">
                    <div class="order">
                        <label>Requests</label>
                        <div class="searchdiv">
                            <input type="text" id="orderSearch" class="search" placeholder="Search by Request ID..." onkeyup="filterOrders()" />
                        </div>
                    </div>

                    <!-- Requsts Table -->
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>RequestID</th>
                                <th>Date</th>
                                <th>Organization Name</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            <?php if (!empty($requests)) : ?>
                                <?php foreach ($requests as $request) : ?>
                                    <tr class="order-row"
                                        data-status="<?= strtolower(str_replace(' ', '-', $request->status)) ?>"
                                        onclick="window.location.href='<?= ROOT ?>/business/viewRequest/<?= $request->id ?>'">
                                        <td class="order-id">#<?= htmlspecialchars($request->id) ?></td>
                                        <td><?= htmlspecialchars($request->dateTime) ?></td>
                                        <td><?= htmlspecialchars($request->organization) ?></td>
                                        <td><?= htmlspecialchars($request->reason) ?></td>
                                        <td>
                                            <span class="order-status <?= strtolower(str_replace(' ', '-', $request->status)) ?>">
                                                <?= htmlspecialchars($request->status) ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><label>View Full Details</label></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" style="text-align: center;">No Requests Found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- JavaScript to Handle Filtering -->
                <script>
                    function filterOrders() {
                        let input = document.getElementById("orderSearch").value.toUpperCase();
                        let rows = document.querySelectorAll(".order-row");

                        rows.forEach(row => {
                            let requestId = row.querySelector(".order-id").textContent.toUpperCase();
                            row.style.display = requestId.includes(input) ? "" : "none";
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
                </table>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>
    
</body>

</html>