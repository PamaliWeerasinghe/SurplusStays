<?php require APPROOT . '/views/customerDeleteConfirmation.view.php'?>
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
            <div class="edit-delete">
                <span class="material-symbols-outlined" style="z-index:999;" id="edit_customer" >
                    edit_square
                </span>
                <span class="material-symbols-outlined action-btn deactivate" style="color: red;" id="delete_customer">
                    person_remove
                </span>
                <input type="hidden" id="hidden_id"/>
            </div>
           
            <!-- <div class="view-customer-location">
                        <iframe src="https://www.google.com/maps/embed?pb=YourMapURL"
                        width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                        </div> -->
            <div class="reply-box">
                <div class="name-img" >
                  
                    <div class="profile-img-popup">
                        <div class="view-customer-row1">
                            <div class="view-customer-img">
                                <img src="" id="customerImg"/>
                            </div>
                            <div class="view-customer-details">
                                <h3>ORGANIZATION INFORMATION</h3>
                                <label>Name : <label id="name"></label></label>
                                <label>Email : &nbsp;<label id="email"></label></label>
                                <label>Phone : <label id="phoneNo"></label></label>
                            </div>
                        </div>
                        <div class="view-customer-row2">
                            <label>No. of Donations : <label id="orders"></label></label>
                            <!-- <label>No. of Items  : 25</label> -->
                        </div>
                        <div class="view-customer-row3">

                        </div>
                        <div class="view-customer-row4">
                            <h3>DONATIONS</h3>
                        </div>
                        <div class="view-customer-row5">
                        <table class="order-table">
                        <tbody> 
                            
                        </tbody>
                        </table>
                        </div>

                       
                      
                    </div>
                    <div class="profile-details">
                        <h3>RECENTLY DONATED BUSINESSES</h3>
                        <div class="profile-section-1" id="profile-section-1">
                           
                        </div>
                        <div class="profile-section-2" id="profile-section-2">

                        </div>
                    </div>
               
                </div>  
                
            </div>
            
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/adminViewCharityDetails.js"></script>
    <script src="<?=ROOT?>/assets/js/deletePopup.js"></script>
</body>

</html>