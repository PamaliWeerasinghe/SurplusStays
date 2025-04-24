<?php
class Admin extends Controller
{
    
    //Admin view charity organization details
    function viewCharity($user_id,$charity_id)
    { 

            $charity = new AdminModel();
            $errors = array();
            $arr = array();

            if (count($_POST) > 0) {
                if ($charity->validateEditCharity($_POST)) {
                    $arr = $charity->data;
                    // print_r($arr);
                    $org_arr=array();
                    $user_arr=array();

                    if(isset($arr['name'])){
                        $org_arr['name'] = $arr['name'];
                    }
                    if(isset($arr['profile_pic'])){
                        $user_arr['profile_pic'] = $arr['profile_pic'];

                    }
                    if(isset($arr['city'])){
                        $org_arr['city'] = $arr['city'];
                    }
                    if(isset($arr['email'])){
                        $user_arr['email'] = $arr['email'];
                    }
                    if(isset($arr['phoneNo'])){
                        $org_arr['phoneNo'] = $arr['phoneNo'];
                    }
                    if(isset($arr['charity_description'])){
                        $org_arr['charity_description'] = $arr['charity_description'];
                    }
                    if(!empty($user_arr) && !empty($org_arr)){
                        $charity->update($user_id, $user_arr, 'user');
                        $charity->update($charity_id, $org_arr, 'organization');
                    }else if (!empty($user_arr)){
                        $charity->update($user_id, $user_arr, 'user');
                    }else if (!empty($org_arr)){
                        $charity->update($charity_id, $org_arr, 'organization');
                    }else{
                       
                        $data = $charity->where(['org_id'], [$charity_id], 'charity_details');
                        $data = $data[0];
                        $this->view('AdminEditCharityOrg', [
                            'rows' => $data,
                        ]);
                    }
                    // $charity->update($id, $arr, 'charity_details');
                    $data = $charity->where(['org_id'], [$charity_id], 'charity_details');
                    // $data = $data[0];
                    $this->view('AdminEditCharityOrg', [
                        'rows' => $data[0],
                    ]);
                } else {
                    $errors = $charity->errors;
                    $data = $charity->where(['user_id'], [$user_id], 'charity_details');
                    $data = $data[0];
                    $this->view('AdminEditCharityOrg', [
                        'rows' => $data,
                        'errors' => $errors
                    ]);
                }
            } else {

                $data = $charity->where(['org_id'], [$charity_id], 'charity_details');

                $data = $data[0];
                $this->view('AdminEditCharityOrg', [
                    'rows' => $data
                ]);
            }
        
    }
    //Admin view business details
    function viewBusiness($user_id,$business_id)
    { {

            $business = new AdminModel();
            $errors = array();
            $arr = array();
            // print_r($arr);

            if (count($_POST) > 0) {

                if ($business->validateEditBusiness($_POST)) {
                    $arr = $business->data;
                    $business_details=array();
                    $user=array();

                    if(isset($arr['name'])){
                        $business_details['name'] = $arr['name'];
                    }
                    if(isset($arr['profile_pic'])){
                        $user['profile_pic'] = $arr['profile_pic'];
                    }
                    if(isset($arr['latitude'])){
                        $business_details['latitude'] = $arr['latitude'];
                    }
                    if(isset($arr['longitude'])){
                        $business_details['longitude'] = $arr['longitude'];
                    }
                    if(isset($arr['email'])){
                        $user['email'] = $arr['email'];
                    }
                    if(isset($arr['phone'])){
                        $business_details['phone'] = $arr['phone'];
                    }
                    if(isset($arr['username'])){
                        $business_details['username'] = $arr['username'];
                    }
                    // print_r($user);
                    // print_r($business_details);
                    if(!empty($user) && !empty($business_details)){
                        $business->update($user_id, $user, 'user');
                        $business->update($business_id, $business_details, 'business');
                    }else if (!empty($user)){
                        $business->update($user_id, $user, 'user');
                    }else if (!empty($business_details)){
                        $business->update($business_id, $business_details, 'business');
                    }else{
                       
                        $data = $business->where(['bus_id'], [$business_id], 'business_details');
                        $data = $data[0];
                        $this->view('AdminEditBusiness', [
                            'rows' => $data,
                        ]);
                    }
                
                    $data = $business->where(['bus_id'], [$business_id], 'business_details');
                    $data = $data[0];
                    $this->view('AdminEditBusiness', [
                        'rows' => $data,
                    ]);
                } else {
                    $errors = $business->errors;
                    $data = $business->where(['bus_id'], [$business_id], 'business_details');
                    $data = $data[0];
                    $this->view('AdminEditBusiness', [
                        'rows' => $data,
                        'errors' => $errors
                    ]);
                }
            } else {

                $data = $business->where(['bus_id'], [$business_id], 'business_details');
                // print_r($data);
                $data = $data[0];
                $this->view('AdminEditBusiness', [
                    'rows' => $data
                ]);
            }
        }
    }
    //view business details - manage business popup
    function businessDetails($user_id,$business_id)
    {
        if (Auth::logged_in()) {
            $admin = new AdminModel();
            $business = $admin->where(['user_id'], [$user_id], 'business_details');
            $business_complaints = $admin->where(['businessID'], [$business_id], 'complaintdetails');
            $data["business"] = $business;
            $data["business_complaints"] = $business_complaints;
            //get the number of orders
            $orders = $admin->countWithWhere('order_and_the_business', ['business_id'], [$business_id]);
            $data["no_of_orders"] = $orders;
            //get the images of recently added products
            $items = $admin->whereWithLimit('products', ['business_id'], [$business_id], 2);
            $data["images"] = $items;
            // print_r(json_encode($data["customer_complaints"]));
            error_log("data: " . print_r($data, true));
            echo json_encode($data);
        } else {
            $this->redirect('register');
        }
    }
    //Admin Deletes a business
    function DeleteBusiness($id){
        $business= new AdminModel();
        $data["status_id"] = 2;
        $business->update($id, $data, 'user');

        $this->ManageBusinesses();
    }
    //Admin Deletes a customer
    function DeleteCustomer($id)
    {
        $customer = new AdminModel();
        $data["status_id"] = 2;
        $customer->update($id, $data, 'user');

        $this->ManageCustomers();
    }
   

