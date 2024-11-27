<?php 
require APPROOT . '/views/includes/htmlHeader.view.php' ?>
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
    <!-- View Recent Items -->
    <!-- <?php echo $this->view('home') ?> -->
    <div class="surrounding">
        <div class="surrounding1">
            <h3 class="surround-label1">BENEFITS OF USING <h3 class="surround-label2"> &nbsp; SURPLUS STAYS</h3></h3>
        </div>
        <div class="surrounding2">
            <label>Reduce Food Waste</label>
            <label>|</label>
            <label>Save Money</label>
            <label>|</label>
            <label>Support Local Businesses</label>
            <label>|</label>
            <label>Variety And Quality</label>
            <label>|</label>
            <label>Convenient And Easy To Use</label>
        </div>
    </div>

    <!-- FAQS -->
    <div class="goal-faq">
        <div class="faq">
        <h2>FAQS</h2>
        </div>
        <div class="faq-ques">
        <div class="faq1">
            <label>HOW DO I REGISTER ON SURPLUSSTAYS ?</label>
            <img src="<?= ASSETS ?>/images/dropdown.png"/>
        </div>
        <div class="faq-ans1">
            <span>
            Registering on SurplusStays is simple and takes only a 
            few steps! Click on the "Sign Up" button located at the top right corner
             of the homepage. Choose whether you want to register as a customer or 
             a business. Fill in your details, such as your name, email address, 
             and password, and follow the on-screen instructions to complete your 
             registration. If you're signing up as a business, you'll be asked for 
             additional details like your business name and location. Once you've 
             registered, you'll be able to browse surplus food deals or list 
            your own surplus food items to reduce waste and save money.
            </span>
        </div>
        <div class="faq2">
            <label>IS THERE A REGISTRATION FEE ?</label>
            <img src="<?= ASSETS ?>/images/dropdown.png"/>
        </div>
        <div class="faq-ans2">
            <span> 
            No, there is no registration fee to join SurplusStays! 
            Signing up as a customer or a business is completely free. 
            Our platform is dedicated to making surplus food accessible to 
            everyone while helping businesses reduce waste, 
            so you can start using SurplusStays without any upfront costs.
            </span>
        </div>
        <div class="faq3">
            <label>HOW CAN MY BUSINESS LIST SURPLUS ITEMS ?</label>
            <img src="<?= ASSETS ?>/images/dropdown.png"/>
        </div>
        <div class="faq-ans3">
        Listing surplus items on SurplusStays is quick and easy! 
        After registering as a business, log in to your account and 
        navigate to the "Dashboard." Click on the "Add Item" button, 
        where you can provide details such as the name of the item, 
        quantity, discounted price, and a brief description. You can also 
        upload photos to make your listing more appealing. Once submitted, 
        your surplus items will be visible to customers browsing the platform. 
        This helps your business reduce food waste and attract new customers 
        while contributing to sustainability efforts.
        </div>
        </div>
       
        
    </div>

    <!-- Involve with surplusstays -->
     <div class="involve">
     <label style="color: #2D6A4F;font-weight:bolder;font-size:xx-large">GET INVOLVED WITH <label style="color: black;"> SURPLUSSTAYS</label></label>
     <div class="involve-btns">
        <button class="involve-btn1">Register Now</button>
        <button class="involve-btn2">Donate</button>
     </div>
    </div>
    
    <?php echo $this->view('includes/footer') ?>
    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>