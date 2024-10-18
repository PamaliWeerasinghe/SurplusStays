<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityDashboard.css">
</head>
<body>
    <?php echo $this->view('includes/navbar')?>

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
                        <img src="<?=ASSETS?>/images/profit-growth.png" alt="Events Icon" class="stat-icon">
                        <div>
                            <span class="stat-title">Events</span>
                            <span class="stat-value">25</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <img src="<?=ASSETS?>/images/manifest.png" alt="Donations Icon" class="stat-icon">
                        <div>
                            <span class="stat-title">Donations</span>
                            <span class="stat-value">450</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <img src="<?=ASSETS?>/images/box-mark.png" alt="Total Donations Icon" class="stat-icon">
                        <div>
                            <span class="stat-title">Total Donations</span>
                            <span class="stat-value">790</span>
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
                        <select>
                            <option>This Week</option>
                            <option>Last Month</option>
                            <option>This Year</option>
                        </select>
                    </div>

                    <div class="barChart-status-chart">
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
            </div>

            <div class="top-contributers-grid">
                <div>
                    <label>Top Contributers</label>
                    <div class="barChart-dropdown">
                    <div></div>
                    <select>
                        <option>By 1 week</option>
                        <option>By 2 weeks</option>
                        <option>By 1 month</option>
                    </select>
                    </div>
                </div>            
                <div class="buisness-summaries">
                    <div class="buisness-row">
                        <div class="buisness-item">
                            <div>
                                <img src="<?=ASSETS?>/images/keels.png"/>
                            </div>
                            <div class="buisness-summaries-item">
                                <label class="buisness-summaries-label1">Keels</label>
                                <label class="buisness-summaries-label2">52 donations</label>
                            </div>
                        </div>
                        <div class="buisness-item">
                            <div>
                                <img src="<?=ASSETS?>/images/Glomark.png"/>
                            </div>
                            <div class="buisness-summaries-item">
                                <label class="buisness-summaries-label1">Glomark</label>
                                <label class="buisness-summaries-label2">32 donations</label>
                            </div>
                        </div>
                        <div class="buisness-item">
                            <div>
                                <img src="<?=ASSETS?>/images/Laughs.png"/>
                            </div>
                            <div class="buisness-summaries-item">
                                <label class="buisness-summaries-label1">Laughs Super</label>
                                <label class="buisness-summaries-label2">12 Donations</label>
                            </div>
                        </div>
                    </div>
                    <div class="buisness-row">
                        <div class="buisness-item">
                            <div>
                                <img src="<?=ASSETS?>/images/ElephantHouse.png"/>
                            </div>
                            <div class="buisness-summaries-item">
                                <label class="buisness-summaries-label1">Elephant House</label>
                                <label class="buisness-summaries-label2">5 Donations</label>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="next">
                    <img src="<?=ASSETS?>/images/down.png"/>
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
                                <th>Shop</th>
                                <th>buisness</th>
                                <th>Response</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>14.02.2024</td>
                                <td>Mallika Bakers</td>
                                <td>12 Full Bread</td>
                                <td><button class="completed">Responded</button></td>
                            </tr>
                            <tr>
                                <td>20.02.2024</td>
                                <td>Sampath Food City</td>
                                <td>15 Cans Of Tuna</td>
                                <td><button class="take-action">Not Responded</button></td>
                            </tr>
                            <tr>
                                <td>07.02.2024</td>
                                <td>Wasana Bakers</td>
                                <td>15 Fish Buns</td>
                                <td><button class="completed">Responded</button></td>
                            </tr>
                            <tr>
                                <td>27.02.2024</td>
                                <td>Simlo</td>
                                <td>Rice packets</td>
                                <td><button class="take-action">Not Responded</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>                                     
                    <div class="next">
                        <img src="<?=ASSETS?>/images/down.png"/>
                    </div>
            </div>
        </div>
    </div>

    <?php
    echo "<pre>";
    if (isset($rows)) {
        print_r($rows);
    } else {
        echo "No data available";
    }
?>

    <?php echo $this->view('includes/footer')?>
    
</body>
</html>