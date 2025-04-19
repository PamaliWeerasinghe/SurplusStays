<?php
class ProductsEdit extends Model
{
    public $table = "products";
    public function validate($DATA)
    {
        // Reset errors
        $this->errors = [];

        if (empty($DATA['product-name'])) {
            $this->errors['product'] = "Product name is required";
        }

        if (empty($DATA['category'])) {
            $this->errors['category'] = "Category cannot be empty";
        }

        if (empty($DATA['description'])) {
            $this->errors['product_description'] = "Product description is required";
        }
        if (empty($DATA['quantity'])) {
            $this->errors['quantity'] = "Quantity is required";
        }

        if (empty($DATA['price-per-unit'])) {
            $this->errors['price-per-unit'] = "Price is required";
        }

        if (empty($DATA['pictures'])) {
            $this->errors['pictures'] = "At least one product picture is required.";
        }

        if (empty($DATA['expiration'])) {
            $this->errors['expiration'] = "Expiration date and time is required";
        } else {
            // Normalize datetime-local format to include seconds
            $expirationInput = $DATA['expiration'] . ':00'; // Append seconds

            $currentDateTime = new DateTime();
            $expirationDateTime = DateTime::createFromFormat('Y-m-d\TH:i:s', $expirationInput);

            if (!$expirationDateTime) {
                $this->errors['expiration'] = "Invalid date and time format.";
            } elseif ($expirationDateTime < $currentDateTime) {
                $this->errors['expiration'] = "Expiration date and time must be in the future.";
            }
        }

        // Return true if no errors
        return empty($this->errors);
    }

}
