<?php

class Complaint extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db=Database::getInstance();
    }
    public $table = "complaints";

    public function validate($DATA)
    {
        // Reset errors
        $this->errors = [];

        // Validate event name
        if (empty($DATA['order-id'])) {  // Updated to 'event-name'
            $this->errors['order_id'] = "Order ID is required";
        }

        if (empty($DATA['shopName'])) {  // Updated to 'event-name'
            $this->errors['shop'] = "Shop name is required";
        }

        // Validate event description
        if (empty($DATA['complaint'])) {  // Updated to 'description'
            $this->errors['feedback'] = "Event description is required";
        }

        // Validate start and end datetime
        if (empty($DATA['date'])) {  // Updated to 'start-date'
            $this->errors['date'] = "Start date and time is required";
        }

        // Return true if no errors
        return empty($this->errors);
    }

    public function countRows($org_id) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE customer_id = :cust_id";
        $params = [':cust_id' => $org_id];
        $result = $this->db->query($query, $params); // Pass parameters for prepared statement
        return $result[0]->count ?? 0; // Ensure query() returns array or object
    }
    
}