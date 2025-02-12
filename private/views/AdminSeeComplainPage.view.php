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
                    <div class="seecomplain-bar" style="background-color:  #e05b4a;">
                        <label><?=$complaint_details->fname?>&nbsp;<?=$complaint_details->lname?></label>
                        <label>Ord. No : 00<?=$complaint_details->order_id?></label>
                        
                    </div>
                    <div class="see-product">
                        <div class="main-img-details">
                        <div class="see-product-img">
                                <img src="<?=COMPLAINTS?><?=$complaint_imgs[0]->path?>" id="lgComplainImg"/>
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
                                        <?=$complaint_details->complaintDescription?>
                                        </p>
                                    </div>
                                    <div class="see-product-location">
                                        <div>
                                        <label>
                                            Shop : <?=$complaint_details->business_name?>
                                        </label>
                                        </div>
                                            
                                        <div class="see-product-location-details">
                                        <img src="<?=ASSETS?>/images/location.png"/>
                                        
                                        <label>Kaduwela</label>
                                        </div>
                                       
                                    </div>
                                    <div>
                                        <label>Amount Paid : Rs. <?=$complaint_details->total?></label>
                                    </div>
                                    <div>
                                        <label>Quantity : <?=$complaint_details->itemQty?></label>
                                    </div>
                                    <div>
                                        <label>Payment Method :<?=$complaint_details->paymentMethod?></label>
                                    </div>
                                   
                                    
                            </div>
                        </div>
                        <div class="sub-img">
                        <?php foreach ($complaint_imgs as $complaint_img): ?>
                            <img src="<?=COMPLAINTS?><?=$complaint_img->path?>" id="complaintImg<?=$complaint_img->id?>"/>
                        <?php endforeach ?>
                        </div>
                        <div class="sub-details" >
                            <label>Mentioned expiration date and time : <?=$complaint_details->complaint_date?></label>
                        </div>
                        <div class="sub-details" >
                            <label>Discounted price : Rs <?=$complaint_details->discountPrice?></label>
                        </div>
                        <div class="sub-customer-details" >
                            <label>Customer  Details : </label>
                            <span>Contact Number - <?=$complaint_details->customer_phone?></span>
                            <span>Email Address - <?=$complaint_details->customer_email?></span>
                        </div>
                        <div class="business-response-area">
                            <div>
                                <h3>Feedback from the Business regarding the complain</h3>
                            </div>
                            <div>
                                        <p>
                                        <?=$complaint_details->feedback?>
                                        </p>
                                    </div>
                        </div>
                        <div class="business-response-area-btn">
                            <button class="complain-btn1" onclick="refundMoney(<?=$complaint_details->complaint_id?>);">Refund Money</button>
                            <button class="complain-btn2" onclick="replyToCustomer(<?=$complaint_details->complaint_id?>);">Reply To Customer</button>
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