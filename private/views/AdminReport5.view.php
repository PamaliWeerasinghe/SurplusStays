<?php
// Your PHP code above this (if needed)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Details</title>
    <style>
        /* Main Report Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
        }
        
        .report-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        
        .report-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .report-title {
            color: #2c3e50;
            margin: 0;
            font-size: 28px;
        }
        
        .report-subtitle {
            color: #7f8c8d;
            font-weight: normal;
            margin-top: 5px;
        }
        
        /* Table Styling */
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        
        .report-table th {
            background-color: #289043;
            color: white;
            text-align: left;
            padding: 12px;
        }
        
        .report-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
        }
        
        .report-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        .report-table tr:hover {
            background-color: #e3f2fd;
        }
        
        /* Summary Section */
        .report-summary {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 30px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .summary-label {
            font-weight: bold;
            color: #2c3e50;
        }
        
        .summary-value {
            color: #e74c3c;
            font-weight: bold;
        }
        
        /* Footer */
        .report-footer {
            margin-top: 30px;
            text-align: center;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        /* Print Button Styling */
        .print-button-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .print-button {
            background-color: #289043;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .print-button:hover {
            background-color: #1e7a34;
        }
        .back-button {
  background-color: #f0f0f0;
  border: none;
  color: #333;
  font-size: 16px;
  padding: 10px 18px;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.back-button:hover {
  background-color: #e0e0e0;
  transform: translateX(-3px);
}

.back-button:active {
  background-color: #ccc;
}
        
        /* Print-specific styles */
        @media print {
            .print-button-container {
                display: none;
            }
            body {
                background-color: white;
                padding: 0;
            }
            .report-container {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="print-button-container">
        <button class="back-button" onclick="window.location.href='<?= ROOT ?>/Admin/Reports'">&lAarr;</button>
        <button class="print-button" onclick="window.print()">Generate Report</button>
    </div>
    
    <div class="report-container">
        <div class="report-header">
            <h1 class="report-title">Charity Organizations' Details </h1>
            <p class="report-subtitle">Generated on <?php echo date("Y-m-d"); ?></p>
        </div>
        
        <table class="report-table">
            <thead>
                <tr>
                    <th>Org ID</th>
                    <th>Name</th>
                    <th>Contact No</th>
                    <th>Based On</th>
                    <th># Donations Received</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_orders=0;
                
                ?>
                <?php foreach($charity as $org) :?>
                <tr>
                    <?php
                    $total_orders=$total_orders+$org->donation_count;
                    
                    ?>
                    
                    <td># <?=$org->org_id?></td>
                    <td><?=$org->org_name?></td>
                    <td><?=$org->phoneNo?></td>
                    <td><?=$org->city?></td>
                    <td><?=$org->donation_count?></td>
                    
                </tr>
                <?php endforeach;?>
                
            </tbody>
        </table>
        
        <div class="report-summary">
            <div class="summary-item">
                <span class="summary-label">Total No. Of Orders:</span>
                <span class="summary-value"> <?=$total_orders?></span>
            </div>
            
        </div>
        
        <div class="report-footer">
            <p>Confidential - For internal use only - surplusstays </p>
        </div>
    </div>
</body>
</html>

<?php
// Your PHP code below this (if needed)
?>