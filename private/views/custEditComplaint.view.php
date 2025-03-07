<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityCreateEvents.css">
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerDashboard.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/customerSidepanel')?>
        <div class="container-right">

            <div class="top-half">
                <div class="top-bar">
                    <div class="notification">
                        <img src="<?=ROOT?>/assets/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>   
                <div class="event-card">
                    <div class="header">
                        <h2>Edit Event</h2>
                    </div>
                    <?php if (($row)): ?>
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
                                <label for="order-id">Order ID :</label>
                                <input value="<?=get_var('order-id',$row[0]->order_id)?>" type="text" name="order-id" placeholder="Enter The Name Of The Event">
                            </div>

                            <div class="input-group">
                                <label for="shopName">Shop Name :</label>
                                <input type="text" value="<?=get_var('shopName',$row[0]->shop)?>"  name="shopName" placeholder="Enter The Goal Of The Event">
                            </div>

                            <div class="input-group">
                                <label for="complaint">Description Of Your Complaint :</label>
                                <textarea name="complaint" placeholder="Enter Your Complaint"><?=get_var('complaint', $row[0]->feedback)?></textarea>

                            </div>

                            <div class="input-group">
                                <label for="sdate">Date Of Purchase :</label>
                                <input type="date" value="<?=get_var('date',$row[0]->date)?>" name="date">
                            </div>

                            <div class="input-group upload-group">
                                <label>Images Related To The Complaint : <small>You Can Add Up To 5 Images.</small></label>
                                <div class="upload-wrapper">
                                    <?php 
                                        // Get the images from the pictures array
                                        $eventPictures = explode(',', $row[0]->pictures);
                                    ?>
                                    <label for="upload-1">
                                        <?php if(!empty($eventPictures[0])):?>
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[0]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                            <img class="delete-btn" src="<?=ASSETS?>/icons/delete-button.png" alt="" onclick="">
                                        <?php else:?>
                                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-1">
                                        <?php endif;?>
                                    </label>
                                    <input type="file" id="upload-1" name="upload-1" style="display: none;">
                                    <input type="hidden" id="delete-1" name="delete-1" value="false">


                                    <label for="upload-2">
                                        <?php if(!empty($eventPictures[1])):?>
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[1]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-2">
                                            <img class="delete-btn" src="<?=ASSETS?>/icons/delete-button.png" alt="">
                                        <?php else:?>
                                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-2">
                                        <?php endif;?>
                                    </label>
                                    <input type="file" id="upload-2" name="upload-2" style="display: none;">
                                    <input type="hidden" id="delete-2" name="delete-2" value="false">

                                    <label for="upload-3">
                                        <?php if(!empty($eventPictures[2])):?>
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[2]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-3">
                                            <img class="delete-btn" src="<?=ASSETS?>/icons/delete-button.png" alt="">
                                        <?php else:?>
                                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-3">
                                        <?php endif;?>
                                    </label>
                                    <input type="file" id="upload-3" name="upload-3" style="display: none;">
                                    <input type="hidden" id="delete-3" name="delete-3" value="false">

                                    <label for="upload-4">
                                        <?php if(!empty($eventPictures[3])):?>
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[3]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-4">
                                            <img class="delete-btn" src="<?=ASSETS?>/icons/delete-button.png" alt="">
                                        <?php else:?>
                                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-4">
                                        <?php endif;?>
                                    </label>
                                    <input type="file" id="upload-4" name="upload-4" style="display: none;">
                                    <input type="hidden" id="delete-4" name="delete-4" value="false">

                                    <label for="upload-5">
                                        <?php if(!empty($eventPictures[4])):?>
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventPictures[4]) ?>" alt="Upload Image" class="upload-icon" id="profilePreview-5">
                                            <img class="delete-btn" src="<?=ASSETS?>/icons/delete-button.png" alt="">
                                            
                                        <?php else:?>
                                            <img src="<?=ASSETS?>/icons/uploadArea.png" alt="Upload Image" class="upload-icon" id="profilePreview-5">
                                        <?php endif;?>
                                    </label>
                                    <input type="file" id="upload-5" name="upload-5" style="display: none;">
                                    <input type="hidden" id="delete-5" name="delete-5" value="false">
                                </div>
                            </div>

                            <div class="button-group">
                                <button type="submit" class="btn-create">Edit Event</button>
                                <button type="reset" class="btn-clear">Clear All</button>
                                <button type="button" class="btn-cancel" onclick="window.location.href='<?=ROOT?>/customer/manageComplaints'">Cancel</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <h3>That event was not found</h3>   
                    <?php endif; ?>
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

     document.querySelectorAll('.delete-btn').forEach((btn, index) => {
        btn.addEventListener('click', function(event) {
            event.preventDefault();

            // Find the associated image and set the input to empty
            let uploadInput = document.getElementById('upload-' + (index + 1));
            uploadInput.value = ''; // Clear the file input

            // Hide the image preview and the delete button
            let imagePreview = document.getElementById('profilePreview-' + (index + 1));
            imagePreview.src = '<?=ASSETS?>/icons/uploadArea.png'; // Reset the preview image
            this.style.display = 'none'; // Hide the delete button
        });
    });

    document.querySelectorAll('.delete-btn').forEach((btn, index) => {
        btn.addEventListener('click', function(event) {
            event.preventDefault();

            // Find the associated hidden input and set it to indicate deletion
            let deleteInput = document.getElementById('delete-' + (index + 1));
            deleteInput.value = 'delete.png'; // Set the deletion value

            // Hide the image preview and the delete button
            let imagePreview = document.getElementById('profilePreview-' + (index + 1));
            imagePreview.src = '<?=ASSETS?>/icons/uploadArea.png'; // Reset the preview image
            this.style.display = 'none'; // Hide the delete button
        });
    });
    
    document.querySelector('.btn-clear').addEventListener('click', function(e) {
        e.preventDefault();  // Prevent form submission
        
        // Clear all text, textarea, and select inputs
        document.querySelectorAll('input[type="text"], input[type="datetime-local"], textarea, select').forEach(function(input) {
            input.value = ''; 
        });

        // Clear file inputs and image previews
        document.querySelectorAll('input[type="file"]').forEach(function(input) {
            input.value = '';  // Reset file input
        });
        document.querySelectorAll('.upload-icon').forEach(function(icon) {
            icon.src = '<?=ASSETS?>/icons/uploadArea.png';  // Reset image preview
        });

        // Clear delete button visibility
        document.querySelectorAll('.delete-btn').forEach(function(btn) {
            btn.style.display = 'none';  // Hide delete buttons
        });

        // Reset any hidden delete inputs to their initial values
        document.querySelectorAll('input[type="hidden"]').forEach(function(hiddenInput) {
            hiddenInput.value = 'false'; // Reset hidden delete flags
        });
    });


    </script>
    
</body>
</html>