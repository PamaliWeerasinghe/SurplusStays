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
        $data = $event->where('customer_id', $customer_id);

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
                $this->redirect('customer');
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
}
?>