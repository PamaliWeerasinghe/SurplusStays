<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/businessReports.css">
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


                </div>
                <div class="reports-status">
                    <div class="orange-bar">
                        <label>REPORTS</label>
                    </div>
                    <div class="white-bar">
                        <label>DETAILS OF PRODUCTS THAT UPLOADED</label>
                    </div>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Final Discounted Price</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fresh Apple</td>
                                <td>Fruits</td>
                                <td>10</td>
                                <td>Rs. 2.50</td>
                                <td>Rs. 25.00</td>
                                
                            </tr>
                            <tr>
                                <td>Fresh Apple</td>
                                <td>Fruits</td>
                                <td>10</td>
                                <td>Rs. 2.50</td>
                                <td>Rs. 25.00</td>
                                
                            </tr>
                            <tr>
                                <td>Fresh Apple</td>
                                <td>Fruits</td>
                                <td>10</td>
                                <td>Rs. 2.50</td>
                                <td>Rs. 25.00</td>
                                
                            </tr>
                            <tr>
                                <td>Fresh Apple</td>
                                <td>Fruits</td>
                                <td>10</td>
                                <td>Rs. 2.50</td>
                                <td>Rs. 25.00</td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <div class="get-report-btn">
                        <button>Get Report</button>
                    </div>
                    
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
</body>

</html>