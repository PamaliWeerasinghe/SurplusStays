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
                        <div class="order-card accepted" onclick="filterByStatus('Accepted')">
                            <h3>Accepted</h3>

                        </div>
                        <div class="order-card rejected" onclick="filterByStatus('Rejected')">
                            <h3>Rejected</h3>

                        </div>
                    </div>
                </div>

                <div class="main-box">
                    <div class="header">
                        <label>Requests</label>
                        <div>
                            <input class="search" type="text" id="requestSearch" placeholder="Search by Request ID..." onkeyup="filterrequests()" />
                        </div>
                    </div>

                    <!-- Request Table -->
                    <table class="main-table">
                        <thead>
                            <tr>
                                <th>RequestID</th>
                                <th>Date</th>
                                <th>Organization Name</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($requests)) : ?>
                                <?php foreach ($requests as $request) : ?>
                                    <tr class="request-row"
                                        data-status="<?= htmlspecialchars($request->status) ?>"
                                        onclick="window.location.href='<?= ROOT ?>/business/viewRequest/<?= $request->id ?>'">
                                        <td class="request-id">#<?= htmlspecialchars($request->id) ?></td>
                                        <td><?= htmlspecialchars($request->date) ?></td>
                                        <td><?= htmlspecialchars($request->organization) ?></td>
                                        <td><?= mb_strimwidth(htmlspecialchars($request->title), 0, 15, '...') ?></td>
                                        <td>
                                            <span class="order-status <?= strtolower($request->status) ?>">
                                                <?= htmlspecialchars($request->status) ?>
                                            </span>
                                        </td>
                                        <td>View Full Details</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No Requests Found</td>
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

        const rows = Array.from(document.querySelectorAll('.request-row'));
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

        /* search Requests by ID */

        function filterrequests() {
            let input = document.getElementById("requestSearch").value.toUpperCase();
            let rows = document.querySelectorAll(".request-row");

            rows.forEach(row => {
                let requestId = row.querySelector(".request-id").textContent.toUpperCase();
                row.style.display = requestId.includes(input) ? "" : "none";
            });
        }

        /* filter status by status */

        function filterByStatus(status) {
            let rows = document.querySelectorAll(".request-row");

            rows.forEach(row => {
                let rowStatus = row.getAttribute("data-status");
                row.style.display = (status === "all" || rowStatus === status) ? "" : "none";
            });
        }
    </script>
</body>

</html>