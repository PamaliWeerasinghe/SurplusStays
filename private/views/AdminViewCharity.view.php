<?php require APPROOT . '/views/includes/htmlHeader.view.php' ?>
<link rel="stylesheet" href="<?= STYLES ?>/adminSidePanel.css" />
<link rel="stylesheet" href="<?= STYLES ?>/admin.css">
<link rel="stylesheet" href="<?= STYLES ?>/adminSeeComplains.css">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"   />
<link rel="stylesheet" href="<?= STYLES ?>/popup.css">
</head>

<body>
    <?php echo $this->view('includes/navbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php require APPROOT . "/views/includes/adminSidePanel.view.php" ?>
            <div class="dashboard">
                <div class="summary">
                    <!-- <div class="notifications-type2">
                        <div class="searchdiv">
                            <input type="text" class="search" placeholder="Search..." />
                            <img src="<?= ASSETS ?>/images/search.png" class="bell2" />
                        </div>

                        <img src="<?= ASSETS ?>/images/Bell.png" class="bell" />
                    </div>
                     -->

                </div>
                <div class="seecomplain-status">
                    <div class="seecomplain-bar">
                        <label>INGOUDE FOUNDATION</label>
                        <label>Org. ID :000<?= $rows->id ?></label>

                    </div>
                    <div class="see-product">
                        <div class="business-response-area-btn">
                            <button class="complain-btn1" onclick="window.location.href='<?=ROOT ?>/AdminCharity/<?=$rows->id?>'">
                                <span class="material-symbols-outlined action-btn edit">
                                    edit_square
                                </span>

                            </button>
                            <!-- <button class="complain-btn2">Reply To Customer</button> -->
                        </div>
                        <div class="main-img-details">
                            <div class="see-product-img">
                                <img src='<?= $rows->picture ?>' />
                            </div>
                            <div class="see-product-details">
                                <div>
                                    <h2><?= $rows->name ?></h2>
                                </div>
                                <div>
                                    <h3>Details </h3>
                                </div>
                                <!-- <div>
                                        <p>
                                        The loaf of bread which was purchased today ,
                                        It was not in a good condition and smelled bad too. 
                                        Photos are attached here with as proof. please be kind enough to 
                                        get actions to reduce these scenarios in the future
                                        </p>
                                    </div> -->
                                <div class="see-product-location">
                                    <div>
                                        <label>
                                            Email : <?= $rows->email ?>
                                        </label>
                                    </div>

                                    <div class="see-product-location-details">
                                        <img src="<?= ASSETS ?>/images/location.png" />

                                        <label><?= $rows->city ?></label>
                                    </div>

                                </div>
                                <div>
                                    <label>Phone : <?= $rows->phoneNo ?></label>
                                </div>
                                <div>
                                    <label>Username : <?= $rows->username ?></label>
                                </div>
                                <div>
                                    <label>Date Joined : <?= $rows->date ?></label>
                                </div>


                            </div>
                        </div>

                        <div class="business-response-area">
                            <div>
                                <h3>Organization Description</h3>
                            </div>
                            <div>
                                <p>
                                    <?= $rows->charity_description ?>
                                </p>
                            </div>
                        </div>


                    </div>











                </div>


            </div>
        </div>
        <!-- <div class="popup-container">
            
            <div class="popup" id="popup">
                <img src="<?= ASSETS ?>/images/404-tick.png" class="popup-img" />
                <h4>Edit Details</h4>
                <div class="popup-div">
                    <form method="post">
                        <input placeholder="ENTER YOUR ORGANIZATION NAME" type="text" name="name" class="input" value='<?= $rows->name ?>'>
                        <input placeholder="ENTER YOUR ORGANIZATION CITY" type="text" name="city" class="input" value=<?= $rows->city ?>>
                        <input placeholder="ENTER AN EMAIL" type="text" name="email" class="input" value=<?= $rows->email ?>>
                        <input placeholder="ENTER A PHONE NUMBER" type="text" name="phone" class="input" value=<?= $rows->phoneNo ?>>
                        <input placeholder="ENTER A USERNAME" type="username" name="username" class="input" value=<?= $rows->username ?>>
                        <input placeholder="ENTER NEW PASSWORD" type="text" name="password" class="input">
                        <input placeholder="RE-ENTER NEW PASSWORD" type="text" name="confirm_password" class="input">
                        <input placeholder="ENTER A BRIEF DESCRIPTION ABOUT THE ORGANIZATION" type="text" name="description" class="input" style="height: 4vh" value='<?= $rows->charity_description ?>'>
                        <input placeholder="ADD ORGANIZATION OF THE LOGO" type="file" name="logo" class="input">
                        <button type="button" class="popup-close-button" onclick="closePopup()" >UPDATE</button>
                    </form>
                </div>

                
            </div>
        </div> -->
        <?php echo $this->view('includes/footer') ?>
        <?php require APPROOT . '/views/includes/htmlFooter.view.php' ?>


        <!-- <script>
            let popup = document.getElementById("popup");

            function openPopup() {
                popup.classList.add("open-popup");
            }

            function closePopup() {
                popup.classList.remove("open-popup");
            }
        </script> -->