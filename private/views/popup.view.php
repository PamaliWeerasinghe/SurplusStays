<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=STYLES?>/popup.css">
</head>
<body>
    <div class="container">
        <button type="submit" class="btn" onclick="openPopup()">Submit</button>
        <div class="popup" id="popup">
            <img src="<?=ASSETS?>/images/404-tick.png"/>
            <h2>Successfull!</h2>
            <p>Your details has been successfully submitted.</p>
            <button type="button" onclick="closePopup()">OK</button>
        </div>
    </div>

<script>
    let popup=document.getElementById("popup");
    function openPopup(){
        popup.classList.add("open-popup");
    }
    function closePopup(){
        popup.classList.remove("open-popup");
    }
</script>
</body>

</html>