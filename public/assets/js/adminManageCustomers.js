
function CustomerEditPopup(){
    alert("Hello");
    var test=document.getElementById("EditCustomerPopup-container");
    alert(test);
}

function replyToCustomer(id){
    
    let rcpopup=document.getElementById("rcpopup");
    let rcpopupContainer=document.getElementById("rcpopup-container");
    rcpopup.classList.add("open-popup");
    rcpopupContainer.className="open-popup-container";
    window.scrollTo({top:0,behavior:'smooth'})
    document.getElementById("complaintID").value=id;
}
function closePopup(){
    let rcpopup=document.getElementById("rcpopup");
    let rcpopupContainer=document.getElementById("rcpopup-container");
    rcpopup.classList.remove("open-popup");
    rcpopupContainer.className="popup-container";
}

// function sendReply(){
//     let msg=document.getElementById("replyText").value;
//     let id=document.getElementById("complaintID").value;
//     const data=[id,msg];
//     const form=document.querySelector('#form1');
//     form.action=`http://localhost/surplusstays/public/AdminReplyToComplaint/${data}`;
    
// }