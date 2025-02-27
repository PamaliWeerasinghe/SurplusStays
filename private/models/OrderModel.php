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
                    IFNULL(o.order_status, 'Ongoing') AS status
                  FROM `order` o
                  JOIN customer c ON o.customer_id = c.id
                  JOIN order_items oi ON o.id = oi.order_id
                  JOIN products p ON oi.products_id = p.id
                  WHERE p.business_id = :business_id
                  GROUP BY o.id
                  ORDER BY o.dateTime DESC";

        return $this->query($query, ['business_id' => $business_id]);
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
                IFNULL(o.order_status, 'Ongoing') AS status
              FROM `order` o
              JOIN customer c ON o.customer_id = c.id
              JOIN order_items oi ON o.id = oi.order_id
              JOIN products p ON oi.products_id = p.id
              WHERE o.id = :order_id";

        return $this->query($query, ['order_id' => $order_id]);
    }

    public function updateOrderStatus($order_id, $status)
    {
        $query = "UPDATE `order` 
              SET order_status = :status 
              WHERE id = :order_id";
        $this->query($query, ['order_id' => $order_id, 'status' => $status]);

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
        $orderItems = $this->query($query, ['order_id' => $order_id]);

        // Deduct the quantities from the products table
        foreach ($orderItems as $item) {
            $updateQuery = "UPDATE products 
                        SET qty = GREATEST(qty - :qty, 0) 
                        WHERE id = :product_id";
            $this->query($updateQuery, ['qty' => $item->qty, 'product_id' => $item->products_id]);
        }
    }
}
