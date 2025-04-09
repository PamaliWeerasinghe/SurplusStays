<?php

class Charity extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
    
        $event = new Event();
        $donation = new Donation();

        $org_id = Auth::getID();

        $EventCount = $event->countRows($org_id);
        $AllReqCount = $donation->countRows($org_id,0);
        $AccReqCount = $donation->countRows($org_id,2);
    
        $this->view('charity_dashboard', [
            'EventCount' => $EventCount,
            'AllReqCount' => $AllReqCount,
            'AccReqCount' => $AccReqCount
        ]);

    }

    function manage_events()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $event = new event();
        $organization_id = Auth::getID();
        $data = $event->where('organization_id', $organization_id);
        $currentDateTime = date('Y-m-d H:i:s');

        if(!empty($data))
        {
            foreach ($data as $row) {
                if ($currentDateTime > $row->end_dateTime) {
                    // Update the status to closed (0)
                    $event->update($row->id, ['status' => 0]); // Assuming you have a method to update the status
                }
            }
        }

        $this->view('charity_manage_events',['rows' => $data]);
    }

    function donations()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $requests = new Donation();
        $requests_r = new BusinessDonation();
        $shop = new Business();
        $org_id = Auth::getID();

        $rows = $requests->where('organization_id', Auth::getID());
        $rows_r = $requests_r->where('organization_id', Auth::getID());
        $shopRows = $shop->findAll();

        $AllReqCount = $requests->countRows($org_id,0);
        $AccReqCount = $requests->countRows($org_id,2);
        $RejReqCount = $requests->countRows($org_id,1);

        $this->view('charityDonations',[
            'rows' => $rows, 
            'rows_r' => $rows_r,
            'shopRows' => $shopRows,
            'AllReqCount' => $AllReqCount,
            'AccReqCount' => $AccReqCount,
            'RejReqCount' => $RejReqCount
        ]);
    }

    function browse_shops()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $shops = new Business();
        $rows = $shops->findAll();
        $this->view('charityBrowseShops2',['rows' => $rows]);
    }

    function browse_charities()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $orgs = new Organization();
        $rows = $orgs->findAll();
        $this->view('charityBrowseOrganizations',['rows' => $rows]);
    }

    function reports()
    {
        $this->view('charityReports');
    }

    function profile()
    {
        $this->view('charityProfile');
    }

    function viewEvent($id = null)
    {
        $event = new Event();
        $row = $event->where('id', $id);
        $this->view('charityViewEvent2', [
            'row' => $row,
        ]);
    }

    function viewOrganization($id = null)
    {
        $org = new Organization();
        $row = $org->where('id', $id);

        $event = new Event();
        $eventRows = $event->where('organization_id', $id);

        $this->view('charityViewOrganization', [
            'row' => $row,
            'eventRows' => $eventRows
        ]);
    }   
    
    function createEvent()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = [];
        if (count($_POST) > 0) {
            $event = new Event();
            $uploadedPictures = [];
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/charityImages/";

            // Handle image uploads
            foreach ($_FILES as $key => $file) {
                if (strpos($key, 'upload-') === 0 && isset($file['name']) && $file['error'] === 0) {
                    $fileName = basename($file['name']);
                    $filePath = $targetDir . $fileName;
                    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

                    // Allow certain file formats
                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array(strtolower($fileType), $allowedTypes)) {
                        if (move_uploaded_file($file['tmp_name'], $filePath)) {
                            $uploadedPictures[] = '/assets/charityImages/' . $fileName;
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

            // Validate required-food input
            $requiredFood = $_POST['required-food'] ?? '';
            if (!empty($requiredFood)) {
                try {
                    $correctedFood = $this->callOpenAI($requiredFood);
                    if($requiredFood != $correctedFood){
                        $errors[] = "Did you mean {$correctedFood}.";
                    }else{
                        $_POST['required-food'] = $requiredFood;
                    }
                } catch (Exception $e) {
                    $errors[] = "Error validating food names: " . $e->getMessage();
                }
            }

            // Process the event if no errors
            if (empty($errors) && $event->validate($_POST)) {
                $arr['organization_id'] = Auth::getId();
                $arr['event'] = $_POST['event-name'];
                $arr['event_description'] = $_POST['description'];
                $arr['start_dateTime'] = $_POST['start-date'];
                $arr['end_dateTime'] = $_POST['end-date'];
                $arr['requesting_items'] = $_POST['required-food'];
                $arr['status'] = 1;
                $arr['goal'] = $_POST['event-goal'];
                $arr['district'] = $_POST['district'];
                $arr['location'] = $_POST['location'];
                $arr['pictures'] = $_POST['pictures']; // Store full file paths in the database


                $event->insert($arr);
                $this->redirect('charity/manage_events');
            } else {
                $errors = array_merge($errors, $event->errors);
            }
        }

        $this->view('charityCreateEvent', [
            'errors' => $errors,
        ]);
    }

    
    function deleteEvent($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = new Event(); // Ensure you have an Event model
            if ($event->delete($id)) {
                // Optionally, set a success message
                $_SESSION['message'] = 'Event deleted successfully';
            } else {
                // Optionally, set an error message
                $_SESSION['message'] = 'Failed to delete event';
            }

            $this->redirect('charity/manage_events'); // Redirect back to the manage events page
        }
    }

    function acceptDonationReq($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = new BusinessDonation();
            $data = ['status' => 'accepted'];

            if ($event->update($id, $data)) {
                $_SESSION['message'] = 'Request Accepted';
            } else {
                $_SESSION['message'] = 'Failed to accept request';
            }

            $this->redirect('charity/manage_events');
        }
    }


    function editEvent($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $errors = []; // Ensure this is declared before use.
        $event = new event();

        $row = $event->where('id', $id);
        $currentPictures = explode(',', $row[0]->pictures);
        $uploadedPictures = [];
        
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/charityImages/";

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
                        $uploadedPictures[$i] = '/assets/charityImages/' . $uniqueName;
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
                
                $arr['organization_id'] = Auth::getUserId();
                $arr['event'] = $_POST['event-name'];
                $arr['event_description'] = $_POST['description'];
                $arr['start_dateTime'] = $_POST['start-date'];
                $arr['end_dateTime'] = $_POST['end-date'];
                $arr['requesting_items'] = $_POST['required-food'] ?? '';  // Optional field
                $arr['status'] = 1;  // Default status for new event
                $arr['goal'] = $_POST['event-goal'];
                $arr['district'] = $_POST['district'];
                $arr['location'] = $_POST['location'];
                $arr['pictures'] = $_POST['pictures'];
            
                $event->update($id, $arr);
                $this->redirect('charity/manage_events');  // Redirect to the event list page or another relevant page
            }else
            {
                $errors = $event->errors;
            }
        }
        $row = $event->where('id', $id);
        
        $this->view('charityEditEvent',[
            'row' => $row,
            'errors' => $errors,
        ]);
    }

    function sendDonationRequest()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = [];
        if (count($_POST) > 0) {
            $request = new Donation();

            // Process the event if no errors
            if (empty($errors) && $request->validate($_POST)) {
                $arr['organization_id'] = Auth::getId();
                $arr['business_id'] = $_POST['business_id'];
                $arr['title'] = $_POST['title'];
                $arr['message'] = $_POST['message'];
                $arr['status'] = 0;
                $arr['date'] = date('Y-m-d');

                $request->insert($arr);
                $this->redirect('charity/manage_events');
            } else {
                $errors = array_merge($errors, $request->errors);
            }
        }

        $this->view('charityBrowseShops', [
            'errors' => $errors,
        ]);
    }
    
}
