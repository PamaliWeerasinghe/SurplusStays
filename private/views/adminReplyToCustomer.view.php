<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= STYLES ?>/replypopup.css">
</head>

<body>
    <div class="popup-container" id="rcpopup-container">

        <div class="popup" id="rcpopup">
            <div class="msg-div">
                <div class="close-btn" onclick="closePopup()">&times;</div>
            </div>
            <form action="<?= ROOT ?>/Admin/ReplyToComplaint" method="POST" id="form1">
            <div class="reply-box">
                <img src="<?= ASSETS ?>/icons/reply.png" class="popup-img" />
                
                <div>
                <textarea type="text" class="msg" id="replyText" name="feedback"></textarea>
                    <input type="hidden" id="complaintID" name="id"/>
                    
                
                <button type="submit" class="send-icon" onclick="sendReply();">
                        <img src="<?= ASSETS ?>/icons/send-msg.png" class="send-icon"/>
                </button>  
                </div>  
                
            </div>
            </form>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/adminManageCustomers.js"></script>

</body>

</html>