<link rel="stylesheet" href="<?=STYLES?>/navbar.css">
    <nav class="navbar">
        <ul class="nav-links-left">
            <li><a href="<?=ROOT?>">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li class="dropdown">
                <a href="<?=ROOT?>/customer">Shop <li><a href="#"><img src="<?=ASSETS?>/icons/sortdown-icon.png" class="dropdown-icon" alt="cart icon"></a></li></a>
            </li>
        </ul>
        <div class="logo">
            <img src="<?=ASSETS?>/images/nav-logo.png" alt="Logo">
        </div>
        <ul class="nav-links-right">
            <li><a href="#">Contact Us</a></li>
            <?php if (Auth::getcharity_description() != "Unknown" && !empty(Auth::getcharity_description())):?>
                <li><a href="<?=ROOT?>/charity"><img class="profile-img" src="<?=ASSETS?>/charityImages/<?=basename(Auth::getUserPicture())?>" alt="profile icon"></a></li>
            <?php elseif (Auth::getlname() != "Unknown" && !empty(Auth::getlname())):?>
                <li><a href="<?=ROOT?>/customer"><img class="profile-img" src="<?=ASSETS?>/customerImages/<?=basename(Auth::getUserPicture())?>" alt="profile icon"></a></li>
            <?php elseif (Auth::getbusiness_type() != "Unknown" && !empty(Auth::getbusiness_type())):?>
                <li><a href="<?=ROOT?>/customer"><img class="profile-img" src="<?=ASSETS?>/businessImages/<?=basename(Auth::getUserPicture())?>" alt="profile icon"></a></li>
            <?php else:?>
                <li><a href="#"><img src="<?=ASSETS?>/images/sample_profile_pic.png" alt="profile icon"></a></li>
                
            <?php endif;?>    
            <li><a href="#"><img src="<?=ASSETS?>/icons/heart-icon.png" alt="heart icon"></a></li>
            <li><a href="<?=ROOT?>/logout">Logout</a></li>
        </ul>

    </nav>
