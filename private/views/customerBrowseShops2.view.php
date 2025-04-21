<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/customerBrowseShops2.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOjGDz3PRLABXKf8sf5d___lX-RuWo3L4"></script>

    <script>
    function initMap() {
        // Initialize the map
        const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 6.927079, lng: 79.861244 }, // Default center
            zoom: 8,
        });

        // Initialize the Geocoder
        const geocoder = new google.maps.Geocoder();

        // Shop locations data from PHP
        const shopLocations = [
            <?php if ($rows): ?>
                <?php foreach ($rows as $row): ?>
                    {
                        name: "<?= htmlspecialchars($row->name) ?>",
                        lat: parseFloat("<?= htmlspecialchars($row->latitude) ?>"),
                        lng: parseFloat("<?= htmlspecialchars($row->longitude) ?>"),
                        image: "<?= htmlspecialchars($row->picture) ?>"
                    },
                <?php endforeach; ?>
            <?php endif; ?>
        ];

        // Add markers for each shop
        shopLocations.forEach(shop => {
            const marker = new google.maps.Marker({
                position: { lat: shop.lat, lng: shop.lng },
                map: map,
                title: shop.name,
                icon: {
                    path: "M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5 14.5 7.6 14.5 9 13.4 11.5 12 11.5z", // SVG path for a teardrop
                    fillColor: "#005250", 
                    fillOpacity: 0.8,     
                    strokeColor: "#000", 
                    strokeWeight: 1,      
                    scale: 1.5,           
                    anchor: new google.maps.Point(12, 24), // Position the marker point 
                },
            });

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
                                            <span style="font-size: 12px; color: #666;">3.5KM</span>
                                        </div>
                                        <button class="visit-button" onclick="window.location.href='<?= ROOT ?>/customer/viewShop/${shop.id}'">
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
                            map,
                        });
                    });
                } else {
                    console.error("Geocode failed: " + status);
                }
            });
        });
    }

    window.initMap = initMap;
</script>




</head>
<body onload="initMap()">
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/customerSidePanel')?>
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
                        <button class="filter-btn" id="price">Price ▼</button>
                        <button class="filter-btn" id="distance">Distance ▼</button>
                    </div>
                    </div>

                    <div class="table-container">
                        <div class="admin-order-table"> 
                            <?php if ($rows): ?>
                                <?php foreach ($rows as $row): ?>                                 
                                    
                                        <button class="action-btn-edit send-request-btn" onclick="window.location.href='<?= ROOT ?>/customer/viewShop/<?= htmlspecialchars($row->id) ?>'">
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

</script>

</html>