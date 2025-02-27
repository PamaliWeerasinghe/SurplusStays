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
                    <div class="notification">
                        <img src="<?=ASSETS?>/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>
                <div class="stats">
                    <div class="stat-item">                                   
                            <div class="stat-title">Total Requests</div>
                            <div class="stat-value">28</div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">Accepted</div>
                            <div class="stat-value">3</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">Rejected</div>
                            <div class="stat-value">2</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">No response</div>
                            <div class="stat-value">23</div>
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

                <div class="complaints-status">
                    <div class="table-container">
                        <h2>Recieved Donation Requests</h2>
                        <div class="toggle-slider">
                            <button class="toggle-option2 active" data-status="all">All</button>
                            <button class="toggle-option2" data-status="yet-to-decide">Yet To Decide</button>
                            <button class="toggle-option2" data-status="accepted">Accepted</button>
                            <button class="toggle-option2" data-status="rejected">Rejected</button>
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

            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>
    <script src="<?=ASSETS?>/js/charityToggle.js"></script>
    
</body>
</html>