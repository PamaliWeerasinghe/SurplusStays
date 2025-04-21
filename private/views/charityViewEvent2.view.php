<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta noame="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityViewEvent2.css">
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
                    
                    <div class="section">
                        <?php if (($row)): ?>
                            <div class="charity-title">
                                    <h1><?=$row[0]->event?></h1>
                            </div>
                            
                            <div class="slidersection">
                                <div class="slider">
                                    <div class="slide">
                                        <input type="radio" name="radio-btn" id="radio1">
                                        <?php if(!empty($eventPictures[1])):?>
                                            <input type="radio" name="radio-btn" id="radio2">
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[2])):?>
                                            <input type="radio" name="radio-btn" id="radio3">
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[3])):?>
                                            <input type="radio" name="radio-btn" id="radio4">
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[4])):?>
                                            <input type="radio" name="radio-btn" id="radio5">
                                        <?php endif;?>

                                        <div class="st first">
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[0]) ?>" alt="">
                                        </div>
                                        <?php if(!empty($eventPictures[1])):?>
                                        <div class="st">
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[1]) ?>" alt="">
                                        </div>
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[2])):?>
                                        <div class="st">
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[2]) ?>" alt="">
                                        </div>
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[3])):?>
                                        <div class="st">
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[3]) ?>" alt="">
                                        </div>
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[4])):?>
                                        <div class="st">
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[4]) ?>" alt="">
                                        </div>
                                        <?php endif;?>

                                        <div class="nav-auto">
                                            <div class="a-b1"></div>
                                            <?php if(!empty($eventPictures[1])):?>
                                            <div class="a-b2"></div>
                                            <?php endif;?>

                                            <?php if(!empty($eventPictures[2])):?>
                                            <div class="a-b3"></div>
                                            <?php endif;?>

                                            <?php if(!empty($eventPictures[3])):?>
                                            <div class="a-b4"></div>
                                            <?php endif;?>

                                            <?php if(!empty($eventPictures[4])):?>
                                            <div class="a-b5"></div>
                                            <?php endif;?>
                                            
                                        </div>
                                    </div>
                                    <div class="nav-m">
                                        <label for="radio1" class="m-btn"></label>
                                        <?php if(!empty($eventPictures[1])):?>
                                        <label for="radio2" class="m-btn"></label>
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[2])):?>
                                        <label for="radio3" class="m-btn"></label>
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[3])):?>
                                        <label for="radio4" class="m-btn"></label>
                                        <?php endif;?>

                                        <?php if(!empty($eventPictures[4])):?>
                                        <label for="radio5" class="m-btn"></label>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>

                            <div class="charity-text">
                                <p><strong>Event Goal :</strong> <?=$row[0]->goal?></p>
                                <p><strong>District :</strong> <?=$row[0]->district?></p>
                                <p><strong>Required Food :</strong> <?=$row[0]->requesting_items?></p>
                            </div>
                            
                            <div class="charity-text">
                                <p><strong>Starting date and time :</strong><?=$row[0]->start_dateTime?></p>
                                <p><strong>Ending date and time :</strong> <?=$row[0]->end_dateTime?></p>
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
    </div>
    <?php echo $this->view('includes/footer')?>
    
    <script type="text/javascript">
    <?php $imgcount = count($eventPictures); ?>
    var imgcount = <?php echo $imgcount; ?>; // Pass PHP variable to JavaScript
    var counter = 1;
    setInterval(function(){
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if(counter > imgcount){
            counter = 1;
        }
    }, 3000);
</script>

    
</body>
</html>