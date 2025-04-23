<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<?php require APPROOT . '/views/adminViewCharityPopup.view.php' ?>
<link rel="stylesheet" href="<?= STYLES ?>/adminSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/adminManageActors.css" />
<link rel="stylesheet" href="<?= STYLES ?>/admin.css">
<link rel="stylesheet" href="<?= STYLES ?>/searchBar.css">

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"   />
</head>

<body>
    <?php echo $this->view('includes/navbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2"> 
                    <?php
                        $columns = [
                            'org_name' => 'Organization Name',
                            'org_contact' => 'Contact No',
                            'user_email' => 'Email',
                            'username' => 'Username',
                            'reg_date' => 'Registered Date'
                        ];
                        $seacher = TableSearcher::getInstance();
                        echo $seacher->renderSearchBar($columns);
                        ?>
                    </div>
                    <div class="add-buyer" onclick="window.location.href='<?= ROOT ?>/Admin/addNewCharityOrg'" style="margin-top: 4%";>
                        <div>
                            <label>
                                + Add Charity Organization
                            </label>

                        </div>
                    </div>


                </div>
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <!-- <label>Charity Organizations</label> -->
                        <div>
                        <?php
                    $columns = [
                      'org_name' => 'Organization Name',
                            'org_contact' => 'Contact No',
                            'user_email' => 'Email',
                            'username' => 'Username',
                            'reg_date' => 'Registered Date'
                    ];

                    $sorter = Sorter::getInstance();
                    echo $sorter->renderSorter($columns);
                    ?>
                            
                        </div>

                    </div>
                    <table class="order-table">
                        <thead>
                            
                            <tr>
                                <th>Profile</th>
                                <th>ID</th>
                                <th>Organization</th>
                                <th>Registered Date</th>

                            </tr>
                        </thead>
                        <tbody>
                    <!-- <?php foreach ($org as $row): ?> -->
                        <!-- <div class="business-row">
                            <div class="business-wrap">
                                <div class="business">
                                    <img class="pic" src="<?=ASSETS?>/charityImages/<?= $row->profile_pic ?>" />
                                </div>
                                <div class="business-details">
                                    <label style="font-weight: bold;font-size:larger"><?= $row->org_name ?></label>
                                </div>
                                <div class="business-summary">
                                    <label>Donors Engaged : <?= $row->donors ?></label>
                                    
                                </div>
                                <div class="business-buttons">
                                    <button onclick="window.location.href='<?=ROOT ?>/AdminViewCharity/<?=$row->id?>'">
                                        <span class="material-symbols-outlined action-btn view">
                                            account_box
                                        </span>


                                    </button>
                                    <button onclick="openPopup(<?=$row->id?>)" value="<?=$row->id?>">
                                        <span class="material-symbols-outlined action-btn deactivate" style="color: red;">
                                            person_remove
                                        </span>
                                    </button>

                                </div>

                            </div>
                          


                        </div> -->
                       
                       
                            <tr  onclick="viewOrganization(<?=$row->user_id?>,<?=$row->org_id?>)">
                                <td><img src="<?=ASSETS?>/charityImages/<?= $row->profile_pic ?>" class="pic"/></td>
                                <td># <?= $row->org_id?></td>
                                <td><?=$row->org_name?></td>
                                <td><?=$row->reg_date?></td>
                                <td>
                               
                                    <span class="material-symbols-outlined" style="z-index: 1;" onclick="viewCharity(<?=$row->user_id?>,<?=$row->org_id?>)">
                                        edit_square
                                    </span>
                                    <span class="material-symbols-outlined action-btn deactivate" style="color: red;" onclick="openPopup(<?=$row->user_id?>)" value="<?=$row->user_id?>">
                                        person_remove
                                    </span>
                                </td>
                            </tr>
                        <!-- <?php endforeach;?> -->
                        </tbody>
                    </table>
                    <?php $org_pager->display() ?>





                    <!-- <div class="arrow-div">
                        <div class="arrows">
                            <img src="<?= ASSETS ?>/images/Arrow right-circle.png" />
                            <img src="<?= ASSETS ?>/images/Arrow right-circle-bold.png" />

                        </div>
                    </div> -->

                </div>





            </div>


        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>


    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>
  
    <script src="<?=ROOT?>/assets/js/deletePopup.js"></script>
    <script src="<?=ROOT?>/assets/js/adminViewCharityDetails.js"></script>
    <script src="<?= ROOT ?>/assets/js/PagerAndSorter.js"></script>