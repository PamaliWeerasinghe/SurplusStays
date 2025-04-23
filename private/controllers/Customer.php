<?php
class Customer extends Controller{
    function index(){
        $this->view('CustomerDashboard');
    }

    //customer registration
    // function register()
    // {
    //     $errors = array();
    //     $verify = new CustomerModel();

    // }


    function manageComplaints()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $event = new Complaint();
        $customer_id = Auth::getID();
        // print_r($customer_id);
        $customer_id=1;
        $data = $event->where(['customer_id'], [$customer_id], "complaints");

        $this->view('custManageComplaints',['rows' => $data]);
        
    }

    function viewComplaint($id = null)
    {
        $event = new Complaint();
        $row = $event->where('id', $id);
        $this->view('custViewComplaint', [
            'row' => $row,
        ]);
    }

    function makeComplaint()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
    
        $errors = [];
        if (count($_POST) > 0) {
            $event = new Complaint();
            $uploadedPictures = [];
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/customerImages/";
    
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
                            // Save the full path to the image in the array
                            $uploadedPictures[] = '/assets/customerImages/' . $fileName; // Use relative path
                        } else {
                            $errors[] = "Failed to upload image: {$fileName}.";
                        }
                    } else {
                        $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed for {$fileName}.";
                    }
                }
            }
    
            // Check if at least one image was uploaded
            if (!empty($uploadedPictures)) {
                $_POST['pictures'] = implode(',', $uploadedPictures); // Store paths as a comma-separated string
            } else {
                $errors[] = "At least one event picture is required.";
            }
    
            if (empty($errors) && $event->validate($_POST)) {
                $arr['order_id'] = $_POST['order-id'];
                $arr['feedback'] = $_POST['complaint'];
                $arr['complaint_status_id'] = 0;  // Default 
                $arr['pictures'] = $_POST['pictures'];
                $arr['customer_id'] = Auth::getId();
                $arr['shop'] = $_POST['shopName'];
                $arr['date'] = $_POST['date'];
    
                $event->insert($arr);
                $this->redirect('customer/manageComplaints');
            } else {
                $errors = array_merge($errors, $event->errors);
            }
        }
    
        $this->view('custLodgeComplaint', [
            'errors' => $errors,
        ]);
    }

    function deleteComplaint($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = new Complaint(); // Ensure you have an Event model
            if ($event->delete($id)) {
                // Optionally, set a success message
                $_SESSION['message'] = 'Complaint deleted successfully';
            } else {
                // Optionally, set an error message
                $_SESSION['message'] = 'Failed to delete complaint';
            }

            $this->redirect('customer/manageComplaints'); // Redirect back to the manage events page
        }
    }

    function editComplaint($id = null){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $errors = []; // Ensure this is declared before use.
        $event = new Complaint();

        $row = $event->where('id', $id);
        $currentPictures = explode(',', $row[0]->pictures);
        $uploadedPictures = [];
        
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/customerImages/";

        // Loop through upload slots (assuming there are 5 upload slots)
        for ($i = 0; $i < 5; $i++) {
            $uploadKey = 'upload-' . $i+1;
        
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
                        $uploadedPictures[$i] = '/assets/customerImages/' . $uniqueName;
                    } else {
                        $errors[] = "Failed to upload image: {$fileName}.";
                    }
                } else {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed for {$fileName}.";
                }
            } 
             // If no file uploaded, check if it's a delete request
            elseif (isset($_POST['delete-' . ($i + 1)]) && $_POST['delete-' . ($i + 1)] === "delete.png") {
                // If delete request, remove the image from the server
                if (!empty($currentPictures[$i])) {
                    $filePathToDelete = $_SERVER['DOCUMENT_ROOT'] . $currentPictures[$i];
                    if (file_exists($filePathToDelete)) {
                        unlink($filePathToDelete);  // Delete the file from server
                    }
                    // Mark the image slot as deleted
                    $uploadedPictures[$i] = '';  // Mark as empty or deleted
                }
            }
             // If no file uploaded, keep the current picture
            elseif (!empty($currentPictures[$i])) {
                $uploadedPictures[$i] = $currentPictures[$i];
            }
        }
        

        // Ensure all 5 slots are accounted for
        for ($i = 0; $i < 5; $i++) {
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0)
        {
            if ($event->validate($_POST)) 
            {
                
                $arr['order_id'] = $_POST['order-id'];
                $arr['feedback'] = $_POST['complaint'];
                $arr['complaint_status_id'] = 0;  // Default 
                $arr['pictures'] = $_POST['pictures'];
                $arr['customer_id'] = Auth::getId();
                $arr['shop'] = $_POST['shopName'];
                $arr['date'] = $_POST['date'];
            
                $event->update($id, $arr);
                $this->redirect('customer/manageComplaints');  // Redirect to the event list page or another relevant page
            }else
            {
                $errors = $event->errors;
            }
        }
        $row = $event->where('id', $id);
        
        $this->view('custEditComplaint',[
            'row' => $row,
            'errors' => $errors,
        ]);
    }
    



    //other pages
    function browseShops(){
        $this->view('CustomerBrowseShops');
    }
    function cart(){
        $errors = array();
        $verify = new CustomerModel();
        $cart_view = $verify->findAll("cart_view"); // Store results in $cart_view
        $item_count = count($cart_view); // Now count the actual variable
        
        $this->view('CustomerCart', [
            'errors' => $errors,
            'cart_view' => $cart_view, // Pass the same variable to view
            'item_count' => $item_count
        ]);
    }

    // Add these methods to your Customer controller class

