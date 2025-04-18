<?php
class Products extends Model
{
    public $table = "products";
    public function validate($DATA)
    {
        // Reset errors
        $this->errors = [];

        if (empty($DATA['product-name'])) {
            $this->errors['product'] = "Product name is required";
        }
        $categories = ['Fast foods', 'Snack', 'Drinks', 'Other'];
        if (empty($DATA['category']) || !in_array($DATA['category'], $categories)) {
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
            $this->errors['pictures'] = "At least one event picture is required.";
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

    public function countRows($pro_id)
    {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE business_id = :pro_id";
        $params = [':pro_id' => $pro_id];
        $result = $this->query($query, $params); // Pass parameters for prepared statement
        return $result[0]->count ?? 0; // Ensure query() returns array or object
    }

    public function getFilteredProducts($business_id, $filter = null)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE business_id = :business_id";

        // Add filtering criteria
        if ($filter === 'expiration_date') {
            $query .= " ORDER BY expiration_date_time ASC";
        } elseif ($filter === 'quantity') {
            $query .= " ORDER BY qty DESC";
        } elseif ($filter === 'price') {
            $query .= " ORDER BY price_per_unit ASC";
        }

        $params = [':business_id' => $business_id];
        return $this->query($query, $params);
    }
}
