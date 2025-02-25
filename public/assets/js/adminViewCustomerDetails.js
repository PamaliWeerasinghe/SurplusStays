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
            document.getElementById("fname").innerHTML = data.customer[0].fname;
            document.getElementById("lname").innerHTML = data.customer[0].lname;
            document.getElementById("email").innerHTML = data.customer[0].email;
            document.getElementById("phoneNo").innerHTML = data.customer[0].phoneNo;
            document.getElementById("orders").innerHTML = data.no_of_orders;
        
            //selects the table body
            let tbody=document.querySelector(".order-table tbody");
            // //clear the rows
            tbody.innerHTML="";
            complaints=data.customer_complaints;
            // console.log(complaints);
            let row = document.createElement("tr");
            if (data.customer_complaints && Array.isArray(data.customer_complaints) && data.customer_complaints.length > 0) {
            data.customer_complaints.forEach((complaints,index) => {
                
                
                        row.innerHTML=`
                        <td>#${index+1}</td>
                        <td>${complaints.complaintDescription}</td>
                        <td>${complaints.complaint_date}</td>
                        <td>${complaints.complant_status==='Not Attended'?
                            ' <td style="text-align: center;"><button class="completed">Attend</button></td>'
                            :
                            ' <td style="text-align: center;"><button class="take-action">Attend</button></td>'
                        }</td>
                        <td>
                        ' <button 
                                class="see-complain" 
                                style="color:grey;background-color:transparent;border-style:solid;border-color:grey"
                                onclick="window.location.href='<?=ROOT?>/Admin/ViewComplain/'"
                        >
                                See Complain
                        </button>'
                        </td>
                        `;
                        tbody.appendChild(row);
               
                    });
            }else{
                row.innerHTML=`<td>No complaints</td>`;
                tbody.appendChild(row);
            }

        } else {
            console.error("Customer data not found", data);
            document.getElementById("fname").innerHTML = "Customer Not Found";
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