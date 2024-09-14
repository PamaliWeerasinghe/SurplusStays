function dashboard(){
    var buttons=document.querySelectorAll('.btn-Selected');

    buttons.forEach(btn=>{
        btn.className='btn-nonSelected'
      
    });

    document.getElementById("dashboard").className='btn-Selected';
}
function trackExpiry(){
    
    
    var buttons=document.querySelectorAll('.btn-Selected');

    buttons.forEach(btn=>{
        btn.className='btn-nonSelected'
      
    });

    document.getElementById("trackExpiry").className='btn-Selected';
    
    window.location.href='http://localhost/SurplusStays/public/admin/TrackExpiry'
   
    
}
function complaints(){
     window.location.href='http://localhost/SurplusStays/public/admin/seeComplain'
    var buttons=document.querySelectorAll('.btn-Selected');

    buttons.forEach(btn=>{
        btn.className='btn-nonSelected'
      
    });

    document.getElementById("complaints").className='btn-Selected';
    
}
function manageCustomers(){
    var buttons=document.querySelectorAll('.btn-Selected');

    buttons.forEach(btn=>{
        btn.className='btn-nonSelected'
      
    });

    document.getElementById("manageCustomers").className='btn-Selected';
    
}
function manageBusinesses(){
    var buttons=document.querySelectorAll('.btn-Selected');

    buttons.forEach(btn=>{
        btn.className='btn-nonSelected'
      
    });

    document.getElementById("manageBusinesses").className='btn-Selected';
    
}
function manageCharity(){
    var buttons=document.querySelectorAll('.btn-Selected');

    buttons.forEach(btn=>{
        btn.className='btn-nonSelected'
      
    });

    document.getElementById("manageCharity").className='btn-Selected';
    
}
function reports(){
    var buttons=document.querySelectorAll('.btn-Selected');

    buttons.forEach(btn=>{
        btn.className='btn-nonSelected'
      
    });

    document.getElementById("reports").className='btn-Selected';
    
}
function profile(){
    var buttons=document.querySelectorAll('.btn-Selected');

    buttons.forEach(btn=>{
        btn.className='btn-nonSelected'
      
    });

    document.getElementById("profile").className='btn-Selected';
    
}



