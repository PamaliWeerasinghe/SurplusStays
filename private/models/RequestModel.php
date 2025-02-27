<?php

class RequestModel extends Model
{
    protected $table = "donations";

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

        return $this->query($query, ['business_id' => $business_id]);
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
                org.email AS email
              FROM `donations` d
              JOIN organization org ON d.organization_id = org.id
              WHERE d.id = :request_id        
              ORDER BY d.date DESC";

        return $this->query($query, ['request_id' => $request_id]);
    }

    public function updateRequestStatus($request_id, $status)
    {
        $query = "UPDATE donations SET status = :status WHERE id = :request_id";
        return $this->query($query, ['status' => $status, 'request_id' => $request_id]);
    }
}
