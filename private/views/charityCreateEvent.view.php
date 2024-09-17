<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityCreateEvents.css">
</head>
<body>
    <?php echo $this->view('includes/navbar')?>

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
                    <form action="#" method="POST">
                        <div class="input-group">
                            <label for="event-name">Event Name :</label>
                            <input type="text" id="event-name" name="event-name" placeholder="Enter The Name Of The Event">
                        </div>

                        <div class="input-group">
                            <label for="event-goal">Goal Of The Event :</label>
                            <select id="event-goal" name="event-goal">
                                <option value="" disabled selected>Enter The Main Goal Of The Event</option>
                                <option value="Goal 1">Goal 1</option>
                                <option value="Goal 2">Goal 2</option>
                                <option value="Goal 3">Goal 3</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="description">Description :</label>
                            <textarea id="description" name="description" placeholder="Provide A Brief Description Of The Event"></textarea>
                        </div>

                        <div class="input-group">
                            <label for="district">Select District :</label>
                            <select id="district" name="district">
                                <option value="Colombo">Colombo</option>
                                <option value="District 2">District 2</option>
                                <option value="District 3">District 3</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="location">Location :</label>
                            <input type="text" id="location" name="location" placeholder="Enter The Location Where The Event Will Take Place">
                        </div>

                        <div class="input-group">
                            <label for="start-date">Start Date And Time :</label>
                            <input type="datetime-local" id="start-date" name="start-date">
                        </div>

                        <div class="input-group">
                            <label for="end-date">Ending Date And Time :</label>
                            <input type="datetime-local" id="end-date" name="end-date">
                        </div>

                        <div class="input-group upload-group">
                            <label>Upload Images : <small>You Can Add Up To 5 Images.</small></label>
                            <div class="upload-wrapper">
                                <label for="upload-1">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon">
                                </label>
                                <input type="file" id="upload-1" name="upload-1" style="display: none;">

                                <label for="upload-2">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon">
                                </label>
                                <input type="file" id="upload-2" name="upload-2" style="display: none;">

                                <label for="upload-3">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon">
                                </label>
                                <input type="file" id="upload-3" name="upload-3" style="display: none;">

                                <label for="upload-4">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon">
                                </label>
                                <input type="file" id="upload-4" name="upload-4" style="display: none;">

                                <label for="upload-5">
                                    <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon">
                                </label>
                                <input type="file" id="upload-5" name="upload-5" style="display: none;">
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="required-food">Add Required Food : <small>Optional</small></label>
                            <input type="text" id="required-food" name="required-food" placeholder="Enter Food Items That Are Needed">
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-create">Create Event</button>
                            <button type="reset" class="btn-clear">Clear All</button>
                            <button type="button" class="btn-cancel">Cancel</button>
                        </div>
                    </form>
                </div>          
            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>
    
</body>
</html>