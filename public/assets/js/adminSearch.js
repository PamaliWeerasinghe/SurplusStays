function search(){
    var input=document.getElementById("searchInput");
    var filter=input.value.toUpperCase();
    var order_table=document.getElementById("order-table-body");
    var td=document.getElementsByName('td');

    for (i=0;i<td.length;i++){
        var a=td[i].getElementsByTagName("a")[0];
        var txtValue=a.textContent || a.innerText;
        if(txtValue.toUpperCase().indexOf(filter)>-1){
            li[i].style.display="";

        }else{
            
        }
    }
}