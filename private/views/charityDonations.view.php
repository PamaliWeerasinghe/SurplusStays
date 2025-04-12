<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityDonations.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-half">
            <div class="top-bar">
                </div>
                <div class="stats">
                    <div class="stat-item">                                   
                            <div class="stat-title">Total Requests</div>
                            <div class="stat-value"><?= isset($AllReqCount) ? htmlspecialchars($AllReqCount) : 0 ?></div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">Accepted</div>
                            <div class="stat-value"><?= isset($AccReqCount) ? htmlspecialchars($AccReqCount) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">Rejected</div>
                            <div class="stat-value"><?= isset($RejReqCount) ? htmlspecialchars($RejReqCount) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">No response</div>
                            <div class="stat-value"><?= isset($PenReqCount) ? htmlspecialchars($PenReqCount) : 0 ?></div>
                        </div>
                    </div>
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <h2>Sent Donation Requests</h2>
                        <div class="toggle-slider">
                            <button class="toggle-option1 active" data-status="all">All</button>
                            <button class="toggle-option1" data-status="yet-to-decide">Pending</button>
                            <button class="toggle-option1" data-status="accepted">Accepted</button>
                            <button class="toggle-option1" data-status="rejected">Rejected</button>
                        </div>
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Shop</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows): ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td class="date"><?= htmlspecialchars($row->date) ?></td>
                                            <td>
                                                <?php foreach ($shopRows as $shopRow): ?>
                                                    <?php if ($shopRow->id == $row->business_id): ?>
                                                        <?= htmlspecialchars($shopRow->name) ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row->title) ?></td>
                                            <?php if(htmlspecialchars($row->status)==2): ?>
                                                <td><button class="status ongoing">Accepted</button></td>
                                            <?php elseif(htmlspecialchars($row->status)==0): ?>
                                                <td><button class="status draft">Pending</button></td>
                                            <?php elseif(htmlspecialchars($row->status)==1): ?>
                                                <td><button class="status closed">Rejected</button></td>
                                            <?php endif; ?>    
                                            <td class="action">
                                                <button class="action-btn edit">View More</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr><td colspan="5"><h4>You currently have 0 donation requests.</h4></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="stats">
                    <div class="stat-item_r">                                   
                            <div class="stat-title">Total Requests</div>
                            <div class="stat-value"><?= isset($AllReqCount_r) ? htmlspecialchars($AllReqCount_r) : 0 ?></div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">Accepted</div>
                            <div class="stat-value"><?= isset($AccReqCount_r) ? htmlspecialchars($AccReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">Rejected</div>
                            <div class="stat-value"><?= isset($RejReqCount_r) ? htmlspecialchars($RejReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">No response</div>
                            <div class="stat-value"><?= isset($PenReqCount_r) ? htmlspecialchars($PenReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                </div>

                <div class="complaints-status">
                    <div class="table-container">
                        <h2>Recieved Donation Requests</h2>
                        <div class="toggle-slider">
                            <button class="toggle-option2 active" data-status="all">All</button>
                            <button class="toggle-option2" data-status="yet-to-decide">Yet To Decide</button>
                            <button class="toggle-option2" data-status="accepted">Accepted</button>
                            <button class="toggle-option2" data-status="rejected">Rejected</button>
                        </div>
                        <table class="admin-order-table2">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Shop</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows_r): ?>
                                    <?php foreach ($rows_r as $row): ?>
                                        <tr>
                                            <td class="date"><?= htmlspecialchars($row->date) ?></td>
                                            <td>
                                                <?php foreach ($shopRows as $shopRow): ?>
                                                    <?php if ($shopRow->id == $row->business_id): ?>
                                                        <?= htmlspecialchars($shopRow->name) ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row->title) ?></td>
                                            <?php if(htmlspecialchars($row->status)=='accepted'): ?>
                                                <td><button class="status ongoing">Accepted</button></td>
                                            <?php elseif(htmlspecialchars($row->status)=='pending'): ?>
                                                <td> 
                                                    <div class="take-action-container">
                                                        <form id="editStatusForm<?= $row->id ?>" action="<?=ROOT?>/charity/acceptDonationReq/<?=$row->id?>" method="POST">
                                                            <button type="button" class="take-action_r" data-form-id="editStatusForm<?= $row->id ?>">Accept</button>
                                                        </form>
                                                        <button class="take-action">Reject</button>
                                                    </div>
                                                </td>
                                            <?php elseif(htmlspecialchars($row->status)=='rejected'): ?>
                                                <td><button class="status closed">Rejected</button></td>
                                            <?php endif; ?>    
                                            <td class="action">
                                                <button class="action-btn edit">View More</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr><td colspan="5"><h4>You currently have 0 donation requests.</h4></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>

    <!-- Modal for Delete Confirmation -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirm Request</h3>
            <p>Are you sure you want to accept this donation request?</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="modal-button confirm">Accept</button>
                <button id="cancelDelete" class="modal-button cancel">Cancel</button>
            </div>
        </div>
    </div>

<script>

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".take-action_r").forEach(button => {
        button.addEventListener("click", function () {
            let formId = this.getAttribute("data-form-id");
            document.getElementById(formId).submit();
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.toggle-option1');
    const rows = document.querySelectorAll('.admin-order-table tbody tr');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const statusFilter = button.getAttribute('data-status');

            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(4) button');
                if (!statusCell) return;

                const statusText = statusCell.textContent.trim().toLowerCase();

                if (statusFilter === 'all') {
                    row.style.display = '';
                } else if (
                    (statusFilter === 'yet-to-decide' && statusText === 'pending') ||
                    (statusFilter === 'accepted' && statusText === 'accepted') ||
                    (statusFilter === 'rejected' && statusText === 'rejected')
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.toggle-option2');
    const rows = document.querySelectorAll('.admin-order-table2 tbody tr');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const statusFilter = button.getAttribute('data-status');

            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(4)');
                const hasActionDiv = statusCell.querySelector('.take-action-container');
                const buttonText = statusCell.querySelector('button')?.textContent.trim().toLowerCase();

                if (statusFilter === 'all') {
                    row.style.display = '';
                } else if (
                    (statusFilter === 'yet-to-decide' && hasActionDiv) ||
                    (statusFilter === 'accepted' && buttonText === 'accepted') ||
                    (statusFilter === 'rejected' && buttonText === 'rejected')
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});

</script>

<script src="<?=ASSETS?>/js/charityToggle.js"></script>
    
</body>
</html>