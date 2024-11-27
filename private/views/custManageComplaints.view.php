<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/custManageComplaints.css">
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/customerSidePanel')?>
        <div class="container-right">
            <div class="top-nav">
                <div class="top-bar">
                    <div class="notification">
                        <img src="<?=ASSETS?>/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>
                <div class="events-header">
                <h2 style="color:black;">Complaint History</h2>
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
                    <option value="dateAdded">Unresolved</option>
                    <option value="dateAdded">Resolved</option>
                    </select>
                </div>
                <button class="create-event-button" onclick="window.location.href='<?=ROOT?>/customer/makeComplaint'">+ Make Complaint</button>
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>
                                    <?php 
                                        // Get the first image from the pictures array
                                        $eventPictures = explode(',', $row->pictures); // Assuming $row->pictures is a comma-separated string
                                        $eventImage = isset($eventPictures[0]) ? $eventPictures[0] : 'event_placeholder.png'; // Use placeholder if no image
                                    ?>
                                    <tr>
                                        <td class="event">
                                            <div class="event-name">
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventImage) ?>" alt="Event" class="event-img">
                                                <a href="<?=ROOT?>/customer/viewComplaint/<?=$row->id?>" style="text-decoration: none; color: black;">
                                                <h3><?= htmlspecialchars($row->id) ?></h3>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="date"><?= htmlspecialchars($row->date) ?></td>
                                        <td>
                                            <?php if ($row->complaint_status_id == 1): ?>
                                                <button class="status ongoing">Resolved</button>
                                            <?php else: ?>
                                                <button class="status closed">Unresolved</button>
                                            <?php endif; ?>
                                        </td>
                                        <td class="action">
                                            <a href="<?=ROOT?>/customer/editComplaint/<?=$row->id?>">
                                            <button class="action-btn edit">Edit</button>
                                            </a>
                                            <form action="<?=ROOT?>/customer/deleteComplaint/<?=$row->id?>" method="post" onsubmit="return confirm('Are you sure you want to delete this event?');">
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