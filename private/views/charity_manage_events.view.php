<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityManageEvents.css">
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
                <button class="create-event-button" onclick="window.location.href='<?=ROOT?>/charity/createEvent'">+ Create Event</button>
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
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td class="event">
                                            <div class="event-name">
                                                <img src="<?=ASSETS?>/images/event_placeholder.png" alt="Event" class="event-img">
                                                <h3><?= htmlspecialchars($row->event) ?></h3>
                                            </div>
                                        </td>
                                        <td class="date"><?= htmlspecialchars($row->start_dateTime) ?></td>
                                        <td class="date"><?= htmlspecialchars($row->end_dateTime) ?></td>
                                        <td>
                                            <?php if ($row->status == 1): ?>
                                                <button class="status ongoing">Ongoing</button>
                                            <?php elseif ($row->status == 2): ?>
                                                <button class="status draft">Draft</button>
                                            <?php else: ?>
                                                <button class="status closed">Closed</button>
                                            <?php endif; ?>
                                        </td>
                                        <td class="action">
                                            <button class="action-btn edit">Edit</button>
                                            <form action="<?=ROOT?>/charity/deleteEvent/<?=$row->id?>" method="post" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                <button type="submit" class="action-btn delete">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5"><h4>No events found</h4></td></tr>
                            <?php endif; ?>
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