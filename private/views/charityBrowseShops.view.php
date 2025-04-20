<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityBrowseShops.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoo4pzFf80sXYMtcQUux4CWSCY9nDbvig"></script>

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
                                width: 300px; 
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
                                        <button style="
                                            background-color: #000; 
                                            color: #fff; 
                                            font-size: 14px; 
                                            border: none; 
                                            border-radius: 20px; 
                                            padding: 8px 20px; 
                                            cursor: pointer;
                                        ">
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
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-nav">
                <div class="top-bar">
                    <div class="notification">
                        <img src="<?=ASSETS?>/images/bell.png" alt="Notification Bell" class="bell-icon">
                    </div>
                </div>
                <div class="events-header">
                <h2>Shops</h2>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search Shops...">
                    <button class="search-button">
                    <i class="search-icon"></i>
                    </button>
                </div>
                <div class="filter-container">
                    <p>Filter By: </p>
                    <select id="filter" class="filter-select">
                    <option value="dateAdded">Shop Type</option>
                    <option value="dateAdded">Bakeries</option>
                    <option value="dateAdded">Supermarkets</option>
                    <option value="dateAdded">Resturants</option>
                    </select>
                </div>
                <button class="create-event-button">Locate Nearby Shops</button>
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <div class="map">
                            <div id="map" style="height: 500px; width: 100%; margin: bottom 10px;"></div>
                        </div>
                        <table class="admin-order-table">     
                            <tbody>
                                <?php if ($rows): ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td class="event">
                                                <div class="event-name">
                                                    <img src="<?=ASSETS?>/businessImages/<?= htmlspecialchars($row->picture) ?>" alt="Event" class="event-img">
                                                    <h3><?= htmlspecialchars($row->name) ?></h3>
                                                </div>
                                            </td>                                           
                                            <td class="date"><span class="status open">Open Today</span><br>10.00AM-22.00PM</td>
                                            <td><button class="action-btn-edit">Send Request</button></td>
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
    
</body>
</html>

<!-- content: `
                            <div style="
                                margin:0;
                                font-family: Poppins, sans-serif; 
                                text-align: center; 
                                width: 240px; 
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
                                    <div style="display:flex; flex-direction:row;">
                                        <img 
                                            src="<=ASSETS?>/businessImages/${shop.image}" 
                                            alt="${shop.name}" 
                                            style="width: 120px; height: 120px; object-fit: cover; padding: 10px; border-radius: 50%; "
                                        />
                                        <div style="padding: 10px;">
                                            </p>
                                            
                                            <button style="
                                                background-color: #000; 
                                                color: #fff; 
                                                font-size: 12px; 
                                                border: none; 
                                                height: 60px;
                                                border-radius: 20px; 
                                                padding: 8px 20px; 
                                                cursor: pointer;
                                            ">
                                                VISIT STORE →
                                            </button>
                                            <div style="display: flex; align-items: center; justify-content: center; margin: 10px 0;">
                                                <img 
                                                    src="https://img.icons8.com/material-outlined/24/000000/place-marker.png" 
                                                    alt="distance" 
                                                    style="width: 16px; height: 16px; margin-right: 4px;"
                                                />
                                                <span style="font-size: 12px; color: #666;">3.5KM</span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        `, -->