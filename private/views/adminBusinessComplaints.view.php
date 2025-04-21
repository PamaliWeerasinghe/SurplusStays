<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/adminBusinessComplaints.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2">
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?=ASSETS?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?=ASSETS?>/images/Bell.png" class="bell" />
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
                                <th>Complaint Description</th>
                                <th>Date Submitted</th>
                                <th style="text-align: center;">Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($complaints as $complaint):?>
                            <tr>
                
                                <td># <?= $complaint->complaint_id ?></td>
                                <td><?=$complaint->DESCRIPTION?></td>
                                <td><?=$complaint->complaint_dateTime?></td>
                                <?php if($complaint->status=='Not Attended'){?>
                                    <td style="text-align: center;"><button class="take-action">Attend</button></td>
                                <?php }else{?>
                                    <td style="text-align: center;"><button class="completed">Resolved</button></td>
                                <?php }?>
                                <td style="text-align: center;">
                                    
                                    <button 
                                    class="see-complain" 
                                    style="color:grey;background-color:transparent;border-style:solid;border-color:grey"
                                    onclick="window.location.href='<?=ROOT?>/Admin/ViewComplain/<?=$complaint->complaint_id?>'"
                                    >
                                    See Complain
                                    </button>
                                </td>
                                
                            </tr>
                            <?php endforeach; ?>   
                           
                            
                            
                        </tbody>
                    </table>
                    <div class="arrow-div">
                        <div class="arrows">
                           
                            <?php $complaints_pager->display()?>
                            
                        </div>
                    </div>

                </div>


            </div>
        </div>

</body>

</html>