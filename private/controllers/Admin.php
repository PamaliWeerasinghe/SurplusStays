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
    // customer make a complaint
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
                    $complaint_status=$admin->where(['name'],['Not Attended'],'complaint_status');
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

                    // Columns
                    $columns=['business_id','customer_id','order_items_id'];

                    //values
                    $values=[$business_id,'1',$orderItem];


                    if(!$admin->insertComplaint($arr,$insertImg,$columns,$values)){
                        $errors["complaint_insertion"]="Complaint already exists";
                        $this->view('customerMakeComplaint',[
                            "orders"=>$orders,
                            "orderDetails"=>$orderDetails,
                            "errors"=>$errors
                        ]);
                    }else{
                        //send notification for the admin
                        // new Mailer();
                        
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
    // Reply to a complaint
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
    
    //Add new product of a business
    function AddProduct()
    {
        $this->view('business_AddProduct');
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
           $admin=new AdminModel();
           $complaint_limit =3;
           //count the no of complaints in the table complaints
           $complaintCountData=$admin->count('complaintDetails');
           //calculate the no of pages
           $noOfPages_complaints= ceil($complaintCountData/$complaint_limit);
            
           //Pagination for complaints

           $complaints_pager=Pager::getInstance('complaints',$noOfPages_complaints,$complaint_limit);
           $complaints_offset=$complaints_pager->offset;
           $complaints=$admin->select('complaintdetails','complaint_id',$complaint_limit,$complaints_offset);
           
           
           $product_limit=1;
           //count the no of products in the table products
           $productsCountData=$admin->count('products');
           //calculate the no of pages
           $noOfPages_products= ceil($productsCountData/$product_limit);
           
           //Pagination for products
           $products_pager=Pager::getInstance('products',$noOfPages_products,$product_limit);
           $products_offset=$products_pager->offset;
           $products=$admin->select('products','expiration_dateTime',$product_limit,$products_offset);
        
          
           $this->view('adminWelcomePage',[
                "complaints"=>$complaints,
                "complaints_pager"=>$complaints_pager,
                "products"=>$products,
                "products_pager"=>$products_pager

           ]);
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
    
        $admin=new AdminModel();
        
        $product_limit=1;
        //count the no of products in the table products
        $productsCountData=$admin->count('about_to_expire_products');
        //calculate the no of pages
        $noOfPages_products= ceil($productsCountData/$product_limit);
        
        //Pagination for products
        $products_pager=Pager::getInstance('about_to_expire_products',$noOfPages_products,$product_limit);
        $products_offset=$products_pager->offset;
        $products=$admin->select('about_to_expire_products','bestBefore',$product_limit,$products_offset);
     
        $this->view('adminTrackExpiryPage',[
            "rows"=>$products,
            "products_pager"=>$products_pager

        ]);

    }
    //View all the complaints
    function Complaints()
    {
        $admin=new AdminModel();
        
        $complaint_limit=1;
        //count the no of complaints in the non_resolved_complaints view
        $complaintsCountData=$admin->count('non_resolved_complaints');
        //calculate the no of pages
        $noOfPages_complaints= ceil($complaintsCountData/$complaint_limit);
        
        //Pagination for complaints
        $complaints_pager=Pager::getInstance('non_resolved_complaints',$noOfPages_complaints,$complaint_limit);
        $complaints_offset=$complaints_pager->offset;
        $complaints=$admin->select('non_resolved_complaints','complaint_dateTime',$complaint_limit,$complaints_offset);

        // $user=new AdminComplaints();
        // $complaints=$user->getAllComplaints();
        //AdminSeeComplainPage is the page to be directed after clicking on AdminBusinessComplaints
        $this->view('AdminBusinessComplaints',[
            "complaints"=>$complaints,
            "complaints_pager"=>$complaints_pager
        ]);
    }
    //View a respective complaint made by a customer
    function ViewComplain($complaint_id)
    {
        $admin=new AdminComplaints();
        $complaint_details=$admin->complaintDetails($complaint_id);
        $complaint_images=$admin->getComplaintImages($complaint_id);
        $this->view('AdminSeeComplainPage',[
            "complaint_details"=>$complaint_details[0],
            "complaint_imgs"=>$complaint_images
        ]);
    }
    //Manage all the customers
    function ManageCustomers()
    {
        // if(Auth::logged_in()){
            $admin=new AdminModel();
        
            $customer_limit=5;
            //count the no of products in the table products
            $customersCountData=$admin->count('customer_details');
            //calculate the no of pages
            $noOfPages_customers= ceil($customersCountData/$customer_limit);
            
            //Pagination for products
            $customers_pager=Pager::getInstance('customer_details',$noOfPages_customers,$customer_limit);
            $customers_offset=$customers_pager->offset;
            $customers=$admin->select('customer_details','fname',$customer_limit,$customers_offset);
         
            $this->view('adminManageCustomers',[
                "customers"=>$customers,
                "customers_pager"=>$customers_pager
    
            ]);
            
        // }else{
            // $this->view('adminLoginStep1');
        // }
       

    }
    //Add new customer
    function addNewCustomer()
    {
        $errors=array();
        if(count($_POST)>0){
                $customer=new AdminCustomer();
                if($customer->validateCustomer($_POST)){
                    $user['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $user['email']=$_POST['email'];
                    $user['role']='customer';
                    $user['profile_pic']=$customer->uploadCustomerPic($_FILES['profile_picture']['name']);
                    $user['reg_date']=date('Y-m-d H:i:s');

                    $add_customer['fname']=$_POST['fname'];
                    $add_customer['lname']=$_POST['lname'];
                    $add_customer['phoneNo']=$_POST['phone'];
                    $add_customer['username']=$_POST['username'];
                    
                    
                    $user_columns=['email','password','role','profile_pic','reg_date'];
                    $user_values=[$user['email'],$user['password'],$user['role'],$user['profile_pic'],$user['reg_date']];
                   
                    $customer_columns=['fname','lname','phoneNo'];
                    $customer_values=[$add_customer['fname'],$add_customer['lname'],$add_customer['phoneNo']];
                    
                    if(!$customer->insertCustomer(
                        $user_columns,$user_values,$customer_columns,
                        $customer_values,$user,$add_customer
                        )){
                            $errors["customer_insertion"]="Customer already exists";
                            $this->view('AdminAddNewCustomer',[
                                "errors"=>$errors
                            ]);
                        }

                   
                }else{
                    $errors=$customer->errors;
                    $this->view('AdminAddNewCustomer',[
                        "errors"=>$errors
                    ]);
                }
                
                
            


        }else{
            $this->view('AdminAddNewCustomer');
        }
    }
    //Admin Manage Business
    function ManageBusinesses()
    {
        $this->view('AdminManageBusinesses');
    }
    //Managing charity organizations
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
    //Default page
    function index()
    {

        // $this->view('home_section1');
        $this->view('popup');
    }
    
}
