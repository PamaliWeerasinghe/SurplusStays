<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= STYLES ?>/popup.css">
</head>

<body>
    <div class="popup-container" id="popup-container" >

        <div class="popup" id="popup" style="width: 40%;">
            <img src="<?= ASSETS ?>/images/delete.png" class="popup-img" />
            <h2>Are you Sure ?</h2>
            <p>All the details related to the customer will be removed</p>
            <input type="hidden" id="popupRowId"/>
            <form action="<?=ADMIN ?>/deleteCustomer/" method="POST">
                <div class="popup-btn-div">

                    <button type="submit" class="popup-yes-button">Yes</button>

                    <button type="button" class="popup-close-button" onclick="closedeletePopup()">No</button>



                </div>
            </form>
        </div>
    </div>


</body>
<script src="<?= ROOT ?>/assets/js/adminViewCustomerDetails.js"></script>

</html>