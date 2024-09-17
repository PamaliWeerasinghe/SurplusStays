<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/businessrequests.css" />
    <link rel="stylesheet" href="<?=STYLES?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/business.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/businessSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2">
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?=ASSETS?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?=ASSETS?>/images/Bell.png" class="bell" />
                    </div>
                    <div class="summary-blocks">
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Requests</label>
                            </div>
                            <div class="summaries-2">
                                <label>7000</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Accepted Requests</label>
                            </div>
                            <div class="summaries-2">
                                <label>320</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Donated Amount</label>
                            </div>
                            <div class="summaries-2">
                                <label>Rs 74000</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Items Donated</label>
                            </div>
                            <div class="summaries-2">
                                <label>65</label>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="order-status">
                    <div class="order">
                        <label>Donation Requests</label>
                        <select>
                            <option>All Time</option>
                        </select>
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
                                <label>Donated</label>

                            </div>
                            <div class="slot2">
                                <label>Rejected</label>
                            </div>
                        </div>
                    </div>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>RequestID</th>
                                <th>Date</th>
                                <th>Charity Name</th>
                                <th>Items</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>F and S lanka</td>
                                <td>5*Full Bread<br>4*Rice<br>4*popcorn</td>
                                <td><button class="take-action">Pending</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suwasetha Foundation</td>
                                <td>5*Toast Bread<br>3*Sandwitches</td>
                                <td><button class="take-action">Pending</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sadaham sewana</td>
                                <td>Rice</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>5*Full Bread<br>4*Rice<br>4*popcorn</td>
                                <td><button class="rejected">Rejected</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>Rice</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>Rice</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>5*Full Bread<br>4*Rice<br>4*popcorn</td>
                                <td><button class="rejected">Rejected</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>5*Toast Bread<br>3*Sandwitches</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>5*Full Bread<br>4*Rice<br>4*popcorn</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>5*Toast Bread<br>3*Sandwitches</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;"><label>View Full Details</label></td>
                            </tr>
                            
                            
                            
                        </tbody>
                    </table>
                    <div class="arrow-div">
                        <div class="arrows">
                            <img src="<?=ASSETS?>/images/Arrow right-circle.png"/>
                            <img src="<?=ASSETS?>/images/Arrow right-circle-bold.png"/>
                            
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
        