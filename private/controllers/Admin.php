<?php 
    class Admin extends Controller{

        function index(){
            $this->view('adminManageCustomers');
        }

        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }




    }



?>