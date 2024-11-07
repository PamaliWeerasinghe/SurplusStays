<?php 
    class Admin extends Controller{
        function AddProduct(){
            $this->view('business_AddProduct');
        }
        function index(){
            // $db=new Database();
            // $data=$db->query("SELECT * FROM admin");
            // echo($data);
            $this->view('home_section1');
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

        function Complaints(){
            $this->view('AdminSeeComplainPage');
        }

        function ManageCustomers(){
            $this->view('AdminManageCustomers');
        }
        
        function ManageBusinesses(){
            $this->view('AdminManageBusinesses');
        }
        function ManageCharityOrg(){
            $this->view('AdminManageCharityOrganizations');
        }
        function Reports(){
            $this->view('AdminReports');
        }
        function RecentItems(){
            $this->view('home');
        }

        function test($name){
            $data=[
                "username"=>$name
            ];
            $this->view('aboutView',$data);
        }





    }



?>