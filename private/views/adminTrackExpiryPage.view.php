<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
<?php require APPROOT.'/views/AdminTrackExpiryViewItemPopup.view.php'?>
    <title><?php echo SITENAME ?></title>
    <link rel="icon" href="<?=ASSETS?>/images/nav-logo.png"/>
    <link rel="stylesheet" href="<?=STYLES?>/adminTrackExpiry.css" />
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
    <link rel="stylesheet" href="<?= STYLES ?>/searchBar.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                <div class="summary-blocks">
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Additional Surplus Saved</label>
                            </div>
                            <div class="summaries-2">
                                <label><?=$productsSaved?></label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Expired Surplus Items</label>
                            </div>
                            <div class="summaries-2">
                                <label><?=$expired?></label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Transactions</label>
                            </div>
                            <div class="summaries-2">
                                <label><?=$orders?></label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Revenue</label>
                            </div>
                            <div class="summaries-2">
                                <label>Rs. <?=$revenue?></label>
                            </div>


                        </div>
                    </div>
                    <div class="notifications-type2">
                    <?php
                        $columns = [
                            'product_name' => 'Product Name',
                            'notify_status' => 'Notify Status',
                            'business_name' => 'Business Name',
                            'bestBefore' => 'Expires In',
                            'price' => 'Price'
                        ];
                        $seacher = TableSearcher::getInstance();
                        echo $seacher->renderSearchBar($columns);
                        ?>
                    </div>
                    

                </div>
                <div class="order-status">
                    <div class="order">
                        <label>Track Expiration</label>
                        <?php
                            $columns = [
                                'product_name' => 'Product Name',
                                'notify_status' => 'Notify Status',
                                'business_name' => 'Business Name',
                                'bestBefore' => 'Expires In',
                                'price' => 'Price'
                            ];

                    $sorter = Sorter::getInstance();
                    echo $sorter->renderSorter($columns);
                    ?>
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
                                <label>No recently expiring items</label>
                                

                           <?php }else{?>
                            <?php foreach($rows as $row):?>
                            
                            <tr>
                                <td><?=$row->product_id?></td>
                                <td>
                                    <label id="days<?=$row->product_id?>"style="font-size:small">00</label>
                                    <label id="hours<?=$row->product_id?>" style="font-size:small">00</label>
                                    <label id="minutes<?=$row->product_id?>" style="font-size:small">00</label>
                                    <label id="seconds<?=$row->product_id?>" style="font-size:small">00</label>
                                    
                                </td>
                                <td><?=$row->business_name?></td>
                                <td><?=$row->product_name?></td>
                                <?php 
                                    if($row->notify_status=='Notified'){
                                        ?>
                                        <td><button class="completed">Notified</button></td>
                                        <?php
                                    }else if($row->notify_status=='Notify'){
                                        ?>
                                        <form method="post">
                                            <td><button class="take-action" type="submit">Notify</button></td>
                                            <input type="hidden" value="<?=$row->product_id?>" name="product_id"/>
                                            <input type="hidden" value="<?=$row->email?>" name="email"/>
                                        </form>
                                       
                                        <?php
                                    }else{
                                        ?>
                                        <td><button class="notify">Action Taken</button></td>
                                        <?php

                                    }
                                ?>
                                
                                <td style="text-align: center;">Rs. <?=$row->price?> <br/></td>
                            </tr>
                            <script>
                                document.addEventListener("DOMContentLoaded",function(){
                                    countDown('<?=$row->bestBefore?>','<?=$row->product_id?>');
                                });
                                
                            </script>
                            <?php endforeach; ?>
                           <?php }?>
                        </tbody>
                    </table>
                    <div class="arrow-div">
                        <div class="arrows">
                            <!-- <img src="<?=ASSETS?>/images/Arrow right-circle.png" id="prevBtn"/>
                            <img src="<?=ASSETS?>/images/Arrow right-circle-bold.png" id="nextBtn"/> -->
                            <?php $products_pager->display()?>
                            
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
        <script src="<?= ROOT ?>/assets/js/adminCountdown.js"></script>
        <script src="<?= ROOT ?>/assets/js/PagerAndSorter.js"></script>
        <!-- <script src="<?=ROOT?>/assets/js/TrackExpiryPopup.js"></script> -->
