<?php
class Business extends Controller
{

    function index()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $product = new Products();
        $pro_id = Auth::getID();
        $rowCount = $product->countRows($pro_id);
        $this->view('businessWelcomePage', [
            'rowCount' => $rowCount,
        ]);
    }

    function myproducts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $product = new Products();
        $business_id = Auth::getID();

        // Handle expired products
        $currentDateTime = date('Y-m-d H:i:s');
        $data = $product->where('business_id', $business_id);
        if (!empty($data)) {
            foreach ($data as $row) {
                if ($currentDateTime > $row->expiration_date_time) {
                    $product->delete($row->id);
                }
            }
        }

        // Get filter from query parameters
        $filter = $_GET['filter'] ?? null;

        // Fetch filtered or default data
        $data = $product->getFilteredProducts($business_id, $filter);

        $this->view('businessMyProducts', ['rows' => $data]);
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
            $this->redirect('orders'); // Redirect if order is not found
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


    function requests()
    {
        $this->view('businessRequests');
    }

    function complains()
    {
        $this->view('businessComplains');
    }
    function reports()
    {
        $this->view('businessReport');
    }
    function profile()
    {
        $this->view('businessProfile');
    }

    function viewProduct($id = null)
    {
        $product = new Products();
        $row = $product->where('id', $id);
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
            } else {
                $errors[] = "At least one product picture is required.";
            }

            if (empty($errors) && $product->validate($_POST)) {
                $arr['business_id'] = Auth::getUserId();
                $arr['name'] = $_POST['product-name'];
                $arr['category'] = $_POST['category'];
                $arr['description'] = $_POST['description'];
                $arr['qty'] = $_POST['quantity'];
                $arr['price_per_unit'] = $_POST['price-per-unit'];
                $arr['expiration_date_time'] = $_POST['expiration'];
                $arr['discount_price'] = $_POST['discount'];
                $arr['pictures'] = $_POST['pictures'];
                $product->insert($arr);
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
        $product = new Products();

        $row = $product->where('id', $id);
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
            // Process the form
            if ($product->validate($_POST)) {
                $arr['business_id'] = Auth::getUserId();
                $arr['name'] = $_POST['product-name'];
                $arr['category'] = $_POST['category'];
                $arr['description'] = $_POST['description'];
                $arr['qty'] = $_POST['quantity'];
                $arr['price_per_unit'] = $_POST['price-per-unit'];
                $arr['expiration_date_time'] = $_POST['expiration'];
                $arr['discount_price'] = $_POST['discount'];
                $arr['pictures'] = $_POST['pictures'];

                $product->update($id, $arr);
                $this->redirect('business/myproducts');
            } else {
                $errors = $product->errors;
            }
        }

        // Fetch existing product details for display
        $row = $product->where('id', $id);

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
                $product = new Products(); // Ensure you have an Product model
                if ($product->delete($id)) {
                    // Optionally, set a success message
                    $_SESSION['message'] = 'Product deleted successfully';
                } else {
                    // Optionally, set an error message
                    $_SESSION['message'] = 'Failed to delete product';
                }
                $this->redirect('business/myproducts'); // Redirect back to the myproducts page
            }
        }
    }


    function test($name)
    {
        $data = [
            "username" => $name
        ];
        $this->view('aboutView', $data);
    }
}
