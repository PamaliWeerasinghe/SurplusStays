<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Shop</title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/custViewShop.css">
    <link rel="stylesheet" href="<?=STYLES?>/customerSidePanel.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php echo $this->view('includes/charityNavbar')?>
<div class="page-wrapper">
    <div class="container">
        <?php echo $this->view('includes/customerSidePanel')?>
        <div class="container-right">   
        <div class="top-half"> 
            <div class="top-nav">
                <div class="top-bar"></div>
                <div class="searchWelcome">
                    <img src="<?= ROOT ?>/assets/businessImages/<?= $picture ?>" class="shop-logo" alt="Shop Logo">
                    <div class="shop-info">
                        <h2><?= $row[0]->name ?? '' ?></h2>
                    </div>
                    <div class="search-container">
                        <input type="text" class="search-input" placeholder="Search products...">
                        <button class="search-button"><i class="fas fa-search"></i></button>
                    </div>
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
                                                <button class="add-btn" title="Add to cart">+</button>
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



<div class="modal-overlay" id="productModal">
    <div class="modal-content">
        <span class="close-button" id="modalClose">&times;</span>
        <div class="modal-images">
        <img id="modalImage" src="" alt="Product Image">
        <div class="modal-image-controls">
            <button id="prevImage">&lt;</button>
            <button id="nextImage">&gt;</button>
        </div>
        </div>
        <div class="modal-details">
        <h2 id="modalName"></h2>
        <p id="modalPrice"></p>
        <p id="modalQty"></p>
        <p id="modalExpiry"></p>
        <p id="modalCategory"></p>
        <div class="quantity-selector">
            <label for="qtyInput">Quantity:</label>
            <input type="number" id="qtyInput" min="1" value="1">
        </div>
        <button class="add-cart-button">Add to Cart</button>
        </div>
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
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("productModal");
        const modalImage = document.getElementById("modalImage");
        const modalName = document.getElementById("modalName");
        const modalPrice = document.getElementById("modalPrice");
        const modalQty = document.getElementById("modalQty");
        const modalExpiry = document.getElementById("modalExpiry");
        const modalCategory = document.getElementById("modalCategory");
        const qtyInput = document.getElementById("qtyInput");
        const closeModal = document.getElementById("modalClose");
        const prevBtn = document.getElementById("prevImage");
        const nextBtn = document.getElementById("nextImage");

        let images = [];
        let currentIndex = 0;

        function showImage(index) {
            if (images.length) {
                modalImage.src = '<?= ROOT ?>/' + images[index].trim();
            }
        }

        document.querySelectorAll(".product-card").forEach(card => {
            card.addEventListener("click", function () {
                const name = card.querySelector(".product-name").textContent;
                const price = card.querySelector(".product-price").textContent;
                const qty = card.querySelector(".product-qty").textContent;
                const expiry = card.querySelector(".expiry-date").textContent;
                const category = card.closest(".category-section")?.querySelector("h3")?.textContent || "";

                const imageData = card.querySelector("img").getAttribute("src");
                const fullProduct = <?= json_encode($productRows) ?>;
                const productObj = fullProduct.find(p => imageData.includes(p.pictures.split(',')[0].trim()));

                if (productObj) {
                    images = productObj.pictures.split(',');
                    console.log(images);
                    currentIndex = 0;
                    showImage(currentIndex);
                }

                modalName.textContent = name;
                modalPrice.textContent = price;
                modalQty.textContent = qty;
                modalExpiry.textContent = expiry;
                modalCategory.textContent = "Category: " + category;
                qtyInput.value = 1;

                modal.style.display = "flex";
            });
        });

        closeModal.addEventListener("click", () => {
            modal.style.display = "none";
        });

        prevBtn.addEventListener("click", () => {
            if (images.length) {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                showImage(currentIndex);
            }
        });

        nextBtn.addEventListener("click", () => {
            if (images.length) {
                currentIndex = (currentIndex + 1) % images.length;
                showImage(currentIndex);
            }
        });

        window.addEventListener("click", (e) => {
            if (e.target === modal) modal.style.display = "none";
        });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOjGDz3PRLABXKf8sf5d___lX-RuWo3L4&callback=initMap" async defer></script>
</body>
</html>