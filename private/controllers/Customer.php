<?php
class Customer extends Controller{
    function index(){
        $this->view('CustomerDashboard');
    }

    function manageComplaints()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $event = new Complaint();
        $customer_id = Auth::getID();
        // print_r($customer_id);
        $customer_id=1;
        $data = $event->where('customer_id', $customer_id, "complaints");

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
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
    
        $shops = new BusinessModel();
        $users = new User();
    
        $rows = $shops->findAll('business');
        $rows_p = $users->findAll('user');
    
        // Build map of user_id to picture
        $userPictures = [];
        foreach ($rows_p as $user) {
            $userPictures[$user->id] = $user->profile_pic;
        }
    
        // Add picture to each business row
        foreach ($rows as &$row) {
            $row->picture = $userPictures[$row->user_id] ?? '';
        }
    
        $this->view('customerBrowseShops2',[
            'rows' => $rows
        ]);
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

// function removeFromCart() {
//     if (!Auth::logged_in()) {
//         echo json_encode(['success' => false, 'message' => 'Not logged in']);
//         exit;
//     }

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $cart_id = $_POST['cart_id'] ?? null;

//         if ($cart_id) {
//             $cart = new Cart();
//             $result = $cart->delete($cart_id);
            
//             if ($result) {
//                 echo json_encode(['success' => true]);
//                 exit;
//             }
//         }
//     }

//     echo json_encode(['success' => false, 'message' => 'Invalid request']);
//     exit;
// }


    // function removeFromCart(){

    // }



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
        $this->view('custProfile');
    }

    function changePassword(){
        $this->view('custChangePassword');
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

    function viewShop($id = null)
    {
        $business = new BusinessModel();
        $row = $business->where('id', $id, 'business');

        $products = new Products();
        $productRows = $products->where('business_id', $id, 'products');

        $picture = '';
        if ($row && isset($row[0]->user_id)) {
            $user = new User();
            $userRow = $user->where('id', $row[0]->user_id, 'user');
            $picture = $userRow[0]->profile_pic ?? '';
        }

        $this->view('custViewShop', [
            'row' => $row,
            'productRows' => $productRows,
            'picture' => $picture
        ]);
    }


 

}
?>