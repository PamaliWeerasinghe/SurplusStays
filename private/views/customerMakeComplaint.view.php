<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
<?php require APPROOT . '/views/adminReplyToCustomer.view.php' ?>
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
                  
                    

                </div>
                <div class="seecomplain-status">
                    <div class="seecomplain-bar">
                        <label></label>
                        <label>Ord. No :
                        <select>
                            <option>Order ID</option>
                            <option><?=$orderCount?></option>
                        </select>
                        </label>
                        
                    </div>
                    <div class="see-product">
                        <div class="main-img-details">
                        <div class="see-product-img">
                                <!-- <img src="<?=ASSETS?><?=$complaint_imgs[0]->path?>" id="lgComplainImg"/> -->
                            </div>
                            <div class="see-product-details">
                                    <div>
                                    <h2>Bread</h2>
                                    </div>
                                    <div>
                                    <h3>Customer Feedback</h3>
                                    </div>
                                    <div>
                                        <p>
                                        description
                                        </p>
                                    </div>
                                    <div class="see-product-location">
                                        <div>
                                        <label>
                                            Shop :
                                        </label>
                                        </div>
                                            
                                        <div class="see-product-location-details">
                                        <!-- <img src="<?=ASSETS?>/images/location.png"/> -->
                                        
                                        <label>Kaduwela</label>
                                        </div>
                                       
                                    </div>
                                    <div>
                                        <label>Amount Paid : Rs. </label>
                                    </div>
                                    <div>
                                        <label>Quantity :</label>
                                    </div>
                                    <div>
                                        <label>Payment Method :</label>
                                    </div>
                                   
                                    
                            </div>
                        </div>
                        <div class="sub-img">
                       
                        <!-- <img src="<?=ASSETS?><?=$complaint_imgs[1]->path?>" id="complaintImg<?=$complaint_imgs[1]->id?>"/> -->
                        <!-- <img src="<?=ASSETS?><?=$complaint_imgs[2]->path?>" id="complaintImg<?=$complaint_imgs[2]->id?>"/> -->
                        </div>
                        <div class="sub-details" >
                            <label>Mentioned expiration date and time : </label>
                        </div>
                        <div class="sub-details" >
                            <label>Discounted price : Rs </label>
                        </div>
                        <div class="sub-customer-details" >
                            <label>Customer  Details : </label>
                            <span>Contact Number - </span>
                            <span>Email Address - </span>
                        </div>
                        <div class="business-response-area">
                            <div>
                                <h3>Feedback from the Business regarding the complain</h3>
                            </div>
                            <div>
                                        <p>
                                        
                                        </p>
                                    </div>
                        </div>
                        <div class="business-response-area-btn">
                            <button class="complain-btn1" onclick="">Refund Money</button>
                            <button class="complain-btn2" onclick="">Reply To Customer</button>
                        </div>
                           
                    </div>

                   

  

                    
                  



                </div>


            </div>
        </div>

        <!-- image popup modal -->
        <div id="popup-modal" class="popup">
            <span class="close">&times;</span>
            <img class="popup-content" id="popup-image">
            
        </div>
        <!-- image popup modal -->
         
        <?php echo $this->view('includes/footer')?>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
        <script src="<?=ROOT?>/assets/js/adminManageCustomers.js"></script>