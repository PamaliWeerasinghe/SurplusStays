<?php

class Order extends Model
{
    public $table = "order";
    public $errors = [];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['customer_id']) || !is_numeric($data['customer_id'])) {
            $this->errors['customer_id'] = "Invalid customer ID.";
        }

        if (empty($data['dateTime'])) {
            $this->errors['dateTime'] = "Order date and time is required.";
        }

        if (!isset($data['total']) || !is_numeric($data['total']) || $data['total'] < 0) {
            $this->errors['total'] = "Total amount must be a valid non-negative number.";
        }

        $allowedMethods = ['CashOnPickup']; // Add more if needed
        if (empty($data['paymentMethod']) || !in_array($data['paymentMethod'], $allowedMethods)) {
            $this->errors['paymentMethod'] = "Invalid payment method.";
        }

        $allowedStatuses = ['Pending', 'Completed', 'Cancelled'];
        if (empty($data['order_status']) || !in_array($data['order_status'], $allowedStatuses)) {
            $this->errors['order_status'] = "Invalid order status.";
        }

        return empty($this->errors);
    }
}
