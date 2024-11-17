<?php
class AdminCharity extends Controller
{
    //load all the charity organizations
    function index(){
        if(!Auth::logged_in()){
            $this->redirect('register');
        }
        $user= new AdminModel();
        $data=$user->findAll('organization');
        $this->view('users',['rows'=>$data]);
    }
}
?>