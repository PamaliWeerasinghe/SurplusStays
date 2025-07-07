function viewCharity(user_id,org_id){
    fetch(`http://localhost/SurplusStays/public/admin/charityDetails/${user_id}`)
    .then(response => {
        if(!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json(); // Convert response to JSON
    })
    .then(data => {
        window.location.href=`http://localhost/SurplusStays/public/admin/viewCharity/${user_id}/${data[0].org_id}`
    })

}

