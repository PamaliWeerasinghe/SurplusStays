const data=[
    //Example Data Set
    [item1,item2,item3],
    [item1,item2,item3],
    [item1,item2,item3],
    [item1,item2,item3],
    [item1,item2,item3],
]
let currentPage=0;

const dataContainer=document.getElementById("order-table-body");
const prevBtn=document.getElementById("prevBtn");
const nextBtn=document.getElementById("nextBtn");

function loadPageDetails(page){
    //clearing existing data
    dataContainer.innerHTML='';

    //
}