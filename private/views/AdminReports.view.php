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
                    <div class="white-bar">
                        <label>SURPLUS SAVED FROM WASTAGE</label>
                    </div>
                    <table class="order-table">
    <thead>
      <tr>
        <th>Product Name</th>
       
        <th>Quantity Saved</th>
        <th>Unit Price</th>
        <th>Discounted Price</th>
        <th>Left Overs</th>
      </tr>
    </thead>
    <tbody id="pdf-content">
      <!-- <?=print_r($products)?> -->
      <?php foreach($products as $product):?>
       <tr>
        <td><?=$product->product_name?></td>   
        <td><?=$product->qty_saved?></td>
        <td>Rs. <?=$product->original_price?></td>
        <td>Rs. <?=$product->discounted_price?></td>
        <td><?=$product->left_overs?></td>
      </tr>
      
      <?php endforeach;?>
     
    
    </tbody>
    
  </table>
  <?= $products_pager->display();?>
  <div class="get-report-btn">
    <button onclick="generatePDF()">Get Report</button>
  </div>
  <div class="reports-next">
                        <img src="<?=ASSETS?>/images/down.png"/>
                    </div>
    <!-- Report 02 -->
                    <div class="white-bar">
                        <label>MOST POPULAR SURPLUS ITEMS</label>
                    </div>
                    <table class="order-table">
    <thead>
      <tr>
        <th>Product</th>
        <th>Product Name</th>
        <th>Company</th>
        <th>Location</th>
        <th>Surplus Saved</th>
        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
        <img src="<?=ASSETS?>/images/chips.png" />
        </td>
        <td>Uswatte Crispy Chips</td>
        <td>
        <img src="<?=ASSETS?>/images/keells.png"  />
        </td>
        <td>Rajagiriya</td>
        <td>10</td>
    
      </tr>
      <tr>
        <td>
        <img src="<?=ASSETS?>/images/popcorn.png" />
        </td>
        <td>Pop Corn</td>
        <td>
        <img src="<?=ASSETS?>/images/laughs.png"  />
        </td>
        <td>Rajagiriya</td>
        <td>10</td>
    
      </tr>
      <tr>
        <td>
        <img src="<?=ASSETS?>/images/pasta.png" />
        </td>
        <td>Cheese Pasta (Dinner)</td>
        <td>
        <img src="<?=ASSETS?>/images/keells.png"  />
        </td>
        <td>Malabe</td>
        <td>10</td>
    
      </tr>
      
      
    </tbody>
  </table>
  <div class="get-report-btn">
    <button>Get Report</button>
  </div>
  <div class="reports-next">
                        <img src="<?=ASSETS?>/images/down.png"/>
                    </div>

                    <!-- Report 03 -->
                    <div class="white-bar">
                        <label>MOST INCLUDED CHARITY ORGANIZATIONS TO REDUCE WASTAGE</label>
                    </div>
                    <!-- <table class="order-table">
    <thead>
      <tr>
        <th>Organization</th>
        <th>Donations Requested</th>
        <th>Donations Received</th>
        <th>No. of Complaints</th>
        
        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
        <img src="<?=ASSETS?>/images/ginyard.png" />
        </td>
        <td>25</td>
        <td>
        30
        </td>
        <td>0</td>
    
    
      </tr>
      <tr>
        <td>
        <img src="<?=ASSETS?>/images/warnerandspencer.png" />
        </td>
        <td>25</td>
        <td>
        30
        </td>
        <td>5</td>
    
    
      </tr>
      
      
      
    </tbody>
  </table> -->
  
  <div class="get-report-btn">
    <button>Get Report</button>
  </div>
  <div class="reports-next">
                        <img src="<?=ASSETS?>/images/down.png"/>
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
</body>

</html>
