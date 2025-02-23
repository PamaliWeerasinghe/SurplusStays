<?php

class OrderModel extends Model
{
    protected $table = "order";

    public function getOrdersByBusiness($business_id)
    {
        $query = "SELECT 
                    o.id, 
                    o.dateTime, 
                    o.total, 
                    c.fname AS Customer, 
                    GROUP_CONCAT(p.name SEPARATOR ', ') AS Products,
                    IFNULL(os.order_status, 'Not Collected') AS status
                  FROM `order` o
                  JOIN customer c ON o.customer_id = c.id
                  JOIN order_items oi ON o.id = oi.order_id
                  LEFT JOIN order_status os ON o.id = os.order_id
                  JOIN products p ON oi.products_id = p.id
                  WHERE p.business_id = :business_id
                  GROUP BY o.id
                  ORDER BY o.dateTime DESC";

        return $this->query($query, ['business_id' => $business_id]);
    }
}
