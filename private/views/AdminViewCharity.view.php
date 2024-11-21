<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
    <link rel="stylesheet" href="<?=STYLES?>/adminSeeComplains.css">
    
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <!-- <div class="notifications-type2">
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?=ASSETS?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?=ASSETS?>/images/Bell.png" class="bell" />
                    </div>
                     -->

                </div>
                <div class="seecomplain-status">
                    <div class="seecomplain-bar">
                        <label>INGOUDE FOUNDATION</label>
                        <label>Org. ID :</label>
                    
                    </div>
                    <div class="see-product">
                        <div class="main-img-details">
                        <div class="see-product-img">
                                <img src="<?=ASSETS?>/images/bread-lg.png"/>
                            </div>
                            <div class="see-product-details">
                                    <div>
                                    <h2>INGOUDE FOUNDATION</h2>
                                    </div>
                                    <div>
                                    <h3>Details </h3>
                                    </div>
                                    <!-- <div>
                                        <p>
                                        The loaf of bread which was purchased today ,
                                        It was not in a good condition and smelled bad too. 
                                        Photos are attached here with as proof. please be kind enough to 
                                        get actions to reduce these scenarios in the future
                                        </p>
                                    </div> -->
                                    <div class="see-product-location">
                                        <div>
                                        <label>
                                            Email : john@gmail.com
                                        </label>
                                        </div>
                                            
                                        <div class="see-product-location-details">
                                        <img src="<?=ASSETS?>/images/location.png"/>
                                        
                                        <label>Colombo</label>
                                        </div>
                                       
                                    </div>
                                    <div>
                                        <label>Phone : 0772282335</label>
                                    </div>
                                    <div>
                                        <label>Username : ingoudefoundation@gmail.com</label>
                                    </div>
                                    <div>
                                        <label>Date Joined : 2024.09.20  10:00 AM</label>
                                    </div>
                                  
                                    
                            </div>
                        </div>
                        <!-- <div class="sub-img">
                        <img src="<?=ASSETS?>/images/bread.png"/>
                        <img src="<?=ASSETS?>/images/bread.png"/>
                        </div> -->
                        <!-- <div class="sub-details" >
                            <label>Date Joined : 2024.09.20  10:00 AM</label>
                        </div> -->
                        <!-- <div class="sub-details" >
                            <label>Discounted price : Rs 12.50</label>
                        </div> -->
                        <!-- <div class="sub-customer-details" >
                            <label>Customer  Details : </label>
                            <span>Contact Number - 0773616815 </span>
                            <span>Email Address - samashi12@gmail.com</span>
                        </div> -->
                        <div class="business-response-area">
                            <div>
                                <h3>Organization Description</h3>
                            </div>
                            <div>
                                        <p>
                                        The loaf of bread which was purchased today ,
                                        It was not in a good condition and smelled bad too. 
                                        Photos are attached here with as proof. please be kind enough to 
                                        get actions to reduce these scenarios in the future
                                        </p>
                                    </div>
                        </div>
                        <div class="business-response-area-btn">
                            <button class="complain-btn1">Edit Details</button>
                            <!-- <button class="complain-btn2">Reply To Customer</button> -->
                        </div>
                           
                    </div>

                   

  

                    
                  

                    
                   

                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>