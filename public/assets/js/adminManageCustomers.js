
document.addEventListener("DOMContentLoaded", function() {
  for (let i = 1; i <= 5; i++) {
    document.getElementById(`upload-${i}`).addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          // Assign to the preview linked to THIS upload button only
          const preview = document.getElementById(`profilePreview-${i}`);
          preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  }
});

function loadOrderItems() {
  console.log("pressed");
  const oid = document.getElementById("orderID");
  if(oid!="oid"){
    oid.addEventListener("change", (event) => {
      const orderID = event.target.value;
      if(orderID){
        fetch(`http://localhost/SurplusStays/public/Customer/loadItems`,{
          method: "POST",
          headers:{
            "content-Type":"application/x-www-form-urlencoded",
          },
          body:`order_id=${orderID}`,
        })
        .then(response=>{
          if(!response.ok){
            throw new Error("Network response was not ok: "+response.statusText);
          }
          return response.json();
        })
        .then(data=>{
          
          const itemsDropdown=document.getElementById("orderItems");
          itemsDropdown.innerHTML="<option>Select Item</option>";
  
          data.forEach(item => {
              const option= document.createElement("option");
              option.value=item.order_items_id;
              // option.name='orderitem';
              option.textContent=item.product_name;
              itemsDropdown.appendChild(option);

              // set the business name after selection
              document.getElementById("shopName").innerHTML=item.business_name;
              document.getElementById('shopName').value=item.business_name;
              // set the business id after selection
              document.getElementById("shopID").value=item.business_id;
          });

          

        })
        .catch(error=>{
          console.error('Error fetching order items :');
        });
      }
    });
  }
  
}

function CustomerEditPopup() {
  alert("Hello");
  var test = document.getElementById("EditCustomerPopup-container");
  alert(test);
}

function replyToCustomer(id) {
  let rcpopup = document.getElementById("rcpopup");
  let rcpopupContainer = document.getElementById("rcpopup-container");
  rcpopup.classList.add("open-popup");
  rcpopupContainer.className = "open-popup-container";
  window.scrollTo({ top: 0, behavior: "smooth" });
  document.getElementById("complaintID").value = id;
}
function closePopup() {
  let rcpopup = document.getElementById("rcpopup");
  let rcpopupContainer = document.getElementById("rcpopup-container");
  rcpopup.classList.remove("open-popup");
  rcpopupContainer.className = "popup-container";
}


