<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/businessMyProducts.css" />
<link rel="stylesheet" href="<?= STYLES ?>/business.css">
</head>

<body>
    
    <div class="main-div">
    <?php echo $this->view('includes/navbar') ?>
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
                        <button class="add-complain-btn" onclick="window.location.href='<?=ROOT?>/business/addproduct'">+ Add Product</button>
                    </div>


                </div>
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <label>Products</label>
                        <div>
                            <select>
                                <option>Quantity by count</option>
                                <option>less than 10</option>
                                <option>less than 50</option>
                                <option>More than 50</option>
                            </select>
                            <select>
                                <option>Expiery date</option>
                                <option>This week</option>
                                <option>This month</option>
                            </select>
                            <select>
                                <option>Date added</option>
                                <option>september</option>
                                <option>octomber</option>
                            </select>
                        </div>

                    </div>
                    <div class="buyer-row-colomn">
                        <div class="buyer-row">
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/bread.png" />

                                        <div class="customer-details">

                                            <label>Bread</label>
                                            <label>Rs 24.50</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>24</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/popcorn.png" />

                                        <div class="customer-details">

                                            <label>Popcorn</label>
                                            <label>Rs 32</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>12</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/pasta.png" />

                                        <div class="customer-details">

                                            <label>Pasta</label>
                                            <label>Rs 99</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>5</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="buyer-row">
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/chips.png" />

                                        <div class="customer-details">

                                            <label>Chips</label>
                                            <label>Rs 55</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>17</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/peanuts.png" />

                                        <div class="customer-details">

                                            <label>Peanuts</label>
                                            <label>Rs 119</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>7</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/rice.png" />

                                        <div class="customer-details">

                                            <label>Rice</label>
                                            <label>Rs 42</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>54</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="buyer-row">
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/chips.png" />

                                        <div class="customer-details">

                                            <label>Chips</label>
                                            <label>Rs 55</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>17</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/peanuts.png" />

                                        <div class="customer-details">

                                            <label>Peanuts</label>
                                            <label>Rs 119</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>7</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                            <div class="row1">
                                <div>
                                    <div class="customer-img">
                                        <img src="<?= ASSETS ?>/images/rice.png" />

                                        <div class="customer-details">

                                            <label>Rice</label>
                                            <label>Rs 42</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="customer-joined">
                                    <label>Expire :</label>
                                    <label>2024.12.25 11.00AM</label>
                                </div>
                                <div class="customer-purchased">
                                    <label>Items - </label>
                                    <label>54</label>
                                </div>
                                <div class="customer-buttons">
                                    <button>View</button>
                                    <button>Remove</button>
                                </div>
                            </div>
                            
                        </div>
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
    </div>


    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>