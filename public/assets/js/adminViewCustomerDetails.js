function viewCustomer(id){
  
    let rcpopup = document.getElementById("rcpopup");
    let rcpopupContainer = document.getElementById("rcpopup-container");
  
    //fetch the customer details
    fetch(`http://localhost/SurplusStays/public/admin/customerDetails/${id}`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json(); // Convert response to JSON
    })
    .then(data => {
        console.log("Fetched Data:", data); // Debugging: Check JSON structure

        // Check if 'customer' exists and is an array
        if (data.customer && Array.isArray(data.customer) && data.customer.length > 0) {
            document.getElementById("name").innerHTML = data.customer[0].fname;
        } else {
            console.error("Customer data not found", data);
            document.getElementById("name").innerHTML = "Customer Not Found";
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
    });
    //open the popup
      rcpopup.classList.add("open-popup");
      rcpopupContainer.className = "open-popup-container";
      window.scrollTo({ top: 0, behavior: "smooth" });
     
    
}
function closeCustomer(id){
    let rcpopup = document.getElementById("rcpopup");
    let rcpopupContainer = document.getElementById("rcpopup-container");
    rcpopup.classList.remove("open-popup");
    rcpopupContainer.className = "popup-container";
}

function editCustomer(){
    alert("edit")
}