<?php

class OrderModel extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db=Database::getInstance();
    }

    public $table = "order";

    public function getOrdersByBusiness($business_id)
    {
        $query = "SELECT 
                    o.id, 
                    o.dateTime, 
                    o.total, 
                    c.fname AS Customer, 
                    GROUP_CONCAT(p.name SEPARATOR ', ') AS Products,
                    IFNULL(o.order_status, 'Ongoing') AS status
                  FROM `order` o
                  JOIN customer c ON o.customer_id = c.id
                  JOIN order_items oi ON o.id = oi.order_id
                  JOIN products p ON oi.products_id = p.id
                  WHERE p.business_id = :business_id
                  GROUP BY o.id
                  ORDER BY o.dateTime DESC";

        return $this->db->query($query, ['business_id' => $business_id]);
    }

    public function getOrderDetails($order_id)
    {
        $query = "SELECT 
                o.id, 
                o.dateTime, 
                o.total, 
                c.fname AS customer_name, 
                c.phoneNo AS customer_phone, 
                p.name AS product_name, 
                oi.qty, 
                p.price_per_unit, 
                p.discountPrice,
                IFNULL(o.order_status, 'Ongoing') AS status
              FROM `order` o
              JOIN customer c ON o.customer_id = c.id
              JOIN order_items oi ON o.id = oi.order_id
              JOIN products p ON oi.products_id = p.id
              WHERE o.id = :order_id";

        return $this->db->query($query, ['order_id' => $order_id]);
    }

    public function updateOrderStatus($order_id, $status)
    {
        $query = "UPDATE `order` 
              SET order_status = :status 
              WHERE id = :order_id";
        $this->db->query($query, ['order_id' => $order_id, 'status' => $status]);

        // Deduct quantities only if status is "Completed"
        if ($status === 'Completed') {
            $this->deductProductQuantities($order_id);
        }
    }

    private function deductProductQuantities($order_id)
    {
        // Get the ordered products and quantities
        $query = "SELECT products_id, qty 
              FROM order_items 
              WHERE order_id = :order_id";
        $orderItems = $this->db->query($query, ['order_id' => $order_id]);

        // Deduct the quantities from the products table
        foreach ($orderItems as $item) {
            $updateQuery = "UPDATE products 
                        SET qty = GREATEST(qty - :qty, 0) 
                        WHERE id = :product_id";
            $this->db->query($updateQuery, ['qty' => $item->qty, 'product_id' => $item->products_id]);
        }
    }

    public function countOrders($business_id)
    {
        $query = "SELECT COUNT(DISTINCT o.id) as count
              FROM `order` o
              JOIN order_items oi ON o.id = oi.order_id
              JOIN products p ON oi.products_id = p.id
              WHERE p.business_id = :business_id";

        $result = $this->db->query($query, ['business_id' => $business_id]);
        return $result[0]->count ?? 0;
    }

    public function getWeeklyOrderStats($business_id)
    {
        $query = "
        SELECT 
            DAYNAME(o.dateTime) AS day,
            COUNT(DISTINCT o.id) AS order_count
        FROM `order` o
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON oi.products_id = p.id
        WHERE p.business_id = :business_id
            AND YEARWEEK(o.dateTime, 1) = YEARWEEK(CURDATE(), 1)
        GROUP BY DAYOFWEEK(o.dateTime)
        ORDER BY FIELD(DAYNAME(o.dateTime), 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
    ";

        return $this->db->query($query, ['business_id' => $business_id]);
    }
}
