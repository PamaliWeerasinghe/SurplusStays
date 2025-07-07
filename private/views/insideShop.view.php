<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?=STYLES?>/customer.css">
    <link rel="stylesheet" href="<?=STYLES?>/insideShop.css">

</head>

<body>
    <!-- navbar -->
    <div class="main-div">
        <?php echo $this->view('includes/Navbar') ?>
        <div class="sub-div-1">
            <div class="dashboard">
                <div class="summary"></div>
                <div class="box">
                    <div class="row1" style="padding-top: 15px;">
                        <div class="column1" style="justify-content: center; align-items: center;">
                            <img src="<?=ASSETS?>/images/keells.png" id="keells-img" />
                        </div>
                        <div class="column1">
                            <div class="content1">
                                <div class="row2">
                                    <div class="column2">
                                        <b style="padding:30px;"><?= $business->name ?></b>
                                        <br />
                                        <p style="font-weight:350; font-size:14px;">284 Galle Rd, Dehiwala-Mount Lavinia, Sri Lanka, WP</p>
                                    </div>
                                    <div class="column2">
                                        <b class="rating">3.9</b>
                                    </div>
                                </div>
                            </div>
                            <div class="content2" style="margin-top:2%">
                                <!-- google maps api -->
                                <div class="map">
                                    <iframe src="https://www.google.com/maps?q=YourLocation&output=embed" width="100%" height="200" allowfullscreen="" loading="lazy" style="margin-top:-2%;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- filtering selection -->
                    <div style="display: flex; flex-direction: row; padding:40px; width: 100%;">
                        <div style="margin-right: 20px; margin-right: 60%;">
                            <b>Featured Items</b>
                        </div>
                        <div class="button1" style="margin-right: 20px;">
                            Price
                        </div>
                        <div class="button1">
                            Expiry Date
                        </div>
                    </div>

                    <!-- actual items display -->
                    <div class="row3">
                        <?php foreach ($products as $product): ?>
                        <div class="card">
                            <!-- Left Section (Text and Date) -->
                            <div class="card-info">
                                <h2 class="product-name"><?= $product->name ?></h2>
                                <p class="price">Rs <?=$product->price_per_unit ?></p>
                                <div class="date-info">
                                    <img src="<?=ASSETS?>/images/expiry 1.png" alt="Calendar Icon" class="calendar-icon">
                                    <span class="date-text"><?= $product->expiration_dateTime  ?></span>
                                </div>
                            </div>

                            <!-- Right Section (Image and Plus Button) -->
                            <div class="card-image">
                                <img src="<?=ASSETS?>/images/<?= $product->pictures  ?>" alt="<?= $product->name  ?>">
                                <button class="add-button" data-product-id="<?= $product->id ?>" data-product-name="<?= $product->name ?>" data-product-price="<?= $product->price_per_unit ?>" data-product-image="<?= $product->pictures ?>" data-product-expiry="<?=$product->expiration_dateTime?>">+</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup Modal -->
        <div class="overlay" id="overlay"></div>
        <div class="modal" id="addToCartModal">
            <button class="close-button" id="closeModal">&times;</button>
            <div class="modal-content">
                <!-- Left Side: Image -->
                <div class="modal-image">
                    <img id="modalProductImage" src="" alt="Product Image">
                </div>
                <!-- Right Side: Info -->
                <div class="modal-info">
                    <h2 id="modalProductName"></h2>
                    <p class="price" id="modalProductPrice"></p>
                    <p class="expiry" id="modalProductExpiry"></p>
                    <div class="quantity-selector">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1">
                        <button class="heart" id="heartButton">❤️</button>

                    </div>
                    <div class="modal-buttons">
                        <button class="add-to-cart" id="confirmAddToCart" onclick="">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php echo $this->view('includes/footer') ?>
    </div>

    <script>
        // JavaScript to handle the popup modal
        document.addEventListener('DOMContentLoaded', function() {
            const addButtons = document.querySelectorAll('.add-button');
            const modal = document.getElementById('addToCartModal');
            const overlay = document.getElementById('overlay');
            const closeButton = document.getElementById('closeModal');
            const confirmButton = document.getElementById('confirmAddToCart');
            const heartButton = document.getElementById('heartButton');
            const modalProductName = document.getElementById('modalProductName');
            const modalProductPrice = document.getElementById('modalProductPrice');
            const modalProductImage = document.getElementById('modalProductImage');
            const modalProductExpiry = document.getElementById('modalProductExpiry');

            addButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Set product details in the modal
                    modalProductName.textContent = this.getAttribute('data-product-name');
                    modalProductPrice.textContent = 'Rs ' + this.getAttribute('data-product-price');
                    modalProductExpiry.textContent = this.getAttribute('data-product-expiry');
                    modalProductImage.src = `<?=ASSETS?>/images/${this.getAttribute('data-product-image')}`;

                    // Show the modal
                    modal.classList.add('active');
                    overlay.classList.add('active');
                });
            });

            // Close modal on close button click
            closeButton.addEventListener('click', function() {
                modal.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Close modal on overlay click
            overlay.addEventListener('click', function() {
                modal.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Handle Add to Cart button
            confirmButton.addEventListener('click', function() {
                const quantity = document.getElementById('quantity').value;
                alert(`Added ${quantity} item(s) to cart!`);
                modal.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Handle Heart button
            heartButton.addEventListener('click', function() {
                alert('Added to favorites!');
            });
        });
    </script>
</body>

</html>