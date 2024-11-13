<?php
class Products extends Model
{
    protected $table = "products";
    public function validate($DATA)
    {
        // Reset errors
        $this->errors = [];
       
        if (empty($DATA['product-name'])) {  
            $this->errors['product'] = "Product name is required";
        }
        $categories=['Fast foods','Snack','Drinks','Other'];
        if(empty($DATA['category']) || !in_array($DATA['category'],$categories)) {
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
        
        if (empty($DATA['expiration'])) {  
            $this->errors['expiration'] = "expiration date and time is required";
        }
        
        // Return true if no errors
        return empty($this->errors);
    }
}