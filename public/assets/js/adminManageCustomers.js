function loadOrderItems() {
  const oid = document.getElementById("orderID");
  if(oid!="oid"){
    oid.addEventListener("change", (event) => {
      const orderID = event.target.value;
      if(orderID){
        fetch('http://localhost/SurplusStays/public/admin/loadItems',{
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
              option.value=item.id;
              option.textContent=item.product_name;
              itemsDropdown.appendChild(option);
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

// function sendReply(){
//     let msg=document.getElementById("replyText").value;
//     let id=document.getElementById("complaintID").value;
//     const data=[id,msg];
//     const form=document.querySelector('#form1');
//     form.action=`http://localhost/surplusstays/public/AdminReplyToComplaint/${data}`;

// }
