<?php require APPROOT.'/views/includes/htmlHeader.view.php'?>
    <link rel="stylesheet" href="<?=STYLES?>/adminSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/adminBusinessComplaints.css" />
    <link rel="stylesheet" href="<?=STYLES?>/admin.css">
    <link rel="stylesheet" href="<?= STYLES ?>/searchBar.css">
</head>

<body>
<?php echo $this->view('includes/navbar')?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications-type2">
                    <?php
                        $columns = [
                            'DESCRIPTION' => 'Complaint Description',
                            'complaint_dateTime' => 'Date Submitted',
                            'complaint_id' => 'Complaint ID',
                            'status' => 'Complaint Status'
                        ];
                        $seacher = TableSearcher::getInstance();
                        echo $seacher->renderSearchBar($columns);
                        ?>
                    </div>
                    

                </div>
                <div class="Business-complaints-order-status">
                    <div class="order">
                        <!-- <label>Complaints</label> -->
                        <?php
                    $columns = [
                        'DESCRIPTION' => 'Complaint Description',
                        'complaint_dateTime' => 'Date Submitted',
                        'complaint_id' => 'Complaint ID',
                        'status' => 'Complaint Status'
                    ];

                    $sorter = Sorter::getInstance();
                    echo $sorter->renderSorter($columns);
                    ?>

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
                            <?php if($complaints):?>
                            <?php foreach($complaints as $complaint):?>
                            <tr>
                                <td># <?= $complaint->complaint_id ?></td>
                                <td><?=$complaint->DESCRIPTION?></td>
                                <td><?=$complaint->complaint_dateTime?></td>
                                <?php if($complaint->status=='Pending'){?>
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
                           <?php else: ?>
                            <tr>
                                        <td colspan="4" style="text-align: center;">
                                            No Complaints Added
                                        </td>
                                    </tr>
                           <?php endif;?>
                            
                            
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
        <?php echo $this->view('includes/footer')?>
        <script src="<?= ROOT ?>/assets/js/PagerAndSorter.js"></script>
        <?php require APPROOT.'/views/includes/htmlFooter.view.php'?>