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
        
            $errors=array();
            if(count($_POST)>0){
                $user=new User();
               
                if($user->validate($_POST)){
                
                    $this->view('AdminRegister');
                }else{
                    $errors=$user->errors;
                    $this->view('AdminLoginStep1',['errors'=>$errors]);
                
                }
              
            }else{
                $this->view('AdminLoginStep1',['errors'=>$errors]);
            }
            
            // print_r($_POST);
            
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