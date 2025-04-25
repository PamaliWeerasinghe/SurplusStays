<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Shop</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityViewShop.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php echo $this->view('includes/charityNavbar')?>
    <div class="container">
        <?php echo $this->view('includes/charitySidePanel')?>
        <div class="container-right">   
        <div class="top-half"> 
            <div class="top-nav">
                <div class="top-bar"></div>
                <div class="searchWelcome">
                    <img src="<?= ROOT ?>/assets/businessImages/<?= $picture ?>" class="shop-logo" alt="Shop Logo">
                    <div class="shop-info">
                        <h2><?= $row[0]->name ?? '' ?></h2>
                    </div>                
                        <button class="send-request">Send Request</button>
                        <form method="POST" action="<?= ROOT ?>/charity/<?= isset($isFavorite) && $isFavorite ? 'removeFav' : 'addToFav' ?>" style="display:inline;">
                            <input type="hidden" name="business_id" value="<?= $row[0]->id ?>">
                            <button type="submit" class="favorite-btn"  aria-label="Add to Favorites">
                                <svg class="heart-icon <?= isset($isFavorite) && $isFavorite ? 'active' : '' ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50">
                                    <path fill="currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </button>
                        </form>
                </div>

                <div class="complaints-status">
                    <div id="map" class="shop-map"></div>   
                    <div class="filter-section">
                        <h3>Filter Products</h3>
                        <div class="filters">
                        <select name="sort-by">
                            <option value="">Sort By</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="expiry">Expiry Date</option>
                        </select>
                        <select name="category">
                            <option value="">All Categories</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Bakery">Bakery</option>
                            <option value="Desserts">Desserts</option>
                            <option value="Frozen foods">Frozen Foods</option>
                            <option value="Beverages">Beverages</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Prepared Foods">Prepared Foods</option>
                            <option value="Fruits & Vegetables">Fruits & Vegetables</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="search-container">
                        <input type="text" class="search-input" placeholder="Search products...">
                        <button class="search-button"><i class="fas fa-search"></i></button>
                    </div>
                        </div>
                    </div>
                    
                    <?php
                        $categories = [
                        "Dairy", "Bakery", "Desserts", "Frozen foods","Beverages", "Snacks", "Prepared Foods", "Fruits & Vegetables", "Other"
                        ];
                    ?>

                    <div class="products-container">
                    <?php foreach ($categories as $category): ?>
                        <?php
                            $hasProducts = false;
                            foreach ($productRows as $product) {
                                if (strcasecmp($product->category, $category) === 0) {
                                     $hasProducts = true;
                                    break;
                                }
                            }
                            if (!$hasProducts) continue;
                        ?>

                        <div class="category-section">
                            <h3><?= $category ?></h3>
                            <div class="product-grid">
                                <?php foreach ($productRows as $product): ?>
                                    <?php if (strcasecmp($product->category, $category) === 0): ?>
                                        <div class="product-card">
                                            <div class="product-image">
                                            <img src="<?= ROOT . '/' . explode(',', $product->pictures)[0] ?>" alt="<?= $product->name ?>">
                                        </div>
                                        <div class="product-details">
                                            <h4 class="product-name"><?= $product->name ?></h4>
                                            <p class="product-price">Rs <?= $product->price_per_unit ?></p>
                                            <p class="product-qty"><?= $product->qty ?> left</p>
                                            <div class="product-footer">
                                                <span class="expiry-date">
                                                    <i class="far fa-clock"></i> 
                                                    <?= date("Y.m.d", strtotime($product->expiration_dateTime)) ?>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div id="popupModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Send Request</h2>
        <form method="POST" action="<?= ROOT ?>/charity/sendDonationRequest">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Enter title" required />

            <input type="hidden" name="business_id" value="<?= $row[0]->id ?>" readonly />

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>

            <label>Select Products:</label>
            <div class="modal-products-list" style="max-height: 200px; overflow-y: auto; margin-bottom: 15px;">
                <?php foreach ($productRows as $product): ?>
                    <div style="display: flex; align-items: center; gap: 10px; margin: 5px 0;">
                        <input type="checkbox" name="product_ids[]" value="<?= $product->id ?>">
                        <img src="<?= ROOT . '/' . explode(',', $product->pictures)[0] ?>" alt="<?= $product->name ?>" style="width: 30px; height: 30px; object-fit: cover;">
                        <span><?= $product->name ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <button type="submit" class="submit-btn">Send</button>
        </form>
    </div>
