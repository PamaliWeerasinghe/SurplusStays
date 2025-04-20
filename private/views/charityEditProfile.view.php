<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Charity Profile</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityEditProfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-half">
                <div class="top-bar">
                </div>
                <form method="POST" enctype="multipart/form-data" >
                    <div class="charity-info-card">
                        <div class="header">
                            <h2><i class="fas fa-edit"></i> Edit Charity Information</h2>
                        </div>
                        
                        <div class="section charity-details">
                            <h3>Charity Details</h3>
                            <div class="charity-overview">
                                <div class="image-container">
                                    <img id="profile-preview" class="logo-img" src="<?=ASSETS?>/charityImages/<?=$currUser[0]->profile_pic?>" alt="Charity Logo">
                                    <div class="overlay">
                                        <div class="camera-icon">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                    </div>
                                    <input type="file" id="profile-upload" name="profile_pic" accept="image/*" />
                                </div>
                                <div class="charity-text">
                                    <div class="charity-contact">
                                        <div class="input-group">
                                            <label for="name">Charity Name</label>
                                            <input type="text" id="name" name="name" value="<?=get_var('name',$currOrg[0]->name)?>" required>
                                        </div>
                                        
                                        <div class="input-group">
                                            <label for="username">Username</label>
                                            <input type="text" id="username" name="username" value="<?=$currOrg[0]->username?>" required>
                                        </div>
                                        
                                        <div class="input-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" id="phone" name="phone" value="<?=get_var('phone',$currOrg[0]->phoneNo)?>" required>
                                        </div>
                                        
                                        <div class="input-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" id="email" name="email" value="<?=get_var('email',$currUser[0]->email)?>" readonly>
                                            <small>Email cannot be changed</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section business-address">
                            <h3><i class="fas fa-map-marker-alt"></i> Business Address</h3>
                            <div class="charity-info">
                                <div class="address-grid">
                                    <div class="input-group">
                                        <label for="street">Street Address</label>
                                        <input type="text" id="street" name="street" value="Dialog Axiata PLC, 475, Union Place, Colombo 02, Sri Lanka." required>
                                    </div>
                                    
                                    <div class="input-group">
                                        <label for="city">City</label>
                                        <input type="text" id="city" name="city" value="<?=get_var('city',$currOrg[0]->city)?>" required>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="section charity-description">
                            <h3><i class="fas fa-info-circle"></i> Charity Description</h3>
                            <div class="charity-info">
                                <div class="input-group">
                                    <label for="description">Tell us about your charity</label>
                                    <textarea id="description" name="description" rows="5"><?=get_var('description',$currOrg[0]->charity_description)?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="section account-security">
                            <div class="charity-info">
                                <div class="button-group">
                                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Changes</button>
                                    <button type="reset" class="btn-clear"><i class="fas fa-redo"></i> Reset Form</button>
                                    <button type="button" class="btn-cancel" onclick="window.location.href='<?=ROOT?>/charity/profile'"><i class="fas fa-times"></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>
    
    <script>
        // Handle image upload and preview
        document.addEventListener('DOMContentLoaded', function() {
            const imageContainer = document.querySelector('.image-container');
            const profileUpload = document.getElementById('profile-upload');
            const profilePreview = document.getElementById('profile-preview');
            
            // Open file dialog when clicking on the image container
            imageContainer.addEventListener('click', function() {
                profileUpload.click();
            });
            
            // Preview the selected image
            profileUpload.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });

        
    document.querySelector('.btn-clear').addEventListener('click', function(e) {
        e.preventDefault();  // Prevent form submission
        
        // Clear all text, textarea, and select inputs
        document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea, select').forEach(function(input) {
            input.value = ''; 
        });

        // Clear file inputs and image previews
        document.querySelectorAll('input[type="file"]').forEach(function(input) {
            input.value = '';  // Reset file input
        });
        document.querySelectorAll('.upload-icon').forEach(function(icon) {
            icon.src = '<?=ASSETS?>/icons/uploadArea.png';  // Reset image preview
        });

        // Reset any hidden delete inputs to their initial values
        document.querySelectorAll('input[type="hidden"]').forEach(function(hiddenInput) {
            hiddenInput.value = 'false'; // Reset hidden delete flags
        });
    });


    </script>
</body>
</html>