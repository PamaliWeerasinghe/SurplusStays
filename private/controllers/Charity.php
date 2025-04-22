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
    $donation_b = new BusinessDonation();
    $businesses = new Business();

    $org_id = Auth::getID();

    $EventCount = $event->countRows($org_id);
    $AllReqCount = $donation->countRows($org_id, 0) + $donation_b->countRows($org_id, 'pending');
    $AccReqCount = $donation->countRows($org_id, 2) + $donation_b->countRows($org_id, 'accepted');

    // Date ranges
    $today = date('Y-m-d');
    $monday = date('Y-m-d', strtotime('monday this week'));
    $firstDayLastMonth = date('Y-m-01', strtotime('first day of last month'));
    $lastDayLastMonth = date('Y-m-t', strtotime('last day of last month'));
    $firstDayThisYear = date('Y-01-01');
    $firstDayThisMonth = date('Y-m-01');
    $lastDayThisMonth = date('Y-m-t');

    // Fetch accepted donations
    $weekRaw = array_merge(
        $donation->getAcceptedDonationsByDate($org_id, $monday, $today),
        $donation_b->getAcceptedDonationsByDate($org_id, $monday, $today)
    );

    // Fetch accepted donations for this month
    $monthRaw = array_merge(
        $donation->getAcceptedDonationsByDate($org_id, $firstDayThisMonth, $lastDayThisMonth),
        $donation_b->getAcceptedDonationsByDate($org_id, $firstDayThisMonth, $lastDayThisMonth)
    );

    $yearRaw = array_merge(
        $donation->getAcceptedDonationsByDate($org_id, $firstDayThisYear, $today),
        $donation_b->getAcceptedDonationsByDate($org_id, $firstDayThisYear, $today)
    );

    // Helpers
    function getDailyCounts($data, $startDate, $days = 7) {
        $counts = array_fill(0, $days, 0);
        $map = [];
        foreach ($data as $item) {
            $map[$item->date] = $item->count;
        }
        for ($i = 0; $i < $days; $i++) {
            $date = date('Y-m-d', strtotime("$startDate +$i days"));
            $counts[$i] = isset($map[$date]) ? (int)$map[$date] : 0;
        }
        return $counts;
    }

    function getMonthlyCounts($data) {
        $counts = array_fill(0, 12, 0);
        foreach ($data as $item) {
            $monthIndex = (int)date('n', strtotime($item->date)) - 1;
            $counts[$monthIndex] += (int)$item->count;
        }
        return $counts;
    }
    function getDailyCountsByDay($data, $startDate) {
        $daysInMonth = date('t', strtotime($startDate));
        $counts = array_fill(0, 31, 0); // Always 31 elements
    
        foreach ($data as $item) {
            $day = (int)date('j', strtotime($item->date)); // Day of month (1-31)
            $counts[$day - 1] += (int)$item->count;
        }
    
        return $counts;
    }

    // Process data
    $weekData = getDailyCounts($weekRaw, $monday);
    $monthData = getDailyCountsByDay($monthRaw, $firstDayThisMonth);
    $yearData = getMonthlyCounts($yearRaw);

    

    $topBusinesses = $this->getTopDonatingBusinesses();
    $recentRequests = $this->getRecentReqeuests();


    $this->view('charity_dashboard', [
        'EventCount' => $EventCount,
        'AllReqCount' => $AllReqCount,
        'AccReqCount' => $AccReqCount,
        'weekData' => $weekData,     // 7 days (Mon-Sun)
        'monthData' => $monthData,   // original monthly data
        'yearData' => $yearData,      // 12 months of year
        'topBusinesses' => $topBusinesses,
        'recentRequests' => $recentRequests
    ]);
}

