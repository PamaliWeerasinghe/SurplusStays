<?php 
    class Business extends Controller{

        function index(){

            if(!Auth::logged_in()){
                $this->redirect('login');
            }

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
            $this->view('businessAddProduct');
        }
        function profile(){
            $this->view('businessProfile');
        }
        function addproduct(){
            $this->view('businessAddProduct');
        }
        

        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }





    }



?>