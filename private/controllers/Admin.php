<?php
class Admin extends Controller
{
    //View a charity organization
    function CharityOrgView(){
        $this->view('AdminViewCharity');
    }
    //Add new Charity organization
    function addNewCharityOrg()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $charity = new AdminModel();
            if ($charity->validateCharity($_POST)) {
                $logo = $_FILES['logo']['name'];
                $logoExt = explode('.', $logo);
                $logoActualExt = strtolower(end($logoExt));
                $logoNameNew=uniqid('',true).".".$logoActualExt;
                $fileDestination='../../SurplusStays/public/assets/uploads/'.$logoNameNew;
                move_uploaded_file($_FILES['logo']['tmp_name'],$fileDestination);
                //insert charity org
                $arr['name'] = $_POST['name'];
                $arr['picture']=$fileDestination;
                $arr['city'] = $_POST['city'];
                $arr['email'] = $_POST['email'];
                $arr['phoneNo'] = $_POST['phone'];
                $arr['charity_description'] = $_POST['description'];
                $arr['username'] = $_POST['username'];
                $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $arr['date'] = date("Y-m-d H:i:s");

                $charity->insert($arr, 'organization');
                //redirect to manage charity org 
                $this->view('AdminManageCharityOrganizations');
            } else {

                $errors = $charity->errors;
                $this->view('AddNewCharityOrg', ['errors' => $errors]);
            }
        } else {
            $this->view('AddNewCharityOrg', ['errors' => $errors]);
        }
    }

    function AddProduct()
    {
        $this->view('business_AddProduct');
    }
    function index()
    {
        // $db=new Database();
        // $data=$db->query("SELECT * FROM admin");
        // echo($data);
        $this->view('home_section1');
    }

    function register()
    {
        if (AdminAuth::logged_in()) {
            $this->view('adminWelcomePage');
        } else {
            $errors = array();

            if (count($_POST) > 0) {
                $user = new AdminModel();
                $charityOrg=$user->findAll('organization');
                if ($row = $user->where('email', $_POST['email'],'admin')) {
                    AdminAuth::authenticate($row);
                   
                    $this->view('adminWelcomePage',['charityOrg'=>$charityOrg]);
                } else {
                    if ($user->validate($_POST)) {

                        $this->view('adminWelcomePage',['charityOrg'=>$charityOrg]);
                    } else {
                        $errors = $user->errors;
                        $this->view('AdminLoginStep1', ['errors' => $errors]);
                    }

                    // $errors['email'] = "wrong email or password";
                }

                
            } else {
                $this->view('AdminLoginStep1', ['errors' => $errors]);
            }
        }


        // print_r($_POST);

    }

    function dashboard()
    {
        if (Auth::logged_in()) {
            $this->view('adminWelcomePage');
        } else {
            $this->redirect('register');
        }
    }
    function AdminLogin(){
        $this->view('adminLoginStep1');
    }

    function TrackExpiry()
    {
        $this->view('adminTrackExpiryPage');
    }

    function Complaints()
    {
        //AdminSeeComplainPage is the page to be directed after clicking on AdminBusinessComplaints
        $this->view('AdminBusinessComplaints');
    }
    function ViewComplain(){
        $this->view('AdminSeeComplainPage');
    }

    function ManageCustomers()
    {
        $this->view('AdminManageCustomers');
    }

    function ManageBusinesses()
    {
        $this->view('AdminManageBusinesses');
    }
    function ManageCharityOrg()
    {
        $this->view('AdminManageCharityOrganizations');
    }
    function Reports()
    {
        $this->view('AdminReports');
    }
    function RecentItems()
    {
        $this->view('home');
    }

    function test($name)
    {
        $data = [
            "username" => $name
        ];
        $this->view('aboutView', $data);
    }
}