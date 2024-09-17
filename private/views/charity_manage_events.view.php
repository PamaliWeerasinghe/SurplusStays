<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityManageEvents.css">
</head>
<body>
    <?php echo $this->view('includes/navbar')?>

    <div class="container">
        <?php echo $this->view('includes/charity_sidepanel')?>
        <div class="container-right">
            <div class="top-nav">
                <div class="top-bar">
                    <div class="notification">
                        <img src="<?=ASSETS?>/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>
                <div class="events-header">
                <h2>Events</h2>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search Events...">
                    <button class="search-button">
                    <i class="search-icon"></i>
                    </button>
                </div>
                <div class="filter-container">
                    <p>Filter By: </p>
                    <select id="filter" class="filter-select">
                    <option value="dateAdded">Date Added</option>
                    <option value="dateAdded">Ongoing</option>
                    <option value="dateAdded">Drafts</option>
                    <option value="dateAdded">Closed</option>
                    </select>
                </div>
                <button class="create-event-button">+ Create Event</button>
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/manudam mehewara 2.png" alt="Event" class="event-img">
                                            <span>Manudam Mehewara</span>
                                        </div>
                                    </td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (10.00AM)</td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (08.00PM)</td>
                                    <td><button class="status ongoing">Ongoing</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Edit</button>
                                        <button class="action-btn delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/popcorn.png" alt="Event" class="event-img">
                                            <span>Harvest Hope</span>
                                        </div>
                                    </td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (10.00AM)</td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (08.00PM)</td>
                                    <td><button class="status draft">Draft</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Edit</button>
                                        <button class="action-btn delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/popcorn.png" alt="Event" class="event-img">
                                            <span>Harvest Hope</span>
                                        </div>
                                    </td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (10.00AM)</td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (08.00PM)</td>
                                    <td><button class="status draft">Draft</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Edit</button>
                                        <button class="action-btn delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/popcorn.png" alt="Event" class="event-img">
                                            <span>Harvest Hope</span>
                                        </div>
                                    </td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (10.00AM)</td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (08.00PM)</td>
                                    <td><button class="status closed">Closed</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Edit</button>
                                        <button class="action-btn delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/popcorn.png" alt="Event" class="event-img">
                                            <span>Harvest Hope</span>
                                        </div>
                                    </td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (10.00AM)</td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (08.00PM)</td>
                                    <td><button class="status closed">Closed</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Edit</button>
                                        <button class="action-btn delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/popcorn.png" alt="Event" class="event-img">
                                            <span>Harvest Hope</span>
                                        </div>
                                    </td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (10.00AM)</td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (08.00PM)</td>
                                    <td><button class="status draft">Draft</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Edit</button>
                                        <button class="action-btn delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="event">
                                        <div class="event-name">
                                            <img src="<?=ASSETS?>/images/popcorn.png" alt="Event" class="event-img">
                                            <span>Harvest Hope</span>
                                        </div>
                                    </td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (10.00AM)</td>
                                    <td class="date">Fri, Aug 14, 2024 <br> (08.00PM)</td>
                                    <td><button class="status ongoing">Ongoing</button></td>
                                    <td class="action">
                                        <button class="action-btn edit">Edit</button>
                                        <button class="action-btn delete">Delete</button>
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
    
</body>
</html>