<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
<?php require APPROOT . '/views/adminReplyToCustomer.view.php' ?>
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
    <link rel="stylesheet" href="<?=STYLES?>/adminSeeComplains.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerMakeComplain.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="complain-error-div">
                        <?php if(!empty($errors)) :?>
                            <div class="error alert">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        </div>
                   
                </div>
                <div class="seecomplain-status" >
                    <form method="post" enctype="multipart/form-data">
                    <div class="seecomplain-bar">
                        <label></label>
                        <label>Ord. No :
                        <select onchange="loadOrderItems();" id="orderID" name='orderid'>
                            <option value="oid" >Order ID</option>
                                <?php foreach($orders as $order):?>
                                    <option value="<?=$order->id?>"><?=$order->id?></option>
                                <?php endforeach ?>
                        </select>
                        </label>
                        
                    </div>
                    <div class="see-product">
                        <div class="main-img-details">
                        
                            <div class="see-product-details">
                                    <h2>Shop Name : </h2><label id="shopName"></label>
                                    <input type="hidden" id="shopID" name="shopID"/>
                                    <div style="width: 100%;"> 
                                    <h2>Select Item</h2>
                                    <select style="width: 100%;" id="orderItems" name="orderitem">
                                        <option value="selectItem">Select Item</option>

                                    </select>
                                    </div>
                                    <div style="width: 100%;">
                                    <h3>Customer Complaint</h3>
                                    <textarea style="width: 100%; height: 20vh;" name="complaint" id="complaint" value='<?=get_var('complaint')?>'></textarea>
                                    </div>
                                    <div>
                                    </div>       
                            </div>
                            
                            
                        </div>
                        <div class="sub-img">
                       
                        <div class="img-container">
                
                   
                    <input type="file" id="complaintImg1" name="complaintImg1" value='<?=get_file('complaintImg1')?>'/>
                    <input type="file" id="complaintImg1" name="complaintImg2" value='<?=get_file('complaintImg2')?>'/>
                    <input type="file" id="complaintImg1" name="complaintImg3" value='<?=get_file('complaintImg3')?>'/>
                    <input type="file" id="complaintImg1" name="complaintImg4" value='<?=get_file('complaintImg4')?>'/>
                    <input type="file" id="complaintImg1" name="complaintImg5" value='<?=get_file('complaintImg5')?>'/>
                
                        </div>
               
                        <!-- <img src="<?=ASSETS?><?=$complaint_imgs[2]->path?>" id="complaintImg<?=$complaint_imgs[2]->id?>"/> -->
                        </div>
                        <div class="business-response-area-btn">
                            <button class="complain-btn1" type="submit">Complain</button>
                            
                        </div>
                        </form>
                           
                    </div>
                </div>
            </div>
        </div> 
        <?php echo $this->view('includes/footer')?>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
        <script src="<?=ROOT?>/assets/js/adminManageCustomers.js"></script>