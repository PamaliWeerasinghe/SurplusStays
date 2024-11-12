<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<title><?php echo SITENAME ?></title>
<link rel="stylesheet" href="<?= STYLES ?>/businesscomplains.css" />
<link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/business.css">
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/businessSidePanel.view.php" ?>
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
                        <button class="add-complain-btn">+ Add A Complain</button>
                    </div>

                </div>
                <div class="order-status">
                    <div class="order">
                        <label>Complains</label>
                        <select>
                            <option>All Time</option>
                        </select>
                    </div>

                    <div class="order-nav">
                        <div class="view-slots">
                            <div class="slot1">
                                <label>Customer Complains</label>
                            </div>
                            <div class="slot2">
                                <label>My Complains</label>
                            </div>
                        </div>
                    </div>

                    <div class="order-nav">
                        <div class="view-slots">
                            <div class="slot1">
                                <label>All</label>
                            </div>
                            <div class="slot2">
                                <label>Pending</label>
                            </div>
                            <div class="slot2">
                                <label>Resolved</label>
                            </div>
                        </div>
                    </div>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>F and S lanka</td>
                                <td>3689</td>
                                <td><button class="take-action">In Progress</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suwasetha Foundation</td>
                                <td>5874</td>
                                <td><button class="completed">Resolved</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>

                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sadaham sewana</td>
                                <td>7894</td>
                                <td><button class="take-action">In Progress</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>2158</td>
                                <td><button class="completed">Resolved</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>7469</td>
                                <td><button class="completed">Resolved</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>2536</td>
                                <td><button class="completed">Resolved</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>2103</td>
                                <td><button class="completed">Resolved</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>9683</td>
                                <td><button class="completed">Resolved</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>8647</td>
                                <td><button class="completed">Resolved</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>8967</td>
                                <td><button class="completed">Resolved</button></td>
                                <td style="text-align: center;"><label>See Complain</label></td>
                            </tr>



                        </tbody>
                    </table>
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
        <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>