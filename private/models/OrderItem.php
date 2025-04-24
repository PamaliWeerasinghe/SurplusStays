<?php

class OrderItem extends Model
{
    public $table = "order_items";
    public $errors = [];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['products_id']) || !is_numeric($data['products_id'])) {
            $this->errors['products_id'] = "Invalid product ID.";
        }

        if (empty($data['order_id']) || !is_numeric($data['order_id'])) {
            $this->errors['order_id'] = "Invalid order ID.";
        }

        if (!isset($data['qty']) || !is_numeric($data['qty']) || $data['qty'] <= 0) {
            $this->errors['qty'] = "Quantity must be a positive number.";
        }

        return empty($this->errors);
    }
}
