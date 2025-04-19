<link rel="stylesheet" href="<?=STYLES?>/navbar.css">
    <nav class="navbar">
        <ul class="nav-links-left">
            <li><a href="<?=ROOT?>">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li class="dropdown">
                <a href="#">Shop <li><a href="#"><img src="<?=ASSETS?>/icons/sortdown-icon.png" class="dropdown-icon" alt="cart icon"></a></li></a>
            </li>
        </ul>
        <div class="logo">
            <img src="<?=ASSETS?>/images/nav-logo.png" alt="Logo">
        </div>
        <ul class="nav-links-right">
            <li><a href="#">Contact Us</a></li>
            <li><a href="#"><img class="profile-img" src="<?=ASSETS?>/businessImages/<?=basename(Auth::getUserPicture())?>" alt="profile icon"></a></li>
            <li><a href="#"><img src="<?=ASSETS?>/icons/heart-icon.png" alt="heart icon"></a></li>
            <li><a href='<?=ROOT?>/logout'>Logout</a></li>
        </ul>
    </nav>