<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    
    
    <link rel="stylesheet" href="../../public/assets/styles/CustSidePanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/CustTopPanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/CustPayment.css">
    
</head>

<body style="font-family: 'Outfit', sans-serif;">
    <div class="container">
        <!-- Sidebar -->
        <div class="side-nav">
            <div class="profile-section">
                <img src="../../public/assets/images/sample_profile_pic.png" alt="Profile Image" class="profile-image">
                <h2>Hi Janitha!</h2>
            </div>
            <ul class="nav-links">
                <li class="nav-item "><a href="#">Dashboard</a></li>
                <li class="nav-item"><a href="#">Browse Shops</a></li>
                <li class="nav-item"><a href="#">Cart</a></li>
                <li class="nav-item"><a href="#">Wishlist</a></li>
                <li class="nav-item active"><a href="#">Orders</a></li>
                <li class="nav-item"><a href="#">View Payment History</a></li>
                <li class="nav-item"><a href="#">Profile</a></li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Top Navigation -->
            <div class="top-nav">
                <div class="top-bar">
                    <div class="search-bar">
                        <input type="text" placeholder="Search..." />
                    </div>
                    <div class="notification">
                        <img src="../../public/assets/images/Bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div> 
            </div>

            <!-- main content -->
            <div class="content">
                <div class="box">
                    <div class="box-header">Payment</div>
                    <div class="box-subheading" style="background-color: white;">
                        <div class="payment-text">CREDIT CARD/DEBIT CARD</div>
                        <div class="payment-icons">
                            <img src="visa.png" alt="Visa" class="icon">
                            <img src="mastercard.png" alt="Mastercard" class="icon">
                        </div>
                    </div>


                    <div class="payment-form" style="margin: 40px;">
                    <div class="payment-form">
                        <div class="form-group">
                        <label for="card-number">Card Number:</label>
                        <input type="text" id="card-number" placeholder="Card Number">
                        </div>
                        <div class="form-group">
                        <label for="name-on-card">Name On Card:</label>
                        <input type="text" id="name-on-card" placeholder="Name On Card">
                        </div>
                        <div class="form-group-row">
                        <div class="form-group">
                            <label for="expiration-date">Expiration Date:</label>
                            <input type="text" id="expiration-date" placeholder="Expiration Date (MM/YY)">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV:</label>
                            <input type="text" id="cvv" placeholder="CVV">
                        </div>
                        </div>
                    </div>
                    </div>

                    
                </div>
            </div>


        </div>
    </div>
</body>
</html>