function getTopDonatingBusinesses()
{
    $db = Database::getInstance();

    $query = "
        SELECT business_id, SUM(donation_count) AS total_donations
        FROM (
            SELECT business_id, COUNT(*) AS donation_count
            FROM donations
            WHERE status = 2 AND organization_id = :org_id
            GROUP BY business_id

            UNION ALL

            SELECT business_id, COUNT(*) AS donation_count
            FROM business_donations
            WHERE status = 'accepted' AND organization_id = :org_id
            GROUP BY business_id
        ) AS combined
        GROUP BY business_id
        ORDER BY total_donations DESC
        LIMIT 6
    ";

    $org_id = Auth::getID();
    $topBusinesses = $db->query($query, ['org_id' => $org_id], 'assoc');

    foreach ($topBusinesses as &$b) {
        $result = $db->query("SELECT name FROM business WHERE id = :id", ['id' => $b['business_id']], 'assoc');
        $user_id = $db->query("SELECT user_id FROM business WHERE id = :id", ['id' => $b['business_id']], 'assoc');
        $result_p = $db->query("SELECT profile_pic FROM user WHERE id = :id", ['id' => $user_id[0]['user_id']], 'assoc');
        if ($result && isset($result[0])) {
            $b['name'] = $result[0]['name'];
            $b['image'] = ASSETS . '/businessimages/' . $result_p[0]['profile_pic'];
        } else {
            $b['name'] = 'Unknown';
            $b['image'] = ASSETS . '/images/default.png'; // fallback image
        }
    }

    return $topBusinesses;
}

    function getRecentReqeuests()
{
    $db = Database::getInstance();
    $org_id = Auth::getID();

    $recentRequests = $db->query(
        "SELECT * FROM business_donations 
         WHERE organization_id = :org_id 
         ORDER BY date DESC 
         LIMIT 5",
        ['org_id' => $org_id],
        'assoc'
    );

    foreach ($recentRequests as &$req) {
        $result = $db->query("SELECT name FROM business WHERE id = :id", ['id' => $req['business_id']], 'assoc');
        if ($result && isset($result[0])) {
            $req['business_name'] = $result[0]['name'];
        } else {
            $req['business_name'] = 'Unknown';
        }
    }

    return $recentRequests;
}


    function manage_events()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $event = new event();
        $organization_id = Auth::getID();
        $data = $event->where('organization_id', $organization_id, 'upcoming_events');
        $currentDateTime = date('Y-m-d H:i:s');

        if(!empty($data))
        {
            foreach ($data as $row) {
                if ($currentDateTime > $row->end_dateTime) {
                    // Update the status to closed (0)
                    $event->update($row->id, ['status' => 0],'upcoming_events'); // Assuming you have a method to update the status
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

        $rows = $requests->where('organization_id', Auth::getID(),'donations' );
        $rows_r = $requests_r->where('organization_id', Auth::getID(), 'business_donations');
        $shopRows = $shop->findAll('business');

        $PenReqCount = $requests->countRows($org_id,0);
        $AccReqCount = $requests->countRows($org_id,2);
        $RejReqCount = $requests->countRows($org_id,1);

        $PenReqCount_r = $requests_r->countRows($org_id,'pending');
        $AccReqCount_r = $requests_r->countRows($org_id,'accepted');
        $RejReqCount_r = $requests_r->countRows($org_id,'rejected');

        $this->view('charityDonations',[
            'rows' => $rows, 
            'rows_r' => $rows_r,
            'shopRows' => $shopRows,
            'AllReqCount' => $PenReqCount + $AccReqCount + $RejReqCount,
            'PenReqCount' => $PenReqCount,
            'AccReqCount' => $AccReqCount,
            'RejReqCount' => $RejReqCount,
            'AllReqCount_r' => $PenReqCount_r + $AccReqCount_r + $RejReqCount_r,
            'PenReqCount_r' => $PenReqCount_r,
            'AccReqCount_r' => $AccReqCount_r,
            'RejReqCount_r' => $RejReqCount_r
        ]);
    }

    function browse_shops()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $shops = new Business();
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

        $this->view('charityBrowseShops2',[
            'rows' => $rows
        ]);
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

        $this->view('charityBrowseOrganizations', [
            'rows' => $rows,
            'weekCounts' => $weekCounts
        ]);
    }

    function reports()
    {
        $this->view('charityReports');
    }

    function profile()
    {
        $org = new Organization();
        $org_id = Auth::getID();
        $currOrg = $org->where('id', $org_id,'organization');
        $user_id = $currOrg[0]->user_id;

        $user = new User();
        $currUser = $user->where('id', $user_id,'user' );

        $this->view('charityProfile',[
            'currOrg' => $currOrg,
            'currUser' => $currUser,
        ]);
    }

    function viewEvent($id = null)
    {
        $event = new Event();
        $row = $event->where('id', $id,'upcoming_events');
        $this->view('charityViewEvent2', [
            'row' => $row,
        ]);
    }

    function viewOrganization($id = null)
    {
        $org = new Organization();
        $row = $org->where('id', $id, 'organization');

        $requests_r = new BusinessDonation();
        $PenReqCount = $requests_r->countRows($id, 'pending');
        $AccReqCount = $requests_r->countRows($id, 'accepted');
        $RejReqCount = $requests_r->countRows($id, 'rejected');

        $total = $PenReqCount + $AccReqCount + $RejReqCount;
        $ResponseRate = ($total > 0) ? (($AccReqCount + $RejReqCount) / $total) * 100 : 0;

        $event = new Event();
        $eventRows = $event->where('organization_id', $id, 'upcoming_events');

        // Fetch the picture from the related user
        $picture = '';
        if ($row && isset($row[0]->user_id)) {
            $user = new User();
            $userRow = $user->where('id', $row[0]->user_id, 'user');
            $picture = $userRow[0]->profile_pic ?? '';
        }

        $this->view('charityViewOrganization', [
            'row' => $row,
            'eventRows' => $eventRows,
            'responseRate' => $ResponseRate,
            'picture' => $picture
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
            // if (!empty($requiredFood)) {
            //     try {
            //         $correctedFood = $this->callOpenAI($requiredFood);
            //         if($requiredFood != $correctedFood){
            //             $errors[] = "Did you mean {$correctedFood}.";
            //         }else{
            //             $_POST['required-food'] = $requiredFood;
            //         }
            //     } catch (Exception $e) {
            //         $errors[] = "Error validating food names: " . $e->getMessage();
            //     }
            // }

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
            if ($event->delete($id,'upcoming_events')) {
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

        $row = $event->where('id', $id,'upcoming_events');
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
            
                $event->update($id, $arr,'upcoming_events');
                $this->redirect('charity/manage_events');  // Redirect to the event list page or another relevant page
            }else
            {
                $errors = $event->errors;
            }
        }
        $row = $event->where('id', $id,'upcoming_events');
        
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

    function sendDonationRequestToCharity()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = [];
        if (count($_POST) > 0) {
            $request = new BusinessDonation();

            // Process the event if no errors
            if (empty($errors) && $request->validate($_POST)) {
                // Prepare the data array for database insertion
                $arr['organization_id'] = $_POST['org_id'];
                $arr['business_id'] = Auth::getId();
                $arr['title'] = $_POST['title'];
                $arr['message'] = $_POST['message'];
                
                // Convert food_items array to comma-separated string
                if (isset($_POST['food_items']) && is_array($_POST['food_items'])) {
                    // Filter out empty values and trim whitespace
                    $filteredItems = array_filter($_POST['food_items'], function($item) {
                        return trim($item) !== '';
                    });
                    
                    // Convert the array to a comma-separated string
                    $arr['food_items'] = implode(', ', $filteredItems);
                } else {
                    // Handle case when no food items are provided
                    $arr['food_items'] = '';
                }
                
                $arr['status'] = 'pending';
                $arr['date'] = date('Y-m-d');

                $request->insert($arr);
                $this->redirect('charity/browse_charities');
                
                // Optional: Set a success message in session
                // $_SESSION['success_message'] = "Donation request sent successfully!";
                
            } else {
                $errors = array_merge($errors, $request->errors);
            }
        }

        $this->view('charityBrowseShops', [
            'errors' => $errors,
        ]);
    }

    function replyDonationRequest($id = null)
{
    if (!Auth::logged_in()) {
        $this->redirect('login');
    }

     // Debug to see what's coming in
    //  echo "ID: " . $id . "<br>";
    //  echo "<pre>";
    //  print_r($_POST);
    //  echo "</pre>";
    //  die(); // This will stop execution and show you the data

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $request = new BusinessDonation();
        
        // Get the donation ID from the form
        $donationId = $_POST['donation_id'] ?? $id;
        
        // Create the data array for update
        $arr = [];
        $arr['feedback'] = $_POST['reply-message']; // Note the hyphen
        $arr['status'] = $_POST['status']; // This is coming from the hidden input
        
        // Update the database
        $result = $request->update($donationId, $arr, 'business_donations');
        
        // Redirect back to donations page
        $this->redirect('charity/donations');
        return; // Make sure to return after redirect
    }

    // If we get here, something went wrong
    $this->redirect('charity/donations');
}
    
}



