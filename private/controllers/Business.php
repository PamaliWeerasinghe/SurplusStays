<?php
class Business extends Controller
{

    function index()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $this->view('businessWelcomePage');
    }

    function dashboard()
    {
        $this->view('businessWelcomePage');
    }

    function myproducts()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $product = new Products();
        $business_id = Auth::getUserId();
        $data = $product->where('business_id', $business_id);
        $currentDateTime = date('Y-m-d H:i:s');
        if (!empty($data)) {
            foreach ($data as $row) {
                if ($currentDateTime > $row->expiration_date_time) {
                    $product->delete($row->id);
                }
            }
        }
        $data = $product->where('business_id', $business_id);
        $this->view('businessMyProducts', ['rows' => $data]);
    }

    function orders()
    {
        $this->view('businessOrders');
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

        $product = new Products();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uploadedPictures = [];
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
                            // Save the full path to the image in the array
                            $uploadedPictures[] = '/assets/businessImages/' . $fileName; // Use relative path
                        } else {
                            $errors[] = "Failed to upload image: {$fileName}.";
                        }
                    } else {
                        $errors[] = "Only JPG, JPEG, PNG, and GIF formats are allowed for {$fileName}.";
                    }
                }
            }

            // Handle pictures field
            if (!empty($uploadedPictures)) {
                $_POST['pictures'] = implode(',', $uploadedPictures); // Store paths as a comma-separated string
            } else {
                // Fetch existing product details
                $row = $product->where('id', $id);

                if (!empty($row[0]->pictures)) {
                    // Use the existing images if no new images are uploaded
                    $_POST['pictures'] = $row[0]->pictures;
                } else {
                    $errors[] = "At least one product picture is required.";
                }
            }

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
