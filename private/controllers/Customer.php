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
    function RemoveFromWishlist($id){
        $item=new AdminModel();
        $status=$item->delete($id,'watchlist');
        if(empty($status)){
            $this->redirect('customer/wishlist');

        }
            
        
    }
   


    function viewComplaint($id)
    {
        // print_r($id);
        $complaint=new AdminModel();
        $complaint_details=$complaint->where(['complaint_id'],[$id],'complaintdetails');
        $complaint_details=$complaint_details[0];

        $complaint_imgs=$complaint->where(['complaints_id'],[$id],'complaint_imgs');

        $this->view('custViewComplaint',[
            "complaint_details"=>$complaint_details,
            "complaint_imgs"=>$complaint_imgs
        ]);

    }

    // function makeComplaint()
    // {
    //     if (!Auth::logged_in()) {
    //         $this->redirect('login');
    //     }
    
    //     $errors = [];
    //     if (count($_POST) > 0) {
    //         $event = new Complaint();
    //         $uploadedPictures = [];
    //         $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/customerImages/";
    
    //         // Handle each upload field
    //         foreach ($_FILES as $key => $file) {
    //             if (strpos($key, 'upload-') === 0 && isset($file['name']) && $file['error'] === 0) {
    //                 $fileName = basename($file['name']);
    //                 $filePath = $targetDir . $fileName;
    //                 $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
    
    //                 // Allow certain file formats
    //                 $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    //                 if (in_array(strtolower($fileType), $allowedTypes)) {
    //                     // Attempt to move the uploaded file
    //                     if (move_uploaded_file($file['tmp_name'], $filePath)) {
    //                         // Save the full path to the image in the array
    //                         $uploadedPictures[] = '/assets/customerImages/' . $fileName; // Use relative path
    //                     } else {
    //                         $errors[] = "Failed to upload image: {$fileName}.";
    //                     }
    //                 } else {
    //                     $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed for {$fileName}.";
    //                 }
    //             }
    //         }
    
    //         // Check if at least one image was uploaded
    //         if (!empty($uploadedPictures)) {
    //             $_POST['pictures'] = implode(',', $uploadedPictures); // Store paths as a comma-separated string
    //         } else {
    //             $errors[] = "At least one event picture is required.";
    //         }
    
    //         if (empty($errors) && $event->validate($_POST)) {
    //             $arr['order_id'] = $_POST['order-id'];
    //             $arr['feedback'] = $_POST['complaint'];
    //             $arr['complaint_status_id'] = 0;  // Default 
    //             $arr['pictures'] = $_POST['pictures'];
    //             $arr['customer_id'] = Auth::getId();
    //             $arr['shop'] = $_POST['shopName'];
    //             $arr['date'] = $_POST['date'];
    
    //             $event->insert($arr);
    //             $this->redirect('customer/manageComplaints');
    //         } else {
    //             $errors = array_merge($errors, $event->errors);
    //         }
    //     }
    
    //     $this->view('custLodgeComplaint', [
    //         'errors' => $errors,
    //     ]);
    // }

    // function deleteComplaint($id)
    // {
    //     if (!Auth::logged_in()) {
    //         $this->redirect('login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $event = new Complaint(); // Ensure you have an Event model
    //         if ($event->delete($id)) {
    //             // Optionally, set a success message
    //             $_SESSION['message'] = 'Complaint deleted successfully';
    //         } else {
    //             // Optionally, set an error message
    //             $_SESSION['message'] = 'Failed to delete complaint';
    //         }

    //         $this->redirect('customer/manageComplaints'); // Redirect back to the manage events page
    //     }
    // }

    // function editComplaint($id = null){
    //     if(!Auth::logged_in())
    //     {
    //         $this->redirect('login');
    //     }

    //     $errors = []; // Ensure this is declared before use.
    //     $event = new Complaint();

    //     $row = $event->where('id', $id);
    //     $currentPictures = explode(',', $row[0]->pictures);
    //     $uploadedPictures = [];
        
    //     $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/customerImages/";

    //     // Loop through upload slots (assuming there are 5 upload slots)
    //     for ($i = 0; $i < 5; $i++) {
    //         $uploadKey = 'upload-' . $i+1;
        
    //         if (isset($_FILES[$uploadKey]) && $_FILES[$uploadKey]['error'] === 0) {
    //             // Get the original file name and extension
    //             $fileName = basename($_FILES[$uploadKey]['name']);
    //             $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
    //             // Generate a unique file name
    //             $uniqueName = uniqid('img_', true) . '.' . $fileType;
        
    //             // Define the file path
    //             $filePath = $targetDir . $uniqueName;
        
    //             // Allow certain file formats
    //             $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    //             if (in_array(strtolower($fileType), $allowedTypes)) {
    //                 if (move_uploaded_file($_FILES[$uploadKey]['tmp_name'], $filePath)) {
    //                     // Save the relative path to the uploaded image
    //                     $uploadedPictures[$i] = '/assets/customerImages/' . $uniqueName;
    //                 } else {
    //                     $errors[] = "Failed to upload image: {$fileName}.";
    //                 }
    //             } else {
    //                 $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed for {$fileName}.";
    //             }
    //         } 
    //          // If no file uploaded, check if it's a delete request
    //         elseif (isset($_POST['delete-' . ($i + 1)]) && $_POST['delete-' . ($i + 1)] === "delete.png") {
    //             // If delete request, remove the image from the server
    //             if (!empty($currentPictures[$i])) {
    //                 $filePathToDelete = $_SERVER['DOCUMENT_ROOT'] . $currentPictures[$i];
    //                 if (file_exists($filePathToDelete)) {
    //                     unlink($filePathToDelete);  // Delete the file from server
    //                 }
    //                 // Mark the image slot as deleted
    //                 $uploadedPictures[$i] = '';  // Mark as empty or deleted
    //             }
    //         }
    //          // If no file uploaded, keep the current picture
    //         elseif (!empty($currentPictures[$i])) {
    //             $uploadedPictures[$i] = $currentPictures[$i];
    //         }
    //     }
        

    //     // Ensure all 5 slots are accounted for
    //     for ($i = 0; $i < 5; $i++) {
    //         if (!isset($uploadedPictures[$i])) {
    //             $uploadedPictures[$i] = ''; // Fill empty slots with an empty string
    //         }
    //     }

    //     // Check if at least one image was uploaded or exists
    //     if (!array_filter($uploadedPictures)) { // array_filter removes empty values
    //         $errors[] = "At least one event picture is required.";
    //     } else {
    //         $_POST['pictures'] = implode(',', $uploadedPictures); // Store paths as a comma-separated string
    //     }

    //     $errors = array();
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0)
    //     {
    //         if ($event->validate($_POST)) 
    //         {
                
    //             $arr['order_id'] = $_POST['order-id'];
    //             $arr['feedback'] = $_POST['complaint'];
    //             $arr['complaint_status_id'] = 0;  // Default 
    //             $arr['pictures'] = $_POST['pictures'];
    //             $arr['customer_id'] = Auth::getId();
    //             $arr['shop'] = $_POST['shopName'];
    //             $arr['date'] = $_POST['date'];
            
    //             $event->update($id, $arr);
    //             $this->redirect('customer/manageComplaints');  // Redirect to the event list page or another relevant page
    //         }else
    //         {
    //             $errors = $event->errors;
    //         }
    //     }
    //     $row = $event->where('id', $id);
        
    //     $this->view('custEditComplaint',[
    //         'row' => $row,
    //         'errors' => $errors,
    //     ]);
    // }
    



    //other pages
    function browseShops(){
        $this->view('CustomerBrowseShops');
    }
    function cart(){
        
        $errors = array();
        $verify = new AdminModel();
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
    //view complaints made
    function complaints(){
        $complaints=new AdminModel();
        $cus_id=$_SESSION['USER'][0]->id;
        $complaints_details=$complaints->where(['customer_id'],[$cus_id],'complaintdetails');
        $no_of_complaints=$complaints->countWithWhere('complaintdetails',['customer_id'],[$cus_id]);
        foreach($complaints_details as $complaint){
            $img=array();
            $images=$complaints->where(['complaints_id'],[$complaint->complaint_id],'complaint_imgs');
            foreach($images as $image){
                array_push($img,$image->path);
            }
            $complaint->images=$img;

           
        }
        // print_r($complaints_details);
        $this->view('custViewMadeComplaints',[
            "complaint_details"=>$complaints_details,
            "complaint_count"=>$no_of_complaints
        ]);
    }
    // Get all the orders made by a customer
    function orders(){
        $orders=new AdminModel();
        $cus_id=$_SESSION['USER'][0]->id;
        $order_details=$orders->where(['customer_id'],[$cus_id],'order');
        $order_count=$orders->countWithWhere('order',['customer_id'],[$cus_id]);
        $this->view('custViewOrders',[
            "orders"=>$order_details,
            "order_count"=>$order_count
        ]);

    }
    //view order items belonging to an order
    function viewOrder($id){
        $order=new AdminModel();
        $order_details=$order->where(['id'],[$id],'order');
        $order_details=$order_details[0];

        $item_details=$order->where(['order_id'],[$id],'order_and_the_business');
        
        $this->view('custOrderDetails',[
            "ord_id"=>$id,
            "ord_details"=>$order_details,
            "items"=>$item_details
        ]);

    }

    // wishlist
    function wishlist(){
        $errors = array();
        $wishlist = new AdminModel();
        $cus_id=$_SESSION['USER'][0]->id;
        $watchlist = $wishlist->where(['cus_id'],[$cus_id],"watchlist_details");
        $item_count=$wishlist->countWithWhere('watchlist_details',['cus_id'],[$cus_id]);
        
        $this->view('custWishlist', [
            'errors'=>$errors,
            'data' => $watchlist,
            'item_count' => $item_count,
            // 'customer_id'=>$_SESSION['USER']
        ]);
        // $this->view('custWishList');
    }
    function AddToCartFromWishlist($id){
        $item=new AdminModel();
        $data=$item->where(['id'],[$id],'watchlist_details');
        $data=$data[0];
        echo json_encode($data);
    }
    function WishlistToCart($wishlist_id,$qty)
    {
        $wishlist=new AdminModel();
        if($qty>0){
            $wishlist_row=$wishlist->where(['id'],[$wishlist_id],'watchlist_details');
            $wishlist_row=$wishlist_row[0];
    
            //Get the relevant details to add to the cart table
            $products_id=$wishlist_row->product_id;
            $cus_id=$wishlist_row->cus_id;
    
            //remove from wishlist
            $wishlist->delete($wishlist_id, 'watchlist');
    
            //update the products table
            $product=$wishlist->where(['id'],[$products_id],'products');
            $product=$product[0];
            $new_qty=$product->qty-$qty;
            $product_data['qty']=$new_qty;
            $wishlist->update($products_id,$product_data,'products');
    
            //insert into the cart
            $data['products_id']=$products_id;
            $data['customer_id']=$cus_id;
            $data['qty']=$qty;
            $wishlist->insert($data,'cart');
    
            
        }
        $this->redirect('Customer/wishlist');
       
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

    // function insideShop(){
    //     // $this->view('insideShop');
    //     $errors=array();
    //     $verify=new CustomerModel();
    //     $customer=$verify->where('business_id',1, "products");
    //     $business=$verify->where('id',1, "business");
    //     $user=$verify->where('id',2, "user");
    //     // $cart=$verify->insert();

    //     // print_r($customer[0]->name);
    //     $this->view('insideShop',[
    //         'errors'=>$errors,
    //         'products'=>$customer,
    //         'business'=>$business,
    //         'user'=>$user
    //     ]);
    // }


 

}
?>