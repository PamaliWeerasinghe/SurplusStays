<?php
// Your PHP code above this (if needed)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surplus Saved Via Notifications</title>
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
            justify-content: flex-end;
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
        <button class="print-button" onclick="window.print()">Generate Report</button>
    </div>
    
    <div class="report-container">
        <div class="report-header">
            <h1 class="report-title">Surplus Saved From Wastage</h1>
            <p class="report-subtitle">Generated on <?php echo date("Y-m-d"); ?></p>
        </div>
        
        <table class="report-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Business</th>
                    <th>Qty Available</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                $qty_avail=0;
                
                ?>
                <?php foreach($products as $product) :?>
                <tr>
                    <?php
                    $qty_avail=$qty_avail+$product->qty_avail;
                    
                    ?>
                    
                    <td><?=$product->product_name?></td>
                    <td><?=$product->bus_name?></td>
                    <td><?=$product->qty_avail?></td>
                    
                </tr>
                <?php endforeach;?>
                
            </tbody>
        </table>
        
        <div class="report-summary">
            <div class="summary-item">
                <span class="summary-label">Total Quantity Available:</span>
                <span class="summary-value"> <?=$qty_avail?></span>
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