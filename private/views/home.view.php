<?php 
require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<title><?php echo SITENAME ?></title>

<link rel="stylesheet" href="<?= STYLES ?>/home.css">
</head>

<body>
    <?php
        if(!Auth::logged_in())
        {
            echo $this->view('includes/navbar_unregistered'); 
        }
        else{
            echo $this->view('includes/charityNavbar');
        }
    ?>
    
    <div class="landing-section">
        <div class="aboutUs">
            <div class="us">
            <span class="def">
            <span style="color: white;">Surplus</span>
            Stays
            <span style="color: white;">
            : <br/>
            Addressing Food <br/>Surplus
            </span>
            </span>
            <h5 style="color: white;font-weight:normal">
            SurplusStays Connects Businesses With Excess 
            Food To <br/>Customers And Donation Organizations.
            </h5>
            <button class="learnMore">
                Learn More
            </button>
            </div>
        </div>
        <div class="right">

        </div>
        
    </div>
    <div class="availability">
        <div>
            <img src="<?= ASSETS ?>/images/24-hours (1) 1.png"/>
            <label style="color: #40916C;">&nbsp;Availble 24 Hours</label>
        </div>
        <div>
            <img src="<?= ASSETS ?>/images/coupon 1.png"/>
            <label style="color: #40916C;"> &nbsp;Upto 75% Discount</label>
        </div>
        <div>
            <img src="<?= ASSETS ?>/images/eco-friendly 1.png"/>
            <label style="color: #40916C;">&nbsp;Environmental Friendly</label>
        </div>
        <div>
            <img src="<?= ASSETS ?>/images/tap 1.png"/>
            <label style="color: #40916C;">&nbsp;Click and Collect</label>
        </div>
    </div>

    <div class="godie-bag">
    <h1 class="title2">WHY USE</h1>
    <h1 class="title">SURPLUS STAYS</h1>
    <div class="bag-content">
        <!-- Left Points -->
        <div class="points left">
        <div class="point" id="point1">
            <img src="<?= ASSETS ?>/icons/tag.png" alt="Icon" />
            <p>ENJOY GOOD FOOD AT ½ PRICE OR LESS</p>
        </div>
        <div class="point" id="point2">
            <img src="<?= ASSETS ?>/icons/web.png" alt="Icon" />
            <p>HELP THE ENVIRONMENT BY REDUCING FOOD WASTE</p>
        </div>
        </div>

        <!-- Main Bag Image -->
        <div class="bag-image">
        <img src="<?= ASSETS ?>/images/bag.png" alt="Main Bag Image" />
        </div>

        <!-- Right Points -->
        <div class="points right">
        <div class="point" id="point3">
            <img src="<?= ASSETS ?>/icons/healthy-food.png" alt="Icon" />
            <p>RESCUE FOOD NEAR YOU</p>
        </div>
        <div class="point" id="point4">
            <img src="<?= ASSETS ?>/icons/store.png" alt="Icon" />
            <p>TRY SOMETHING NEW FROM LOCAL CAFES, BAKERIES OR RESTAURANTS</p>
        </div>
        </div>
    </div>
    </div>
    <div class="slider-container">
    <div class="slider-track">
        <span>SANDWICHES</span>
        <span>SMOOTHIES</span>
        <span>MUFFINS</span>
        <span>BURGERS</span>
        <span>SUSHI</span>
        <span>POKE</span>
        <span>BURRITO</span>
        <span>DONUTS</span>
        <span>SALADS</span>
        <span>PIZZA</span>
        <span>PASTRIES</span>
        
    </div>
    </div>


    <div class="how-it-works">
            <div class="div-left">
                <div class="points">
                    <div class="point1">
                        <div class="bullet-details">
                            <label style="color: #FFFB9B;font-weight:bolder;font-size:xx-large">HOW IT <span style="color: black;">WORKS</span></label>
                            <h3>REGISTER AND CREATE ACCOUNT</h3>
                            <label style="color: #DEE3E3;">Customers and businesses register on our platform.</label>
                        </div>
                    </div>
                    <div class="point1">
                        <div class="bullet-details">
                            <label style="color: #FFFB9B;font-weight:bolder;font-size:xx-large">HOW IT <span style="color: black;">WORKS</span></label>
                            <h3>BUSINESSES LIST SURPLUS</h3>
                            <label style="color: #DEE3E3;">Businesses list their surplus food items and available quantities on the platform.</label>
                        </div>
                    </div>
                    <div class="point1">
                        <div class="bullet-details">
                            <label style="color: #FFFB9B;font-weight:bolder;font-size:xx-large">HOW IT <span style="color: black;">WORKS</span></label>
                            <h3>CUSTOMERS BROWSE AND ORDER</h3>
                            <label style="color: #DEE3E3;">Customers browse available food items and order what they need at discounted prices.</label>
                        </div>
                    </div>
                    <div class="point1">
                        <div class="bullet-details">
                            <label style="color: #FFFB9B;font-weight:bolder;font-size:xx-large">HOW IT <span style="color: black;">WORKS</span></label>
                            <h3>PICKUP</h3>
                            <label style="color: #DEE3E3;">Customers choose to pick up their order from the business location.</label>
                        </div>
                    </div>
                </div>
                <div class="navigation">
                    <button class="prev-btn">&lt;</button>
                    <div class="indicators">
                        <span class="indicator"></span>
                        <span class="indicator"></span>
                        <span class="indicator"></span>
                        <span class="indicator"></span>
                    </div>
                    <button class="next-btn">&gt;</button>
                </div>
            </div>
            <div class="div-right">
            <img src="<?= ASSETS ?>/images/howItWorks1.png"/>
            <img src="<?= ASSETS ?>/images/howItWorks2.png"/>
            <img src="<?= ASSETS ?>/images/howItWorks3.png"/>
            <img src="<?= ASSETS ?>/images/howItWorks4.png"/>
            </div>
        
    </div>

    <div class="goal">
        <label style="color:#4AD66D;font-size:xx-large;font-weight:bold">Reduce <label style="color: black;">Waste</label>
        <label style="color: #D8F3DC;">,</label> Share <label style="color: black;">Surplus</label>
        <label style="color: #D8F3DC;">,</label> Make a <label style="color: black;">Difference</label></label>
    </div>
    <div class="young-crowd">

    </div>
    <?php echo $this->view('RecentItems') ?>
    <?php echo $this->view('includes/footer') ?>
    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>

    <script>
    let currentStep = 0; // Start at step 1
    const steps = document.querySelectorAll('.point1');
    const indicators = document.querySelectorAll('.indicator');
    const images = document.querySelectorAll('.div-right img'); // Select all images

    function updateSteps() {
        steps.forEach((step, index) => {
            // Apply the "active" class to the current step and remove it from others
            step.classList.toggle('active', index === currentStep);
        });

        // Update the indicators
        indicators.forEach((dot, index) => {
            dot.style.backgroundColor = index === currentStep ? '#67D695' : '#DCE2E2';
        });

        // Update the images
        images.forEach((img, index) => {
            img.style.display = index === currentStep ? 'block' : 'none';
        });
    }

    function nextStep() {
        if (currentStep < steps.length - 1) {
            currentStep++;
            updateSteps();
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            updateSteps();
        }
    }

    // Initialize the steps and images
    updateSteps();

    document.querySelector('.next-btn').addEventListener('click', nextStep);
    document.querySelector('.prev-btn').addEventListener('click', prevStep);

    document.addEventListener("scroll", () => {
        const points = document.querySelectorAll(".point, .title, .title2");
        points.forEach((point) => {
            const rect = point.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                point.style.opacity = "1";
                point.style.transform = "translateY(0)";
            }
        });
    });
    
    const sliderTrack = document.querySelector('.slider-track');

    // Duplicate content for seamless sliding
    sliderTrack.innerHTML += sliderTrack.innerHTML;

    // Adjust animation duration based on content width
    const trackWidth = sliderTrack.offsetWidth;
    sliderTrack.style.animationDuration = `${trackWidth / 100}px`; // Adjust speed


</script>
