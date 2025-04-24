<?php

class RequestModel extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db=Database::getInstance();
    }

    public $table = "donations";

    public function getRequestByBusiness($business_id)
    {
        $query = "SELECT 
                    d.id, 
                    d.title, 
                    d.status AS status,
                    d.date,  
                    org.name AS organization
                  FROM `donations` d
                  JOIN organization org ON d.organization_id = org.id
                  WHERE d.business_id = :business_id        
                  ORDER BY d.date DESC";

        return $this->db->query($query, ['business_id' => $business_id]);
    }

    public function getRequestDetails($request_id)
    {
        $query = "SELECT 
                d.id, 
                d.title, 
                d.status AS status,
                d.date, 
                d.message, 
                org.name AS organization,
                org.phoneNO AS phone,
                u.email
              FROM `donations` d
              JOIN organization org ON d.organization_id = org.id
              JOIN user u ON org.user_id=u.id 
              WHERE d.id = :request_id        
              ORDER BY d.date DESC";

        return $this->db->query($query, ['request_id' => $request_id]);
    }

    public function updateRequestStatus($request_id, $status,$feedback)
    {
        $query = "UPDATE donations SET status = :status,feedback=:feedback WHERE id = :request_id";
        return $this->db->query($query, ['status' => $status, 'request_id' => $request_id,'feedback'=>$feedback]);
    }

    public function countRequests($business_id)
    {
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE business_id = :business_id";
        $result = $this->db->query($query, ['business_id' => $business_id]);
        return $result[0]->count ?? 0;
    }
}
