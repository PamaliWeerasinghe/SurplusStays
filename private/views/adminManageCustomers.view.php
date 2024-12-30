<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
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

                        <img src="<?= ASSETS ?>/images/Bell.png" class="bell" />
                    </div>
                    <div class="add-buyer">
                        <div>
                            <label>
                                + Add Buyer
                            </label>

                        </div>
                    </div>


                </div>
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <label>Buyers</label>
                        <div>
                            <select>
                                <option>Business</option>
                            </select>
                            <select>
                                <option>Location</option>
                            </select>
                            <select>
                                <option>Total Amount</option>
                            </select>
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
                        <?php foreach( $customers as $customer):?>
                            <tr>
                                <td></td>
                                <td>#<?=$customer->customer_id?></td>
                                <td><?=$customer->phoneNo?></td>
                                <td><?=$customer->reg_date?></td>
                                <td>

                                    <span class="material-symbols-outlined" onclick="CustomerEditPopup()">
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


                </div>





            </div>


        </div>


        <?php echo $this->view('includes/footer') ?>
    </div>
    <script src="<?=ROOT?>/assets/js/adminManageCustomers.js"></script>
    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>
    