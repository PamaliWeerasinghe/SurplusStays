<?php
class AdminCharity extends Controller
{
    //load all the charity organizations
    function index(){
        if(!AdminAuth::logged_in()){
            $this->redirect('register');
        }
        $user= new AdminModel();
        $data=$user->findAll('organization');
        $this->view('users',['rows'=>$data]);
    }
    

    // delete a charity organization
    function delete($id=null){
        if(!Auth::logged_in()){
            $this->redirect('register');
        }
        $charity=new AdminModel();

        $errors=array();

        if(count($_POST)>0){
            $charity->delete($id,'organization');
            $this->redirect('ManageCharityOrg');
        }
        $row=$charity->where('id',$id);

        $this->view('charity.delete',[
            'row'=>$row,
        ]);

    }
}
?>