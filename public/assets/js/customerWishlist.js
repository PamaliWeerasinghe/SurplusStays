//add to cart popup functionality
const cartPopup = document.getElementById("cart-popup");
const cartPopupContainer = document.getElementById("cart-popup-container");

//close delete popup
function closedeletePopup(){
    let rcpopup = document.getElementById("wishlist-popup");
    let rcpopupContainer = document.getElementById("wishlist-popup-container");
    rcpopup.classList.remove("open-popup");
    rcpopupContainer.className = "popup-container";
}
//delete from wishlist popup functions
function openDeletePopup(rowId) {  // Changed from openCartPopup to match onclick
    let popup=document.getElementById("wishlist-popup");
    let popupContainer=document.getElementById("wishlist-popup-container");
    popupContainer.className="open-popup-container";
    popup.classList.add("open-popup");
    
    //setting the ID in the hidden input field
    document.getElementById('wishlistpopupRowId').value=rowId;

    //dynamically set the form action
    const form=document.querySelector('#wishlist-popup form');
    form.action=`http://localhost/surplusstays/public/Customer/RemoveFromWishlist/${rowId}`;
    
}

//cart popup functions
function openAddToCartPopup(rowId) {  // Changed from openCartPopup to match onclick
    
    cartPopupContainer.classList.add("open-cart-popup-container");
    cartPopup.classList.add("open-popup");
    document.getElementById('popupRowID').value = rowId;

    //fetch the details of the item 
    fetch(`http://localhost/SurplusStays/public/Customer/AddToCartFromWishlist/${rowId}`)
    .then(response=>{
        if(!response.ok){
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json(); // Convert response to JSON
    })
    .then(data=>{
        console.log("Fetched Data:",data); // Debugging: Check JSON structure
        document.getElementById('addToCartImage').src=`http://localhost/SurplusStays/public/assets/images/${data.product_img}`;
        document.getElementById('bus_name').innerHTML=data.bus_name;
        document.getElementById('product_name').innerHTML=data.product_name;
        document.getElementById('expires_in').innerHTML=data.expires_in;
        document.getElementById('watchlist_id').value=rowId;
        
        if(data.qty_avail==0){
            document.getElementById('quantity-input-1').value=0;
            document.getElementById('quantity-input-1').disabled=true;
            document.getElementById('selected-Qty').value=0;
        }else{
            document.getElementById('quantity-input-1').value=1;
            document.getElementById('quantity-input-1').disabled=false;
            document.getElementById('selected-Qty').value=1;
        }
        document.getElementById('quantity-input-1').max=data.qty_avail;
        
        
        
    })
    .catch(error=>{
        console.error("Fetch error:",error);
    })

}


//when clicking the close button for the add to cart popup
function hideCartPopup() {
    cartPopupContainer.classList.remove("open-cart-popup-container");
    cartPopup.classList.remove("open-popup");
}

// Add click outside to close
cartPopupContainer.addEventListener('click', function(e) {
    if (e.target === this) {
        hideCartPopup();
    }
});
// Add click outside to close
// wishlist-popup-container.addEventListener('click', function(e) {
//     if (e.target === this) {
        
//         closedeletePopup();
//     }
// });


document.querySelectorAll('.popup-quantity-selector').forEach(popup => {
    const input = popup.querySelector('.quantity-input');
    const minusBtn = popup.querySelector('.quantity-btn.minus');
    const plusBtn = popup.querySelector('.quantity-btn.plus');
    
    minusBtn.addEventListener('click', () => {
      
      let currentValue = parseInt(input.value);
      let min = parseInt(input.min);
      if (currentValue > min) {
        input.value = currentValue - 1;
        document.getElementById('selected-Qty').value=input.value;
      }
    });
  
    plusBtn.addEventListener('click', () => {
      let currentValue = parseInt(input.value);
      let max = parseInt(input.max);
      if (currentValue < max) {
        input.value = currentValue + 1;
        document.getElementById('selected-Qty').value=currentValue+1;
      }
    });
  });
  
//add to cart
function insertToCart(){
    hideCartPopup();
    const watchlistID=document.getElementById("watchlist_id").value;
    const qtySelected=document.getElementById("selected-Qty").value;
    const form=document.querySelector('#AddToCartFromWishlist');
    form.action=`http://localhost/surplusstays/public/customer/WishlistToCart/${watchlistID}/${qtySelected}`;

    
    
}

// function insertToCart(products_id, button) {
//     const container = button.closest('.product-container'); // or specific wrapper class
//     const quantityInput = container.querySelector('.quantity-input');
//     const quantity = quantityInput.value;
//     const customer_id = <?= Auth::getID() ?>;

//     fetch(`<?=ROOT?>/customer/addToCart/${products_id}`, {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({
//             customer_id: customer_id,
//             products_id: products_id,
//             quantity: quantity
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             alert('Item added to cart successfully!');
//             hideCartPopup();
//             // Optional: Refresh cart count
//         } else {
//             alert('Error: ' + (data.message || 'Failed to add to cart'));
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('An error occurred while adding to cart');
//     });
// }

