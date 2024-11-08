<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>
</head>
<body>
<link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/login.css">
<?php echo $this->view('includes/navbar')?>
    <div class="container">
        <input type="text">
    </div>

    <?php
    echo "<pre>";
    if (isset($rows)) {
        print_r($rows);
    } else {
        echo "No data available";
    }
?>
<?php echo $this->view('includes/footer')?>
</body>
</html>