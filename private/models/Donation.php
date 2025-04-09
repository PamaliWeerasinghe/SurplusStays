<?php

class Donation extends Model
{
    protected $table = "donations";

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
        $result = $this->query($query, $params);
    
        // Return the scalar count value or 0 if the result is empty
        return isset($result[0]) ? (int) $result[0]->count : 0;
    }
}
