<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= STYLES ?>/viewCustomerPopup.css">
</head>

<body>
    <div class="popup-container" id="rcpopup-container">

        <div class="popup" id="rcpopup">
            <div class="msg-div">
                <div class="close-btn" onclick="closeCustomer()">&times;</div>
            </div>
            <div class="view-customer-location">
                        <iframe src="https://www.google.com/maps/embed?pb=YourMapURL"
                        width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                        </div>
            <div class="reply-box">
                <div class="name-img" >
                  
                    <div class="profile-img-popup">
                        <div class="view-customer-row1">
                            <div class="view-customer-img">
                                <img src="<?=ASSETS?>/images/woman-user (1).png"/>
                            </div>
                            <div class="view-customer-details">
                                <h3>PERSONAL INFORMATION</h3>
                                <label>Name : <label id="fname"></label>&nbsp;<label id="lname"></label></label></label>
                                <label>Email : &nbsp;<label id="email"></label></label>
                                <label>Phone : <label id="phoneNo"></label></label>
                            </div>
                        </div>
                        <div class="view-customer-row2">
                            <label>No. of Orders : <label id="orders"></label></label>
                            <!-- <label>No. of Items  : 25</label> -->
                        </div>
                        <div class="view-customer-row3">

                        </div>
                        <div class="view-customer-row4">
                            <h3>COMPLAINTS</h3>
                        </div>
                        <div class="view-customer-row5">
                        <table class="order-table">
                        <thead>
                           
                        </thead>
                        <tbody>
                            
                            <!-- <tr> -->
                
                                <!-- <td># 01</td>
                                <td>ddf dkcd cdbchdbfdsjdskc</td>
                                <td>2025-01-12 4:10:02</td>
                                
                                    <td style="text-align: center;"><button class="take-action">Attend</button></td>
                                <td style="text-align: center;">
                                    
                                    <button 
                                    class="see-complain" 
                                    style="color:grey;background-color:transparent;border-style:solid;border-color:grey"
                                    onclick="window.location.href='<?=ROOT?>/Admin/ViewComplain/'"
                                    >
                                    See Complain
                                    </button>
                                </td> -->
                                
                            <!-- </tr> -->
                              
                           
                            
                            
                        </tbody>
                        </table>
                        </div>

                       
                      
                    </div>
                    <div class="profile-details">
                        <h3>RECENTLY PURCHASED</h3>
                        <div class="profile-section-1">
                           
                        </div>
                        <div class="profile-section-2">

                        </div>
                    </div>
               
                </div>  
                
            </div>
            
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/adminViewCustomerDetails.js"></script>

</body>

</html>