function updateCartQuantity() {
    if (!Auth::logged_in()) {
        echo json_encode(['success' => false, 'message' => 'Not logged in']);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cart_id = $_POST['cart_id'] ?? null;
        $new_quantity = $_POST['quantity'] ?? null;

        if ($cart_id && $new_quantity !== null) {
            $cart = new Cart();
            $result = $cart->updateQuantity($cart_id, $new_quantity);
            
            if ($result) {
                echo json_encode(['success' => true]);
                exit;
            }
        }
    }

    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}


    // function addToCart($id){
    //     if(!Auth::logged_in()){
    //         $this->redirect('login');
    //     }

    //     $cart = new Cart();
    //     // $cart -> insert();
    // }


    function addToCart($products_id) {
        if(!Auth::logged_in()) {
            echo json_encode(['success' => false, 'message' => 'Please login to add items to cart']);
            exit;
        }
    
        // Get data from POST request
        $data = json_decode(file_get_contents('php://input'), true);
        $customer_id = $data['customer_id'] ?? Auth::getID();
        $quantity = $data['quantity'] ?? 1;
    
        $cart = new Cart();
        $result = $cart->addToCart($customer_id, $products_id, $quantity);
    
        if($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add to cart']);
        }
        exit;
    }

 function removeFromCart($id) {
    if (!Auth::logged_in()) {
        $this->redirect('login');
    }
    
    $cart = new Cart();
    $cart->delete($id, 'cart');
    $this->redirect('customer/cart');
}




    function paymentHistory(){
        $this->view('custPayment');
    }

    function orders(){
        $this->view('custViewOrders');
    }


    // wishlist
    function wishlist(){
        $errors = array();
        $verify = new CustomerModel();
        $watchlist_view = $verify->findAll("watchlist_view");
        $item_count = count($watchlist_view);
        $this->view('custWishlist', [
            'errors'=>$errors,
            'watchlist_view' => $watchlist_view,
            'item_count' => $item_count,
            // 'customer_id'=>$_SESSION['USER']
        ]);
    }

    function removeFromWatchlist($id) {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        
        $watchlist = new Watchlist();
        $watchlist->delete($id, 'watchlist');
        $this->redirect('customer/wishlist');
    }

    function profile(){
        $errors = array();
        $cust = new CustomerModel();
        $cust_id = Auth::getuserid();
        $currentCustomer = $cust -> where('id', $cust_id, 'customer');
        $user_id = $currentCustomer[0]->user_id;

        $user = new User();
        $currUser = $user->where('id', $user_id,'user');



        $this->view('custProfile', [
            'errors'=>$errors,
            'cust'=>$currentCustomer,
            'user'=>$currUser
        ]);
    }

    function editProfile(){
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $errors = array();
        $cust = new CustomerModel();

        $cust_id = Auth::getuserid();
        $currentCustomer = $cust -> where('id', $cust_id, 'customer');
        $user_id = $currentCustomer[0]->user_id;

        $user = new User();
        $currUser = $user->where('id', $user_id,'user');

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //profile picture upload
            $profile_pic_path = $currUser[0]->profile_pic;
            if(isset($_FILES['profile_pic'])&& $_FILES['profile_pic']['error']===0){
                $targetDir = $_SERVER['DOCUMENT_ROOT']."/SurplusStays/public/assets/customerImages";
                $fileName = basename($_FILES['profile_pic']['name']);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                if(in_array(strtolower($fileType), $allowedTypes)){
                    $uniqueName = uniqid('img_', true).'.'.$fileType;
                    $filePath = $targetDir.'/'.$uniqueName;

                    if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $filePath)){
                        $profile_pic_path=$uniqueName;
                    }else{
                        $errors[] = "Failed to upload profile picture.";
                    }
                }else{
                    $errors[] = "Invalid image format.";
                }
            }


            //validate and update
            if(empty($errors) && $cust->validateEdit($_POST)){
                $custData = [
                    'fname' => $_POST['fname'],
                    'lname' => $_POST['lname'],
                    'phoneNo' => $_POST['phone'],
                    'username' => $_POST['username']
                ];

                $userData = [
                    'profile_pic'=>$profile_pic_path
                ];

                $cust->update($cust_id, $custData, 'customer');
                $user->update($user_id, $userData, 'user');

                $this-> redirect('customer/profile');
            }
        }

        $this->view('custEditProfile', [
            'cust' => $currentCustomer,
            'user' => $currUser,
            'errors' => $errors
        ]);

    }

      function deleteAccount() {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
    
        $cust = new CustomerModel();
        $user = new User();
    
        $cust_id = Auth::getuserid();
        $currentCustomer = $cust->where('id', $cust_id, 'customer');
        $user_id = $currentCustomer[0]->user_id;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData = ['status_id' => 2];

            $user->update($user_id, $userData, 'user');
            Auth::logout();
            $this->redirect('/');
            
            
            // if ($user->update($user_id, $userData, 'user')) {
            //     Auth::logout();
            //     $this->redirect('/');
            // } else {

            //     $this->redirect('customer/profile'); 
            // }
        }
    }

      function changePassword() {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
    
        $errors = array();
        $cust = new CustomerModel();
        $user = new User();
    
        $cust_id = Auth::getuserid();
        $currentCustomer = $cust->where('id', $cust_id, 'customer');
        $user_id = $currentCustomer[0]->user_id;
        $currUser = $user->where('id', $user_id, 'user');
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate inputs
            if (empty($_POST['current-password'])) {
                $errors['current-password'] = "Current password is required";
            }
            if (empty($_POST['new-password'])) {
                $errors['new-password'] = "New password is required";
            } elseif (strlen($_POST['new-password']) < 6) {
                $errors['new-password'] = "Password must be at least 6 characters";
            }
            if ($_POST['new-password'] !== $_POST['reenter-password']) {
                $errors['reenter-password'] = "Passwords don't match";
            }
    
            if (empty($errors)) {
                if (!password_verify($_POST['current-password'], $currUser[0]->password)) {
                    $errors['current-password'] = "Current password is incorrect";
                } else {
                    // Update password
                    $data = [
                        'password' => password_hash($_POST['new-password'], PASSWORD_DEFAULT)
                    ];
                    
                    if (empty($user->update($user_id, $data, 'user'))) {
                        $errors['success']="Password changed successfully";
                        $this->redirect('customer/profile');
                    } else {
                        $errors['database'] = "Failed to update password";
                    }
                }
            }
        }
    
        $this->view('custChangePassword', [
            'cust' => $currentCustomer,
            'user' => $currUser,
            'errors' => $errors
        ]);
    }


    function insideShop(){
        // $this->view('insideShop');
        $errors=array();
        $verify=new CustomerModel();
        $customer=$verify->where('business_id',1, "products");
        $business=$verify->where('id',1, "business");
        $user=$verify->where('id',2, "user");
        // $cart=$verify->insert();

        // print_r($customer[0]->name);
        $this->view('insideShop',[
            'errors'=>$errors,
            'products'=>$customer,
            'business'=>$business,
            'user'=>$user
        ]);
    }


 

}
?>
