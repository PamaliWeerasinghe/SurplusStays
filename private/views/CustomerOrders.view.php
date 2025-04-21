<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
<?php require APPROOT.'/views/AdminTrackExpiryViewItemPopup.view.php'?>
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/adminTrackExpiry.css" />
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/customerSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary" >
                    <!-- <div class="notifications-type2">
                        

                        
                    </div> -->
                    

                </div>
                <div class="order-status" style="margin-top: -28%;">
                    <div class="order">
                        <label>Orders</label>
                        <!-- <select>
                            <option>All Time</option>
                        </select> -->
                    </div>

                   
                    <table class="order-table" >
                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>Date & Time</th>
                                <th>Shop</th>
                                <!-- <th>Product</th> -->
                                <th>Payment</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="order-table-body">
                            <tr onclick="openPopup()">
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <!-- <td>Full Bread</td> -->
                                <td>
                                    <label>
                                        
                                    <button class="take-action">Processing</button>
                                    </label>
                                </td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <!-- <td>Full Bread</td> -->
                                <td><button class="take-action">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="take-action">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="take-action">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="take-action">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="take-action">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="take-action">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="take-action">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="completed">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="completed">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="completed">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="completed">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 <br/> 02: 45: 30</td>
                                <td>Cargills - Rajagiriya</td>
                                <td>Full Bread</td>
                                <td><button class="completed">Notified</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br/><label>View Full Details</label></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="arrow-div">
                        <div class="arrows">
                            <img src="<?=ASSETS?>/images/Arrow right-circle.png" id="prevBtn"/>
                            <img src="<?=ASSETS?>/images/Arrow right-circle-bold.png" id="nextBtn"/>
                            
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <?php echo $this->view('includes/footer')?>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>
    
        <script src="<?=ROOT?>/assets/js/TrackExpiryPopup.js"></script>