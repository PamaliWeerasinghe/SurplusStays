<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
<?php require APPROOT . '/views/adminViewBusinessPopup.view.php'?>
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/adminManageActors.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"   />
    <link rel="stylesheet" href="<?= STYLES ?>/searchBar.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>  
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2">     
                    <?php
                        $columns = [
                            'business_name' => 'Business Name',
                            'phoneNo' => 'Phone No',
                            'email' => 'Email',
                            'username' => 'Username',
                            'reg_date' => 'Registered Date'
                        ];
                        $seacher = TableSearcher::getInstance();
                        echo $seacher->renderSearchBar($columns);
                        ?>
                    </div>
                    <div class="add-buyer" onclick="window.location.href='<?=ROOT?>/Admin/addNewBusiness'" style="margin-top: 4%";>
                            <div>
                                <label>
                                + Add Supplier
                                </label>
                                
                            </div>
                    </div>
                    

                </div>
                
                <div class="Business-complaints-order-status">
                <?php
                    $columns = [
                        'business_name' => 'Business Name',
                        'phoneNo' => 'Phone No',
                        'email' => 'Email',
                        'username' => 'Username',
                        'reg_date' => 'Registered Date'
                    ];

                    $sorter = Sorter::getInstance();
                    echo $sorter->renderSorter($columns);
                    ?>
                <table class="order-table">
                        <thead>
                            
                            <tr>
                                <th>Profile</th>
                                <th>Business Name</th>
                                <th>Phone No</th>
                                <th>Registered Date</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php if($business):?>
                        <?php foreach($business as $business):?>
                            <tr  onclick="viewBusiness(<?=$business->user_id?>,<?=$business->bus_id?>)">
                                <td><img src="<?=BUSINESS.'/'.$business->profile_pic?>" class="customer-profile-pic"/></td>
                                <td><?=$business->business_name?></td>
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
                        <?php else: ?>
                            <tr>
                                        <td colspan="4" style="text-align: center;">
                                            No Complaints Added
                                        </td>
                                    </tr>
                           <?php endif;?> 
                        </tbody>
                    </table>
                    <?php $business_pager->display() ?>
                    </div>
                </div>

            </div>
            <?php echo $this->view('includes/footer')?>
        </div>
        <script src="<?=ROOT?>/assets/js/adminViewBusinessDetails.js"></script>
        <script src="<?= ROOT ?>/assets/js/PagerAndSorter.js"></script>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>