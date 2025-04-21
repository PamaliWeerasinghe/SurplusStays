<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= STYLES ?>/wishlistPopup.css">
</head>

<body>
    <div class="popup-container" id="wishlist-popup-container" >

        <div class="popup" id="wishlist-popup" style="width: 40%;">
            
            <h2>Are you Sure ?</h2>
            <p>The product will be removed from your wishlist</p>
            <input type="hidden" id="wishlistpopupRowId"/>
            <form action="" method="POST">
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