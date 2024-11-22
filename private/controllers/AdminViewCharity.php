<?php
class AdminViewCharity extends Controller
{   
    
    function index($id){
        $charity=new AdminModel();
        $data=$charity->where('id',$id,'organization');
        if($data){
                 $data=$data[0];
        }

        $this->view('AdminViewCharity',[
            'rows'=>$data
        ]);
        
    }

    
}
?>