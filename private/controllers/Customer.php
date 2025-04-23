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


    function paymentHistory(){
        $this->view('custPayment');
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

        $customer_id = Auth::getId();
        $wishlistProductIds = [];

        $wishlistModel = new Wishlist();
        $wishlistItems = $wishlistModel->where('customer_id', $customer_id, 'watchlist');
        foreach ($wishlistItems as $item) {
            $wishlistProductIds[] = $item->products_id;
        }

        $this->view('custViewShop', [
            'row' => $row,
            'productRows' => $productRows,
            'picture' => $picture,
            'wishlistProductIds' => $wishlistProductIds
        ]);
    }

    function addToCart()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = [];
        if (count($_POST) > 0) {
            
            $cart = new Cart();
            $businessId = $_POST['business_id'];
            $product = new Products();
            $customerId = Auth::getId();
            $productId = $_POST['product_id'];
            $requestedQty = (int)$_POST['qty'];
            $db = Database::getInstance();

             // Check for conflicting shop
            $existingBusinesses = $db->query("SELECT DISTINCT business_id FROM cart WHERE customer_id = ?", [$customerId]);

            if (!empty($existingBusinesses) && $existingBusinesses[0]->business_id != $businessId) {
                    // Conflict found
                    $previousBusinessId = $existingBusinesses[0]->business_id;

                    // Get shop names (assuming you have a businesses table)
                    $shopModel = new BusinessModel();
                    $currentShop = $shopModel->where('id', $businessId, 'business')[0]->name ?? 'Current Shop';
                    $previousShop = $shopModel->where('id', $previousBusinessId, 'business')[0]->name ?? 'Previous Shop';

                    // Store in session
                    $_SESSION['cart_conflict'] = [
                        'previous_id' => $previousBusinessId,
                        'previous_name' => $previousShop,
                        'current_id' => $businessId,
                        'current_name' => $currentShop,
                        'product_id' => $productId,
                        'qty' => $_POST['qty'],
                    ];

                    $this->redirect('customer/viewShop/' . $businessId);
                }
            else{
                if (isset($_POST['original_qty'])) {
                    $requestedQty = (int)$_POST['qty'] - (int)$_POST['original_qty'];
                }

                // Check if the product already exists in the cart
                $existing = $db->query(
                    "SELECT * FROM cart WHERE customer_id = ? AND products_id = ? LIMIT 1",
                    [$customerId, $productId]
                );

                // Fetch product from database
                $prod = $product->where('id',$productId,'products');

                
                if ($existing && isset($existing[0])) {
                    // Product already in cart → update qty
                    $existingRow = $existing[0];
                    $newQty = $existingRow->qty + $requestedQty;
                    $cart->update($existingRow->id, ['qty' => $newQty], 'cart');
                    // Update product qty
                    $newQty_p = $prod[0]->qty - $requestedQty;
                    $product->update($productId, ['qty' => $newQty_p], 'products');
                    if (isset($_POST['original_qty'])) {
                        $this->redirect('customer/cart');
                    }
                    else{
                        $this->redirect('customer/viewShop/' . $businessId);
                    }
                    
                }
                else{
                    if ($prod && $prod[0]->qty >= $requestedQty) {
                    // Process the event if no errors
                    if (empty($errors) && $cart->validate($_POST)) {
                        $arr['customer_id'] = Auth::getId();
                        $arr['products_id'] = $_POST['product_id'];
                        $arr['business_id'] = $_POST['business_id'];
                        $arr['qty'] = $_POST['qty'];
                        $cart->insert($arr);

                        // Update product qty
                        $newQty = $prod[0]->qty - $requestedQty;
                        $product->update($productId, ['qty' => $newQty], 'products');

                        $this->redirect('customer/viewShop/' . $businessId);

                    } else {
                        $errors = array_merge($errors, $request->errors);
                    }
                    }else {
                        $errors[] = "Not enough stock available.";
                    }
                }
            }
        }
    }

    function cart(){
       
        $cart = new Cart();
        $customerId = Auth::getId();

        $cartRows = $cart->where('customer_id', $customerId, 'cart');

        $products = new Products();
        $productRows = [];
        $db = Database::getInstance();

        if ($cartRows) {
            // Collect all product IDs from the cart
            $productIds = array_column($cartRows, 'products_id');
    
            // Create a string with placeholders for IN clause
            $placeholders = implode(',', array_fill(0, count($productIds), '?'));
            
            // Prepare custom query to fetch all matching products
            $query = "SELECT * FROM products WHERE id IN ($placeholders)";
            $productRows = $db->query($query, $productIds);
        }

        $this->view('custCart', [
            'cartRows' => $cartRows,
            'productRows' => $productRows,
        ]);
    }
    public function confirmNewOrder()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $customerId = Auth::getId();
        $cart = new Cart();
        $product = new Products();
        $db = Database::getInstance();

        // Get all cart items for customer
        $cartItems = $cart->where('customer_id', $customerId, 'cart');

        // Restore stock and remove each item properly
        foreach ($cartItems as $item) {
            $productId = $item->products_id;
            $qtyToRestore = $item->qty;

            // Get the product
            $productRow = $product->where('id', $productId, 'products');
            if ($productRow) {
                $updatedQty = $productRow[0]->qty + $qtyToRestore;

                // Update product stock
                $product->update($productId, ['qty' => $updatedQty], 'products');

                // Remove cart item
                $cart->delete($item->id, 'cart');
            }
        }

        // Now add the new product from the form
        // You can call addToCart() or insert manually
        $_POST['product_id'] = $_POST['product_id'] ?? null;
        $_POST['qty'] = $_POST['qty'] ?? 1;
        $_POST['business_id'] = $_POST['business_id'] ?? null;

        if ($_POST['product_id'] && $_POST['qty']) {
            $this->addToCart(); // Reuse your existing logic
        } else {
            $this->redirect('customer/viewShop/' . $_POST['business_id']);
        }
    }

    function removeCartItem()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {

            $cartId = $_POST['cart_id'];
            $cart = new Cart();
            $product = new Products();
            $db = Database::getInstance();

            // Get the cart item
            $cartItem = $cart->where('id', $cartId, 'cart');

            if ($cartItem) {
                $productId = $cartItem[0]->products_id;
                $qtyToRestore = $cartItem[0]->qty;

                // Get the product
                $productRow = $product->where('id',$productId, 'products');

                if ($productRow) {
                    $updatedQty = $productRow[0]->qty + $qtyToRestore;

                    // Update product stock
                    $product->update($productId, ['qty' => $updatedQty], 'products');

                    // Remove cart item
                    $cart->delete($cartId, 'cart');
                }
            }

            $this->redirect('customer/cart'); // Adjust as needed
        }
    }

    function placeOrder()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = [];
        if (count($_POST) > 0) {
            
            $db = Database::getInstance();
            $customerId = Auth::getId();
            $order = new Order();
            $paymentMethod = $_POST['payment_method']; // 'cash_on_pickup'
            $cartItems = $_POST['cart']; // Cart items array
            $total = $_POST['total']; // Total amount from the order summary

            // 1. Insert into the `orders` table add vallidation
            if (empty($errors) ) {   
                $arr1['customer_id'] =  $customerId;
                $arr1['dateTime'] = date('Y-m-d H:i:s');
                $arr1['total'] = $total;
                $arr1['paymentMethod'] = 'CashOnPickup';
                $arr1['order_status'] = 'Ongoing';
                $arr1['business_id'] = $_POST['businessID']; // Default status   
                $order->insert($arr1);
            }
            // Get the ID of the newly inserted order
            $orderId = $db->lastInsertId();

            // 2. Insert into the `order_items` table
            foreach ($cartItems as $cartItem) {

                    $arrOrderItem['order_id'] = $orderId;
                    $arrOrderItem['products_id'] = $cartItem['products_id'];
                    $arrOrderItem['qty'] = $cartItem['qty'];
                    
                    

                // Assuming $orderItem is your model for the `order_items` table
                $orderItem = new OrderItem();
                
                $orderItem->insert($arrOrderItem);;

                // Update the product stock
                $product = new Products();
                $prod = $product->where('id', $cartItem['products_id'], 'products');
                if ($prod) {
                    $newStock = $prod[0]->qty - $cartItem['qty'];
                    $product->update($cartItem['products_id'], ['qty' => $newStock], 'products');
                }
            }

            //3. Remove items from the `cart` table using the `delete` method
            foreach ($cartItems as $cartItem) {
                $cart = new Cart();
                $cart->delete($cartItem['id'], 'cart');
            }

            // Redirect to a success page or show a confirmation
            $this->redirect('customer/');
        }
    }

    function orders(){
        $orders = new Model();
        $cus_id = Auth::getId();

        $db = Database::getInstance();
    
        // Fetch all orders for the customer
        $order_details = $orders->where('customer_id', $cus_id, 'order');
        $order_count = is_array($order_details) ? count($order_details) : 0;
    
        // For each order, check if there's a rating
        if ($order_details && is_array($order_details)) {
            foreach ($order_details as &$order) {
                $rating_result = $db->query(
                    "SELECT id, rating FROM business_rating WHERE order_id = :order_id AND customer_id = :cus_id LIMIT 1",
                    ['order_id' => $order->id, 'cus_id' => $cus_id]
                );
    
                $order->rating = $rating_result && isset($rating_result[0]->rating) ? $rating_result[0]->rating : null;
                $order->rating_id = $rating_result && isset($rating_result[0]->id) ? $rating_result[0]->id : null;
            }
        }
    
        $this->view('custViewOrders', [
            "orders" => $order_details,
            "order_count" => $order_count
        ]);
    }
    

    function viewOrder(){

    }

    function wishlist() {
        $errors = array();
        $wishlist = new Wishlist();
        $productModel = new Products();
        $cus_id = Auth::getId();
    
        // Get all watchlist entries for the logged-in customer
        $watchlist = $wishlist->where('customer_id', $cus_id, 'watchlist');
    
        // Prepare an array to store enriched watchlist items
        $data = [];
    
        if ($watchlist) {
            foreach ($watchlist as $item) {
                // Fetch product info
                $productResults = $productModel->where('id', $item->products_id, 'products');
    
                // Only proceed if we got at least one result
                if ($productResults && count($productResults) > 0) {
                    $product = $productResults[0]; // Get the first result
                    $shop = new Business();
                    $shop_row = $shop->where('id',$product->business_id,'business' );
    
                    $data[] = [
                        'product_id' => $item->products_id,
                        'business_name' => $shop_row[0]->name,
                        'image' => $product->pictures,
                        'expiry' => $product->expiration_dateTime,
                        'price' => $product->price_per_unit,
                        'qty' => $product->qty,
                    ];
                }
            }
        }
    
        $item_count = count($data);
    
        $this->view('custWishlist', [
            'errors' => $errors,
            'data' => $data,
            'item_count' => $item_count,
        ]);
    }
    

    function addToWishlist(){
        $wishlist = new Wishlist();
        $cus_id=Auth::getId();

        if (empty($errors) ) {   
            $arr['customer_id'] =  $cus_id;
            $arr['datetime'] = date('Y-m-d H:i:s');
            $arr['products_id'] =  $_POST['product_id'];
            $wishlist->insert($arr);
            $this->redirect('customer/viewShop/' . $_POST['business_id']);
        }
    }

    function removeFromWishlist() {
        $product_id = $_POST['product_id'];
        $customer_id = Auth::getId();

        if ($product_id && $customer_id) {
            $wishlist = new Wishlist();
            // Get all wishlist items for the customer
            $items = $wishlist->where('customer_id', $customer_id, 'watchlist');

            // Find the one with matching products_id
            foreach ($items as $item) {
                if ($item->products_id == $product_id) {
                    $wishlist->delete($item->id, 'watchlist');
                    break;
                }
            }
        }
        $this->redirect('customer/viewShop/' . $_POST['business_id']);
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
            $bus_id=$wishlist_row->bus_id;
    
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
            $data['business_id']=$bus_id;
            $data['qty']=$qty;
            $wishlist->insert($data,'cart');
        }
        $this->redirect('Customer/wishlist');
    }

    function rateShop(){
        $cus_id=Auth::getId();

        $ratingTable = new BusinessRating();

        $arr['business_id'] =  $_POST['business_id'];
        $arr['rating'] = $_POST['rating'];
        $arr['order_id'] = $_POST['order_id'];
        $arr['customer_id'] = $cus_id;

        $ratingTable->insert($arr,'business_rating');        
        $this->redirect('Customer/orders');
    }

    function editShopRating(){
        $cus_id=Auth::getId();

        $ratingTable = new BusinessRating();

        $arr['rating'] = $_POST['rating'];
        $rating_id = $_POST['rating_id'];

        $ratingTable->update($rating_id, $arr,'business_rating');        
        $this->redirect('Customer/orders');
    }


}
?>