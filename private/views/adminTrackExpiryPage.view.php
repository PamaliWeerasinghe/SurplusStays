<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
<?php require APPROOT.'/views/AdminTrackExpiryViewItemPopup.view.php'?>
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/adminTrackExpiry.css" />
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
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
                            <input type="text" class="search" placeholder="Search..." id="searchInput" />
                            <img src="<?=ASSETS?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?=ASSETS?>/images/Bell.png" class="bell" />
                    </div>
                    <div class="summary-blocks">
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Additional Surplus Saved</label>
                            </div>
                            <div class="summaries-2">
                                <label>Rs. 4000</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Expired Surplus Items</label>
                            </div>
                            <div class="summaries-2">
                                <label>589</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Transactions</label>
                            </div>
                            <div class="summaries-2">
                                <label>223</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Revenue</label>
                            </div>
                            <div class="summaries-2">
                                <label>Rs. 52000</label>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="order-status">
                    <div class="order">
                        <label>Order Status</label>
                        <select>
                            <option>All Time</option>
                        </select>
                    </div>

                    <div class="order-nav">
                        <div class="view-slots">
                            <div class="slot1">
                                <label>All</label>
                            </div>
                            <div class="slot2">
                                <label>Within a Month</label>
                            </div>
                            <div class="slot2">
                                <label>Within a Week</label>

                            </div>
                            <div class="slot2">
                                <label>Took Actions</label>
                            </div>
                            <div class="slot2">
                                <label>Wastage</label>
                            </div>
                        </div>
                    </div>
                    <table class="order-table" >
                        <thead>
                            <tr>
                                <th>ItemID</th>
                                <th>Best Before</th>
                                <th>Business</th>
                                <th>Product</th>
                                <th>Notify Status</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        
                        <tbody id="order-table-body">
                            <?php if(count($rows)==0) {?>
                                <!-- No products available -->
                                </tbody>
                                     </table>
                                <label>No recently expiriing items</label>
                                

                           <?php }else{?>
                            <?php foreach($rows as $row):?>
                            
                            <tr>
                                <td><?=$row->product_id?></td>
                                <td>
                                    <label id="days<?=$row->product_id?>">00</label>
                                    <label id="hours<?=$row->product_id?>">00</label>
                                    <label id="minutes<?=$row->product_id?>">00</label>
                                    <label id="seconds<?=$row->product_id?>">00</label>
                                    
                                </td>
                                <td><?=$row->business_name?></td>
                                <td><?=$row->product_name?></td>
                                <td><button class="take-action">Notify</button></td>
                                <td style="text-align: center;">Rs. <?=$row->price_per_unit?> <br/><label>View Full Details</label></td>
                            </tr>
                            <script>
                                document.addEventListener("DOMContentLoaded",function(){
                                    countDown('<?=$row->best_before?>','<?=$row->product_id?>');
                                });
                                
                            </script>
                            <?php endforeach; ?>
                           <?php }?>
                        </tbody>
                    </table>
                    <div class="arrow-div">
                        <div class="arrows">
                            <img src="<?=ASSETS?>/images/Arrow right-circle.png" id="prevBtn"/>
                            <img src="<?=ASSETS?>/images/Arrow right-circle-bold.png" id="nextBtn"/>
                            
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
        <script src="<?= ROOT ?>/assets/js/adminCountdown.js"></script>
        <!-- <script src="<?=ROOT?>/assets/js/TrackExpiryPopup.js"></script> -->