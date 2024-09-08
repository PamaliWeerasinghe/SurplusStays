<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/adminTrackExpiry.css" />
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/adminReports.css"/>
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/adminRefundMoney.css"/>
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/admin.css"/>
</head>

<body>
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
                        <label>REPORTS</label>
                    </div>
                    <div class="white-bar" style="justify-content: flex-start;font-weight:bold">
                        <label>SURPLUS SAVED FROM WASTAGE</label>
                    </div>
                    <div class="account-details">
                    <div class="account-holder">
                        <label>Account Holder : </label>
                        <input type="text"/>
                    </div>
                    </div>
                   
  

  

  


 


                    
                    

                </div>


            </div>
        </div>

</body>

</html>