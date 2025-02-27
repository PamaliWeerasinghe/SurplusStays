<?php

class ComplaintModel extends Model
{
    protected $table = "complaints";

    public function getComplainsByBusiness($business_id)
    {
        $query = "SELECT 
                    m.id, 
                    m.dateTime, 
                    c.fname AS Customer, 
                    IFNULL(cs.name, 'Pending') AS status
                  FROM `complaints` m
                  JOIN customer c ON m.customer_id = c.id
                  LEFT JOIN complaint_status cs ON m.complaint_status_id = cs.id               
                  WHERE m.business_id = :business_id
                  GROUP BY m.id
                  ORDER BY m.dateTime DESC";

        return $this->query($query, ['business_id' => $business_id]);
    }

    public function getComplaintDetails($complaint_id)
    {
        $query = "SELECT 
                m.id, 
                m.dateTime, 
                m.description,
                c.fname AS customer_name, 
                IFNULL(cs.name, 'Pending') AS status
              FROM `complaints` m
              JOIN customer c ON m.customer_id = c.id
              LEFT JOIN complaint_status cs ON m.complaint_status_id = cs.id 
              WHERE m.id = :complaint_id";

        return $this->query($query, ['complaint_id' => $complaint_id]);
        
    }
}
