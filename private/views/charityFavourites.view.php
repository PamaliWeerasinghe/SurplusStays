<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityManageEvents.css">
</head>
<body>
    <pre>
        <?php print_r($rows); ?>
    </pre>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-nav">
                <div class="top-bar">
                </div>
                <div class="events-header">
                    <h2>Favourite Shops</h2>
                    <div class="search-container">
                        <input type="text" id="searchInput" class="search-input" placeholder="Search Events...">
                        <button class="search-button">
                        <i class="search-icon"></i>
                        </button>
                    </div>
                    <div class="filter-container">
                        <p>Filter By: </p>
                        <select id="filter" class="filter-select">
                            <option value="all">All</option>
                            <option value="1">Ongoing</option>
                            <option value="2">Draft</option>
                            <option value="3">Closed</option>
                        </select>
                    </div>
                    <button class="create-event-button" onclick="window.location.href='<?=ROOT?>/charity/browse_shops'">+ Add Shops</button>
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <table class="admin-order-table">
                            <tbody>
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr onclick="window.location.href='<?= ROOT ?>/charity/viewShop/<?= $row->id ?>'">
                                        <td class="event">
                                            <div class="event-name">
                                                <img src="<?=BUSINESS?>/<?= $row->picture ?>" alt="Event" class="event-img">
                                                <h3><?= htmlspecialchars($row->name) ?></h3>            
                                            </div>
                                        </td>
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
    <?php echo $this->view('includes/footer')?>

        <!-- Modal for Delete Confirmation -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirm Deletion</h3>
            <p>Are you sure you want to delete this product?</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="modal-button confirm">Yes, Delete</button>
                <button id="cancelDelete" class="modal-button cancel">Cancel</button>
            </div>
        </div>
    </div>

    <script>
    let deleteForm = null;

        document.querySelectorAll('.take-action').forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault(); // Prevent form submission
                deleteForm = document.getElementById(button.dataset.formId); // Store form reference
                document.getElementById('deleteModal').style.display = 'block'; // Show modal
            });
        });

        document.getElementById('confirmDelete').addEventListener('click', () => {
            if (deleteForm) deleteForm.submit(); // Submit the form
        });

        document.getElementById('cancelDelete').addEventListener('click', () => {
            document.getElementById('deleteModal').style.display = 'none'; // Hide modal
        });
        //stop the viewProduct page when clicking edit and delete
        document.querySelectorAll('.completed, .take-action').forEach(button => {
            button.addEventListener('click', event => {
                event.stopPropagation();
            });
        });

        
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.querySelector(".search-input");
            const searchButton = document.querySelector(".search-button");
            const filterSelect = document.querySelector(".filter-select");
            const rows = document.querySelectorAll(".admin-order-table tbody tr");

            function filterEvents() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const filterValue = filterSelect.value;

                rows.forEach(row => {
                    const eventName = row.querySelector(".event-name h3").textContent.toLowerCase();
                    const statusButton = row.querySelector(".status");
                    let showRow = true;

                    // Filter by search
                    if (searchTerm && !eventName.includes(searchTerm)) {
                        showRow = false;
                    }

                    // Filter by status
                    if (filterValue === "1" && !statusButton.classList.contains("ongoing")) {
                        showRow = false;
                    } else if (filterValue === "2" && !statusButton.classList.contains("draft")) {
                        showRow = false;
                    } else if (filterValue === "3" && !statusButton.classList.contains("closed")) {
                        showRow = false;
                    }

                    row.style.display = showRow ? "" : "none";
                });
            }

            searchButton.addEventListener("click", filterEvents);
            filterSelect.addEventListener("change", filterEvents);
        });

    </script>
    
</body>
</html>