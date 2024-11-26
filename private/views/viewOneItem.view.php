<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SurplusStays</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../public/assets/styles/viewOneItem.css">
    
</head>

<body style="font-family: 'Outfit', sans-serif;">

<!-- navbar and search functions -->
    <div class="top-nav">
        <div class="search-bar">
                <input type="text" placeholder="Search foods..." />
        </div>

        <div class="search-bar">
                <input type="text" placeholder="Browse shops..." />
        </div>
    </div>


    <!-- item details -->
    <div class="container" style="padding:40px; align-items:center;">
        <!-- Image Section -->
        <div class="image-section">
            <div class="main-image">
                <img src="../../public/assets/images/sugar_image.jpg" alt="sugar">
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="details-section">
            <h1>White Sugar, 1 kg</h1>
            <p class="price">Rs 440.00</p>

            <input type="text" placeholder="Quantity" /><br/><br/>
            
            <button class="add-to-cart">Add to Cart</button> <br/>
            <button class="add-to-cart">Add to Wishlist</button>
        </div>
    </div>

</body>
</html>
