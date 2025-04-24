<?php

class BusinessRating extends Model
{
    public $table = "business_rating";

    public function businessrating($business_id){

        $query = "SELECT COUNT(*) as count, SUM(rating) as sum
                  FROM business_rating
                  WHERE business_id = :business_id";

        return $this->db->query($query, ['business_id' => $business_id]);

    }
}