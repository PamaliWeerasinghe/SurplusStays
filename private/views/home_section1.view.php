<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<title><?php echo SITENAME ?></title>

<link rel="stylesheet" href="<?= STYLES ?>/home_section1.css">
</head>

<body>
    <?php echo $this->view('includes/navbar') ?>
    <div class="search-section">
        <div class="searchdiv">
            <input type="text" class="search" placeholder="Search..." />
            <img src="<?= ASSETS ?>/images/search.png" class="bell2" />
            <button class="reg-btn">
            Register
        </button>
        </div>
        
    </div>
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

    <?php echo $this->view('includes/footer') ?>
    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>