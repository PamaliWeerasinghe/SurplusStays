 
    let popup=document.getElementById("popup");
    let popupContainer=document.getElementById("popup-container");
    function openPopup(rowId){
        popup.classList.add("open-popup");
        popupContainer.className="open-popup-container";

        //setting the ID in the hidden input field
        document.getElementById('popupRowId').value=rowId;

        //dynamically set the form action
        const form=document.querySelector('#popup form');
        form.action=`http://localhost:8080/surplusstays/public/AdminDeleteCharity/${rowId}`;
        
    }
    function closePopup(){
        popup.classList.remove("open-popup");
        popupContainer.className="popup-container";
    }
