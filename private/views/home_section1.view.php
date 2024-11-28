<?php 
require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<title><?php echo SITENAME ?></title>

<link rel="stylesheet" href="<?= STYLES ?>/home_section1.css">
</head>

<body>
    <?php echo $this->view('includes/navbar_unregistered') ?>
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
    <div class="how-it-works">
        <div class="div1">
            <label style="color: #2D6A4F;font-weight:bolder;font-size:xx-large">HOW IT <label style="color: black;">WORKS</label></label>
        </div>
        <div class="div2">
            <!-- point 01 -->
            <div class="point1">
                <div class="bullet">
                    <div class="bullet-num">
                        <h1>1</h1>
                    </div>
                </div>
                <div class="bullet-details">
                    <h3>REGISTER AND CREATE ACCOUNT</h3>
                    <label>Customers and businesses register on our platform.</label>
                </div>
            
            </div>
            <!-- point 01 -->
            <!-- point 02 -->
            <div class="point1">
                <div class="bullet">
                    <div class="bullet-num">
                        <h1>2</h1>
                    </div>
                </div>
                <div class="bullet-details">
                    <h3>BUSINESSES LIST SURPLUS</h3>
                    <label>Businesses list their surplus food items and available quantities on the platform.</label>
                </div>
            
            </div>
            <!-- point 02 -->
            <!-- point 03 -->
            <div class="point1">
                <div class="bullet">
                    <div class="bullet-num">
                        <h1>3</h1>
                    </div>
                </div>
                <div class="bullet-details">
                    <h3>CUSTOMERS BROWSE AND ORDER</h3>
                    <label>Customers browse available food items and order what they need at discounted prices.</label>
                </div>
            
            </div>
            <!-- point 03 -->
            <!-- point 04 -->
            <div class="point1">
                <div class="bullet">
                    <div class="bullet-num">
                        <h1>4</h1>
                    </div>
                </div>
                <div class="bullet-details">
                    <h3>PICKUP</h3>
                    <label>Customers choose to pick up their order from the business location</label>
                </div>
            
            </div>
            <!-- point 04 -->
        </div>
    </div>
    <div class="goal">
        <label style="color:#4AD66D;font-size:xx-large;font-weight:bold">Reduce <label style="color: black;">Waste</label><label style="color: #D8F3DC;">,</label> Share <label style="color: black;">Surplus</label><label style="color: #D8F3DC;">,</label> Make a <label style="color: black;">Difference</label></label>
    </div>
    <div class="young-crowd">

    </div>
    <?php echo $this->view('RecentItems') ?>
    <?php echo $this->view('includes/footer') ?>
    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>