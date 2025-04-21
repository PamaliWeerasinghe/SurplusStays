<?php
class Cart extends Model {
    public $table = 'cart';

    public function addToCart($customer_id, $product_id) {
        $existingItem = $this->where([
            'customer_id' => $customer_id,
            'products_id' => $product_id
        ]);

        if ($existingItem) {
            return $this->update($existingItem[0]->id, [
                'qty' => $existingItem[0]->qty + 1
            ]);
        } else {
            return $this->insert([
                'customer_id' => $customer_id,
                'products_id' => $product_id,
                'qty' => 1
            ]);
        }
    }
    // public function delete($id) {
    //     // Assuming your cart table has 'id' as primary key
    //     $query = "DELETE FROM cart WHERE id = :id LIMIT 1";
    //     $this->query($query, ['id' => $id]);
    // }

    public function updateQuantity($cart_id, $new_quantity) {
        if($new_quantity < 1) {
            return $this->delete($cart_id);
        }
        return $this->update($cart_id, [
            'qty' => $new_quantity
        ]);
    }

    public function getCartItems($customer_id) {
        return $this->query(
            "SELECT * FROM cart_view WHERE cart_id IN 
            (SELECT id FROM cart WHERE customer_id = :customer_id)",
            ['customer_id' => $customer_id]
        );
    }

    public function clearCart($customer_id) {
        return $this->deleteWhere(['customer_id' => $customer_id]);
    }
}