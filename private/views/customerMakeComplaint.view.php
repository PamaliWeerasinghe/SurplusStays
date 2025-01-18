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
                        <select onchange="loadOrderItems();" id="orderID">
                            <option value="oid">Order ID</option>
                            <?php foreach($orders as $order):?>
                            <option value="<?=$order->id?>"><?=$order->id?></option>
                            <?php endforeach ?>
                        </select>
                        </label>
                        
                    </div>
                    <div class="see-product">
                        <div class="main-img-details">
                        
                            <div class="see-product-details">
                                    <div style="width: 100%;"> 
                                    <h2>Select Item</h2>
                                    <select style="width: 100%;" id="orderItems">
                                        <option>Select Item</option>

                                    </select>
                                    </div>
                                    <div style="width: 100%;">
                                    <h3>Customer Complaint</h3>
                                    <textarea style="width: 100%; height: 20vh;"></textarea>
                                    </div>
                                    <div>
                                       
                                    </div>
                                    
                                   
                                   
                                    
                            </div>
                        </div>
                        <div class="sub-img">
                       
                        <img src="<?=ASSETS?>/icons/uploadArea.png" />
                        <img src="<?=ASSETS?>/icons/uploadArea.png" />
                        <img src="<?=ASSETS?>/icons/uploadArea.png" />
                        <img src="<?=ASSETS?>/icons/uploadArea.png" />
                        <img src="<?=ASSETS?>/icons/uploadArea.png" />
                        <!-- <img src="<?=ASSETS?><?=$complaint_imgs[2]->path?>" id="complaintImg<?=$complaint_imgs[2]->id?>"/> -->
                        </div>
                      
                        
                        <div class="business-response-area-btn">
                            <button class="complain-btn1" onclick="">Complain</button>
                            
                        </div>
                           
                    </div>

                   

  

                    
                  



                </div>


            </div>
        </div>

     
         
        <?php echo $this->view('includes/footer')?>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
        <script src="<?=ROOT?>/assets/js/adminManageCustomers.js"></script>