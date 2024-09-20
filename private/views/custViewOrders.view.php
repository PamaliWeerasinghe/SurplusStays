<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View orders</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../public/assets/styles/CustSidePanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/CustTopPanel.css">
    <link rel="stylesheet" href="../../public/assets/styles/custViewOrders.css">

    <style>
        .container {
            display: flex;
            height: 100vh;
        }

        .side-nav {
            width: 250px; 
            background-color: #F0F4F8;
            padding: 20px;
        }

        .main-content {
            flex-grow: 1; 
            display: flex;
            flex-direction: column; /* Stack top nav and the content vertically */
            background-color: #ffffff;
        }

        .top-nav {
            background-color: #1B4332;
            padding: 15px;
            color: white;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar input {
            padding: 8px;
            border-radius: 5px;
            border: none;
            width: 200px;
        }

        .notification img {
            width: 25px;
            cursor: pointer;
        }

        .content {
            padding: 20px;
            color: #333;
            font-size: 1.5rem;
        }
    </style>
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
                <li class="nav-item"><a href="#">Manage Events</a></li>
                <li class="nav-item"><a href="#">Donations</a></li>
                <li class="nav-item"><a href="#">Browse Shops</a></li>
                <li class="nav-item active"><a href="#">Orders</a></li>
                <li class="nav-item"><a href="#">Reports</a></li>
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

            <!-- Main Content -->
            <div class="content">
        <h1>Orders</h1>
        <table>
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Date</th>
                    <th>Shop</th>
                    <th>Product</th>
                    <th>Payment</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#155</td>
                    <td>20.02.2024</td>
                    <td>Keels Borella</td>
                    <td>4*Nuts</td>
                    <td>Pay On Pickup</td>
                    <td>Rs 112 <span class="status processing">Processing</span></td>
                </tr>
                <tr>
                    <td>#156</td>
                    <td>07.02.2024</td>
                    <td>Wasana Bakers</td>
                    <td>6*Pasta</td>
                    <td>Online Payment</td>
                    <td>Rs 144.50 <span class="status processing">Processing</span></td>
                </tr>
                <tr>
                    <td>#156</td>
                    <td>07.02.2024</td>
                    <td>Food City Mathara</td>
                    <td>6*Pasta</td>
                    <td>Online Payment</td>
                    <td>Rs 144.50 <span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>#156</td>
                    <td>07.02.2024</td>
                    <td>P&S</td>
                    <td>6*Pasta</td>
                    <td>Online Payment</td>
                    <td>Rs 144.50 <span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>#156</td>
                    <td>07.02.2024</td>
                    <td>Keels Borella</td>
                    <td>6*Pasta</td>
                    <td>Online Payment</td>
                    <td>Rs 144.50 <span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>#156</td>
                    <td>07.02.2024</td>
                    <td>Kithmal Damsara</td>
                    <td>6*Pasta</td>
                    <td>Online Payment</td>
                    <td>Rs 144.50 <span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>#156</td>
                    <td>07.02.2024</td>
                    <td>Kithmal Damsara</td>
                    <td>6*Pasta</td>
                    <td>Online Payment</td>
                    <td>Rs 144.50 <span class="status completed">Completed</span></td>
                </tr>
            </tbody>
        </table>
    </div>
        </div>
    </div>
</body>
</html>
