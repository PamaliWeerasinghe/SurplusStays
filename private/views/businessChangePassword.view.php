<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?= STYLES ?>/businessEditProduct.css">
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                </div>

                <div class="main-box">
                    <div class="header">
                        <h2>Change Password</h2>
                    </div>

                    <form method="POST" enctype="multipart/form-data">

                        <?php if (!empty($errors)): ?>
                            <div class="error alert">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                       
                        <div class="input-group">
                            <label for="product-name">Current password :</label>
                            <input type="password" value="<?= get_var('current_password') ?>" name="current_password">
                        </div>
                        
                        <div class="input-group">
                            <label for="product-name">New password :</label>
                            <input type="password" value="<?= get_var('password') ?>" name="password" placeholder="ENTER A PASSWORD">
                        </div>

                        <div class="input-group">
                            <label for="product-name">Confirm new password :</label>
                            <input type="password" value="<?= get_var('confirm_password') ?>" name="confirm_password" placeholder="RE-ENTER A PASSWORD">
                        </div>

                        <div class="button-group">
                            <a href="<?= ROOT ?>/business/profile">
                                <button type="button" class="btn-cancel">Cancel</button>
                            </a>
                            <button type="submit" class="btn-create">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>

        

</body>

</html>