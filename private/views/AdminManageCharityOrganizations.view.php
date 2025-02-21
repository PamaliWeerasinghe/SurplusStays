<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<?php require APPROOT . '/views/deleteConfirmation.view.php' ?>
<link rel="stylesheet" href="<?= STYLES ?>/adminSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/adminManageActors.css" />
<link rel="stylesheet" href="<?= STYLES ?>/admin.css">


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
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?= ASSETS ?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?= ASSETS ?>/images/Bell.png" class="bell" />
                    </div>
                    <div class="add-buyer" onclick="window.location.href='<?= ROOT ?>/Admin/addNewCharityOrg'">
                        <div>
                            <label>
                                + Add Charity Organization
                            </label>

                        </div>
                    </div>


                </div>
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <label>Charity Organizations</label>
                        <div>
                            <select>
                                <option>Organization</option>
                            </select>
                            <select>
                                <option>Location</option>
                            </select>
                            <select>
                                <option>Donors</option>
                            </select>
                            <select>
                                <option>Donations Received</option>
                            </select>
                        </div>

                    </div>
                    <?php foreach ($rows as $row): ?>
                        <div class="business-row">
                            <div class="business-wrap">
                                <div class="business">
                                    <img class="pic" src="<?=ASSETS?>/charityImages/<?= $row->picture ?>" />
                                </div>
                                <div class="business-details">
                                    <label style="font-weight: bold;font-size:larger"><?= $row->name ?></label>
                                </div>
                                <div class="business-summary">
                                    <label>Donors Engaged : <?= $row->donors ?></label>
                                    <label>No. of Complaints : <?= $row->donations ?></label>
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
                            <!-- <div class="business-joined">
                                <label>Joined On : 22 / 06 / 2023</label>
                            </div> -->


                        </div>
                    <?php endforeach; ?>





                    <div class="arrow-div">
                        <div class="arrows">
                            <img src="<?= ASSETS ?>/images/Arrow right-circle.png" />
                            <img src="<?= ASSETS ?>/images/Arrow right-circle-bold.png" />

                        </div>
                    </div>

                </div>





            </div>


        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>


    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>
  
    <script src="<?=ROOT?>/assets/js/deletePopup.js"></script>