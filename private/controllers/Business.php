<?php 
    class Business extends Controller{

        function index(){
            $this->view('businessWelcomePage');
        }

        function dashboard(){
            $this->view('businessWelcomePage');
        }

        function myproducts(){
            $this->view('businessMyProducts');
        }

        function orders(){
            $this->view('businessOrders');
        }

        function requests(){
            $this->view('businessRequests');
        }
        
        function complains(){
            $this->view('businessComplains');
        }
        function reports(){
            $this->view('businessReports');
        }
        function profile(){
            $this->view('businessProfile');
        }
        

        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }





    }



?>