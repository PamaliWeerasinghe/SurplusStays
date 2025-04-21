// // Delete popup functionality
// const deletePopup = document.getElementById("delete-popup");
// const deletePopupContainer = document.getElementById("delete-popup-container");

// //add to cart popup functionality
// const cartPopup = document.getElementById("cart-popup");
// const cartPopupContainer = document.getElementById("cart-popup-container");

// //button plus and minusing
// const minusBtn = document.querySelector('.quantity-btn.minus');
// const plusBtn = document.querySelector('.quantity-btn.plus');
// const input = document.querySelector('.quantity-input');


// //delete popup functions
// function openDeletePopup(rowId) {
//     deletePopupContainer.classList.add("open-delete-popup-container");
//     deletePopup.classList.add("open-popup");
//     document.getElementById('popupRowID').value = rowId;
    
//     // Update form action
//     const form = document.querySelector("#delete-popup form");
//     form.action = `http://localhost/surplusstays/public/Customer/removeFromWatchlist/${rowId}`;
//     }

// function hideDeletePopup() {
//     deletePopupContainer.classList.remove("open-delete-popup-container");
//     deletePopup.classList.remove("open-popup");
// }

// Close popup when clicking outside
// deletePopupContainer.addEventListener('click', function(e) {
//     if (e.target === this) {
//         hideDeletePopup();
//     }
// });



//cart popup functions
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

// function hideCartPopup() {
//     cartPopupContainer.classList.remove("open-cart-popup-container");
//     cartPopup.classList.remove("open-popup");
// }

// // Add click outside to close
// cartPopupContainer.addEventListener('click', function(e) {
//     if (e.target === this) {
//         hideCartPopup();
//     }
// });



// //js for the plus and minus buttons
// minusBtn.addEventListener('click', () => {
//     let currentValue = parseInt(input.value);
//     if (currentValue > parseInt(input.min)) {
//     input.value = currentValue - 1;
//     }
// });

// plusBtn.addEventListener('click', () => {
//     let currentValue = parseInt(input.value);
//     input.value = currentValue + 1;
// });


// //add to cart
// // function insertToCart(){
// //     let productQuantity = document.getElementById('quantity-input');
    
// // }

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
