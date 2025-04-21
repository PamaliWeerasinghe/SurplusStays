<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityBrowseShops2.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOjGDz3PRLABXKf8sf5d___lX-RuWo3L4"></script>

    <script>
    let userLocation = { lat: <?= $lat ?>, lng: <?= $long ?> };
let mapInstance;
let shopMarkers = [];
let distanceCircle;
let currentRadius = 10; // Default radius in km

function initMap() {
    // Initialize the map centered on user location
    mapInstance = new google.maps.Map(document.getElementById("map"), {
        center: userLocation,
        zoom: 12,
    });

    // Add a marker for user's location
    const userMarker = new google.maps.Marker({
        position: userLocation,
        map: mapInstance,
        title: "Your Location",
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            fillColor: "#4285F4",
            fillOpacity: 1,
            strokeWeight: 0,
            scale: 8
        },
        zIndex: 999 // Ensure user marker is above shop markers
    });

    // Initialize the Geocoder
    const geocoder = new google.maps.Geocoder();

    // Shop locations data from PHP
    const shopLocations = [
        <?php if ($rows): ?>
            <?php foreach ($rows as $row): ?>
                {
                    id: "<?= htmlspecialchars($row->id) ?>",
                    name: "<?= htmlspecialchars($row->name) ?>",
                    lat: parseFloat("<?= htmlspecialchars($row->latitude) ?>"),
                    lng: parseFloat("<?= htmlspecialchars($row->longitude) ?>"),
                    image: "<?= htmlspecialchars($row->picture) ?>",
                    distance: calculateDistance(
                        userLocation.lat, 
                        userLocation.lng, 
                        parseFloat("<?= htmlspecialchars($row->latitude) ?>"), 
                        parseFloat("<?= htmlspecialchars($row->longitude) ?>")
                    )
                },
            <?php endforeach; ?>
        <?php endif; ?>
    ];

    // Sort shops by distance from user
    shopLocations.sort((a, b) => a.distance - b.distance);

    // Add markers for each shop
    shopLocations.forEach(shop => {
        const marker = new google.maps.Marker({
            position: { lat: shop.lat, lng: shop.lng },
            map: mapInstance,
            title: shop.name,
            shopId: shop.id,
            distance: shop.distance,
            icon: {
                path: "M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5 14.5 7.6 14.5 9 13.4 11.5 12 11.5z",
                fillColor: "#005250", 
                fillOpacity: 0.8,     
                strokeColor: "#000", 
                strokeWeight: 1,      
                scale: 1.5,           
                anchor: new google.maps.Point(12, 24),
            },
        });
        
        shopMarkers.push(marker);

        // Geocode the shop's location to get the address
        const latLng = { lat: shop.lat, lng: shop.lng };
        geocoder.geocode({ location: latLng }, (results, status) => {
            if (status === "OK" && results[0]) {
                const address = results[0].formatted_address;

                // Create info window content dynamically
                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div style="
                            margin:0;
                            font-family: Poppins, sans-serif; 
                            text-align: center; 
                            width: 220px; 
                            border: 1px solid #ddd; 
                            border-radius: 10px; 
                            overflow: hidden; 
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        ">
                            <div style="padding: 10px;">
                                <strong style="font-size: 18px; color: #333;">${shop.name}</strong>
                                <p style="font-size: 12px; color: #666; margin: 5px 0;">
                                     ${address}
                                </p>
                            </div>
                            <div>
                                <img 
                                    src="<?=ASSETS?>/businessImages/${shop.image}" 
                                    alt="${shop.name}" 
                                    style="width: 120px; height: 120px; object-fit: cover;"
                                />
                                <div style="padding-left: 10px; padding-right: 10px;padding-bottom: 10px;">
                                    </p>
                                    <div style="display: flex; align-items: center; justify-content: center; margin: 10px 0;">
                                        <img 
                                            src="https://img.icons8.com/material-outlined/24/000000/place-marker.png" 
                                            alt="distance" 
                                            style="width: 16px; height: 16px; margin-right: 4px;"
                                        />
                                        <span style="font-size: 12px; color: #666;">${shop.distance.toFixed(1)} KM</span>
                                    </div>
                                    <button class="visit-button" onclick="window.location.href='<?= ROOT ?>/charity/viewShop/${shop.id}'">
                                        VISIT STORE →
                                    </button>
                            </div>
                        </div>
                    `,
                });

                // Add click listener to marker to show info window
                marker.addListener("click", () => {
                    infoWindow.open({
                        anchor: marker,
                        map: mapInstance,
                    });
                });
            } else {
                console.error("Geocode failed: " + status);
            }
        });
    });

    // Initial distance circle
    drawDistanceCircle(currentRadius);
    
    // Update shop list with distances
    updateShopListWithDistances(shopLocations);
}

// Calculate distance between two coordinates using the Haversine formula
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius of the earth in km
    const dLat = deg2rad(lat2 - lat1);
    const dLon = deg2rad(lon2 - lon1);
    const a = 
        Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
        Math.sin(dLon/2) * Math.sin(dLon/2); 
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    const distance = R * c; // Distance in km
    return distance;
}

function deg2rad(deg) {
    return deg * (Math.PI/180);
}

// Draw circle around user location with given radius
function drawDistanceCircle(radius) {
    // Remove previous circle if exists
    if (distanceCircle) {
        distanceCircle.setMap(null);
    }
    
    // Create new circle
    distanceCircle = new google.maps.Circle({
        strokeColor: "#4285F4",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#4285F4",
        fillOpacity: 0.1,
        map: mapInstance,
        center: userLocation,
        radius: radius * 1000 // Convert km to meters
    });
    
    // Adjust map zoom to fit the circle
    const bounds = distanceCircle.getBounds();
    mapInstance.fitBounds(bounds);
}

// Update shop list with distances and filter based on radius
function updateShopListWithDistances(shops) {
    const shopButtons = document.querySelectorAll(".admin-order-table button");
    
    // Add distance to each shop in the list
    shopButtons.forEach(button => {
        const shopId = button.getAttribute('data-business-id');
        const shop = shops.find(s => s.id === shopId);
        
        if (shop) {
            // Get or create the distance element
            let distanceElement = button.querySelector('.distance-info');
            if (!distanceElement) {
                distanceElement = document.createElement('div');
                distanceElement.className = 'distance-info';
                button.querySelector('.date').appendChild(distanceElement);
            }
            
            // Update distance text
            distanceElement.textContent = `${shop.distance.toFixed(1)} KM away`;
        }
    });
}

// Filter shops based on radius
function filterShopsByRadius(radius) {
    // Update current radius
    currentRadius = radius;
    
    // Update the circle on the map
    drawDistanceCircle(radius);
    
    // Filter markers
    shopMarkers.forEach(marker => {
        if (marker.distance <= radius) {
            marker.setMap(mapInstance);
        } else {
            marker.setMap(null);
        }
    });
    
    // Filter shop list
    const shopButtons = document.querySelectorAll(".admin-order-table button");
    shopButtons.forEach(button => {
        const shopId = button.getAttribute('data-business-id');
        const markerForShop = shopMarkers.find(m => m.shopId === shopId);
        
        if (markerForShop && markerForShop.distance <= radius) {
            button.style.display = "";
        } else {
            button.style.display = "none";
        }
    });
}

// Add the distance filter functionality when the document is loaded
document.addEventListener("DOMContentLoaded", function() {
    const distanceBtn = document.getElementById("distance");
    
    // Create modal for distance slider
    const distanceModal = document.createElement('div');
    distanceModal.className = 'distance-modal';
    distanceModal.innerHTML = `
        <div class="distance-slider-container">
            <h3>Select Distance Radius</h3>
            <input type="range" id="radiusSlider" min="1" max="50" value="${currentRadius}" class="radius-slider">
            <div class="radius-value">${currentRadius} km</div>
            <button id="applyRadius" class="apply-radius-btn">Apply</button>
        </div>
    `;
    distanceModal.style.display = 'none';
    document.body.appendChild(distanceModal);
    
    // Style for the distance modal
    const style = document.createElement('style');
    style.textContent = `
        .distance-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        .distance-slider-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }
        
        .radius-slider {
            width: 100%;
            margin: 20px 0;
        }
        
        .radius-value {
            font-size: 18px;
            margin-bottom: 20px;
        }
        
        .apply-radius-btn {
            background-color: #005250;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .apply-radius-btn:hover {
            background-color: #003d3b;
        }
        
        .distance-info {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    `;
    document.head.appendChild(style);
    
    // Toggle distance modal
    distanceBtn.addEventListener('click', function() {
        distanceModal.style.display = 'flex';
    });
    
    // Update radius value display when slider changes
    const radiusSlider = document.getElementById('radiusSlider');
    const radiusValue = document.querySelector('.radius-value');
    
    radiusSlider.addEventListener('input', function() {
        radiusValue.textContent = `${this.value} km`;
    });
    
    // Apply the selected radius
    document.getElementById('applyRadius').addEventListener('click', function() {
        const radius = parseInt(radiusSlider.value);
        filterShopsByRadius(radius);
        distanceModal.style.display = 'none';
        
        // Update button text to show selected radius
        distanceBtn.textContent = `Distance (${radius} km) ▼`;
    });
    
    // Close modal when clicking outside
    distanceModal.addEventListener('click', function(e) {
        if (e.target === distanceModal) {
            distanceModal.style.display = 'none';
        }
    });
});

window.initMap = initMap;
</script>




</head>
<body onload="initMap()">
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-nav">
                <div class="top-bar">
                </div>
                <div class="searchWelcome">
                <h2>Search Our Shops</h2>
                </div>

                <div class="complaints-status">
                    <div class="events-header">
                    <div class="slider-container">
                        <div class="slider" id="foodSlider">
                            <div class="category"><img src="<?= ASSETS ?>/icons/frenchfries.png" alt="Fast Food"><span>Fast Food</span></div>
                            <div class="category"><img src="<?= ASSETS ?>/icons/sandwitch.png" alt="Sandwich"><span>Sandwich</span></div>
                            <div class="category"><img src="<?= ASSETS ?>/icons/desserts.png" alt="Desserts"><span>Desserts</span></div>
                            <div class="category"><img src="<?= ASSETS ?>/icons/pizza.png" alt="Pizza"><span>Pizza</span></div>
                            <div class="category"><img src="<?= ASSETS ?>/icons/healthy.png" alt="Healthy"><span>Healthy</span></div>
                            <div class="category"><img src="<?= ASSETS ?>/icons/burger.png" alt="Burger"><span>Burger</span></div>
                        </div>
                    </div>
                    <div class="filters">
                        <button class="filter-btn" id="highestRated">Highest Rated</button>
                        <button class="filter-btn" id="distance">Distance ▼</button>
                    </div>
                    </div>

                    <div class="table-container">
                        <div class="admin-order-table"> 
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>                                 
                                    
                                        <button class="action-btn-edit send-request-btn" data-business-id="<?= htmlspecialchars($row->id) ?>">
                                            <div class="event">
                                                <div class="event-name">
                                                    <img src="<?= ASSETS ?>/businessImages/<?= htmlspecialchars($row->picture) ?>" alt="Event" class="event-img">
                                                    <h3><?= htmlspecialchars($row->name) ?></h3>
                                                </div>
                                            </div>
                                            <div class="date">
                                                <span class="status open">Open Today</span><br>10.00AM-22.00PM
                                            </div>
                                        </button>
                                    
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="no-events">
                                    <h4>No events found</h4>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="map">
                        <div class="search">
                            <div class="search-container">
                                <input type="text" class="search-input" id="searchInput" placeholder="Search Shops...">
                            </div>
                            <button class="create-event-button">Search</button>
                        </div>
                            <div id="map" style="height: 100%; width: 100%; margin: bottom 10px; border-radius: 20px;"></div>
                        </div>
                        
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
        const searchInput = document.querySelector(".search-input");
        const searchButton = document.querySelector(".create-event-button");
        const rows = document.querySelectorAll(".admin-order-table  button");

        function filterEvents() {
            const searchTerm = searchInput.value.toLowerCase().trim();

            rows.forEach(row => {
                const eventName = row.querySelector(".event-name h3").textContent.toLowerCase();
                let showRow = true;

                // Filter by search
                if (searchTerm && !eventName.includes(searchTerm)) {
                    showRow = false;
                }

                row.style.display = showRow ? "" : "none";
            });
        }

        searchButton.addEventListener("click", filterEvents);
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