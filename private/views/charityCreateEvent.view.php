<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityCreateEvents.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">

            <div class="top-half">
                <div class="top-bar">
                    <div class="notification">
                        <img src="<?=ASSETS?>/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>   
                <div class="event-card">
                    <div class="header">
                        <h2>Create New Event</h2>
                    </div>
                    <form method="POST" enctype="multipart/form-data">

                        <?php if (!empty($errors)): ?>
                            <div class="error alert">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="input-group">
                            <label for="event-name">Event Name :</label>
                            <input value="<?=get_var('event-name')?>" type="text" name="event-name" placeholder="Enter The Name Of The Event">
                        </div>

                        <div class="input-group">
                            <label for="event-goal">Goal Of The Event :</label>
                            <input type="text" value="<?=get_var('event-goal')?>"  name="event-goal" placeholder="Enter The Goal Of The Event">
                        </div>

                        <div class="input-group">
                            <label for="description">Description :</label>
                            <textarea value="<?=get_var('description')?>" name="description" placeholder="Provide A Brief Description Of The Event"></textarea>
                        </div>

                        <div class="input-group">
                            <label for="district">Select District:</label>
                            <select value="<?=get_var('district')?>" name="district" class="styled-select">
                                <option value="Ampara">Ampara</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Badulla">Badulla</option>
                                <option value="Batticaloa">Batticaloa</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Galle">Galle</option>
                                <option value="Gampaha">Gampaha</option>
                                <option value="Hambantota">Hambantota</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Kalutara">Kalutara</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Kegalle">Kegalle</option>
                                <option value="Kilinochchi">Kilinochchi</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Mannar">Mannar</option>
                                <option value="Matale">Matale</option>
                                <option value="Matara">Matara</option>
                                <option value="Monaragala">Monaragala</option>
                                <option value="Mullaitivu">Mullaitivu</option>
                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Puttalam">Puttalam</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Trincomalee">Trincomalee</option>
                                <option value="Vavuniya">Vavuniya</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="location">Location :</label>
                            <input type="text" value="<?=get_var('location')?>" name="location" placeholder="Enter The Location Where The Event Will Take Place">
                        </div>

                        <div class="input-group">
                            <label for="start-date">Start Date And Time :</label>
                            <input type="datetime-local" value="<?=get_var('start-date')?>" name="start-date">
                        </div>

                        <div class="input-group">
                            <label for="end-date">Ending Date And Time :</label>
                            <input type="datetime-local" value="<?=get_var('end-date')?>" name="end-date">
                        </div>

                        <div class="input-group upload-group">
                            <label>Upload Images : <small>You Can Add Up To 5 Images.</small></label>
                            <div class="upload-wrapper">
                                <label for="upload-1">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                </label>
                                <input type="file" id="upload-1" name="upload-1" style="display: none;">

                                <label for="upload-2">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-2">
                                </label>
                                <input type="file" id="upload-2" name="upload-2" style="display: none;">

                                <label for="upload-3">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-3">
                                </label>
                                <input type="file" id="upload-3" name="upload-3" style="display: none;">

                                <label for="upload-4">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-4">
                                </label>
                                <input type="file" id="upload-4" name="upload-4" style="display: none;">

                                <label for="upload-5">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-5">
                                </label>
                                <input type="file" id="upload-5" name="upload-5" style="display: none;">
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="required-food">Add Required Food : <small>Optional</small></label>
                            <input type="text" value="<?=get_var('required-food')?>" name="required-food" placeholder="Enter Food Items That Are Needed">
                        </div>

                        <div class="button-group">
                            <button class="btn-create">Create Event</button>
                            <button type="reset" class="btn-clear">Clear All</button>
                            <button type="button" class="btn-cancel">Cancel</button>
                        </div>
                    </form>
                </div>          
            </div>
        </div>
    </div>

    <?php echo $this->view('includes/footer')?>
    
    <!-- JavaScript to Show Preview -->
    <script>
    document.getElementById('upload-1').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview-1').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    document.getElementById('upload-2').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview-2').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    document.getElementById('upload-3').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview-3').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    document.getElementById('upload-4').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview-4').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    document.getElementById('upload-5').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview-5').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>
</html>