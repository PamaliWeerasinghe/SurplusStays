<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/admin.css">
    <link rel="stylesheet" href="../../SURPLUSSTAYS/public/assets/styles/adminDashboard.css">
</head>

<body>
    <div class="main-div">
        <!-- include the navbar -->
        <div class="sub-div-1">
            <!-- included the admin side panel -->
            <?php require APPROOT."/views/includes/adminSidePanel.view.php"?>
            <div class="dashboard">
                <div class="summary">
                    <div class="notifications"><img src="../../SURPLUSSTAYS/public/assets/images/Bell.png" /></div>
                    <div class="summary-blocks">
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="../../SURPLUSSTAYS/public/assets/images/manifest.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Remove Users</label>
                                <label class="summaries-2-label2">25</label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="../../SURPLUSSTAYS/public/assets/images/manifest.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Complaints</label>
                                <label class="summaries-2-label2">4500</label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="../../SURPLUSSTAYS/public/assets/images/box-mark.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Donations</label>
                                <label class="summaries-2-label2">7900</label>
                            </div>
                        </div>
                        <div class="summaries">
                            <div class="summaries-1">
                                <img src="../../SURPLUSSTAYS/public/assets/images/rating.png" />
                            </div>
                            <div class="summaries-2">
                                <label class="summaries-2-label1">Customers</label>
                                <label class="summaries-2-label2">568</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-status">
                    <div class="order">
                        <label>Order Status</label>
                    </div>
                    <div class="order-dropdown">
                        <label class="order-status-label2">Surplus food Secured</label>
                        <select>
                            <option>This Week</option>
                        </select>
                    </div>
                    <div class="order-status-chart">
                        <div class="chart">
                            <div class="bar" style="--value: 70%;"></div>
                            <div class="bar" style="--value: 50%;"></div>
                            <div class="bar" style="--value: 30%;"></div>
                            <div class="bar" style="--value: 100%;"></div>
                            <div class="bar" style="--value: 60%;"></div>
                            <div class="bar" style="--value: 80%;"></div>
                            <div class="bar" style="--value: 50%;"></div>

                        </div>
                        <div class="day-block">
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                            <div class="day">Sun</div>
                        </div>

                    </div>

                </div>

                <div class="product-status">
                    <div>
                        <label>Recent Expiration Products</label>
                        <div class="order-dropdown">
                        <div></div>
                        <select>
                            <option>By 2 weeks</option>
                        </select>
                    </div>
                    </div>
                   
                    <div class="product-summaries">
                            <div class="product-row">
                                <div class="product-item">
                                    <div>
                                        <img src="../../SURPLUSSTAYS/public/assets/images/bread.png"/>
                                    </div>
                                    <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Bread</label>
                                    <label class="product-summaries-label2">Rs. 27.5</label>
                                    </div>

                                </div>
                                <div class="product-item">
                                    <div>
                                        <img src="../../SURPLUSSTAYS/public/assets/images/rice.png"/>
                                    </div>
                                    <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Rice</label>
                                    <label class="product-summaries-label2">Rs. 105.51</label>
                                    </div>

                                </div>
                                <div class="product-item">
                                    <div>
                                        <img src="../../SURPLUSSTAYS/public/assets/images/chips.png"/>
                                    </div>
                                    <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Chips</label>
                                    <label class="product-summaries-label2">Rs. 55</label>
                                    </div>

                                </div>
                            </div>
                            <div class="product-row">
                                <div class="product-item">
                                    <div>
                                        <img src="../../SURPLUSSTAYS/public/assets/images/popcorn.png"/>
                                    </div>
                                    <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Popcorn</label>
                                    <label class="product-summaries-label2">Rs. 32</label>
                                    </div>

                                </div>
                                <div class="product-item">
                                    <div>
                                        <img src="../../SURPLUSSTAYS/public/assets/images/pasta.png"/>
                                    </div>
                                    <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Pasta</label>
                                    <label class="product-summaries-label2">Rs. 75</label>
                                    </div>

                                </div>
                                <div class="product-item">
                                    <div>
                                        <img src="../../SURPLUSSTAYS/public/assets/images/peanuts.png"/>
                                    </div>
                                    <div class="product-summaries-item">
                                    <label class="product-summaries-label1">Nuts</label>
                                    <label class="product-summaries-label2">Rs. 28</label>
                                    </div>

                                </div>
                            </div>
                    </div>
                    <div class="next">
                        <img src="../../SURPLUSSTAYS/public/assets/images/down.png"/>
                    </div>

                </div>
               

                <div class="complaints-status">
                    <div>
                        <label>Recent Complaints Recieved</label>
                       
                    </div>
                    <div class="table-container">
  <table class="order-table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Customer</th>
        <th>Product</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>14.02.2024</td>
        <td>Umanga Padukka</td>
        <td>Full Bread</td>
        <td><button class="completed">Completed</button></td>
      </tr>
      <tr>
        <td>20.02.2024</td>
        <td>Nadun Wickramasinghe</td>
        <td>Fried Rice(Dinner)</td>
        <td><button class="take-action">Take Action</button></td>
      </tr>
      <tr>
        <td>07.02.2024</td>
        <td>Pamali Weerasinghe</td>
        <td>Orange Juice</td>
        <td><button class="completed">Completed</button></td>
      </tr>
      <tr>
        <td>27.02.2024</td>
        <td>Lochana Samarasekara</td>
        <td>2*Green Chips + 2 Bread</td>
        <td><button class="take-action">Take Action</button></td>
      </tr>
    </tbody>
  </table>
</div>


                   
                   
                    <div class="next">
                        <img src="../../SURPLUSSTAYS/public/assets/images/down.png"/>
                    </div>

                </div>

            </div>
            
        </div>
    </div>
</body>

</html>