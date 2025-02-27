<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta noame="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityViewOrganization.css">
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
                <div class="charity-info-card">  
                    <div class="section">
                        <div class="container2">
                            <div class="header">
                                <div class="card-image">
                                    <img src="<?=ASSETS?>/charityImages/<?=$row[0]->picture?> ?>" alt="Project Image">
                                </div>
                                <div class="title">
                                    <h1><?=$row[0]->name?> <span><img src="<?=ASSETS?>/icons/heart-icon.png"></span> <a href="#" class="add-favorites">Add to Favorites</a></h1>        
                                        <div class="tags">
                                            <span>Special population support</span>
                                            <span>Mental health care</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="donate-section">
                                    <div class="donate-btns">
                                    <button class="donate-btn">Donate 🛒</button>
                                    <button class="donate-btn">Browse Events 🔍</button>
                                    </div>
                                    <p><a href="#">Donate</a> easily and safely using the Charity Navigator Giving Basket.</p>
                                </div>

                                <div class="details">
                                    <p>✔ Profile managed by <?=$row[0]->name?> | <a href="#">Is this your nonprofit?</a></p>
                                    <p>✔ 501(c)(3) organization</p>
                                    <p>✔ Donations are tax-deductible</p>
                                </div>

                                <div class="contact">
                                    <a href="https://www.woundedwarriorproject.org/" target="_blank">https://www.woundedwarriorproject.org/</a>
                                    <p> <?=$row[0]->city?></p>
                                    <p>📞 <a href="tel:<?=$row[0]->phoneNo?>"><?=$row[0]->phoneNo?></a></p>
                                </div>

                                <div class="mission">
                                    <p><strong>Organization Description</strong></p>
                                    <p><?=$row[0]->charity_description?></p>
                                </div>

                                <div class="rating">
                                    <div class="score">98%</div>
                                    <div class="stars">⭐⭐⭐⭐</div>
                                    <p class="four-star">Four-Star Charity</p>
                                    <div class="metrics">
                                        <p><strong>Impact & Measurement</strong></p>
                                        <div class="bar gray"></div>
                                        <p>Accountability & Finance</p>
                                        <div class="bar blue"></div>
                                        <p>Culture & Community</p>
                                        <div class="bar blue"></div>
                                        <p>Leadership & Adaptability</p>
                                        <div class="bar blue"></div>
                                    </div>
                                </div>  

                                <section class="featured-initiatives">
                                    <p><strong>Events</strong></p>
                                    <div class="slider-container">
                                        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                                        <div class="slider">
                                            <?php if ($eventRows): ?>
                                                <?php foreach ($eventRows as $row1): ?>
                                                    <?php 
                                                        // Get the first image from the pictures array
                                                        $eventPictures = explode(',', $row1->pictures); // Assuming $row->pictures is a comma-separated string
                                                        $eventImage = isset($eventPictures[0]) ? $eventPictures[0] : 'event_placeholder.png'; // Use placeholder if no image
                                                    ?>
                                                    <div class="slide" onclick="window.location.href='<?= ROOT ?>/charity/viewEvent/<?= $row1->id ?>'">
                                                        <img src="<?=ROOT?><?= htmlspecialchars($eventImage) ?>" alt="Suwasariya appeal" class="slide-img">
                                                        <h3><?= htmlspecialchars($row1->event) ?></h3>
                                                        <p><span class="location">📍 <?= htmlspecialchars($row1->location) ?></span></p>
                                                        <p><span class="category">Healthcare</span></p>
                                                        <p>Raised: <strong>LKR 1,487,193.75</strong></p>
                                                        <p>Goal: <strong>LKR 10,000,000</strong></p>
                                                        <button class="donate-btn">Donate Now</button>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr><td colspan="5"><h4>No events found</h4></td></tr>
                                            <?php endif; ?>
                                        </div>
                                        <button class="next" onclick="moveSlide(1)">&#10095;</button>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>
    <script>
        let currentIndex = 0;

function moveSlide(direction) {
    const slider = document.querySelector(".slider");
    const slides = document.querySelectorAll(".slide");
    const totalSlides = slides.length;
    const slideWidth = slides[0].offsetWidth + 20;

    currentIndex += direction;

    if (currentIndex < 0) {
        currentIndex = totalSlides - 1;
    } else if (currentIndex >= totalSlides) {
        currentIndex = 0;
    }

    slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

    </script>
</body>
</html>