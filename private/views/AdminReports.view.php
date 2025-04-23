<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>

    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/adminReports.css">
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                   
                    

                </div>
                <div class="reports-status">
                    <div class="orange-bar">
                        <label>REPORTS</label>
                    </div>
                    <div class="white-bar-report">
                        <div class="report-img">
                            <img src="<?=ASSETS?>/images/saveFood.jpg" />
                        </div>
                        <div class="report-description">
                          <div>
                            <h4>SURPLUS SAVED </h4>
                          </div>    
                          <div class="report-description-text">
                            <p>The food those were saved from going to waste.
                              Contains the details of all the products that were purchased until today!
                            
                            </p>
                            <button class="view-report-btn" onclick="window.location.href=`http://localhost/surplusstays/public/admin/Report1`">View Report</button>
                          </div> 
                          
                          
                        </div>
                        
                    </div>
                    <div class="white-bar-report">
                        <div class="report-img">
                            <img src="<?=ASSETS?>/images/notify_bus.jpg"  />
                        </div>
                        <div class="report-description">
                          <div>
                            <h4>NOTIFIED EXPIRATION </h4>
                          </div>    
                          <div class="report-description-text">
                            <p>The food those were saved after notifying the product owner about the expiration of the product
                              in the next few days!
                            
                            </p>
                            <button class="view-report-btn" onclick="window.location.href=`http://localhost/surplusstays/public/admin/Report2`">View Report</button>
                          </div> 
                          
                          
                        </div>
                        
                    </div>
                    <div class="white-bar-report">
                        <div class="report-img">
                            <img src="<?=ASSETS?>/images/cus_report.jpg"  />
                        </div>
                        <div class="report-description">
                          <div>
                            <h4>DETAILS OF CUSTOMERS </h4>
                          </div>    
                          <div class="report-description-text">
                            <p>The details of all the customers who have been a part of the Surplus Stays community, 
                              which helped to reduce food waste and save surplus.
                            
                            </p>
                            <button class="view-report-btn" onclick="window.location.href=`http://localhost/surplusstays/public/admin/report3`">View Report</button>
                          </div> 
                          
                          
                        </div>
                        
                    </div>
                    <div class="white-bar-report">
                        <div class="report-img">
                            <img src="<?=ASSETS?>/images/rep_business.jpg"  />
                        </div>
                        <div class="report-description">
                          <div>
                            <h4>DETAILS OF BUSINESS </h4>
                          </div>    
                          <div class="report-description-text">
                            <p>The details of all the businesses who have been a part of the Surplus Stays community, 
                              which helped to reduce their food waste by sales and donations of the surplus.
                            
                            </p>
                            <button class="view-report-btn" onclick="window.location.href=`http://localhost:8080/surplusstays/public/admin/report4`">View Report</button>
                          </div> 
                          
                          
                        </div>
                        
                    </div>
                    <div class="white-bar-report">
                        <div class="report-img">
                            <img src="<?=ASSETS?>/images/charity_report.jpg"  />
                        </div>
                        <div class="report-description">
                          <div>
                            <h4>DETAILS OF CHARITY ORGANIZATION </h4>
                          </div>    
                          <div class="report-description-text">
                            <p>The details of all the charity organizations who have been a part of the Surplus Stays community, 
                              which helped to get their necessary donations and to reduce the wastage of surplus.
                            
                            </p>
                            <button class="view-report-btn" onclick="window.location.href=`http://localhost:8080/surplusstays/public/admin/report5`">View Report</button>
                          </div> 
                          
                          
                        </div>
                        
                    </div>


                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
        <script src="<?= ROOT ?>/assets/js/adminReports.js"></script>
      </body>

</html>
