<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/CustViewOrders.css">
</head>

<body>
    <!-- navbar -->

    <div class="main-div">
    <?php echo $this->view('includes/navbar')?>
        <div class="sub-div-1">
            <!-- included the admin side panel -->
            <?php require APPROOT."/views/includes/customerSidePanel.view.php"?>
            <div class="dashboard">
                <div class="summary">
                <div class="top-bar">
                    <div class="search-bar">
                            <input type="text" placeholder="Search..." />
                        </div>
                        <div class="notification">
                            <img src="<?=ASSETS?>/images/Bell.png" alt="Notification Bell" class="bell-icon">
                        </div>
                    </div>
                </div>

                <div class="box">
                    
                <!-- orders -->
                <div class="orders-container">
        <h1 class="orders-header">Orders</h1>
        <div class="orders-table">
            <table>
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>Shop</th>
                        <th>Product</th>
                        <th>Payment</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#155</td>
                        <td>20.02.2024</td>
                        <td>Keels Borella</td>
                        <td>4*Nuts</td>
                        <td>Pay On Pickup <br/><span class="status processing">Processing</span></td>
                        <td>Rs 112 <a href="#" class="details-link">View Full Details</a></td>
                    </tr>
                    <br/>
                    <tr>
                        <td>#156</td>
                        <td>07.02.2024</td>
                        <td>Wasana Bakers</td>
                        <td>6*Pasta</td>
                        <td>Online Payment <br/><span class="status processing">Processing</span></td>
                        <td>Rs 144.50 <a href="#" class="details-link">View Full Details</a></td>
                    </tr>
                    <br/>
                    <tr>
                        <td>#157</td>
                        <td>07.02.2024</td>
                        <td>Food City Mathara</td>
                        <td>6*Pasta</td>
                        <td>Online Payment <br/><span class="status completed">Completed</span></td>
                        <td>Rs 144.50 <a href="#" class="details-link">View Full Details</a></td>
                    </tr>
                    <br/>
                    <!-- Add more rows here -->
                </tbody>
            </table>
        </div>
    </div>





                </div>
    
                
               


            </div>
            
        </div>
        <?php echo $this->view('includes/footer')?>
    </div>
    
</body>

</html>