    //Admin views a customer
    function viewCustomer($user_id,$cus_id)
    { 

            $customer = new AdminModel();
            $errors = array();
            $arr = array();
            

            if (count($_POST) > 0) {
                if ($customer->validateEditCustomer($_POST)) {
                    $arr = $customer->data;
                    $cus_details=array();
                    $user=array();

                    if(isset($arr['fname'])){
                        $cus_details['fname']=$arr['fname'];
                    }
                    if(isset($arr['lname'])){
                        $cus_details['lname']=$arr['lname'];
                    }
                    if(isset($arr['phoneNo'])){
                        $cus_details['phoneNo']=$arr['phoneNo'];
                    }
                    if(isset($arr['username'])){
                        $cus_details['username']=$arr['username'];
                    }
                    if(isset($arr['profile_pic'])){
                        $user['profile_pic']=$arr['profile_pic'];
                    }
                    // print_r($cus_details);
                    
                    if(!empty($user) && !empty($cus_details)){
                        $customer->update($user_id, $user, 'user');
                        $customer->update($cus_id, $cus_details, 'customer');
                    }else if (!empty($user)){
                        $customer->update($user_id, $user, 'user');
                    }else if (!empty($cus_details)){
                        $customer->update($cus_id, $cus_details, 'customer');
                    }else{
                       
                        $data = $customer->where(['cus_id'], [$cus_id], 'customer_details');
                        $data = $data[0];
                        $this->view('AdminEditCustomer', [
                            'rows' => $data,
                        ]);
                    }

                    // $customer->update($id, $arr, 'customer');
                    $data = $customer->where(['cus_id'], [$cus_id], 'customer_details');
                    $data = $data[0];
                    $this->view('AdminEditCustomer', [
                        'rows' => $data,
                    ]);
                } else {
                    $errors = $customer->errors;
                    $data = $customer->where(['cus_id'], [$cus_id], 'customer_details');
                    $data = $data[0];
                    $this->view('AdminEditCustomer', [
                        'rows' => $data,
                        'errors' => $errors
                    ]);
                }
            } else {

                $data = $customer->where(['cus_id'], [$cus_id], 'customer_details');

                $data = $data[0];
                $this->view('AdminEditCustomer', [
                    'rows' => $data
                ]);
            }
        
    }

  
    //view customer details - manage customers popup
    function customerDetails($user_id,$cus_id)
    {
        if (Auth::logged_in()) {
            $admin = new AdminModel();
            $customer = $admin->where(['user_id'], [$user_id], 'customer_details');
            $customer_complaints = $admin->where(['user_id'], [$user_id], 'complaintdetails');
            $data["customer"] = $customer;
            $data["customer_complaints"] = $customer_complaints;
            //get the number of orders
            $orders = $admin->countWithWhere('order', ['customer_id'], [$cus_id]);
            $data["no_of_orders"] = $orders;
            //get the images of recently purchased items
            $items = $admin->whereWithLimit('products_in_items', ['cus_id'], [$cus_id], 2);
            $data["images"] = $items;
            // print_r(json_encode($data["customer_complaints"]));
            error_log("data: " . print_r($data, true));
            echo json_encode($data);
        } else {
            $this->redirect('register');
        }
    }
    //view charity details
    function charityDetails($user_id,$org_id)
    {
        if (Auth::logged_in()) {
            $admin = new AdminModel();
            $org = $admin->where(['user_id'], [$user_id], 'charity_details');
            //donation details
            $org_donations=$admin->where(['org_id'],[$org_id],'donations_received');
            //get the no. of donations
            $donation_count=$admin->countWithWhere('donations_received',['org_id'],[$org_id]);
            //get the business logos of those recently donated
            $businesses=$admin->whereWithLimit('donations_received', ['org_id'] ,[$org_id],2);
            $data["org"]=$org;
            $data["donations"]=$org_donations;
            $data["countDonations"]=$donation_count;
            $data["businesses"]=$businesses;

            echo json_encode($data);
        }
    }

   
    // Reply to a complaint
    function ReplyToComplaint()
    {
        $errors = array();

        if (count($_POST)) {
            $id = $_POST['id'];
            $admin = new AdminModel();
            
            $arr['adminReply'] = $_POST['feedback'];

            //$feedback=$admin->update($id,$arr,'complaints');
            // returns an empty array

            if ($admin->update($id, $arr, 'complaints')) {

                $this->view('AdminLoginStep1');
            } else {
                $user = new AdminComplaints();
                $complaint_details = $user->complaintDetails($id);
                $complaint_images = $user->getComplaintImages($id);
                $this->view('AdminSeeComplainPage', [
                    "complaint_details" => $complaint_details[0],
                    "complaint_imgs" => $complaint_images,
                    "errors" => $errors

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
        $errors = array();
        $verify = new AdminModel();
        if (count($_POST) > 0) {

            if (!$verify->validateAdminRegister($_POST)) {
                $errors = $verify->errors;
            } else {

                $search = $verify->where(['email'], [$_POST['email']], 'admin_details');
                print_r($search);
                if (isset($search[0]->email)) {
                    $errors['admin'] = "An admin already exists";
                } else {
                    $user_table['email'] = $_POST['email'];
                    $user_table['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $user_table['role'] = 'admin';
                    $user_table['profile_pic'] = $verify->uploadProfilePic($_FILES['profile_pic']['name']);
                    $user_table['reg_date'] = date("Y-m-d H:i:s");

                    $token = TokenHandler::generateToken();
                    $expiry = TokenHandler::generateExpiryDate();

                    $admin_table['name'] = $_POST['name'];
                    $admin_table['token'] = $token;
                    $admin_table['token_expiry'] = $expiry;


                    $admin = new AdminRegister();
                    if ($admin->insertAdmin($user_table, $admin_table)) {
                        //send email to be directed into the dashboard
                        Mail::sendLoginToRegistered($_POST['email'], $token);

                        // TODO:view=>email sent
                        die('Email sent');
                        self::verifyEmail();
                    } else {
                        print_r("No");
                    }
                }
            }
        }
        $this->view('AdminRegister', [
            'errors' => $errors
        ]);
    }
    //verify email when logging in after registered
    public function verifyEmail()
    {
        $token = $_GET['token'];
        //get token details from database
        $admin = new AdminModel();
        $find_token = $admin->where(['token'], [$token], 'admin_details');
        $find_token = $find_token[0];
        if ($find_token->token_expiry > date("Y-m-d H:i:s")) {
            if ($_GET['token'] == $find_token->token) {
                $this->redirect('admin/login');
            } else {
                //prepare a page for invalid login
                $this->view('404');
            }
        } else {
            $errors["token_expiry"] = "Token is expired. Retry to login";
            //prepare a page for invalid login
            $this->view('404');
        }
    }
    //login after registering
    public function login()
    {
        $errors = array();

        // check the POST method
        if (count($_POST) > 0) {
            $adminModel = new AdminModel();
            //find the user with the relevant email
            $user = $adminModel->where(['email'], [$_POST['email']], 'user');


            //check the user exists
            if (isset($user)) {
                $user_details = $user[0];
                $admin = $adminModel->where(['user_id1'], [$user_details->id], 'admin');
                //check the password
                $password = $user_details->password;

                if (password_verify($_POST['password'], $password)) {
                    Auth::authenticate($admin, $user_details);

                    $this->redirect('admin/dashboard');
                }
                //password doesn't match
            } else {
                $errors['password'] = "Please check your password";
                $this->view('AdminLoginStep1', [
                    'errors' => $errors
                ]);
            }
        } else {
            //No email found
            // $errors['email']="Please check your email";
            $this->view('AdminLoginStep1', [
                'errors' => $errors
            ]);
        }
    }
    function dashboard()
    {
        if (Auth::logged_in()) {

            $admin = new AdminModel();
            //sort and search
            $search = $_GET['search'] ?? '';
            $searchBy = $_GET['searchBy'] ?? '';
            $sort = 'expiration_dateTime';
            $order = $_GET['order'] ?? 'ASC';

            $complaint_limit = 3;
            //count the no of complaints in the table complaints
            $complaintCountData = $admin->count('complaintDetails');
            //calculate the no of pages
            $noOfPages_complaints = ceil($complaintCountData / $complaint_limit);

            //Pagination for complaints

            $complaints_pager = Pager::getInstance('complaints', $noOfPages_complaints, $complaint_limit);
            $complaints_offset = $complaints_pager->offset;
            $complaints = $admin->selectRecentComplaints('complaintdetails', 'complaint_id', $complaint_limit, $complaints_offset);


            $product_limit = 2;
            //count the no of products in the table products
            $productsCountData = $admin->countWithWhere('products', ['status_id'], [1]);;
            //calculate the no of pages
            $noOfPages_products = ceil($productsCountData / $product_limit);

            //Pagination for products
            $products_pager = Pager::getInstance('products', $noOfPages_products, $product_limit);
            $products_offset = $products_pager->offset;
            $products = $admin->select('products', $product_limit, $products_offset, $search, $searchBy, $sort, $order);

            //bar chart
            $now = new DateTime();
            $date = $now->format('N');
            //Initiaize the array to store week dates
            $weekDates = [];
            //Use switch-case to find Monday of the week
            switch ($date) {
                case 1: //Monday
                    $monday = clone $now;
                    break;
                case 2: //Tuesday
                    $monday = clone $now;
                    $monday->modify('-1 day'); //moves it backward by one day in the calendar.
                    break;
                case 3: //Wednesday
                    $monday = clone $now;
                    $monday->modify('-2 days'); //moves it backward by two days in the calendar.
                    break;
                case 4: //Thursday   
                    $monday = clone $now;
                    $monday->modify('-3 days'); //moves it backward by three days in the calendar.
                    break;
                case 5: //Friday 
                    $monday = clone $now;
                    $monday->modify('-4 days'); //moves it backward by four days in the calendar.
                    break;
                case 6: //Saturday
                    $monday = clone $now;
                    $monday->modify('-5 days'); //moves it backward by five days in the calendar.
                    break;
                case 7: //Sunday
                    $monday = clone $now;
                    $monday->modify('-6 days'); //moves it backward by six days in the calendar.
                    break;
            }
            //Generate all week dates starting from Monday
            for ($i = 0; $i < 7; $i++) {
                $currentDate = clone $monday;
                $currentDate->add(new DateInterval('P' . $i . 'D'));

                $weekDates[$i] = $monday->format('Y-m-d h:i:s');
                $monday->modify('+1 day'); //moves it forward by one day in the calendar.
            }
            //get the counts
            $countsForBars = $admin->admin_bar($weekDates[0], $weekDates[6]);

            $countForInactiveCust=$admin->countWithWhere('user',['role','status_id'],['customer',2]);
            $countForInactiveBus=$admin->countWithWhere('user',['role','status_id'],['business',2]);
            $countForInactiveCharity=$admin->countWithWhere('user',['role','status_id'],['charity',2]);
            $countAllCustomers=$admin->countWithWhere('user',['role','status_id'],['customer',1]);
            $countDontations=$admin->count('donations');
            
            $inactUser_count=$countForInactiveCust+$countForInactiveBus+$countForInactiveCharity;
            
            //get the week days
            $days = [
                'Monday' => 0,
                'Tuesday' => 0,
                'Wednesday' => 0,
                'Thursday' => 0,
                'Friday' => 0,
                'Saturday' => 0,
                'Sunday' => 0
            ];
            //total for all the products
            $total = 0;
            foreach ($countsForBars as $countForBar) {
                $day1 = new DateTime($countForBar->date_time);
                $day = $day1->format('l');

                $days[$day] = $countForBar->product_count;
                $total += $countForBar->product_count;
            }
            $this->view('adminWelcomePage', [
                "complaints" => $complaints,
                "complaints_pager" => $complaints_pager,
                "products" => $products,
                "products_pager" => $products_pager,
                "days" => $days,
                "total" => $total,
                "inactUser_count"=>$inactUser_count,
                "totalCustomers"=>$countAllCustomers,
                "noOfComplaints"=> $complaintCountData,
                "donations"=>$countDontations


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
        $admin = new AdminModel();
        if (count($_POST) > 0) {

            $data['notify_status_id'] = 1;
            $admin->update($_POST['product_id'], $data, 'products');

            $data=$admin->where(['product_id'],[$_POST['product_id']], 'product_details');
            $data=$data[0];

            Mail::sendProductExpiryNotification($_POST['product_id'], $_POST['email'],$data);

        }
        //sort and search
        $search = $_GET['search'] ?? '';
        $searchBy = $_GET['searchBy'] ?? '';
        $sort = $_GET['sort'] ?? 'product_id';
        $order = $_GET['order'] ?? 'ASC';

        $product_limit = 3;
        //count the no of products in the table products
        $productsCountData = $admin->count('about_to_expire_products');
        //calculate the no of pages
        $noOfPages_products = ceil($productsCountData / $product_limit);

        //Pagination for products
        $products_pager = Pager::getInstance('about_to_expire_products', $noOfPages_products, $product_limit);
        $products_offset = $products_pager->offset;
        $products = $admin->select('about_to_expire_products', $product_limit, $products_offset, $search, $searchBy, $sort, $order);

        //count from products where notifiy_status_id 
        $productsNoty=$admin->countWithWhere('products',['notify_status_id'],[1]);
        //Expired products
        $expired=$admin->countWithWhere('products',['status_id'],[2]);
        //all orderscount
        $orders=$admin->count('order');
        //total Revenue
        $revenue=$admin->totalRevenue('order');
        $this->view('adminTrackExpiryPage', [
            "rows" => $products,
            "products_pager" => $products_pager,
            "productsSaved"=>$productsNoty,
            "expired"=>$expired,
            "orders"=>$orders,
            "revenue"=>$revenue

        ]);
    }
    //View all the complaints
    function Complaints()
    {
        $admin = new AdminModel();

        //sort and search
        $search = $_GET['search'] ?? '';
        $searchBy = $_GET['searchBy'] ?? '';
        $sort = $_GET['sort'] ?? 'complaint_id';
        $order = $_GET['order'] ?? 'ASC';

        $complaint_limit = 4;
        //count the no of complaints in the non_resolved_complaints view
        $complaintsCountData = $admin->count('non_resolved_complaints');
        //calculate the no of pages
        $noOfPages_complaints = ceil($complaintsCountData / $complaint_limit);

        //Pagination for complaints
        // displays only the non-resolved complaints
        $complaints_pager = Pager::getInstance('non_resolved_complaints', $noOfPages_complaints, $complaint_limit);
        $complaints_offset = $complaints_pager->offset;
        $complaints = $admin->selectNotAttended('non_resolved_complaints', $complaint_limit, $complaints_offset, $search, $searchBy, $sort, $order);
        
      
        $this->view('AdminBusinessComplaints', [
            "complaints" => $complaints,
            "complaints_pager" => $complaints_pager
        ]);
    }
    //View a respective complaint made by a customer
    function ViewComplain($complaint_id)
    {
        $admin = new AdminComplaints();
        $complaint_details = $admin->complaintDetails($complaint_id);
        $complaint_images = $admin->getComplaintImages($complaint_id);
        $this->view('AdminSeeComplainPage', [
            "complaint_details" => $complaint_details[0],
            "complaint_imgs" => $complaint_images
        ]);
    }
    //view a respective complaint through the link
    function viewComplaint()
    {
        $complaint_id = $_GET['id'] ?? null;

        if (!$complaint_id) {
            die("Customer ID is missing!");
        }

        $admin = new AdminComplaints();
        $complaint_details = $admin->complaintDetails($complaint_id);
        $complaint_images = $admin->getComplaintImages($complaint_id);
        $this->view('AdminSeeComplainPage', [
            "complaint_details" => $complaint_details[0],
            "complaint_imgs" => $complaint_images
        ]);
    }
    //Manage all the customers
    function ManageCustomers()
    {
        if (Auth::logged_in()) {
            $admin = new AdminModel();

            $search = $_GET['search'] ?? '';
            $searchBy = $_GET['searchBy'] ?? '';
            $sort = $_GET['sort'] ?? 'cus_id';
            $order = $_GET['order'] ?? 'ASC';


            $customer_limit = 2;
            //count the no of customers in the table customer_details
            $customersCountData = $admin->countWithWhere('customer_details', ['status_id'], [1]);
            //count the no of orders in the table orders
            $orderCountData = $admin->count('order');
            //count the no of complaints in the complaints table
            $complaintsCount = $admin->count('complaints');
            //calculate the total purchase price in the order table
            $totalPrice = $admin->sum('order');
            //calculate the no of pages
            $noOfPages_customers = ceil($customersCountData / $customer_limit);

            //Pagination for products
            $customers_pager = Pager::getInstance('customer_details', $noOfPages_customers, $customer_limit);
            $customers_offset = $customers_pager->offset;
            $customers = $admin->select('customer_details', $customer_limit, $customers_offset, $search, $searchBy, $sort, $order);

            $this->view('adminManageCustomers', [
                "customers" => $customers,
                "customers_pager" => $customers_pager,
                "customer_count" => $customersCountData,
                "order_count" => $orderCountData,
                "complaint_count" => $complaintsCount,
                "total_price" => $totalPrice,


            ]);
        } else {
            $this->view('adminLoginStep1');
        }
    }
    //Add new business
    function addNewBusiness(){
        $errors=array();
        // print_r($_FILES);
        if(count($_POST)>0){
            $business=new AdminBusiness();
            if($business->validateBusiness($_POST)){
            
                $user['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user['email'] = $_POST['email'];
                $user['role'] = 'business';
                $user['profile_pic'] = $business->uploadBusinessPic($_FILES['profile_picture']['name']);
                $user['reg_date'] = date('Y-m-d H:i:s');
                $user['status_id'] = 1;
    
                $add_business['name']=$_POST['name'];
                $add_business['phoneNo']=$_POST['phone'];
                $add_business['username']=$_POST['username'];
                $add_business['latitude']=$_POST['latitude'];
                $add_business['longitude']=$_POST['longitude'];
    
                $user_columns = ['email', 'password', 'role', 'profile_pic', 'reg_date'];
                $user_values = [$user['email'], $user['password'], $user['role'], $user['profile_pic'], $user['reg_date']];
    
                $business_columns=['name','phoneNo','username','latitude','longitude'];
                $business_values=[$add_business['name'],$add_business['phoneNo'],$add_business['username'],$add_business['latitude'],$add_business['longitude']];
    
                if(!($business->insertBusiness(
                    $user_columns,
                    $user_values,
                    $business_columns,
                    $business_values,
                    $user,
                    $add_business
                ))){
                    $errors["business_insertion"] = "Business already exists";
                        $this->view('AdminAddNewBusiness', [
                            "errors" => $errors
                        ]);
                }else {
                    $this->redirect('/Admin/ManageBusinesses');
                }
            
    
            }else {
                $errors = $business->errors;
                $this->view('AdminAddNewBusiness', [
                    "errors" => $errors
                ]);
            }
            
        }else{
            $this->view('AdminAddNewBusiness');
        }
        

    
        
    }
    //Add new customer
    function addNewCustomer()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $customer = new AdminCustomer();
            if ($customer->validateCustomer($_POST)) {
                $user['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user['email'] = $_POST['email'];
                $user['role'] = 'customer';
                $user['profile_pic'] = $customer->uploadCustomerPic($_FILES['profile_picture']['name']);
                $user['reg_date'] = date('Y-m-d H:i:s');
                $user['status_id'] = 1;

                $add_customer['fname'] = $_POST['fname'];
                $add_customer['lname'] = $_POST['lname'];
                $add_customer['phoneNo'] = $_POST['phone'];
                $add_customer['username'] = $_POST['username'];


                $user_columns = ['email', 'password', 'role', 'profile_pic', 'reg_date'];
                $user_values = [$user['email'], $user['password'], $user['role'], $user['profile_pic'], $user['reg_date']];

                $customer_columns = ['fname', 'lname', 'phoneNo'];
                $customer_values = [$add_customer['fname'], $add_customer['lname'], $add_customer['phoneNo']];

                if (!($customer->insertCustomer(
                    $user_columns,
                    $user_values,
                    $customer_columns,
                    $customer_values,
                    $user,
                    $add_customer
                ))) {
                    $errors["customer_insertion"] = "Customer already exists";
                    $this->view('AdminAddNewCustomer', [
                        "errors" => $errors
                    ]);
                } else {
                    $this->redirect('/Admin/ManageCustomers');
                }
            } else {
                $errors = $customer->errors;
                $this->view('AdminAddNewCustomer', [
                    "errors" => $errors
                ]);
            }
        } else {
            $this->view('AdminAddNewCustomer');
        }
    }
    //Admin Manage Business
    function ManageBusinesses()
    {
        if(Auth::logged_in()){
            $admin = new AdminModel();
            
            //search bar 
            $search = $_GET['search'] ?? '';
            $searchBy = $_GET['searchBy'] ?? '';
            $sort = $_GET['sort'] ?? 'bus_id';
            $order = $_GET['order'] ?? 'ASC';

            $business_limit = 3;
            //count the no of businesses in the business_details view
            $businessCountData = $admin->countWithWhere('business_details', ['status_id'], [1]);
            //calculate the no of pages
            $noOfPages_business = ceil($businessCountData / $business_limit);
    
            //Pagination for businesses
            $business_pager = Pager::getInstance('business_details', $noOfPages_business, $business_limit);
            $business_offset = $business_pager->offset;
            $business = $admin->select('business_details', $business_limit, $business_offset, $search, $searchBy, $sort, $order);
    
            // print_r($business);
            $this->view('AdminManageBusinesses', [
                "business" => $business,
                "business_pager" => $business_pager
            ]);
        }else{
            $this->redirect('login');
        }
       
    }
    //Managing charity organizations
    function ManageCharityOrg()
    {
        if (!Auth::logged_in()) {
            $this->redirect('register');
        } else {
            $org = new AdminModel();

            //search bar
            $search = $_GET['search'] ?? '';
            $searchBy = $_GET['searchBy'] ?? '';
            $sort = $_GET['sort'] ?? 'org_id';
            $order = $_GET['order'] ?? 'ASC';
            $org_limit = 2;
            //count the no of organizations in the organization table
            $orgCountData = $org->count('charity_details');
            //calculate the no of pages
            $noOfPages_org = ceil($orgCountData / $org_limit);

            //pagination for organizations
            $org_pager = Pager::getInstance('charity_details', $noOfPages_org, $org_limit);
            $org_offset = $org_pager->offset;
            $organization = $org->select('charity_details', $org_limit, $org_offset, $search, $searchBy, $sort, $order);

            $this->view('AdminManageCharityOrganizations', [
                "org" => $organization,
                "org_pager" => $org_pager
            ]);
        }
    }
    //Add new Charity organization
    function addNewCharityOrg()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $charity = new AdminModel();
            if ($charity->validateCharity($_POST)) {
                print_r($_POST);
                //Get charity details
                $charity_arr['name'] = $_POST['name'];
                $charity_arr['city'] = $_POST['city'];
                $charity_arr['phoneNo'] = $_POST['phone'];
                $charity_arr['charity_description'] = $_POST['description'];
                $charity_arr['username'] = $_POST['username'];


                //Details of the user 
                $user['email'] = $_POST['email'];
                $user['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user['profile_pic'] = $charity->uploadCharityOrgPic($_FILES['logo']['name']);
                $user['role'] = 'charity';
                $user['reg_date'] = date('Y-m-d H:i:s');
                $user['status_id'] = 1;

                //Prepare the user details to be inserted into the user table
                $user_columns = ['email', 'password', 'role', 'profile_pic', 'reg_date'];
                $user_values = [$user['email'], $user['password'], $user['role'], $user['profile_pic'], $user['reg_date']];

                //Prepare the charity details to be inserted into the organization table
                $charity_columns = ['name', 'phoneNo', 'username', 'city', 'charity_description'];
                $charity_values = [$charity_arr['name'], $charity_arr['phoneNo'], $charity_arr['username'], $charity_arr['city'], $charity_arr['charity_description']];

                if ($charity->insertCharity(
                    $user_columns,
                    $user_values,
                    $charity_columns,
                    $charity_values,
                    $user,
                    $charity_arr
                )) {
                    $errors["charity_insertion"] = "Charity already exists";
                    $this->view('AddNewCharityOrg', [
                        "errors" => $errors
                    ]);
                } else {
                    $this->redirect('/Admin/ManageCharityOrg');
                }
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
        // $admin = new AdminModel();
        // $products_limit = 3;
        // //count the no of records in the saved_from_wastage_report view
        // $productsCountData = $admin->count('saved_from_wastage_report');
        // //calculate the no of pages
        // $noOfPages_products = ceil($productsCountData / $products_limit);

        // //pagination for the report
        // $products_pager = Pager::getInstance('saved_from_wastage_report', $noOfPages_products, $products_limit);
        // $products_offset = $products_pager->offset;
        // $products = $admin->selectRecentComplaints('saved_from_wastage_report', 'product_name', $products_limit, $products_offset);


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
        $this->view('adminReport1');
        
    }
    function report()
    {
        $this->view('AdminReports');
    }
    function report1()
    {
        $admin=new AdminModel();
        $data=$admin->findAll('saved_from_wastage_report');
       

        $this->view('adminReport1', [
            "products" => $data
        ]);
    }
    function report2()
    {
        $admin=new AdminModel();
        $data=$admin->where(['notify_status_id'],[1],'product_details');
       

        $this->view('AdminReport2', [
            "products" => $data
        ]);
    }
    function report3()
    {
        $admin=new AdminModel();
        $data=$admin->findAll('customer_order_report');
       

        $this->view('AdminReport3', [
            "customers" => $data
        ]);
    }
    function report4()
    {
        $admin=new AdminModel();
        $data=$admin->findAll('business_report');
        $this->view('AdminReport4',[
            "business"=>$data
        ]);

    }
    function report5()
    {
        $admin=new AdminModel();
        $data=$admin->findAll('charity_report');
        $this->view('AdminReport5',[
            "charity"=>$data
        ]);
    }
    
}
