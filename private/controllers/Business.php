<?php
date_default_timezone_set('Asia/Colombo');
class Business extends Controller
{

    function index()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $product = new Products();
        $ordermodel = new OrderModel();
        $requestmodel = new RequestModel();
        $business_id = Auth::getId();

        $productcount = $product->countProducts($business_id);
        $ordercount = $ordermodel->countOrders($business_id);
        $requestcount = $requestmodel->countRequests($business_id);

        $products = $product->gettopsalesproducts($business_id); //filter the top selling products
        $orders = $ordermodel->getOrdersByBusiness($business_id);
        $weeklyStats = $ordermodel->getWeeklyOrderStats($business_id);


        $this->view('businessDashboard', [
            'productcount' => $productcount,
            'ordercount' => $ordercount,
            'requestcount' => $requestcount,
            'orders' => $orders,
            'rows' => $products,
            'weeklyStats' => $weeklyStats
        ]);
    }

    function myproducts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $product = new Products();
        $business_id = Auth::getID();

        $currentDateTime = new DateTime();
        $allProducts = $product->where('business_id', $business_id, 'products');

        if (!empty($allProducts)) {
            foreach ($allProducts as $row) {
                $productExpiration = new DateTime($row->expiration_dateTime);
                if ($currentDateTime > $productExpiration) {
                    $arr['status_id']=2;
                    $product->update($row->id, $arr,'products');
                }
            }
        }

        $filter = $_GET['filter'] ?? null;
        $filteredProducts = $product->getFilteredProducts($business_id, $filter);

        $this->view('businessMyProducts', ['rows' => $filteredProducts]);
    }



    function viewProduct($id = null)
    {
        $product = new Products();
        $row = $product->where('id', $id, 'products');
        $this->view('businessViewProduct', [
            'row' => $row,
        ]);
    }

    function addproduct()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = [];
        $uploadedPictures = []; // Initialize uploaded pictures array

        if (count($_POST) > 0) {
            $product = new Products();
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/businessImages/";

            // Handle each upload field
            foreach ($_FILES as $key => $file) {
                if (strpos($key, 'upload-') === 0 && isset($file['name']) && $file['error'] === 0) {
                    $fileName = basename($file['name']);
                    $filePath = $targetDir . $fileName;
                    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

                    // Allow certain file formats
                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array(strtolower($fileType), $allowedTypes)) {
                        // Attempt to move the uploaded file
                        if (move_uploaded_file($file['tmp_name'], $filePath)) {
                            // Save the relative path to the image in the array
                            $uploadedPictures[] = '/assets/businessImages/' . $fileName;
                        } else {
                            $errors[] = "Failed to upload image: {$fileName}.";
                        }
                    } else {
                        $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed for {$fileName}.";
                    }
                }
            }

            // Handle previously uploaded images
            if (!empty($_POST['uploadedPictures'])) {
                $uploadedPictures = array_merge($uploadedPictures, $_POST['uploadedPictures']);
            }

            // Check if at least one image was uploaded
            if (!empty($uploadedPictures)) {
                $_POST['pictures'] = implode(',', $uploadedPictures); // Store paths as a comma-separated string
            }

            if (empty($errors) && $product->validate($_POST)) {
                $discount = !empty($_POST['discount']) ? $_POST['discount'] : 0;

                $productData = [
                    'business_id' => Auth::getUserId(),
                    'name' => $_POST['product-name'],
                    'category' => $_POST['category'],
                    'description' => $_POST['description'],
                    'qty' => $_POST['quantity'],
                    'price_per_unit' => $_POST['price-per-unit'],
                    'discountPrice' => $_POST['price-per-unit'] * (100 - $discount) / 100,
                    'expiration_dateTime' => $_POST['expiration'] . ':00',
                    'pictures' => $_POST['pictures'],
                    'notify_status_id' => 2,
                    'status_id' => 1,
                ];

                $product->insert($productData);
                $this->redirect('business/myproducts');
            } else {
                $errors = array_merge($errors, $product->errors);
            }
        }

        $this->view('businessAddProduct', [
            'errors' => $errors,
            'uploadedPictures' => $uploadedPictures // Pass uploaded images to the view
        ]);
    }


    function editproduct($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = []; // Ensure this is declared before use.
        $product = new ProductsEdit();

        $row = $product->where('id', $id, 'products');
        $currentPictures = explode(',', $row[0]->pictures);
        $uploadedPictures = [];

        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/businessImages/";

        // Loop through upload slots (assuming there are 4 upload slots)
        for ($i = 0; $i < 3; $i++) {
            $uploadKey = 'upload-' . $i + 1;

            if (isset($_FILES[$uploadKey]) && $_FILES[$uploadKey]['error'] === 0) {
                // Get the original file name and extension
                $fileName = basename($_FILES[$uploadKey]['name']);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                // Generate a unique file name
                $uniqueName = uniqid('img_', true) . '.' . $fileType;

                // Define the file path
                $filePath = $targetDir . $uniqueName;

                // Allow certain file formats
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array(strtolower($fileType), $allowedTypes)) {

                    if (move_uploaded_file($_FILES[$uploadKey]['tmp_name'], $filePath)) {
                        // Save the relative path to the uploaded image
                        $uploadedPictures[$i] = '/assets/businessImages/' . $uniqueName;
                    } else {
                        $errors[] = "Failed to upload image: {$fileName}.";
                    }
                } else {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed for {$fileName}.";
                }
            } elseif (!empty($currentPictures[$i])) {
                $uploadedPictures[$i] = $currentPictures[$i];
            }
        }

        // Ensure all 4 slots are accounted for
        for ($i = 0; $i < 3; $i++) {
            if (!isset($uploadedPictures[$i])) {
                $uploadedPictures[$i] = ''; // Fill empty slots with an empty string
            }
        }
        // Check if at least one image was uploaded or exists
        if (!array_filter($uploadedPictures)) { // array_filter removes empty values
            $errors[] = "At least one event picture is required.";
        } else {
            $_POST['pictures'] = implode(',', $uploadedPictures); // Store paths as a comma-separated string
        }

        $errors = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0) {
            if ($product->validate($_POST)) {
                $discount = !empty($_POST['discount']) ? $_POST['discount'] : 0;

                $productData = [
                    'business_id' => Auth::getUserId(),
                    'name' => $_POST['product-name'],
                    'category' => $_POST['category'],
                    'description' => $_POST['description'],
                    'qty' => $_POST['quantity'],
                    'price_per_unit' => $_POST['price-per-unit'],
                    'discountPrice' => $_POST['price-per-unit'] * (100 - $discount) / 100,
                    'expiration_dateTime' => $_POST['expiration'],
                    'pictures' => $_POST['pictures'],
                ];

                $product->update($id, $productData, 'products');
                $this->redirect('business/myproducts');
            } else {
                $errors = $product->errors;
            }
        }

        // Fetch existing product details for display
        $row = $product->where('id', $id, 'products');

        $this->view('businessEditProduct', [
            'row' => $row,
            'errors' => $errors
        ]);
    }



    function deleteproduct($id)
    { {
            if (!Auth::logged_in()) {
                $this->redirect('login');
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $product = new Products();
                $arr['status_id'] = 2;
                $product->update($id, $arr, 'products');
                $this->redirect('business/myproducts'); // Redirect back to the myproducts page
            }
        }
    }


    function orders()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $business_id = Auth::getID();
        $orderModel = new OrderModel();

        $orders = $orderModel->getOrdersByBusiness($business_id);

        $this->view('businessOrders', ['orders' => $orders]);
    }

    function viewOrder($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $orderModel = new OrderModel();
        $orderDetails = $orderModel->getOrderDetails($id);

        if (!$orderDetails) {
            $this->redirect('business/orders'); // Redirect if order is not found
        }

        $this->view('businessOrderDetails', ['order' => $orderDetails]);
    }

    function updateOrderStatus()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'], $_POST['status'])) {
            $orderModel = new OrderModel();
            $order_id = $_POST['order_id'];
            $status = $_POST['status'];

            $orderModel->updateOrderStatus($order_id, $status);

            $this->redirect('business/orders');
        } else {
            $this->redirect('business/orders');
        }
    }

    function browse_charities()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $donation = new Donation();
        $donation_b = new BusinessDonation();

        $orgs = new Organization();
        $users = new User();

        $rows = $orgs->findAll('organization');
        $rows_p = $users->findAll('user');

        // Build map of user_id to picture
        $userPictures = [];
        $userEmails = [];
        foreach ($rows_p as $user) {
            $userPictures[$user->id] = $user->profile_pic;
            $userEmails[$user->id] = $user->email;
        }

        // Add picture to each business row
        foreach ($rows as &$row) {
            $row->picture = $userPictures[$row->user_id] ?? '';
            $row->email = $userEmails[$row->user_id] ?? '';
        }

        $today = date('Y-m-d 23:59:59');
        $sevenDaysAgo = date('Y-m-d 00:00:00', strtotime('-6 days'));

        // Calculate week count for each organization
        $weekCounts = [];
        foreach ($rows as $org) {
            $orgId = $org->id; // assuming 'id' is the primary key field
            $count = $donation->getAcceptedDonationsCountByDate($orgId, $sevenDaysAgo, $today) +
                $donation_b->getAcceptedDonationsCountByDate($orgId, $sevenDaysAgo, $today);
            $weekCounts[$orgId] = $count;
        }

        $this->view('businessBrowseOrganizations', [
            'rows' => $rows,
            'weekCounts' => $weekCounts
        ]);
    }

    function requests()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $business_id = Auth::getID();
        $requestModel = new RequestModel();

        $requests = $requestModel->getRequestByBusiness($business_id);

        $this->view('businessRequests', ['requests' => $requests]);
    }

    function viewRequest($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $requestModel = new RequestModel();
        $requestDetails = $requestModel->getRequestDetails($id);

        $req_id = $requestDetails[0]->id;
        $donationItemsModel = new DonationItems();
        $db = Database::getInstance();

        $query = "SELECT p.id, p.name, p.pictures, di.qty
                          FROM donation_items di 
                          JOIN products p ON p.id = di.products_id 
                          WHERE di.request_id = :request_id";
                $params = ['request_id' => $req_id];
                $relatedProducts = $db->query($query, $params);

        if (!$requestDetails) {
            $this->redirect('business/requests'); // Redirect if request is not found
        }

        $this->view('businessRequestDetails', [
            'request' => $requestDetails,
            'products' => $relatedProducts
        ]);
    }

    function updateRequestStatus()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'], $_POST['status'])) {
            $requestModel = new RequestModel();
            $request_id = $_POST['request_id'];
            $status = $_POST['status'];

            // Update request status
            $requestModel->updateRequestStatus($request_id, $status);

            // Redirect back to the request details page
            $this->redirect('business/requests/');
        } else {
            $this->redirect('business/requests');
        }
    }


    function complaints()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $business_id = Auth::getID();
        $complaintModel = new ComplaintModel();

        $complaints = $complaintModel->getComplainsByBusiness($business_id);

        $this->view('businessComplaints', ['complaints' => $complaints]);
    }

    function viewComplaint($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $complaintModel = new ComplaintModel();
        $complaintDetails = $complaintModel->getComplaintDetails($id);

        if (!$complaintDetails) {
            $this->redirect('complaints');
        }

        // Handle response submission (safely check for POST data)
        if (isset($_POST['response']) && !empty($_POST['response'])) {
            $complaintModel->addResponse($id, $_POST['response']);
        }

        $this->view('businessComplaintDetails', ['complaint' => $complaintDetails]);
    }

    function profile()
    {
        $this->view('businessProfile');
    }


    function editprofile()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = [];

        $businessModel = new BusinessModel();
        $userTable = new User();

        $businessId = Auth::getUserId(); // Get current user id
        $row = $businessModel->where('id', $businessId, 'business');

        if ($row) {
            $row = $row[0]; // Get the first (and only) record
        } else {
            $errors[] = "Business not found.";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/businessImages/";
            $uploadedPicture = '';

            if (isset($_FILES['upload-1']) && $_FILES['upload-1']['error'] === 0) {
                $fileName = basename($_FILES['upload-1']['name']);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($fileType), $allowedTypes)) {
                    $uniqueName = uniqid('img_', true) . '.' . $fileType;
                    $filePath = $targetDir . $uniqueName;

                    if (move_uploaded_file($_FILES['upload-1']['tmp_name'], $filePath)) {
                        $uploadedPicture = '/assets/businessImages/' . $uniqueName;
                    } else {
                        $errors[] = "Failed to upload the image.";
                    }
                } else {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed.";
                }
            } elseif (!empty($row->pictures)) {
                $uploadedPicture = $row->pictures; // keep existing image if none is uploaded
            } else {
                $errors[] = "An event image is required.";
            }

            $_POST['pictures'] = $uploadedPicture;

            if (count($errors) === 0 && $businessModel->validate($_POST)) {
                $businessData = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'phone_no' => $_POST['phone'],
                    'username' => $_POST['username'],
                    'type' => $_POST['type'],
                    'picture' => $_POST['picture'],
                    'pictures' => $_POST['pictures'], // storing the image path here
                    'latitude' => $_POST['latitude'],
                    'longitude' => $_POST['longitude'],
                ];

                $businessModel->update($businessId, $businessData, 'business');

                $userData = [
                    'email' => $_POST['email'],
                ];
                $userTable->update($businessId, $userData, 'user');

                $this->redirect('login');
            } else {
                $errors = array_merge($errors, $businessModel->errors);
            }
        }

        $this->view('businessEditProfile', [
            'errors' => $errors,
            'row' => [$row], // Pass as array for get_var() compatibility
        ]);
    }




    function test($name)
    {
        $data = [
            "username" => $name
        ];
        $this->view('aboutView', $data);
    }
}
