<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/adminSidePanel.css" />
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/adminBusinessComplaints.css" />
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/admin.css">
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
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <label>Complaints</label>
                        <select>
                            <option>All Time</option>
                        </select>
                    </div>

                    <div class="Business-complaints-order-nav">
                        <div class="Business-complaints-view-slots">
                            <div class="slot1">
                                <label>Order Complaints</label>
                            </div>
                            <div class="slot2">
                                <label>Take Actions</label>
                            </div>
                          
                        </div>
                    </div>
                    <div class="Business-complaints-order-nav">
                        <div class="Business-complaints-view-slots">
                            <div class="slot1">
                                <label>All</label>
                            </div>
                            <div class="slot2">
                                <label>Pending</label>
                            </div>
                            <div class="slot2">
                                <label>Reserved</label>

                            </div>
                           
                        </div>
                    </div>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Complaint ID</th>
                                <th>Date Submitted</th>
                                <th style="text-align: center;">Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024</td>
                                
                                <td style="text-align: center;"><button class="take-action">In Progress</button></td>
                                <td style="text-align: center;">
                                    <button 
                                    class="see-complain" 
                                    style="color:grey;background-color:transparent;border-style:solid;border-color:grey">
                                    See Complain
                                    </button>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024</td>
                                
                                <td style="text-align: center;"><button class="take-action">In Progress</button></td>
                                <td style="text-align: center;">
                                    <button 
                                    class="see-complain" 
                                    style="color:grey;background-color:transparent;border-style:solid;border-color:grey">
                                    See Complain
                                    </button>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024</td>
                                
                                <td style="text-align: center;"><button class="completed">Resolved</button></td>
                                <td style="text-align: center;">
                                    <button 
                                    class="see-complain" 
                                    style="color:grey;background-color:transparent;border-style:solid;border-color:grey">
                                    See Complain
                                    </button>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024</td>
                                
                                <td style="text-align: center;"><button class="take-action">In Progress</button></td>
                                <td style="text-align: center;">
                                    <button 
                                    class="see-complain" 
                                    style="color:grey;background-color:transparent;border-style:solid;border-color:grey">
                                    See Complain
                                    </button>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>#154</td>
                                <td>14.02.2024</td>
                                
                                <td style="text-align: center;"><button class="completed">Resolved</button></td>
                                <td style="text-align: center;">
                                    <button 
                                    class="see-complain" 
                                    style="color:grey;background-color:transparent;border-style:solid;border-color:grey">
                                    See Complain
                                    </button>
                                </td>
                                
                            </tr>
                           
                            
                            
                        </tbody>
                    </table>
                    <div class="arrow-div">
                        <div class="arrows">
                            <img src="../../SURPLUSSTAYS/public/assets/images/Arrow right-circle.png"/>
                            <img src="../../SURPLUSSTAYS/public/assets/images/Arrow right-circle-bold.png"/>
                            
                        </div>
                    </div>

                </div>


            </div>
        </div>

</body>

</html>