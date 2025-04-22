<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityDashboard.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">

            <div class="top-half">
                <div class="top-bar">
                    <div class="notification">   
                    </div>
                </div>
                <div class="stats">
                    <div class="stat-item">
                        <img src="<?=ASSETS?>/images/profit-growth.png" alt="Events Icon" class="stat-icon">
                        <div>
                            <span class="stat-title">Events</span>
                            <span class="stat-value"><?= isset($EventCount) ? htmlspecialchars($EventCount) : 0 ?></span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <img src="<?=ASSETS?>/images/manifest.png" alt="Donations Icon" class="stat-icon">
                        <div>
                            <span class="stat-title">Accepted Requests</span>
                            <span class="stat-value"><?= isset($AccReqCount) ? htmlspecialchars($AccReqCount) : 0 ?></span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <img src="<?=ASSETS?>/images/box-mark.png" alt="Total Donations Icon" class="stat-icon">
                        <div>
                            <span class="stat-title">Pending Requests</span>
                            <span class="stat-value"><?= isset($AllReqCount) ? htmlspecialchars($AllReqCount) : 0 ?></span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <img src="<?=ASSETS?>/images/rating.png" alt="Rating Icon" class="stat-icon">
                        <div>
                            <span class="stat-title">Rating</span>
                            <span class="stat-value">4.0/5.0</span>
                        </div>
                    </div>
                </div>
            
                <div class="barChart">
                    <div class="barChart-title">
                        <label>Donations Received</label>
                    </div>
                    <div class="barChart-dropdown">
                        <label class="barChart-status-label2">Bar Chart</label>
                        <select id="timeRangeSelect">
                            <option>This Week</option>
                            <option>Last Month</option>
                            <option>This Year</option>
                        </select>
                    </div>

                    <div class="barChart-status-chart">
                        <div class="chart" id="barChartContainer">
                            <!-- JS will populate bars here -->
                        </div>
                        <div class="day-block" id="barLabels">
                            <!-- JS will populate labels here -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="top-contributers-grid">
                <div>
                    <label>Top Contributers</label>
                    <div class="barChart-dropdown">
                    <div></div>
                    <select>
                        <option>All Time</option>
                        <option>Last Month</option>
                        <option>Last Year</option>
                    </select>
                    </div>
                </div>            
                <div class="buisness-summaries">
                    <?php if (!empty($topBusinesses)): ?>
                        <?php foreach (array_chunk($topBusinesses, 2) as $row): ?>
                            <div class="buisness-row">
                                <?php foreach ($row as $business): ?>
                                    <div class="buisness-item">
                                        <div>
                                            <img src="<?= $business['image'] ?>" alt="<?= $business['name'] ?>" />
                                        </div>
                                        <div class="buisness-summaries-item">
                                            <label class="buisness-summaries-label1"><?= htmlspecialchars($business['name']) ?></label>
                                            <label class="buisness-summaries-label2"><?= htmlspecialchars($business['total_donations']) ?> Donations</label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No donation data available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="complaints-status">
                <div>
                    <label>Recent Donation Requests</label>   
                </div>
                <div class="table-container">
    <table class="admin-barChart-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Business</th>
                <th>Title</th>
                <th>Response</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($recentRequests as $req): ?>
                <tr>
                    <td><?= date('d.m.Y', strtotime($req['date'])) ?></td>
                    <td><?= htmlspecialchars($req['business_name'] ?? 'Unknown') ?></td>
                    <td><?= htmlspecialchars($req['title']) ?></td>
                    <td>
                        <?php if($req['status'] === 'accepted'): ?>
                            <button class="completed">Responded</button>
                        <?php else: ?>
                            <button class="take-action">Not Responded</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
                        
            </div>
        </div>
    </div>

    <?php echo $this->view('includes/footer')?>
    <script>
    const weekData = <?= json_encode($weekData) ?>;
    const monthData = <?= json_encode($monthData) ?>;
    const yearData = <?= json_encode($yearData) ?>;
    console.log("Week Data:", weekData);
    </script>


    <script src="<?=ASSETS?>/js/charityDashboard.js"></script>
    
</body>
</html>