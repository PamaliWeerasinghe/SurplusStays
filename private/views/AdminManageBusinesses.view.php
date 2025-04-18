<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
<?php require APPROOT . '/views/adminViewBusinessPopup.view.php'?>
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/adminManageActors.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"   />
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
                    <div class="add-buyer">
                            <div>
                                <label>
                                + Add Supplier
                                </label>
                                
                            </div>
                    </div>
                    

                </div>
                <div class="Business-complaints-order-status">
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
                        <?php foreach( $business as $business):?>
                            <tr  onclick="viewBusiness(<?=$business->user_id?>)">
                                <td><img src="<?=CUSTOMER.'/'.$business->profile_pic?>" class="customer-profile-pic"/></td>
                                <td>#<?=$business->bus_id?></td>
                                <td><?=$business->phoneNo?></td>
                                <td><?=$business->reg_date?></td>
                                <td>
                               
                                    <span class="material-symbols-outlined" style="z-index: 1;">
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
                    <?php $business_pager->display() ?>
                    </div>
                </div>

            </div>
            <?php echo $this->view('includes/footer')?>
        </div>
        <script src="<?=ROOT?>/assets/js/adminViewBusinessDetails.js"></script>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>