 
    let popup=document.getElementById("popup");
    let popupContainer=document.getElementById("popup-container");
    function openPopup(rowId){
        popupContainer.className="open-popup-container";
        popup.classList.add("open-popup");
        
        //setting the ID in the hidden input field
        document.getElementById('popupRowId').value=rowId;

        //dynamically set the form action
        const form=document.querySelector('#popup form');
        form.action=`http://localhost/surplusstays/public/AdminDeleteCharity/${rowId}`;
        
    }
    function closePopup(){
        popup.classList.remove("open-popup");
        popupContainer.className="popup-container";
    }
