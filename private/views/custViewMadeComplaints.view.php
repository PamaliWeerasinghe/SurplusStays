<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/CustWishlist.css">
    <link rel="stylesheet" href="<?= STYLES ?>/adminManageActors.css" />
   
</head>

<body>
    <!-- navbar -->
    <div class="main-div">
        <?php echo $this->view('includes/navbar')?>
        <div class="sub-div-1">
            <?php require APPROOT."/views/includes/customerSidePanel.view.php"?>
            <div class="dashboard">
                <div class="summary">
                <div class="" onclick="window.location.href='<?= ROOT ?>/Admin/addNewCustomer'" style="width: 70%;height:7vh;background-color:white;margin-top:8%" >
                        <div>
                            <label>
                                + Add Buyer
                            </label>

                        </div>
                    </div>
               
                    <!-- <div class="top-bar">
                        <div class="search-bar">
                            
                        </div>
                        <div class="notification">
                           
                        </div>
                    </div> -->
                </div>
                

                <div class="box"style="margin-top: -20%;margin-bottom: 10%;">
                    <div class="box-header">
                        COMPLAINTS - <?= $complaint_count ?> <?= $complaint_count == 1 ? 'complaint' : 'Complaints' ?>
                    </div>
                    
                    <div class="wishlist-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Complaint</th>
                                    <th>Description</th>
                                    <th>Complaint Status</th>
                                    <th></th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($complaint_details as $item): ?>
                                <tr id="card-item-<?= $item->complaint_id ?>">
                                    <td>
                                        <div class="product-card">
                                            <div>
                                                <img src="<?=ASSETS?>/complaints/<?= $item->images[0] ?>">
                                            </div>
                                            <div class="product-info">
                                                <p class="category"><?= $item->business_name ?></p>
                                                <h3 class="product-title"><?= $item->product?></h3>
                                                <div class="product-details">
                                                    <p style="color: black;"><strong>Complaint Added:</strong><br/>
                                                    <p style="color:red"><strong><?= $item->complaint_date ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <?= $item->complaintDescription?>
                                    </td>
                                        
                                    <td>
                                        <div class="product-status">
                                            <?php if ($item->complaint_status=='Resolved'): ?>
                                                <span class="in-stock">Resolved</span>
                                            <?php elseif ($item->complaint_status=='Not Attended'): ?>
                                                <span class="out-of-stock">Not Attended</span>
                                            <?php else: ?>
                                                <span class="unknown-status">Status Unknown</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    <td>
                                        <button class="add-to-cart-button"  onclick="window.location.href='<?= ROOT ?>/Customer/viewComplaint/<?=$item->complaint_id?>'">View Complaint</button>
                                    </td>

                                  
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
    </div>

   
</body>
</html>