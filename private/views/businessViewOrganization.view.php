<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessViewOrganization.css">
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css">
</head>

<body>
    <?php echo $this->view('includes/businessNavbar') ?>
    <div class="main-div">
        <div class="sub-div-1">
            <?php echo $this->view('includes/businessSidePanel') ?>
            <div class="dashboard">
                <div class="summary">
                    <!-- You could add a button here similar to the reference page -->
                </div>

                <div class="main-box">
                    <div class="header">
                        <div class="card-image">
                            <img src="<?=ASSETS?>/charityImages/<?= htmlspecialchars($picture) ?> ?>" alt="Project Image">
                        </div>
                        <h1 class="charity-title">
                            <?=$row[0]->name?> 
                            <span class="heart" title="Add to Favorites">❤</span>       
                        </h1>
                    </div>

                    <div class="donate-section">
                        <div class="donate-btns">
                            <button class="donate-btn send-request-btn" data-org-id="<?= htmlspecialchars($row[0]->id) ?>">Donate 🛒</button>
                            <button class="donate-btn">Browse Events 🔍</button>
                        </div>
                        <p><a href="#">Donations</a> are processed as requests for this charity organization.</p>
                    </div>

                    <!-- Verification Badges Section -->
                    <div class="charity-verification">
                        <div class="verification-item">
                            <span class="check">✓</span> Profile managed by <?=$row[0]->name?> | <a href="#">Is this your nonprofit?</a>
                        </div>
                        <div class="verification-item">
                            <span class="check">✓</span> 501(c)(3) organization
                        </div>
                        <div class="verification-item">
                            <span class="check">✓</span> Donations are tax-deductible
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="charity-contact">
                        <div class="contact-item">
                            <span>🌐</span>
                            <a href="https://www.woundedwarriorproject.org/" target="_blank">https://www.woundedwarriorproject.org/</a>
                        </div>
                        <div class="contact-item">
                            <span>📍</span>
                            <?=$row[0]->city?>
                        </div>
                        <div class="contact-item">
                            <span>📞</span>
                            <a href="tel:<?=$row[0]->phoneNo?>"><?=$row[0]->phoneNo?></a>
                        </div>
                    </div>

                    <div class="mission">
                        <p><strong>Organization Description</strong></p>
                        <p><?=$row[0]->charity_description?></p>
                    </div>

                    <div class="rating">
                        <div class="score">98%</div>
                        <div class="stars">⭐⭐⭐⭐</div>
                        <p class="four-star">Four-Star Charity</p>
                        <div class="metrics">
                            <p>Response rate for requests</p>
                            <?php if (isset($responseRate)): ?>
                                <p class="response-percentage"><?= htmlspecialchars($responseRate) ?>%</p>
                                <div class="bar-container">
                                    <div class="bar-fill" style="--percentage: <?= (int)$responseRate ?>%;"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>  
    
                    <!-- Events Section -->
                    <div class="charity-events">
                        <h3 class="section-title">Events</h3>                                   
                        <div class="events-container">
                            <button class="slider-nav slider-prev" onclick="moveSlide(-1)">&#10094;</button>
                            <div class="events-slider">
                                <?php if ($eventRows): ?>
                                    <?php foreach ($eventRows as $row1): ?>
                                        <?php 
                                            // Get the first image from the pictures array
                                            $eventPictures = explode(',', $row1->pictures);
                                            $eventImage = isset($eventPictures[0]) ? $eventPictures[0] : 'event_placeholder.png';
                                        ?>
                                        <div class="event-card" onclick="window.location.href='<?= ROOT ?>/charity/viewEvent/<?= $row1->id ?>'">
                                            <img src="<?=ROOT?><?= htmlspecialchars($eventImage) ?>" alt="<?= htmlspecialchars($row1->event) ?>" class="event-image">
                                            
                                            <div class="event-details">
                                                <h4 class="event-title"><?= htmlspecialchars($row1->event) ?></h4>
                                                
                                                <div class="event-meta">
                                                    <div class="event-location">
                                                        <span>📍</span> <?= htmlspecialchars($row1->location) ?>
                                                    </div>
                                                    <div class="event-category">
                                                        <span>🏙️</span> District: <?= htmlspecialchars($row1->district) ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="event-dates">
                                                    <div class="event-date">
                                                        <span>Start Date:</span> <strong><?= htmlspecialchars($row1->start_dateTime) ?></strong>
                                                    </div>
                                                    <div class="event-date">
                                                        <span>End Date:</span> <strong><?= htmlspecialchars($row1->end_dateTime) ?></strong>
                                                    </div>
                                                </div>
                                                
                                                <button class="btn btn-primary">View Details</button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p><strong>This charity does not have any upcoming events.</strong></p>
                                <?php endif; ?>
                            </div>
                            
                            <button class="slider-nav slider-next" onclick="moveSlide(1)">&#10095;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->view('includes/footer') ?>
    </div>

    <div id="popupModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Send Request</h2>
            <form method="POST" action="<?=ROOT?>/charity/sendDonationRequestToCharity">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" placeholder="Enter title" required />
                <input type="hidden" name="org_id" placeholder="Enter org_id" required readonly />

                <label for="food_items">Food Items:</label>
                <div id="foodItemsContainer">
                    <div class="food-item-row">
                        <input type="text" name="food_items[]" placeholder="Enter food item" />
                        <button type="button" class="add-btn" onclick="addFoodItemRow()">+</button>
                    </div>
                </div>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>

                <button type="submit" class="submit-btn">Send</button>
            </form>
        </div>
    </div>

    <script>    

       // Simple event slider functionality
