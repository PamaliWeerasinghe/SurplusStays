<?php
class Admin extends Controller
{
    //View a charity organization
    function CharityOrgView()
    {
        $this->view('AdminViewCharity');
    }
    //Add new Charity organization
    function addNewCharityOrg()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $charity = new AdminModel();
            if ($charity->validateCharity($_POST)) {

                //insert charity org
                $arr['name'] = $_POST['name'];
                $arr['picture'] = $charity->uploadLogo($_FILES['logo']['name']);
                $arr['city'] = $_POST['city'];
                $arr['email'] = $_POST['email'];
                $arr['phoneNo'] = $_POST['phone'];
                $arr['charity_description'] = $_POST['description'];
                $arr['username'] = $_POST['username'];
                $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $arr['date'] = date("Y-m-d H:i:s");

                $charity->insert($arr, 'organization');
                $data = $charity->findAll('organization');
                
                //include donors and complaints
                $countd = new AdminCharityDetails();
                foreach ($data as $row) {
                    $count = $countd->getDonorCount($row->id);
                    $row->donors = $count;
                }
                foreach ($data as $row) {
                    $count = $countd->getComplaintsCount($row->id);
                    $row->donations = $count;
                }
                
                //redirect to manage charity org 
                $this->view('AdminManageCharityOrganizations', ['rows' => $data]);
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

        // $this->view('home_section1');
        $this->view('popup');
    }

    function register()
    {
        if (AdminAuth::logged_in()) {
            $this->view('adminWelcomePage');
        } else {
            $errors = array();

            if (count($_POST) > 0) {
                $user = new AdminModel();
                $charityOrg = $user->findAll('organization');
                $email=$user->where('email',$_POST['email'],'admin');


                if($email){
                    $password=$user->where('verification_code',$_POST['email'],'admin');
                    if($password){
                        $password=$password[0];
                        $this->view('AdminWelcomePage',[
                            'adminDetails'=>$password
                        ]);
                    }else{
                        $this->view('AdminLoginStep1');
                    }
                }

            }

        }


    }

    function dashboard()
    {
        if (AdminAuth::logged_in()) {
            $this->view('adminWelcomePage');
        } else {
            $this->redirect('register');
        }
    }
    function AdminLogin()
    {
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
    function ViewComplain()
    {
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
        if (!AdminAuth::logged_in()) {
            $this->redirect('register');
        } else {
            $user = new AdminModel();
            $data = $user->findAll('organization');
            $countd = new AdminCharityDetails();
            foreach ($data as $row) {
                $count = $countd->getDonorCount($row->id);
                $row->donors = $count;
            }
            foreach ($data as $row) {
                $count = $countd->getComplaintsCount($row->id);
                $row->donations = $count;
            }
            $this->view('AdminManageCharityOrganizations', ['rows' => $data]);
        }
    }
    function Reports()
    {
        $this->view('AdminReports');
    }
    function RecentItems()
    {
        $this->view('home');
    }
    function landing()
    {
        $this->view('home_section1');
    }
}
