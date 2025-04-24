<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta noame="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/custViewShops2.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>
    <div class="container">
        <?php echo $this->view('includes/customerSidepanel')?>
        <div class="container-right">
            <div class="top-half">
                <div class="top-bar">
                </div>
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

    <?php echo $this->view('includes/footer')?>

</body>
</html>