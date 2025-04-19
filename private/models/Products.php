<?php
class Products extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db=Database::getInstance();
    }

    public $table = "products";
    public function validate($DATA)
    {
        // Reset errors
        $this->errors = [];

        if (empty($DATA['product-name'])) {
            $this->errors['product'] = "Product name is required";
        }

        if($this->where('name',$DATA['product-name'],'products')) {
            $this->errors['name'] = "Product name already in use ";
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



    public function countProducts($business_id)
    {
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE business_id = :business_id";
        $result = $this->db->query($query, ['business_id' => $business_id]);
        return $result[0]->count ?? 0;
    }


    public function getFilteredProducts($business_id, $filter = null)
    {
        $orderBy = "ORDER BY id DESC"; //default -newly added item first

        if ($filter === 'Price') {
            $orderBy = "ORDER BY price_per_unit ASC";
        } else if ($filter === 'Quantity') {
            $orderBy = "ORDER BY qty ASC";
        } else if ($filter === 'Expiration') {
            $orderBy = "ORDER BY expiration_date_time ASC";
        }

        $query = "SELECT * FROM $this->table WHERE business_id = :business_id $orderBy";
        return $this->db->query($query, ['business_id' => $business_id]);
    }


    public function gettopsalesproducts($business_id)
    {
        $query = "SELECT p.id,p.name, p.price_per_unit, p.pictures, p.status_id ,COUNT(*) AS count 
                FROM order_items oi
                JOIN products p ON p.id = oi.products_id
                WHERE p.business_id = :business_id
                GROUP BY oi.products_id
                ORDER BY count DESC";

        return $this->db->query($query, ['business_id' => $business_id]);
    }
}
