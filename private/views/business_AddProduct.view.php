<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/businessAddProduct.css">
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
                    

                </div>
                <div class="reports-status">
                    <div class="orange-bar">
                        <label>Add New Product</label>
                    </div>
                    <div class="add-product-name">
                        <label> Product Name :</label>
                        <input class="inp1"/>
                    </div>
                    <div class="add-product-name">
                        <label>Category :</label>
                         <select class="inp1">
                                <option>Select</option>
                         </select>
                    </div>
                    <div class="add-product-name">
                        <label> Description :</label>
                        <textarea class="inp1"></textarea>
                    </div>
                    <div class="add-product-name">
                        <label>Quantity Available :</label>
                         <select class="inp1">
                                <option>0</option>
                         </select>
                    </div>
                    <div class="add-product-name">
                        <label> Price Per Unit :</label>
                        <input class="inp1" type="text" placeholder="Enter The Price Per Unit"/>
                    </div>
                    <div class="add-product-name">
                        <label> Price Per Unit :</label>
                        <input class="inp1" type="date"/>
                    </div>
                    <div class="add-product-name">
                        <label>Upload Images : <label style="color: grey;">You Can Add Up To 3 Images</label></label>
                        <div class="imgs-div">
                                <div class="add-product-img-div"><img src="<?= ASSETS ?>/images/upload.png"/></div>
                                <div class="add-product-img-div"><img src="<?= ASSETS ?>/images/upload.png"/></div>
                                <div class="add-product-img-div"><img src="<?= ASSETS ?>/images/upload.png"/></div>
                        </div>
                    </div>
                    <div class="add-product-name">
                        <label> Add Discount Price : <label style="color: grey;">(Optional)</label></label>
                        <div class="discount-box">
                            <input type="text" class="inp2" placeholder="by percentage eg: 50%"/>
                            <label>or</label>
                            <input type="text" class="inp2" placeholder="by percentage eg: 50%"/>
                        </div>
                        
                    </div>
                    <div class="submit-product">
                        <button class="add-product-btn">Add Product</button>
                        <button class="clear-btn">Clear All</button>
                        <button class="cancel-btn">Cancel</button>
                    </div>
                    <div class="back-to-products">
                    <label><img src="<?= ASSETS ?>/icons/right-arrow 1.png"/> Back To Products List</label>
                    </div>
                   
                  
  
  

                    
                    

                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
</body>

</html>