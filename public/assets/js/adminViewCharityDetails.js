document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("delete_customer").onclick = function () {
        closeCustomer();
        user_id=document.getElementById("hidden_id").value;
        deletePopup(user_id);
    };
});

function deletePopup(rowId){
    let popup=document.getElementById("popup");
    let popupContainer=document.getElementById("popup-container");
    
        popupContainer.className="open-popup-container";
        popup.classList.add("open-popup");
        
        //setting the ID in the hidden input field
        document.getElementById('popupRowId').value=rowId;

        //dynamically set the form action
        const form=document.querySelector('#popup form');
        form.action=`http://localhost/surplusstays/public/AdminDeleteCharity/${rowId}`;
        
    
}
function closedeletePopup(){
    popup.classList.remove("open-popup");
    popupContainer.className="popup-container";
}
function viewOrganization(user_id,cus_id){
  
    let rcpopup = document.getElementById("rcpopup");
    let rcpopupContainer = document.getElementById("rcpopup-container");
  
    //fetch the customer details
    fetch(`http://localhost/SurplusStays/public/admin/charityDetails/${user_id}/${cus_id}`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json(); // Convert response to JSON
    })
    .then(data => {
        console.log("Fetched Data:", data); // Debugging: Check JSON structure

        // Check if 'customer' exists and is an array
        if (data.org && Array.isArray(data.org) && data.org.length > 0) {
            document.getElementById("customerImg").src=`http://localhost/SurplusStays/public/assets/charityImages/${data.org[0].profile_pic}`;
            document.getElementById("name").innerHTML = data.org[0].org_name;
            document.getElementById("email").innerHTML = data.org[0].user_email;
            document.getElementById("phoneNo").innerHTML = data.org[0].org_contact;
            document.getElementById("orders").innerHTML = data.countDonations;
            document.getElementById("edit_customer").onclick=function(){
                window.location.href=`http://localhost/SurplusStays/public/admin/viewCharity/${user_id}/${cus_id}`
            }
            document.getElementById("hidden_id").value=data.org[0].user_id;
            
            //selects the table body
            let tbody=document.querySelector(".order-table tbody");
            // //clear the rows
            tbody.innerHTML="";
            donation=data.donations;
            
            // console.log(complaints);
            let row = document.createElement("tr");
            if (data.donations && Array.isArray(data.donations) && data.donations.length > 0) {
            data.donations.forEach((donation,index) => {
                
                        let row = document.createElement("tr");
                        row.innerHTML=`
                        <td>#${index+1}</td>
                        <td>${donation.bus_name}</td>
                        <td>${donation.donate_date}</td>
                        <td>${donation.donate_title}</td>
                        `;
                        tbody.appendChild(row);
               
                    });
            }else{
                row.innerHTML=`<td>No Donations</td>`;
                tbody.appendChild(row);
            }
            //check recent images
            let container1=document.getElementById('profile-section-1');
            let container2=document.getElementById('profile-section-2'); 
            container1.style.backgroundImage='none';
            container2.style.backgroundImage='none';
            container1.innerHTML="";              
            container2.innerHTML="";
            
            if(data.businesses && Array.isArray(data.businesses) && data.businesses.length>0){
                path='http://localhost/SurplusStays/public/assets/businessImages/'
               
                data.businesses.forEach((images,index)=>{
                    
                    let container=document.getElementById(`profile-section-${index+1}`);

                    // const img=document.createElement("img");
                    
                    if(images.business_logo==null){
                        container.innerHTML="No image Found"
                    }else{
                        src=path+images.business_logo;
                        container.style.backgroundRepeat='no-repeat'
                        container.style.backgroundPosition='center'
                        container.style.backgroundSize='contain'
                        container.style.backgroundImage=`url('${src}')`
                        // container.appendChild(img);
                    }

                  
                   
                })
                
            }else{
                
                                    
                 container1.innerHTML="No Recent Donations";
                                   
                 container2.innerHTML="No Recent Donations";
                    

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
function closeCharity(){
    let rcpopup = document.getElementById("rcpopup");
    let rcpopupContainer = document.getElementById("rcpopup-container");
    rcpopup.classList.remove("open-popup");
    rcpopupContainer.className = "popup-container";
}




