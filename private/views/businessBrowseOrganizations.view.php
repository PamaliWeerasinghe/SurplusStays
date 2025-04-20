<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?= STYLES ?>/businessSidePanel.css" />
    <link rel="stylesheet" href="<?=STYLES?>/businessBrowseOrganizations.css">
   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoo4pzFf80sXYMtcQUux4CWSCY9nDbvig"></script>
</head>

<body>
    <?php echo $this->view('includes/businessNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/businessSidePanel') ?>
        <div class="container-right">
            <div class="top-nav">
                <div class="top-bar">
                </div>
                <div class="events-header">
                <h2>Charity Organizations</h2>
                <div class="search-container">
                    <input type="text" class="search-input" id="searchInput" placeholder="Search Shops...">
                    <button class="search-button">
                    <i class="search-icon"></i>
                    </button>
                </div>
                <div class="filter-container">
                    <p>City: </p>
                    <select id="filter" class="filter-select">
                    <option value="All">All</option>
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
                
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <table class="admin-order-table">     
                            <tbody>
                                <?php if ($rows): ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr onclick="window.location.href='<?= ROOT ?>/charity/viewOrganization/<?= $row->id ?>'">
                                        <div class="card">
                                            <div class="card-image">
                                                <img src="<?=ASSETS?>/charityImages/<?= htmlspecialchars($row->picture) ?>" alt="Project Image">
                                            </div>
                                            <div class="card-content">
                                                <h3 class="title"><?= htmlspecialchars($row->name) ?></h3>
                                                <p class="location">
                                                    <span class="icon">📍</span><?= htmlspecialchars($row->city) ?>                                                   
                                                    <?php if (!empty($weekCounts[$row->id]) && $weekCounts[$row->id] >= 1): ?>
                                                    <span class="category">Active</span>
                                                <?php endif; ?>
                                                </p>
                                                <p class="description"><?= htmlspecialchars($row->charity_description) ?></p>
                                                <div class="progress-section">
                                                    <div class="funding">
                                                        <p><strong>Phone:</strong> <span class="raised"><?= htmlspecialchars($row->phoneNo) ?></span></p>
                                                        <p><strong>Email:</strong> <span class="goal"><?= htmlspecialchars($row->email) ?></span></p>
                                                    </div>
                                                    <button class="view-btn" onclick="window.location.href='<?= ROOT ?>/charity/viewOrganization/<?= $row->id ?>'">View More</button>
                                                </div>
                                            </div>
                                        </div>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr><td colspan="5"><h4>No events found</h4></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popupModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Send Request</h2>
            <form method="POST" action="<?=ROOT?>/charity/sendDonationRequest">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Enter title" required />
            <input type="hidden" name="business_id" placeholder="Enter business_id" required readonly />


            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>

            <button type="submit" class="submit-btn">Send</button>
            </form>
        </div>
    </div>
    <?php echo $this->view('includes/footer')?>
    
</body>
<script>

    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const searchButton = document.querySelector(".search-button");
        const filterSelect = document.getElementById("filter");
        const cards = document.querySelectorAll(".card");

        function filterOrganizations() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedCity = filterSelect.value.toLowerCase();

            cards.forEach(card => {
                const name = card.querySelector(".title").textContent.toLowerCase();
                const city = card.querySelector(".location").textContent.toLowerCase();

                let show = true;

                if (searchTerm && !name.includes(searchTerm)) {
                    show = false;
                }

                if (selectedCity !== "all" && !city.includes(selectedCity)) {
                    show = false;
                }

                card.style.display = show ? "" : "none";
            });
        }

        searchButton.addEventListener("click", filterOrganizations);
        filterSelect.addEventListener("change", filterOrganizations);
    });

                                
    
    // Get modal elements
    const popupModal = document.getElementById('popupModal'); // Modal container
    const closeModal = document.getElementById('closeModal'); // Close button

    // Function to open the modal
    function openModal() {
        popupModal.style.display = 'block';
    }

    // Function to close the modal
    function closeModalHandler() {
        popupModal.style.display = 'none';
    }

    // Add event listener to all "Send Request" buttons
    document.querySelectorAll('.send-request-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default button behavior
            // Get the business_id from the data attribute
            const businessId = button.getAttribute('data-business-id');
            
            // Set the business_id in the modal form
            document.querySelector('input[name="business_id"]').value = businessId;

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


</script>

</html>