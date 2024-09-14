<?php 
    class Admin extends Controller{

        function index(){
            $this->view('AdminRegister');
        }

        function register(){
            $this->view('AdminRegister');
        }
        function dashboard(){
            $this->view('adminWelcomePage');
        }
        function TrackExpiry(){
            $this->view('adminTrackExpiryPage');
        }
        function seeComplain(){
            $this->view('');
        }
        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }





    }



?>