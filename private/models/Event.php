<?php

class Event extends Model
{
    protected $table = "upcoming_events";

    public function validate($DATA)
    {
        // Reset errors
        $this->errors = [];

        // Validate event name
        if (empty($DATA['event-name'])) {  // Updated to 'event-name'
            $this->errors['event'] = "Event name is required";
        }

        // Validate event description
        if (empty($DATA['description'])) {  // Updated to 'description'
            $this->errors['event_description'] = "Event description is required";
        }

        // Validate start and end datetime
        if (empty($DATA['start-date'])) {  // Updated to 'start-date'
            $this->errors['start_dateTime'] = "Start date and time is required";
        }
        if (empty($DATA['end-date'])) {  // Updated to 'end-date'
            $this->errors['end_dateTime'] = "End date and time is required";
        }

        // Validate location
        if (empty($DATA['location'])) {
            $this->errors['location'] = "Event location is required";
        }

        // Optional: Validate goal
        if (!empty($DATA['goal']) && strlen($DATA['goal']) > 50) {
            $this->errors['goal'] = "Goal must be under 50 characters";
        }
        if (empty($DATA['pictures'])) {
            $this->errors['pictures'] = "At least one event picture is required.";
        }

        // Return true if no errors
        return empty($this->errors);
    }

    public function countRows($org_id) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE organization_id = :org_id";
        $params = [':org_id' => $org_id];
        $result = $this->query($query, $params); // Pass parameters for prepared statement
        return $result[0]->count ?? 0; // Ensure query() returns array or object
    }
    
}