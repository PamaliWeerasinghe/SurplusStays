<?php 
    class Admin extends Controller{

        function index(){
            $this->view('adminManageCharityOrganizations');
        }

        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }




    }



?>