</div>


<script>                      

    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.querySelector(".search-input");
        const sortSelect = document.querySelector("select[name='sort-by']");
        const categorySelect = document.querySelector("select[name='category']");
        const allProductCards = document.querySelectorAll(".product-card");

        function filterProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categorySelect.value;
            const sortBy = sortSelect.value;

            const products = Array.from(allProductCards);

            let filteredProducts = products.filter(card => {
                const name = card.querySelector(".product-name").textContent.toLowerCase();
                const categorySection = card.closest(".category-section").querySelector("h3").textContent;
                return name.includes(searchTerm) && 
                    (selectedCategory === "" || selectedCategory === categorySection);
            });

            // Hide all
            allProductCards.forEach(card => card.style.display = "none");

            // Show filtered
            filteredProducts.forEach(card => card.style.display = "block");

            // Sort
            if (sortBy === "price-low" || sortBy === "price-high") {
                const sorted = filteredProducts.sort((a, b) => {
                    const priceA = parseFloat(a.querySelector(".product-price").textContent.replace("Rs", ""));
                    const priceB = parseFloat(b.querySelector(".product-price").textContent.replace("Rs", ""));
                    return sortBy === "price-low" ? priceA - priceB : priceB - priceA;
                });

                sorted.forEach(card => {
                    const grid = card.closest(".product-grid");
                    grid.appendChild(card); // Re-append to reorder
                });
            } else if (sortBy === "expiry") {
                const sorted = filteredProducts.sort((a, b) => {
                    const dateA = new Date(a.querySelector(".expiry-date").textContent.trim().split(" ").pop());
                    const dateB = new Date(b.querySelector(".expiry-date").textContent.trim().split(" ").pop());
                    return dateA - dateB;
                });

                sorted.forEach(card => {
                    const grid = card.closest(".product-grid");
                    grid.appendChild(card);
                });
            }

            // Hide empty category sections
            document.querySelectorAll(".category-section").forEach(section => {
                const visibleProducts = section.querySelectorAll(".product-card:not([style*='display: none'])");
                section.style.display = visibleProducts.length ? "block" : "none";
            });
        }

        searchInput.addEventListener("input", filterProducts);
        sortSelect.addEventListener("change", filterProducts);
        categorySelect.addEventListener("change", filterProducts);
    });


    function initMap() {
        const location = { lat: <?= $row[0]->latitude ?>, lng: <?= $row[0]->longitude ?> };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: location,
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: true
        });
        new google.maps.Marker({
            position: location,
            map: map,
            title: "<?= $row[0]->name ?? 'Shop Location' ?>"
        });
    }

    document.querySelector('.send-request').addEventListener('click', function () {
    document.getElementById('popupModal').style.display = 'block';
});

document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('popupModal').style.display = 'none';
});

// Optional: close on outside click
window.onclick = function(event) {
    const modal = document.getElementById('popupModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function toggleFavorite(event) {
    // Prevent navigation when clicking on the heart icon
    event.stopPropagation();
    
    const heartIcon = event.currentTarget.querySelector('.heart-icon');
    const isFavorite = heartIcon.classList.toggle('active');
    
    if (isFavorite) {
        heartIcon.setAttribute('title', 'Remove from Favorites');
    } else {
        heartIcon.setAttribute('title', 'Add to Favorites');
    }
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOjGDz3PRLABXKf8sf5d___lX-RuWo3L4&callback=initMap" async defer></script>
</body>
</html>