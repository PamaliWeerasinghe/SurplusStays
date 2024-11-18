<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityViewEvent.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>
    <?php 
        // Get the images from the pictures array
        $eventPictures = explode(',', $row[0]->pictures);
    ?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-half">
                <div class="top-bar">
                    <div class="notification">
                        <img src="<?=ASSETS?>/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>
                <div class="charity-info-card">
                    <div class="header">
                        <h2>Event Information</h2>
                    </div>
                    
                    <div class="section charity-details">
                    <?php if (($row)): ?>
                        <div class="charity-overview">
                            <div class="image-container">
                            <img class="logo-img" src="<?=ROOT?><?= htmlspecialchars($eventPictures[0]) ?>" alt="Charity Logo">
                            </div>
                            <div class="charity-text">
                                <h1><?=$row[0]->event?></h1>
                                <p><strong>Event Goal :</strong> <?=$row[0]->goal?></p>
                                <p><strong>District :</strong> <?=$row[0]->district?></p>
                                <p><strong>Required Food :</strong> <?=$row[0]->requesting_items?></p>
                            </div>
                        </div>
                        <div class="images-container">
                        <?php if(!empty($eventPictures[1])):?>
                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[1]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                        <?php else:?>
                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                        <?php endif;?>
                        <?php if(!empty($eventPictures[2])):?>
                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[2]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                        <?php else:?>
                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                        <?php endif;?>
                        <?php if(!empty($eventPictures[3])):?>
                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[3]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                        <?php else:?>
                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                        <?php endif;?>
                        <?php if(!empty($eventPictures[4])):?>
                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[4]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                        <?php else:?>
                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                        <?php endif;?>
                        </div>
                        <div class="bottom">
                            <p><strong>starting date and time :</strong><?=$row[0]->start_dateTime?></p>
                            <p><strong>starting date and time :</strong> <?=$row[0]->end_dateTime?></p>
                            <p><strong>Description:</strong></p>
                            <p>
                            <?=$row[0]->event_description?>
                            </p>
                                <button onclick="window.location.href='<?=ROOT?>/charity/editEvent/<?=$row[0]->id?>'">Edit Event</button>        
                        </div>
                    <?php else: ?>
                        <h3>That event was not found</h3>   
                    <?php endif; ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>
    
</body>
</html>