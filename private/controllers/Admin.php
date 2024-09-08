<?php 
    class Admin extends Controller{

        function index(){
            $this->view('AdminRefundMoney');
        }

        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }




    }



?>