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
                                + Add Charity Organization
                                </label>
                                
                            </div>
                    </div>
                    

                </div>
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <label>Charity Organizations</label>
                        <div>
                        <select>
                            <option>Organization</option>
                        </select>
                        <select>
                            <option>Location</option>
                        </select>
                        <select>
                            <option>Donors</option>
                        </select>
                        <select>
                            <option>Donations Received</option>
                        </select>
                        </div>
                        
                    </div>
                    <div class="business-row">
                            <div class="business-wrap">
                            <div class="business">
                            <img src="<?=ASSETS?>/images/ingoude.png" />
                            </div>
                            <div class="business-details">
                                <label style="font-weight: bold;font-size:larger">INGOUDE Foundation</label>
                                <div>
                                <label>Ratings : </label>
                                <img src="<?=ASSETS?>/images/star-rating.png" />
                                
                                </div>
                                
                            </div>
                            <div class="business-summary">
                                <label>Donors Engaged : 48</label>
                                <label>No. of Complaints : 20</label>
                            </div>
                            <div class="business-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            
                            </div>
                            <div class="business-joined">
                                <label>Joined On : 22 / 06 / 2023</label>
                            </div>
                           
                            
                    </div>
                    <div class="business-row">
                            <div class="business-wrap">
                            <div class="business">
                            <img src="<?=ASSETS?>/images/ginyard.png" />
                            </div>
                            <div class="business-details">
                                <label style="font-weight: bold;font-size:larger">Ginyard International</label>
                                <div>
                                <label>Ratings : </label>
                                <img src="<?=ASSETS?>/images/star-rating.png" />
                               
                                </div>
                                
                            </div>
                            <div class="business-summary">
                            <label>Donors Engaged : 48</label>
                            <label>No. of Complaints : 20</label>
                            </div>
                            <div class="business-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            
                            </div>
                            <div class="business-joined">
                                <label>Joined On : 22 / 06 / 2023</label>
                            </div>
                           
                            
                    </div>
                    <div class="business-row">
                            <div class="business-wrap">
                            <div class="business">
                            <img src="<?=ASSETS?>/images/warnerandspencer.png" />
                            </div>
                            <div class="business-details">
                                <label style="font-weight: bold;font-size:larger">Warner & Spencer</label>
                                <div>
                                <label>Ratings : </label>
                                <img src="<?=ASSETS?>/images/star-rating.png" />
                                
                                </div>
                                
                            </div>
                            <div class="business-summary">
                            <label>Donors Engaged : 48</label>
                            <label>No. of Complaints : 20</label>
                            </div>
                            <div class="business-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            
                            </div>
                            <div class="business-joined">
                                <label>Joined On : 22 / 06 / 2023</label>
                            </div>
                           
                            
                    </div>
                    <div class="business-row">
                            <div class="business-wrap">
                            <div class="business">
                            <img src="<?=ASSETS?>/images/rimberio.png" />
                            </div>
                            <div class="business-details">
                                <label style="font-weight: bold;font-size:larger">RIMBERIO Foundation</label>
                                <div>
                                <label>Ratings : </label>
                                <img src="<?=ASSETS?>/images/star-rating.png" />
                                
                                </div>
                                
                            </div>
                            <div class="business-summary">
                            <label>Donors Engaged : 48</label>
                            <label>No. of Complaints : 20</label>
                            </div>
                            <div class="business-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            
                            </div>
                            <div class="business-joined">
                                <label>Joined On : 22 / 06 / 2023</label>
                            </div>
                           
                            
                    </div>
                    <div class="business-row">
                            <div class="business-wrap">
                            <div class="business">
                            <img src="<?=ASSETS?>/images/peeloek.png" />
                            </div>
                            <div class="business-details">
                                <label style="font-weight: bold;font-size:larger">PEELOEK</label>
                                <div>
                                <label>Ratings : </label>
                                <img src="<?=ASSETS?>/images/star-rating.png" />
                               
                                </div>
                                
                            </div>
                            <div class="business-summary">
                            <label>Donors Engaged : 48</label>
                            <label>No. of Complaints : 20</label>
                            </div>
                            <div class="business-buttons">
                                <button>View</button>
                                <button>Remove</button>
                            </div>
                            
                            </div>
                            <div class="business-joined">
                                <label>Joined On : 22 / 06 / 2023</label>
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