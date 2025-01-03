<?php
class Admin extends Controller
{

    function makeComplaints(){
        $admin=new AdminComplaints();
        $noOfOrders=$admin->getNoOfOrders(Auth::getUserId());
        $orders=$admin->getAllOrders(Auth::getUserId());
        $this->view('customerMakeComplaint',[
            "orderCount"=>$noOfOrders[0]->orderCount,
            "orders"=>$orders
        ]);
    }

    function ReplyToComplaint(){
        $errors=array();
        
        if(count($_POST)){
            $id=$_POST['id'];
            $admin=new AdminModel();
            $arr['adminReply']=$_POST['feedback'];

            //$feedback=$admin->update($id,$arr,'complaints');
            // returns an empty array

            if($admin->update($id,$arr,'complaints')){
                
                $this->view('AdminLoginStep1');
            } else {
                $user=new AdminComplaints();
                $complaint_details=$user->complaintDetails($id);
                $complaint_images=$user->getComplaintImages($id);
                $this->view('AdminSeeComplainPage',[
                    "complaint_details"=>$complaint_details[0],
                    "complaint_imgs"=>$complaint_images,
                    "errors"=>$errors

                ]);
            }
         
            

        }

    }
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
        if (Auth::logged_in()) {
            $this->view('adminWelcomePage');
        } else {
            $errors = array();

            if (count($_POST) > 0) {
                $user = new AdminModel();
                $charityOrg = $user->findAll('organization');
                $email = $user->where('email', $_POST['email'], 'admin');


                if ($email) {
                    $password = $user->where('verification_code', $_POST['password'], 'admin');
                    if ($password) {
                        $password = $password[0];
                        $this->view('AdminWelcomePage', [
                            'adminDetails' => $password
                        ]);
                    } else {
                        $this->view('AdminLoginStep1');
                    }
                }
            }else{
                $this->view('AdminLoginStep1');
            }
        }
    }

    function dashboard()
    {
        if (Auth::logged_in()) {
            $this->view('adminWelcomePage');
        } else {
            $this->redirect('register');
        }
    }
    function AdminLogin()
    {
        $this->view('adminLoginStep1');
    }

    //Track the expiration products
    function TrackExpiry()
    {
    
        $user=new AdminModel();
        
        $rows=$user->findAll('trackexpiryproducts');
        if($rows==false){
            $no_of_data=0;
        }else{
            $no_of_data=1;
        }
        $this->view('adminTrackExpiryPage',[
            "rows"=>$rows,
            "rowCount"=>$no_of_data
        ]);

    }

    function Complaints()
    {
        $user=new AdminComplaints();
        $complaints=$user->getAllComplaints();
        //AdminSeeComplainPage is the page to be directed after clicking on AdminBusinessComplaints
        $this->view('AdminBusinessComplaints',[
            "complaints"=>$complaints
        ]);
    }
    function ViewComplain($complaint_id)
    {
        $user=new AdminComplaints();
        $complaint_details=$user->complaintDetails($complaint_id);
        $complaint_images=$user->getComplaintImages($complaint_id);
        $this->view('AdminSeeComplainPage',[
            "complaint_details"=>$complaint_details[0],
            "complaint_imgs"=>$complaint_images
        ]);
    }

    function ManageCustomers()
    {
        if(Auth::logged_in()){
            $user=new AdminModel();
            $customers=$user->findAll('customerDetails');
            $this->view('AdminManageCustomers',[
                "customers"=>$customers
            ]);
        }else{
            $this->view('adminLoginStep1');
        }
       

    }

    function ManageBusinesses()
    {
        $this->view('AdminManageBusinesses');
    }
    function ManageCharityOrg()
    {
        if (!Auth::logged_in()) {
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
        $this->view('home');
    }

    
}
