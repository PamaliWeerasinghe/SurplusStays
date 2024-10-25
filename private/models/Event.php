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

        // Return true if no errors
        return empty($this->errors);
    }
}

     // protected $allowedColumns = [
    //     'organization_id',
    //     'event',
    //     'event_description',
    //     'start_dateTime',
    //     'end_dateTime',
    //     'requesting_items',
    //     'status',
    //     'goal',
    //     'district',
    //     'location'
    // ];

    // protected $beforeInsert = [
    //     'make_event_id',
    //     'make_organization_id'
    // ];

    // protected function make_event_id($data)
    // {
    //     $data['event_id'] = random_string(60);
    //     return $data;
    // }

    // protected function make_organization_id($data)
    // {
    //     $data['organization_id'] = random_string(60);
    //     return $data;
    // }

