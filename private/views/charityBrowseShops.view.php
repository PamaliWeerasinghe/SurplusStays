<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityBrowseShops.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-nav">
                <div class="top-bar">
                    <div class="notification">
                        <img src="<?=ASSETS?>/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>
                <div class="events-header">
                <h2>Shops</h2>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search Shops...">
                    <button class="search-button">
                    <i class="search-icon"></i>
                    </button>
                </div>
                <div class="filter-container">
                    <p>Filter By: </p>
                    <select id="filter" class="filter-select">
                    <option value="dateAdded">Shop Type</option>
                    <option value="dateAdded">Bakeries</option>
                    <option value="dateAdded">Supermarkets</option>
                    <option value="dateAdded">Resturants</option>
                    </select>
                </div>
                <button class="create-event-button">Locate Nearby Shops</button>
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th class="shopName">Shop Name</th>
                                    <th>City</th>
                                    <th>Ratings</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/keels.png" alt="Event" class="event-img">
                                            <h3>Keels Super</h3>
                                        </div>
                                    </td>
                                    <td class="city"> <img src="<?=ASSETS?>/icons/location.png" alt="Event" class="location-icon"> <br> Kalutara</td>
                                    <td class="city"> <img src="<?=ASSETS?>/icons/star-rating 3.png" alt="Event" class="location-icon"> <br>3.0</td>
                                    <td class="date"><span class="status open">Open Today</span><br>10.00AM-22.00PM</td>
                                    <td><button class="action-btn-edit">Send Request</button></td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/keels.png" alt="Event" class="event-img">
                                            <h3>Keels Super</h3>
                                        </div>
                                    </td>
                                    <td class="city"> <img src="<?=ASSETS?>/icons/location.png" alt="Event" class="location-icon"> <br> Kalutara</td>
                                    <td class="city"> <img src="<?=ASSETS?>/icons/star-rating 3.png" alt="Event" class="location-icon"> <br>3.0</td>
                                    <td class="date"><span class="status open">Open Today</span><br>10.00AM-22.00PM</td>
                                    <td><button class="action-btn-edit">Send Request</button></td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/keels.png" alt="Event" class="event-img">
                                            <h3>Keels Super</h3>
                                        </div>
                                    </td>
                                    <td class="city"> <img src="<?=ASSETS?>/icons/location.png" alt="Event" class="location-icon"> <br> Kalutara</td>
                                    <td class="city"> <img src="<?=ASSETS?>/icons/star-rating 3.png" alt="Event" class="location-icon"> <br>3.0</td>
                                    <td class="date"><span class="status open">Open Today</span><br>10.00AM-22.00PM</td>
                                    <td><button class="action-btn-edit">Send Request</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>
    
</body>
</html>