<?php

class DonationItems extends Model{


    public $table='donation_items';

    protected $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getdonationitems($req_id){

        $query="SELECT
        p.name,
        p.qty
        FROM products p
        JOIN donation_items d ON p.id=d.products_id
        WHERE d.request_id=:req_id
        ";
        return $this->db->query($query,["req_id"=>$req_id]);
    }

}