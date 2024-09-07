<?php 
    class Admin extends Controller{

        function index(){
            $this->view('adminTrackExpiryPage');
        }

        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }




    }



?>