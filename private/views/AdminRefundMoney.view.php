<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/adminSidePanel.css" />
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/adminRefundMoney.css" />
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/admin.css" />
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
                            <img src="../../SURPLUSSTAYS/public/assets/images/search.png" class="bell2" />
                        </div>

                        <img src="../../SURPLUSSTAYS/public/assets/images/Bell.png" class="bell" />
                    </div>


                </div>
                <div class="reports-status">
                    <div class="orange-bar">
                        <label>REFUND MONEY</label>
                    </div>
                    <div class="white-bar" style="justify-content: center;font-weight:bold">
                        <label>WISHWAS BAKERS</label>
                    </div>
                    <div class="account-details">
                        <div class="account-holder">
                            <label>Account Holder : </label>
                            <input type="text" />
                        </div>
                        
                    </div>
                    <div class="account-details">
                        <div class="account-number">
                            <label>Account Number : </label>
                            <input type="text" />
                        </div>
                        
                    </div>
                    <div class="account-other-details">
                        <div class="other-details">
                            <div>
                            <label>Branch : </label>
                            <input type="text" />
                            </div>
                            <div>
                            <label>Amount : </label>
                            <input type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="makeRefund">
                        <button class="refund">Refund</button>
                        <button class="cancel">Cancel</button>
                    </div>
                    <div class="moveback">
                    <img src="../../SURPLUSSTAYS/public/assets/icons/right-arrow 1.png" />
                    <label>Back To Complain</label>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->view('includes/footer') ?>
</body>

</html>