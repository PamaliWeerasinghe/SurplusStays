<?php
class Admin extends Controller
{
    //search customer through the search bar
    // function searchCustomer($input){
    //     $admin=new AdminModel();
    //     // $customers=$admin->searchCustomer('customer_details',$input);
    //     $jsonData = json_encode($customers);
    //     echo $jsonData;


    // }
    //Admin view charity organization details
    function viewCharity($id)
    { {

            $charity = new AdminModel();
            $errors = array();
            $arr = array();

            if (count($_POST) > 0) {
                if ($charity->validateEditCharity($_POST)) {
                    $arr = $charity->data;
                    $charity->update($id, $arr, 'charity_details');
                    $data = $charity->where(['org_id'], [$id], 'charity_details');
                    // $data = $data[0];
                    $this->view('AdminEditCharityOrg', [
                        'rows' => $data[0],
                    ]);
                } else {
                    $errors = $charity->errors;
                    $data = $charity->where(['user_id'], [$id], 'charity_details');
                    $data = $data[0];
                    $this->view('AdminEditCharityOrg', [
                        'rows' => $data,
                        'errors' => $errors
                    ]);
                }
            } else {

                $data = $charity->where(['org_id'], [$id], 'charity_details');

                $data = $data[0];
                $this->view('AdminEditCharityOrg', [
                    'rows' => $data
                ]);
            }
        }
    }
    //Admin view business details
    function viewBusiness($id)
    { {

            $customer = new AdminModel();
            $errors = array();
            $arr = array();
            // print_r($_FILES);

            if (count($_POST) > 0) {

                if ($customer->validateEditCustomer($_POST)) {
                    $arr = $customer->data;
                    $customer->update($id, $arr, 'customer');
                    $data = $customer->where(['cus_id'], [$id], 'customer_details');
                    $data = $data[0];
                    $this->view('AdminEditCustomer', [
                        'rows' => $data,
                    ]);
                } else {
                    $errors = $customer->errors;
                    $data = $customer->where(['cus_id'], [$id], 'customer_details');
                    $data = $data[0];
                    $this->view('AdminEditCustomer', [
                        'rows' => $data,
                        'errors' => $errors
                    ]);
                }
            } else {

                $data = $customer->where(['cus_id'], [$id], 'customer_details');

                $data = $data[0];
                $this->view('AdminEditCustomer', [
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
    //Admin Deletes a customer
    function DeleteCustomer($id)
    {
        $customer = new AdminModel();
        $data["status_id"] = 3;
        $customer->update($id, $data, 'user');

        $this->ManageCustomers();
    }
    // $data=$customer->findAll('customer_details');
    // $countd = new AdminCharityDetails();
    // foreach ($data as $row) {
    //     $count = $countd->getDonorCount($row->id);
    //     $row->donors = $count;
    // }
    // foreach ($data as $row) {
    //     $count = $countd->getComplaintsCount($row->id);
    //     $row->donations = $count;
    // }
    // $this->view('AdminManageCharityOrganizations',['rows'=>$data]);


    //Admin views a customer
    function viewCustomer($id)
    { {

            $customer = new AdminModel();
            $errors = array();
            $arr = array();
            // print_r($_FILES);

            if (count($_POST) > 0) {
                if ($customer->validateEditCustomer($_POST)) {
                    $arr = $customer->data;
                    $customer->update($id, $arr, 'customer');
                    $data = $customer->where(['cus_id'], [$id], 'customer_details');
                    $data = $data[0];
                    $this->view('AdminEditCustomer', [
                        'rows' => $data,
                    ]);
                } else {
                    $errors = $customer->errors;
                    $data = $customer->where(['cus_id'], [$id], 'customer_details');
                    $data = $data[0];
                    $this->view('AdminEditCustomer', [
                        'rows' => $data,
                        'errors' => $errors
                    ]);
                }
            } else {

                $data = $customer->where(['cus_id'], [$id], 'customer_details');

                $data = $data[0];
                $this->view('AdminEditCustomer', [
                    'rows' => $data
                ]);
            }
        }
    }

    function loadItems()
    {
        if (isset($_POST['order_id'])) {
            $order_id = $_POST['order_id'];
            $admin = new AdminComplaints();
            $items = $admin->getAllOrders($order_id);

            echo json_encode($items);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid Request']);
        }
    }
    //view customer details - manage customers popup
    function customerDetails($id)
    {
        if (Auth::logged_in()) {
            $admin = new AdminModel();
            $customer = $admin->where(['user_id'], [$id], 'customer_details');
            $customer_complaints = $admin->where(['user_id'], [$id], 'complaintdetails');
            $data["customer"] = $customer;
            $data["customer_complaints"] = $customer_complaints;
            //get the number of orders
            $orders = $admin->countWithWhere('order', ['customer_id'], [$id]);
            $data["no_of_orders"] = $orders;
            //get the images of recently purchased items
            $items = $admin->whereWithLimit('products_in_items', ['cus_id'], [$id], 2);
            $data["images"] = $items;
            // print_r(json_encode($data["customer_complaints"]));
            error_log("data: " . print_r($data, true));
            echo json_encode($data);
        } else {
            $this->redirect('register');
        }
    }
    //view charity details
    function charityDetails($id)
    {
        if (Auth::logged_in()) {
            $admin = new AdminModel();
            $org = $admin->where(['user_id'], [$id], 'charity_details');
            echo json_encode($org);
        }
    }

    // customer make a complaint
    function makeComplaints()
    {

        $images = array();
        if (count($_POST)) {
            $errors = array();
            $business_id = $_POST['shopID'];
            $orderId = $_POST['orderid'];
            $orderItem = $_POST['orderitem'];
            $complaint = $_POST['complaint'];
            $img1 = $_FILES['complaintImg1']['name'];
            $img2 = $_FILES['complaintImg2']['name'];
            $img3 = $_FILES['complaintImg3']['name'];
            $img4 = $_FILES['complaintImg4']['name'];
            $img5 = $_FILES['complaintImg5']['name'];



            if (isset($img1)) {
                array_push($images, $img1);
            }
            if (isset($img2)) {
                array_push($images, $img2);
            }
            if (isset($img3)) {
                array_push($images, $img3);
            }
            if (isset($img4)) {
                array_push($images, $img4);
            }
            if (isset($img5)) {
                array_push($images, $img5);
            }

            if ($orderId == 'oid') {
                $errors["oid"] = 'Order ID not Selected';
            }
            if ($orderItem == 'selectItem') {
                $errors["item"] = 'Order Item is not Selected';
            }
            if (empty($complaint)) {
                $errors['complaint'] = "No complaint added";
            }
            if (empty($images[0]) && empty($images[1]) && empty($images[2]) && empty($images[3]) && empty($images[4])) {
                $errors['images'] = "Complaint should contain at least one image";
            }


            $admin = new AdminComplaints();


            $orders = $admin->getNoOfOrders(1);
            $orderDetails = $admin->getAllOrders(1);

            if (count($errors) > 0) {
                $this->view('customerMakeComplaint', [
                    "orders" => $orders,
                    "orderDetails" => $orderDetails,
                    "errors" => $errors
                ]);
            } else {
                $errors = array();
                //find the complaint status - (not attended)
                $complaint_status = $admin->where(['name'], ['Not Attended'], 'complaint_status');
                $complaint_status = $complaint_status[0];

                //insert into complaints
                $arr['business_id'] = $business_id;
                $arr['complaint_status_id'] = $complaint_status->id;
                $arr['complaint_dateTime'] = date('Y-m-d H:i:s');
                $arr['customer_id'] = '1';
                $arr['order_items_id'] = $orderItem;
                $arr['description'] = $complaint;


                // insert complaint images
                $insertImg = array();

                for ($i = 0; $i < count($images); $i++) {
                    if (!empty($images[$i])) {
                        $imgPath = $admin->uploadImage($images[$i], $i);
                        array_push($insertImg, $imgPath);
                    }
                }

                // Columns
                $columns = ['business_id', 'customer_id', 'order_items_id'];

                //values
                $values = [$business_id, '1', $orderItem];


                if (!$admin->insertComplaint($arr, $insertImg, $columns, $values)) {
                    $errors["complaint_insertion"] = "Complaint already exists";
                } else {
                    // send notification for the admin
                    $currentDateTime = date('Y-m-d H:i:s');
                    // $email=$_SESSION['USER'];
                    // $complaints=new AdminComplaints();
                    $complaint_id = $admin->id;
                    if (!Mail::sendCustomerComplaint($complaint_id, $currentDateTime, 'pamaliweerasinghe@gmail.com')) {
                        error_log("Could't send the email");
                    }
                }

                $this->view('customerMakeComplaint', [
                    "orders" => $orders,
                    "orderDetails" => $orderDetails,
                    "errors" => $errors

                ]);
            }
        } else {
            $admin = new AdminComplaints();
            $orders = $admin->getNoOfOrders(1);
            $orderDetails = $admin->getAllOrders(1);
            $this->view('customerMakeComplaint', [
                "orders" => $orders,
                "orderDetails" => $orderDetails,
                "email" => $_SESSION['USER_EMAIL']
            ]);
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
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'DESC';

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
                "total" => $total


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

        $this->view('adminTrackExpiryPage', [
            "rows" => $products,
            "products_pager" => $products_pager

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
        $admin = new AdminModel();
        $products_limit = 3;
        //count the no of records in the saved_from_wastage_report view
        $productsCountData = $admin->count('saved_from_wastage_report');
        //calculate the no of pages
        $noOfPages_products = ceil($productsCountData / $products_limit);

        //pagination for the report
        $products_pager = Pager::getInstance('saved_from_wastage_report', $noOfPages_products, $products_limit);
        $products_offset = $products_pager->offset;
        $products = $admin->selectRecentComplaints('saved_from_wastage_report', 'product_name', $products_limit, $products_offset);


        $this->view('AdminReports', [
            "products" => $products,
            "products_pager" => $products_pager
        ]);
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

        
    }
   
}