let slidePosition = 0;
const slider = document.querySelector('.events-slider');
const slides = document.querySelectorAll('.event-card');
const totalSlides = slides.length;

function moveSlide(direction) {
    // If no slides, don't do anything
    if (totalSlides === 0) return;
    
    // Get width of a single slide including margin/gap
    const slideWidth = slides[0].offsetWidth + 24; // width + margin/gap
    
    if (direction > 0) {
        // Next slide: move to the next or loop back to first
        slidePosition = (slidePosition < totalSlides - 1) ? slidePosition + 1 : 0;
    } else {
        // Previous slide: move to previous or loop to last
        slidePosition = (slidePosition > 0) ? slidePosition - 1 : totalSlides - 1;
    }
    
    // Move the slider
    slider.style.transition = 'transform 0.3s';
    slider.style.transform = `translateX(-${slidePosition * slideWidth}px)`;
}

// Add basic styles to make sure slider works properly
document.addEventListener('DOMContentLoaded', function() {
    if (slider) {
        slider.style.display = 'flex';
        slider.style.transition = 'transform 0.3s';
    }
});
        // Get modal elements
    const popupModal = document.getElementById('popupModal'); // Modal container
    const closeModal = document.getElementById('closeModal'); // Close button

    // Function to open the modal
    function openModal() {
        // First make it display flex (but still invisible)
        popupModal.style.display = 'flex';
        
        // Force a reflow to ensure the display change takes effect before adding the active class
        void popupModal.offsetWidth;
        
        // Then add the active class to trigger the transition
        popupModal.classList.add('active');
    }

    // Function to close the modal
    function closeModalHandler() {
        // First remove the active class to trigger the transition out
        popupModal.classList.remove('active');
        
        // After transition completes, set display to none
        setTimeout(() => {
            popupModal.style.display = 'none';
        }, 300); // Match this timing with your CSS transition duration
    }

    // Add event listener to all "Send Request" buttons
    document.querySelectorAll('.send-request-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default button behavior
            // Get the organization_id from the data attribute
            const orgId = button.getAttribute('data-org-id');
            
            // Set the organization_id in the modal form
            document.querySelector('input[name="org_id"]').value = orgId;

            // Open the modal
            openModal();
        });
    });

    // Close modal when clicking on the close button
    closeModal.addEventListener('click', closeModalHandler);

    // Close modal if user clicks outside the modal
    window.addEventListener('click', (e) => {
        if (e.target === popupModal) {
            closeModalHandler();
        }
    });

    // Handle form submission
    const form = document.getElementById('popupForm'); // Form inside the modal
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent form submission

            const title = document.getElementById('title').value;
            const message = document.getElementById('message').value;

            // Perform actions here, e.g., send data to server or display a success message
            alert(`Request Sent!\nTitle: ${title}\nMessage: ${message}`);

            // Close the modal
            closeModalHandler();

            // Optionally clear the form fields
            form.reset();
        });
    }

    // Function to add new food item row (unchanged)
    function addFoodItemRow() {
        const container = document.getElementById('foodItemsContainer');
        const newRow = document.createElement('div');
        newRow.className = 'food-item-row';
        newRow.innerHTML = `
            <input type="text" name="food_items[]" placeholder="Enter food item" />
            <button type="button" class="add-btn" onclick="addFoodItemRow()">+</button>
        `;
        container.appendChild(newRow);
    }

     // Add favorites functionality
     document.querySelector('.heart').addEventListener('click', function(e) {
            e.preventDefault();
            this.textContent = this.textContent === '❤' ? '❤️' : '❤';
            alert('Charity added to favorites!');
        });
    
    </script>
</body>
</html>