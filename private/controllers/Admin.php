<?php
class Admin extends Controller
{
    
    function loadItems(){
        if(isset($_POST['order_id'])){
            $order_id=$_POST['order_id'];
            $admin=new AdminComplaints();
            $items=$admin->getAllOrders($order_id);
        
            echo json_encode($items);
        }else{
            http_response_code(400);
            echo json_encode(['error'=>'Invalid Request']);
        }    
    }
    
    function makeComplaints(){
        $images=array();
        if(count($_POST)){
            $errors=array();
            $business_id=$_POST['shopID'];
            $orderId=$_POST['orderid'];
            $orderItem=$_POST['orderitem'];
            $complaint=$_POST['complaint'];
            $img1=$_FILES['complaintImg1']['name'];
            $img2=$_FILES['complaintImg2']['name'];
            $img3=$_FILES['complaintImg3']['name'];
            $img4=$_FILES['complaintImg4']['name'];
            $img5=$_FILES['complaintImg5']['name'];
        
           

            if(isset($img1)){
                array_push($images,$img1);
            }
            if(isset($img2)){
                array_push($images,$img2);
            }
            if(isset($img3)){
                array_push($images,$img3);
            }
            if(isset($img4)){
                array_push($images,$img4);
            }
            if(isset($img5)){
                array_push($images,$img5);
            }
            
            if($orderId=='oid'){
                $errors["oid"]='Order ID not Selected';
            }
            if($orderItem=='selectItem'){
                $errors["item"]='Order Item is not Selected';
            } 
            if(empty($complaint)){
                $errors['complaint']="No complaint added";
            }
            if(empty($images[0]) && empty($images[1]) && empty($images[2]) && empty($images[3]) && empty($images[4])){
                $errors['images']="Complaint should contain at least one image";
            }

           
            $admin=new AdminComplaints();
            
            
            $orders=$admin->getNoOfOrders(1);
            $orderDetails=$admin->getAllOrders(1);

            if(count($errors)>0){
                $this->view('customerMakeComplaint',[
                    "orders"=>$orders,
                    "orderDetails"=>$orderDetails,
                    "errors"=>$errors
                ]);
            }else{
                    $errors=array();
                    //find the complaint status - (not attended)
                    $complaint_status=$admin->where('name','Not Attended','complaint_status');
                    $complaint_status=$complaint_status[0];
                    
                    //insert into complaints
                    $arr['business_id']=$business_id;
                    $arr['complaint_status_id']=$complaint_status->id;
                    $arr['complaint_dateTime']=date('Y-m-d H:i:s');
                    $arr['customer_id']='1';
                    $arr['order_items_id']=$orderItem;
                    $arr['description']=$complaint;
                    
                   
                    // insert complaint images
                    $insertImg=array();
                  
                    for($i=0;$i<count($images);$i++){
                        if(!empty($images[$i])){
                            $imgPath=$admin->uploadImage($images[$i],$i);
                            array_push($insertImg,$imgPath);

                        }  
                    }
                    if(!$admin->insertComplaint($arr,$insertImg)){
                        $errors["complaint_insertion"]="Couldn't insert";
                    }
              
                $this->view('customerMakeComplaint',[
                    "orders"=>$orders,
                    "orderDetails"=>$orderDetails
                ]);
            }

        }else{
            $admin=new AdminComplaints();
            $orders=$admin->getNoOfOrders(1);
            $orderDetails=$admin->getAllOrders(1);
            $this->view('customerMakeComplaint',[
                "orders"=>$orders,
                "orderDetails"=>$orderDetails
            ]);
        }
       


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
                $arr['city'] = $_POST['city'];
                $arr['phoneNo'] = $_POST['phone'];
                $arr['charity_description'] = $_POST['description'];
                $arr['username'] = $_POST['username'];
                $arr['user_id']='5';
                
                
                $user_arr['email'] = $_POST['email'];
                $user_arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user_arr['profile_pic'] = $charity->uploadLogo($_FILES['logo']['name']);
                $user_arr['role']='charity';
                $user_arr['reg_date']=date('Y-m-d H:i:s');
                
                $insertcharity=new Admin_Model();
                $insertcharity->insert($user_arr,'user');
                $insertcharity->insert($arr, 'organization');
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
