<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" href="<?=ASSETS?>/images/nav-logo.png"/>
    <link rel="stylesheet" href="<?= STYLES ?>/admin.css">
    <link rel="stylesheet" href="<?= STYLES ?>/adminDashboard.css">
</head>

<body>
    <!-- navbar -->

    <div class="main-div">
        <?php echo $this->view('includes/navbar') ?>
        <div class="sub-div-1">
            <!-- included the admin side panel -->
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">


                    <div class="summary-blocks">
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="<?= ASSETS ?>/images/rating.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Customers</label>
                                <label class="summaries-2-label2"><?=$totalCustomers?></label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="<?= ASSETS ?>/images/manifest.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Left Users</label>
                                <label class="summaries-2-label2"><?=$inactUser_count?></label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="<?= ASSETS ?>/images/manifest.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Complaints</label>
                                <label class="summaries-2-label2"><?=$noOfComplaints?></label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="<?= ASSETS ?>/images/box-mark.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Donations</label>
                                <label class="summaries-2-label2"><?=$donations?></label>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="admin-order-status" >
                    <div class="order" style="justify-content: center;">
                        <label><b>Surplus food Secured Within this Week</b></label>
                        
                    </div>
                    <div class="order-dropdown" style="justify-content: center;">
                        <label class="order-status-label2">#<?=$total?></label>
                       
                       
                    </div>
                    <div class="order-status-chart">
                        <div class="chart">
                            <?php 
                                foreach($days as $day) {
                                    // Calculate the percentage value for each day
                                    $total !=0 ? $percentage = ($day / $total) * 100 : $percentage = 0;
                                    
                                    echo "<div class='bar' style='--value: {$percentage}%;'></div>";
                                }
                            ?>
                        </div>
                        <div class="day-block">
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                            <div class="day">Sun</div>
                        </div>

                    </div>

                </div>

                <!-- <div class="product-status">
                    <div>
                        <label>Recent Expiration Products</label>
                    </div>
                        <div class="order-dropdown">
                            <div></div>
                            <select>
                                <option>By 2 weeks</option>
                            </select>
                        </div>
                    

                    <div class="product-summaries">
                    <div class="table-container">
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($complaints as $complaint) : ?>
                                    <tr>

                                        <td><?= $complaint->complaint_date ?></td>
                                        <td><?= $complaint->fname ?>&nbsp;<?= $complaint->lname ?> </td>
                                        <td><?= $complaint->product ?></td>
                                        <td><button class="completed"><?= $complaint->complaint_status ?></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                        
                        <div class="product-row">
                            <div class="product-item">
                                <div>
                                    <img src="<?= ASSETS ?>/images/popcorn.png" />
                                </div>
                                <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Popcorn</label>
                                    <label class="product-summaries-label2">Rs. 32</label>
                                </div>

                            </div>
                            <div class="product-item">
                                <div>
                                    <img src="<?= ASSETS ?>/images/pasta.png" />
                                </div>
                                <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Pasta</label>
                                    <label class="product-summaries-label2">Rs. 75</label>
                                </div>

                            </div>
                            <div class="product-item">
                                <div>
                                    <img src="<?= ASSETS ?>/images/peanuts.png" />
                                </div>
                                <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Nuts</label>
                                    <label class="product-summaries-label2">Rs. 28</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="next">
                        <img src="<?= ASSETS ?>/images/down.png" />
                    </div>

                </div> -->
                <div class="product-status">
                    <div>
                        <label><b>Recent Expiration Products</b></label>

                    </div>
                    <div class="order-dropdown">
                            <div></div>
                            <?php
                    $columns = [
                        'name' => 'Product Name',
                        'price_per_unit' => 'Price',
                        'discountPrice' => 'Discounted Amount',
                        'expiration_dateTime' => 'Expires In',
                        
                    ];

                    $sorter = Sorter::getInstance();
                    echo $sorter->renderSorter($columns);
                    ?>
                        </div>
                    
                    <div class="table-container">
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Discounted Price</th>
                                    <th>Expires In</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($products):?>
                                
                                <?php foreach ($products as $product):?>
                                    <tr>
                                    <?php
                                    
                                    $productPictures = explode(',', $product->pictures); // Get images
                                    $productImage = isset($productPictures[0]) ? $productPictures[0] : 'product_placeholder.png';
                                    ?>
                                        <td><img src="<?= ROOT ?><?=$productImage?>" style="width:60px;height:60px;border-radius:20px" /></td>
                                        <td> <?=$product->name?></td>
                                        <td>Rs. <?=$product->price_per_unit?>
                                        <td>Rs. <?= $product->discountPrice?></td></td>
                                        <td>
                                        <label id="days<?=$product->id?>">00 </label>
                                    <label id="hours<?=$product->id?>">00</label>
                                    <label id="minutes<?=$product->id?>">00</label>
                                    <label id="seconds<?=$product->id?>">00</label>
                                        </td>
                                    </tr>
                                    <script>
                                document.addEventListener("DOMContentLoaded",function(){
                                    countDown('<?=$product->expiration_dateTime?>','<?=$product->id?>');
                                });
                               
                                
                            </script>
                                <?php endforeach ?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">
                                            No recent items added
                                        </td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <?php $products_pager->display() ?>
                    </div>

                    


                </div>

                <div class="complaints-status" style="margin-top: 20%;">
                    <div>
                        <label>Recent Complaints Recieved</label>

                    </div>
                    <div class="table-container">
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($complaints):?>
                                <?php foreach ($complaints as $complaint) : ?>
                                    <tr>

                                        <td><?= $complaint->complaint_date ?> &nbsp; &nbsp;<?=$complaint->complaint_id?></td>
                                        <td><?= $complaint->fname ?>&nbsp;<?= $complaint->lname ?> </td>
                                        <td><?= $complaint->product ?></td>
                                        <?php 
                                        if($complaint->complaint_status=='Pending'){
                                            ?>
                                                <td><button class="take-action" style="border-radius: 10px;"><?= $complaint->complaint_status ?></button></td>
                                            <?php
                                        }else{
                                            ?>
                                            <td><button class="completed" style="border-radius: 10px;"><?= $complaint->complaint_status ?></button></td>
                                            <?php

                                        }
                                        ?>
                                        
                                    </tr>
                                <?php endforeach; ?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">
                                            No Recent Complaints
                                        </td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>

                    </div>

                    <?php $complaints_pager->display() ?>


                </div>

            </div>

        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>


    <script src="<?= ROOT ?>/assets/js/adminCountdown.js"></script>
    <script src="<?= ROOT ?>/assets/js/PagerAndSorter.js"></script>
    
</body>

</html>