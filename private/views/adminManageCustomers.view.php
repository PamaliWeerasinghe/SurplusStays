<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<?php require APPROOT . '/views/adminViewCustomerPopup.view.php'?>

<link rel="stylesheet" href="<?= STYLES ?>/adminSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/adminManageActors.css" />
<link rel="stylesheet" href="<?= STYLES ?>/admin.css">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <?php echo $this->view('includes/navbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2">
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?= ASSETS ?>/images/search.png" class="bell2" />
                        </div>

                        <!-- <img src="<?= ASSETS ?>/images/Bell.png" class="bell" /> -->
                    </div>
                    <div class="summary-blocks">
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Customers</label>
                            </div>
                            <div class="summaries-2">
                                <label><?=$customer_count?></label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Orders</label>
                            </div>
                            <div class="summaries-2">
                                <label><?=$order_count?></label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Complaints</label>
                            </div>
                            <div class="summaries-2">
                                <label><?=$complaint_count?></label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Revenue</label>
                            </div>
                            <div class="summaries-2">
                                <label>Rs. <?=$total_price?></label>
                            </div>


                        </div>
                    </div>


                </div>
                <div class="Business-complaints-order-status">
                <div class="add-buyer" onclick="window.location.href='<?= ROOT ?>/Admin/addNewCustomer'">
                        <div>
                            <label>
                                + Add Buyer
                            </label>

                        </div>
                    </div>
                    <table class="order-table">
                        <thead>
                            
                            <tr>
                                <th>Profile</th>
                                <th>ID</th>
                                <th>Phone No</th>
                                <th>Registered Date</th>

                            </tr>
                        </thead>
                        <tbody>
                        <!-- onclick="viewCustomer(<?=$customer->cus_id?>)" -->
                        <?php foreach( $customers as $customer):?>
                            <tr id="customer_row<?=$customer->cus_id?>" onclick="viewCustomer(<?=$customer->cus_id?>)">
                                <td><img src="<?=CUSTOMER.'/'.$customer->profile_pic?>" class="customer-profile-pic"/></td>
                                <td>#<?=$customer->cus_id?></td>
                                <td><?=$customer->phoneNo?></td>
                                <td><?=$customer->reg_date?></td>
                                <td>
                               
                                    <span class="material-symbols-outlined" style="z-index:999;" >
                                        edit_square
                                    </span>
                                    <span class="material-symbols-outlined action-btn deactivate" style="color: red;">
                                        person_remove
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <?php $customers_pager->display() ?>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>
    <script src="<?=ROOT?>/assets/js/adminViewCustomerDetails.js"></script>
   
    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>
    