<?php

class BusinessDonation extends Model
{
    public $table = "business_donations";

    protected $db;

    public function __construct()
    {
        $this->db=Database::getInstance();
    }

    public function validate($DATA)
    {
        // Validation rules
        $this->errors = []; // Reset errors

        if(empty($DATA['title'])) {
            $this->errors['title'] = "A title for the message is required";
        }
        if(empty($DATA['message'])) {
            $this->errors['message'] = "Please enter your message";
        }
        
        // Return true if no errors
        return empty($this->errors);
    }

     public function countRows($org_id, $status) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE organization_id = :org_id AND status = :status";
        $params = [':org_id' => $org_id, ':status' => $status];
        $result = $this->db->query($query, $params);
    
        // Return the scalar count value or 0 if the result is empty
        return isset($result[0]) ? (int) $result[0]->count : 0;
    }

    public function getAcceptedDonationsByDate($org_id, $startDate, $endDate) {
        $query = "SELECT DATE(date) as date, COUNT(*) as count 
                  FROM $this->table 
                  WHERE organization_id = :org_id AND status = 'accepted' 
                  AND DATE(date) BETWEEN :start AND :end
                  GROUP BY DATE(date)";
        
        $result = $this->db->query($query, [
            ':org_id' => $org_id,
            ':start' => $startDate,
            ':end' => $endDate,
        ]);
    
        return is_array($result) ? $result : [];
    }

    public function getAcceptedDonationsCountByDate($org_id, $startDate, $endDate) {
        $query = "SELECT COUNT(*) as count 
                  FROM $this->table 
                  WHERE organization_id = :org_id 
                  AND status = 'accepted' 
                  AND DATE(date) BETWEEN :start AND :end";
        
        $result = $this->db->query($query, [
            ':org_id' => $org_id,
            ':start' => $startDate,
            ':end' => $endDate,
        ]);
    
        return is_array($result) && isset($result[0]->count) ? (int)$result[0]->count : 0;

    }
    
    
    
}
