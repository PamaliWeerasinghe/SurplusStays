<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businesscomplaints.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                    <!-- Complaint Status Cards -->
                    <div class="order-status-cards">
                        <div class="order-card all" onclick="filterByStatus('all')">
                            <h3>All</h3>
                        </div>
                        <div class="order-card pending" onclick="filterByStatus('Pending')">
                            <h3>Pending</h3>

                        </div>
                        <div class="order-card resolved" onclick="filterByStatus('Resolved')">
                            <h3>Resolved</h3>

                        </div>
                    </div>

                </div>


                <div class="order-status">
                    <div class="order">
                        <label>Complaints</label>
                        <div class="searchdiv">
                            <input type="text" id="orderSearch" class="search" placeholder="Search by Complaint ID..." onkeyup="filterOrders()" />
                        </div>
                    </div>

                    <!-- Complaints Table -->
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>ComplaintID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            <?php if (!empty($complaints)) : ?>
                                <?php foreach ($complaints as $complaint) : ?>
                                    <tr class="order-row"
                                        data-status="<?= strtolower($complaint->status) ?>"
                                        onclick="window.location.href='<?= ROOT ?>/business/viewComplaint/<?= $complaint->id ?>'">
                                        <td class="order-id">#<?= htmlspecialchars($complaint->id) ?></td>
                                        <td><?= htmlspecialchars($complaint->dateTime) ?></td>
                                        <td><?= htmlspecialchars($complaint->Customer) ?></td>
                                        <td>
                                            <span class="order-status <?= strtolower($complaint->status) ?>">
                                                <?= htmlspecialchars($complaint->status) ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;"><label>View Full Details</label></td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" style="text-align: center;">No Complaints Found</td>
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
                            let complaintId = row.querySelector(".order-id").textContent.toUpperCase();
                            row.style.display = complaintId.includes(input) ? "" : "none";
                        });
                    }

                    function filterByStatus(status) {
                        let rows = document.querySelectorAll(".order-row");
                        let formattedStatus = status.toLowerCase(); // Convert selected status to lowercase

                        rows.forEach(row => {
                            let rowStatus = row.getAttribute("data-status").toLowerCase(); // Get row status in lowercase
                            row.style.display = (formattedStatus === "all" || rowStatus === formattedStatus) ? "" : "none";
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