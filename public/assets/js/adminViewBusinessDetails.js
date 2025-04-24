document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("delete_business").onclick = function () {
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
        form.action=`http://localhost/surplusstays/public/Admin/DeleteBusiness/${rowId}`;
        
    
}

function closedeletePopup(){
    popup.classList.remove("open-popup");
    popupContainer.className="popup-container";
}
function viewBusiness(user_id,business_id){
    // alert(business_id);
    let rcpopup = document.getElementById("rcpopup");
    let rcpopupContainer = document.getElementById("rcpopup-container");
  
    //fetch the customer details
    fetch(`http://localhost/SurplusStays/public/admin/businessDetails/${user_id}/${business_id}`)
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
            document.getElementById("businessImg").src=`http://localhost/SurplusStays/public/assets/businessImages/${data.business[0].profile_pic}`;
            document.getElementById("name").innerHTML = data.business[0].business_name;
            // document.getElementById("name").innerHTML =data.images1;
            document.getElementById("email").innerHTML = data.business[0].email;
            document.getElementById("phoneNo").innerHTML = data.business[0].phoneNo;
            document.getElementById("orders").innerHTML = data.no_of_orders;
            document.getElementById("edit_business").onclick=function(){
                window.location.href=`http://localhost/SurplusStays/public/admin/viewBusiness/${user_id}/${business_id}}`
            }
            document.getElementById("hidden_id").value=user_id;
            
            //selects the table body
            let tbody=document.querySelector(".order-table tbody");
            // //clear the rows
            tbody.innerHTML="";
            complaints=data.business_complaints;
            // console.log(complaints);
            
            if (data.business_complaints && Array.isArray(data.business_complaints) && data.business_complaints.length > 0) {
            data.business_complaints.forEach((complaints,index) => {
                
                let row = document.createElement("tr");
                        row.innerHTML=`
                        <td>#${index+1}</td>
                        <td>${complaints.complaintDescription}</td>
                        <td>${complaints.complaint_date}</td>
                        <td style="text-align: center;">${complaints.complaint_status==='Not Attended'?' <button class="take-action" style="font-size:10px">Take Action</button>':
                            ' <button class="completed" style="font-size:10px">Resolved</button>'
                        }
                        </td>
                        <td style="text-align: center;">
                        ' <button 
                                class="see-complain" 
                                style="color:grey;background-color:transparent;border-style:solid;border-color:grey;font-size:10px"
                                onclick="window.location.href='http://localhost/SurplusStays/public/Admin/ViewComplain/${complaints.complaint_id}'"
                        >
                                See Complain
                        </button>'
                        </td>
                        `;
                        tbody.appendChild(row);
               
                    });
            }else{
                let row = document.createElement("tr");
                row.innerHTML=`<td>No complaints</td>`;
                tbody.appendChild(row);
            }
            //check recent images
            let container1=document.getElementById('profile-section-1');
            let container2=document.getElementById('profile-section-2'); 
            container1.style.backgroundImage='none';
            container2.style.backgroundImage='none';
            container1.innerHTML="";              
            container2.innerHTML="";

            if(data.images1!='no product'){
                path=`http://localhost/SurplusStays/public`;
                src=path+`${data.images1}`;
                console.log(src);
                container1.style.backgroundRepeat='no-repeat'
                container1.style.backgroundPosition='center'
                container1.style.backgroundSize='contain'
                container1.style.backgroundImage=`url('${src}')`
            }else{
                container1.innerHTML="No Recent Products";
            }

            //set the second image also
            if(data.images2!='no product'){
                path=`http://localhost/SurplusStays/public`;
                src=path+`${data.images2}`;
                console.log(src);
                container2.style.backgroundRepeat='no-repeat'
                container2.style.backgroundPosition='center'
                container2.style.backgroundSize='contain'
                container2.style.backgroundImage=`url('${src}')`
            }else{
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