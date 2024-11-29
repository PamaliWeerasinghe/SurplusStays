<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link rel="stylesheet" href="<?=STYLES?>/CustPayment.css">
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
                    <div class="box-header">Payment</div>
                    <div class="box-subheading" style="background-color: white;">
                        <div class="payment-text">CREDIT CARD/DEBIT CARD</div>
                        <div class="payment-icons">
                            <img src="<?=ASSETS?>/images/visa.png" alt="Visa" class="icon">
                            <img src="<?=ASSETS?>/images/mastercard.png" alt="Mastercard" class="icon">
                        </div>
                    </div>


                    <div class="payment-form" style="margin: 40px; font-weight: 200;">
                    <div class="payment-form">
                        <div class="form-group">
                        <label for="card-number">Card Number:</label>
                        <input type="text" id="card-number" placeholder="Card Number">
                        </div>
                        <div class="form-group">
                        <label for="name-on-card">Name On Card:</label>
                        <input type="text" id="name-on-card" placeholder="Name On Card">
                        </div>
                        <div class="form-group-row">
                        <div class="form-group">
                            <label for="expiration-date">Expiration Date:</label>
                            <input type="text" id="expiration-date" placeholder="Expiration Date (MM/YY)">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV:</label>
                            <input type="text" id="cvv" placeholder="CVV">
                        </div>
                        </div>
                    </div>
    
                
                    <div class="button-container">
                    <p style="font-weight: 600;" onclick='window.location.href="http://localhost/surplusstays/public/customer/cart"'><b>&lt;</b> Back</p>
                    <button class="pay-btn">Confirm And Pay</button>
                    </div>

            </div>
            
        </div>
        <?php echo $this->view('includes/footer')?>
    </div>
    
</body>

</html>