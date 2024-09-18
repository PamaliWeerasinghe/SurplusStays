<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<title><?php echo SITENAME ?></title>

<link rel="stylesheet" href="<?= STYLES ?>/home_section1.css">
</head>

<body>
    <?php echo $this->view('includes/navbar') ?>
    <div class="search-section">
        <div class="searchdiv">
            <input type="text" class="search" placeholder="Search..." />
            <img src="<?= ASSETS ?>/images/search.png" class="bell2" />
            <button class="reg-btn">
            Register
        </button>
        </div>
        
    </div>
    <div class="landing-section">

    </div>


    <?php echo $this->view('includes/footer') ?>
    <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>