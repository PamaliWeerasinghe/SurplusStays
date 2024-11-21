<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessorders.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/business.css">
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2">
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?= ASSETS ?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?= ASSETS ?>/images/Bell.png" class="bell" />
                    </div>
                    <div class="summary-blocks">
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Revenue</label>
                            </div>
                            <div class="summaries-2">
                                <label>Rs. 50000</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Customers</label>
                            </div>
                            <div class="summaries-2">
                                <label>320</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Orders</label>
                            </div>
                            <div class="summaries-2">
                                <label>444</label>
                            </div>


                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <label>Total Transactions</label>
                            </div>
                            <div class="summaries-2">
                                <label>Rs. 14000</label>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="order-status">
                    <div class="order">
                        <label>Orders</label>
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
                                <label>Ongoing</label>
                            </div>
                            <div class="slot2">
                                <label>Completed</label>

                            </div>
                            <div class="slot2">
                                <label>Cancelled</label>
                            </div>
                        </div>
                    </div>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Sunil Gamachcchi</td>
                                <td>Full Bread</td>
                                <td><button class="take-action">Not Collected</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Chamindu Sanjana</td>
                                <td>Popcorn</td>
                                <td><button class="take-action">Not Collected</button></td>
                                <td style="text-align: center;">Rs.55 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Desahit Gallge</td>
                                <td>Corn</td>
                                <td><button class="take-action">Not Collected</button></td>
                                <td style="text-align: center;">Rs.75<br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>Rice</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 42 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Wanindu Hasarnga</td>
                                <td>Pasta</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>Rice</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 42 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Wanindu Hasarnga</td>
                                <td>Pasta</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>Rice</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 42 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Wanindu Hasarnga</td>
                                <td>Pasta</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>Rice</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 42 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Wanindu Hasarnga</td>
                                <td>Pasta</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Suriya Kumar</td>
                                <td>Rice</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 42 <br /><label>View Full Details</label></td>
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024 </td>
                                <td>Wanindu Hasarnga</td>
                                <td>Pasta</td>
                                <td><button class="completed">Completed</button></td>
                                <td style="text-align: center;">Rs. 64.50 <br /><label>View Full Details</label></td>
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
</body>

</html>