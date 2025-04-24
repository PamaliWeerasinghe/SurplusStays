<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Shop</title>
    <link rel="stylesheet" href="<?=STYLES?>/custViewShop.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php echo $this->view('includes/charityNavbar')?>
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
                                                <button 
                                                    class="add-btn" 
                                                    title="Add to cart"
                                                    data-name="<?= $product->name ?>"
                                                    data-id="<?= $product->id ?>"
                                                    data-business="<?= $product->business_id ?>"
                                                    data-price="<?= $product->price_per_unit ?>"
                                                    data-qty="<?= $product->qty ?>"
                                                    data-expiry="<?= date("Y.m.d", strtotime($product->expiration_dateTime)) ?>"
                                                    data-category="<?= $product->category ?>"
                                                    data-image="<?= ROOT . '/' . explode(',', $product->pictures)[0] ?>"
                                                >+</button>
                                                <?php
                                                $wishlistIds = $wishlistProductIds ?? [];
                                                ?>
                                                    <?php if (in_array($product->id, $wishlistIds)): ?>
                                                        <form method="POST" action="<?= ROOT ?>/customer/removeFromWishlist">
                                                            <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                                            <input type="hidden" name="business_id" value="<?= $product->business_id ?>">
                                                        <button type="submit" class="wishlist-btn" style="color: red;" >❤</button>
                                                        </form>
                                                    <?php else: ?>
                                                        <form method="POST" action="<?= ROOT ?>/customer/addToWishlist">
                                                            <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                                            <input type="hidden" name="business_id" value="<?= $product->business_id ?>">
                                                        <button type="submit" name="confirm" value="yes" class="wishlist-btn">❤</button>
                                                        </form>
                                                    <?php endif; ?>
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
<?php if (!empty($_SESSION['cart_conflict'])): 
    $conflict = $_SESSION['cart_conflict'];
    unset($_SESSION['cart_conflict']); // only show once
?>
<div class="modal-overlay2" id="conflictModal" style="display:block;">
    <div class="modal-content2">
        <h3>Start a new order?</h3>
        <p>You already have items from <strong><?= $conflict['previous_name'] ?></strong> in your cart.</p>
        <p>Do you want to create a new order from <strong><?= $conflict['current_name'] ?></strong>?</p>

        <form method="POST" action="<?= ROOT ?>/customer/confirmNewOrder">
            <input type="hidden" name="product_id" value="<?= $conflict['product_id'] ?>">
            <input type="hidden" name="qty" value="<?= $conflict['qty'] ?>">
            <input type="hidden" name="business_id" value="<?= $conflict['current_id'] ?>">
            <button type="submit" name="confirm" value="yes">Yes, create new order</button>
            <a href="<?= ROOT ?>/customer/viewShop/<?= $conflict['current_id'] ?>">Cancel</a>
        </form>
    </div>
</div>
<?php endif; ?>



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
                <form method="POST" action="<?=ROOT?>/customer/addToCart">
                <div class="quantity-selector">      
                    <label for="qtyInput">Quantity:</label>
                    <input type="number" name="qty" id="qtyInput" min="1" value="1">
                    <input type="hidden" name="product_id" id="hiddenProductId">
                    <input type="hidden" name="business_id" id="hiddenBusinessId">             
                </div>
                <button type="submit" class="add-cart-button">Add to Cart</button>
                </form>
            </div>
        </div>
</div>

<script>

    //handle the click and set the max for qtyInput:                          
    document.querySelectorAll('.add-btn').forEach(button => {
        button.addEventListener('click', () => {
            const name = button.dataset.name;
            const price = button.dataset.price;
            const qty = button.dataset.qty;
            const expiry = button.dataset.expiry;
            const category = button.dataset.category;
            const image = button.dataset.image;

            document.getElementById('modalName').textContent = name;
            document.getElementById('modalPrice').textContent = "Rs " + price;
            document.getElementById('modalQty').textContent = qty + " left";
            document.getElementById('modalExpiry').textContent = "Expires on: " + expiry;
            document.getElementById('modalCategory').textContent = "Category: " + category;
            document.getElementById('modalImage').src = image;
            document.getElementById('hiddenProductId').value = button.dataset.id;
            document.getElementById('hiddenBusinessId').value = button.dataset.business;

            const qtyInput = document.getElementById('qtyInput');
            qtyInput.max = qty;
            qtyInput.value = 1;

            document.getElementById('productModal').style.display = 'block';
        });
    });                            

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