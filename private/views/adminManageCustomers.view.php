<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/adminManageActors.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2">
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?=ASSETS?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?=ASSETS?>/images/Bell.png" class="bell" />
                    </div>
                    <div class="add-buyer">
                            <div>
                                <label>
                                + Add Buyer
                                </label>
                                
                            </div>
                    </div>
                    

                </div>
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <label>Buyers</label>
                        <div>
                        <select>
                            <option>Business</option>
                        </select>
                        <select>
                            <option>Location</option>
                        </select>
                        <select>
                            <option>Total Amount</option>
                        </select>
                        </div>
                        
                    </div>
                    <div class="buyer-row">
                        <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/woman-user (1).png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Kithmini Herath</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                            <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/man-user.png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Sakith</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                            <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/woman-user (2).png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Sanduni Perera</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                        </div>
                        <div class="buyer-row">
                        <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/woman-user (1).png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Kithmini Herath</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                            <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/man-user.png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Sakith</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                            <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/woman-user (2).png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Sanduni Perera</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                        </div>
                    
                        <div class="buyer-row">
                        <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/woman-user (1).png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Kithmini Herath</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                            <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/man-user.png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Sakith</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                            <div class="row1">
                            <div>
                            <div class="customer-img">
                            <img src="<?=ASSETS?>/images/woman-user (2).png"/>
                            </div>
                            <div class="customer-details">
                                
                                <label>Sanduni Perera</label>
                                
                                
                                <div class="customer-location">
                                <img src="<?=ASSETS?>/images/location.png"/>
                                <label>Kaduwela</label>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="customer-joined">
                                <label>Joined On : 26 / 05 / 2022</label>
                            </div>
                            <div class="customer-purchased">
                                <label>Purchased Total : Rs.48000</label>
                            </div>
                            <div class="customer-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            </div>
                        </div>

                        <div class="arrow-div">
                        <div class="arrows">
                            <img src="<?=ASSETS?>/images/Arrow right-circle.png"/>
                            <img src="<?=ASSETS?>/images/Arrow right-circle-bold.png"/>
                            
                        </div>
                    </div>

                    </div>
                    
                    
                    
                    

                </div>


            </div>
            <?php echo $this->view('includes/footer')?>
    </div>
        
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>