<?php

class DonationItems extends Model
{
    public $table = "donation_items";
    public $errors = [];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['products_id']) || !is_numeric($data['products_id'])) {
            $this->errors['products_id'] = "Invalid product ID.";
        }

        if (empty($data['request_id']) || !is_numeric($data['request_id'])) {
            $this->errors['request_id'] = "Invalid request ID.";
        }

        if (!is_numeric($data['qty']) || $data['qty'] <= 0) {
            $this->errors['qty'] = "Quantity must be a positive number.";
        }

        return empty($this->errors);
    }
}