<?php 
    class Admin extends Controller{

        function index(){
            $this->view('AdminRefundMoney');
        }

        function register(){
            $this->view('AdminRegister');
        }
        
        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }




    }



?>