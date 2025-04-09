<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
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
                                <img src="<?= ASSETS ?>/images/manifest.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Remove Users</label>
                                <label class="summaries-2-label2">25</label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="<?= ASSETS ?>/images/manifest.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Complaints</label>
                                <label class="summaries-2-label2">4500</label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="<?= ASSETS ?>/images/box-mark.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Donations</label>
                                <label class="summaries-2-label2">7900</label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="<?= ASSETS ?>/images/rating.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Customers</label>
                                <label class="summaries-2-label2">568</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-order-status" >
                    <div class="order" style="justify-content: center;">
                        <label>Order Status</label>
                    </div>
                    <div class="order-dropdown" style="justify-content: center;">
                        <label class="order-status-label2">Surplus food Secured</label>
                       
                       
                    </div>
                    <div class="order-status-chart">
                        <div class="chart">
                            <?php 
                                foreach($days as $day) {
                                    // Calculate the percentage value for each day
                                    $percentage = ($day / $total) * 100;
                                    echo "<div class='bar' style='--value: {$percentage}%;'></div>";
                                }
                            ?>
                            <!-- <div class="bar" style="--value: 23%;"></div>
                            <div class="bar" style="--value: 50%;"></div>
                            <div class="bar" style="--value: 30%;"></div>
                            <div class="bar" style="--value: 100%;"></div>
                            <div class="bar" style="--value: 60%;"></div>
                            <div class="bar" style="--value: 80%;"></div>
                            <div class="bar" style="--value: 50%;"></div> -->

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
                        <label>Recent Expiration Products</label>

                    </div>
                    <div class="order-dropdown">
                            <div></div>
                            <select>
                                <option>By 2 weeks</option>
                            </select>
                        </div>
                    
                    <div class="table-container">
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Product</th>
                                    <th>Expires In</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($products as $product):?>
                                    <tr>
                                        <td><img src="<?= ASSETS ?>/images/<?=$product->pictures?>" /></td>
                                        <td> <?=$product->name?></td>
                                        <!-- <td>Rs. <?=$product->price_per_unit?>-<?=$product->discountPrice?></td> -->
                                        <td>02:30:10</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    </div>

                    <?php $products_pager->display() ?>


                </div>

                <div class="complaints-status">
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

                                <?php foreach ($complaints as $complaint) : ?>
                                    <tr>

                                        <td><?= $complaint->complaint_date ?> &nbsp; &nbsp;<?=$complaint->complaint_id?></td>
                                        <td><?= $complaint->fname ?>&nbsp;<?= $complaint->lname ?> </td>
                                        <td><?= $complaint->product ?></td>
                                        <td><button class="completed"><?= $complaint->complaint_status ?></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                    <?php $complaints_pager->display() ?>


                </div>

            </div>

        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>

</body>

</html>