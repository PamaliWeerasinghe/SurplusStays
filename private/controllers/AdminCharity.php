<?php
class AdminCharity extends Controller
{
    // function edit($id){
    //     $charity=new AdminModel();
    //     $data=$charity->where('id',$id,'organization');
    //     $errors=null;

    //     $this->view('AdminViewCharity',[
    //         'rows'=>$data,
    //         'errors'=>$errors
    //     ]);
    // }



    function index($id)
    {
        
        $charity = new AdminModel();
        $errors=array();
        $arr=array();
       

        if (count($_POST) > 0) {
            if ($charity->validateEditCharity($_POST)) {
                $arr = $charity->data;
        
                $charity->update($id,$arr,'organization');
                $data = $charity->where('id', $id, 'organization');
                if ($data) {
                    $data = $data[0];
                
                }
                $this->view('AdminViewCharity', [
                    'rows' => $data,
                    
                ]);

                

            } else {
                $errors = $charity->errors;
                $data = $charity->where('id', $id, 'organization');
                if ($data) {
                    $data = $data[0];
                }
                $this->view('AdminEditCharityOrg', [
                    'rows' => $data,
                    'errors' => $errors
                ]);
            }
        } else {

            $data = $charity->where('id', $id, 'organization');
            if ($data) {
                $data = $data[0];
            }


            $this->view('AdminEditCharityOrg', [
                'rows' => $data
            ]);
        }


        // if(count($_POST)>0){

        // }else{

        // }


        // $charity=new AdminModel();
        // $data=$charity->where('id',$id,'organization');
        // if($data){
        //     $data=$data[0];
        // }

        // $this->view('AdminViewCharity',[
        //     'rows'=>$data,

        // ]);

    }

    //delete a charity organization
    function delete($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('register');
        }
        $charity = new AdminModel();

        $errors = array();

        if (count($_POST) > 0) {
            $charity->delete($id, 'organization');
            $this->redirect('ManageCharityOrg');
        }
        $row = $charity->where('id', $id, 'organization');

        $this->view('AdminManageCharityOrg', [
            'row' => $row,
        ]);
    }
}
