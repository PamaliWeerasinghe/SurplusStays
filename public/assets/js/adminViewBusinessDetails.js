function viewBusiness(id){
  
    let rcpopup = document.getElementById("rcpopup");
    let rcpopupContainer = document.getElementById("rcpopup-container");
  
    //fetch the customer details
    fetch(`http://localhost/SurplusStays/public/admin/businessDetails/${id}`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json(); // Convert response to JSON
    })
    .then(data => {
        console.log("Fetched Data:", data); // Debugging: Check JSON structure

        // Check if 'customer' exists and is an array
        if (data.business && Array.isArray(data.business) && data.business.length > 0) {
            document.getElementById("name").innerHTML = data.business[0].business_name;
            document.getElementById("email").innerHTML = data.business[0].email;
            document.getElementById("phoneNo").innerHTML = data.business[0].phoneNo;
            document.getElementById("orders").innerHTML = data.no_of_orders;
            document.getElementById("edit_business").onclick=function(){
                window.location.href=`http://localhost/SurplusStays/public/admin/viewBusiness/${data.business[0].bus_id}`
            }
            document.getElementById("hidden_id").value=data.business[0].bus_id;
            
            //selects the table body
            let tbody=document.querySelector(".order-table tbody");
            // //clear the rows
            tbody.innerHTML="";
            complaints=data.business_complaints;
            // console.log(complaints);
            let row = document.createElement("tr");
            if (data.business_complaints && Array.isArray(data.business_complaints) && data.business_complaints.length > 0) {
            data.business_complaints.forEach((complaints,index) => {
                
                
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
            //check recent images
            let container1=document.getElementById('profile-section-1');
            let container2=document.getElementById('profile-section-2'); 
            if(data.images && Array.isArray(data.images) && data.images.length>0){
                path='http://localhost/SurplusStays/public/assets/images/'
               
                data.images.forEach((images,index)=>{
                    container1.innerHTML="";              
                    container2.innerHTML="";
                    let container=document.getElementById(`profile-section-${index+1}`);

                    // const img=document.createElement("img");
                    
                    if(images.pictures==null){
                        container.innerHTML="No image Found"
                    }else{
                        src=path+images.pictures;
                        container.style.backgroundRepeat='no-repeat'
                        container.style.backgroundImage=`url('${src}')`
                        // container.appendChild(img);
                    }

                  
                   
                })
                
            }else{
                
                                    
                 container1.innerHTML="No Recent Products";
                                   
                 container2.innerHTML="No Recent Products";
                    

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
function closeCustomer(){
    let rcpopup = document.getElementById("rcpopup");
    let rcpopupContainer = document.getElementById("rcpopup-container");
    rcpopup.classList.remove("open-popup");
    rcpopupContainer.className = "popup-container";
}