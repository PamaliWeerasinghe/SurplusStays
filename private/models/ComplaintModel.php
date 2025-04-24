<?php

class ComplaintModel extends Model
{
    public $table = "complaints";

    protected $db;
    public function __construct()
    {
        $this->db=Database::getInstance();
    }

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

        return $this->db->query($query, ['business_id' => $business_id]);
    }

    public function getComplaintDetails($complaint_id)
    {
        $query = "SELECT 
                m.id, 
                m.dateTime, 
                m.description,
                m.adminReply,
                m.feedback,
                c.fname AS customer_name, 
                IFNULL(cs.name, 'Pending') AS status
              FROM `complaints` m
              JOIN customer c ON m.customer_id = c.id
              LEFT JOIN complaint_status cs ON m.complaint_status_id = cs.id 
              WHERE m.id = :complaint_id";

        return $this->db->query($query, ['complaint_id' => $complaint_id]);
    }

    public function addResponse($complaint_id, $response)
    {
        $query = "UPDATE complaints SET feedback = :response WHERE id = :complaint_id";
        $this->db->query($query, ['response' => $response, 'complaint_id' => $complaint_id]);
    }
}
