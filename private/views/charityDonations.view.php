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
                        <h2>Donation Requests</h2>
                        <div class="toggle-slider">
                            <button class="toggle-option active" data-status="all">All</button>
                            <button class="toggle-option" data-status="yet-to-decide">Yet To Decide</button>
                            <button class="toggle-option" data-status="accepted">Accepted</button>
                            <button class="toggle-option" data-status="rejected">Rejected</button>
                        </div>
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Donation ID</th>
                                    <th>Date</th>
                                    <th>Shop</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <span>#154</span>
                                        </div>
                                    </td>
                                    <td class="date">Fri, Aug 14, 2024</td>
                                    <td>Perera And Sons</td>
                                    <td>Full Bread</td>
                                    <td><button class="status ongoing">Accepted</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Send Message</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <span>#156</span>
                                        </div>
                                    </td>
                                    <td class="date">Mon, Aug 17, 2024</td>
                                    <td>Keels Kalutara</td>
                                    <td>Bakery Items</td>
                                    <td><button class="status ongoing">Accepted</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Send Message</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <span>#158</span>
                                        </div>
                                    </td>
                                    <td class="date">Sat, Sep 12, 2024</td>
                                    <td>Jayashantha</td>
                                    <td>Rice Packets</td>
                                    <td><button class="status draft">Pending</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Send Message</button>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <span>#160</span>
                                        </div>
                                    </td>
                                    <td class="date">Sun, Dec 12, 2024</td>
                                    <td>Simlo</td>
                                    <td>Rice Packets</td>
                                    <td><button class="status closed">Rejected</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Send Message</button>
                                    </td>
                                </tr>
                                
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