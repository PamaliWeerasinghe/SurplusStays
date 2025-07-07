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

                <div class="main-box">
                    <div class="header">
                        <label>Complaints</label>
                        <div>
                            <input class="search" type="text" id="complaintSearch" placeholder="Search by Request ID..." onkeyup="filtercomplaints()" />
                        </div>
                    </div>

                    <!-- Complaint Table -->
                    <table class="main-table">
                        <thead>
                            <tr>
                                <th>ComplaintID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($complaints)) : ?>
                                <?php foreach ($complaints as $complaint) : ?>
                                    <tr class="complaint-row"
                                        data-status="<?= htmlspecialchars($complaint->status) ?>"
                                        onclick="window.location.href='<?= ROOT ?>/business/viewComplaint/<?= $complaint->id ?>'">
                                        <td class="complaint-id">#<?= htmlspecialchars($complaint->id) ?></td>
                                        <td><?= htmlspecialchars($complaint->dateTime) ?></td>
                                        <td><?= htmlspecialchars($complaint->Customer) ?></td>
                                        <td>
                                            <span class="order-status <?= strtolower($complaint->status) ?>">
                                                <?= htmlspecialchars($complaint->status) ?>
                                            </span>
                                        </td>
                                        <td><label>View Full Details</label></td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" style="text-align: center;">No Complaints Found</td>
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

    <!-- JavaScript to Handle Filtering -->
    <script>
        /* pagination */

        const rowsPerPage = 10;
        let currentPage = 1;

        const rows = Array.from(document.querySelectorAll('.complaint-row'));
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

        /* search complaints by ID */

        function filtercomplaints() {
            let input = document.getElementById("complaintSearch").value.toUpperCase();
            let rows = document.querySelectorAll(".complaint-row");

            rows.forEach(row => {
                let requestId = row.querySelector(".complaint-id").textContent.toUpperCase();
                row.style.display = requestId.includes(input) ? "" : "none";
            });
        }

        /* filter status by status */

        function filterByStatus(status) {
            let rows = document.querySelectorAll(".complaint-row");

            rows.forEach(row => {
                let rowStatus = row.getAttribute("data-status");
                row.style.display = (status === "all" || rowStatus === status) ? "" : "none";
            });
        }
    </script>
</body>

</html>