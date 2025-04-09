<?php
class AdminComplaints extends AdminModel
{
    //insert the complaint
    public function insertComplaint($complaint, $imgs,$columns,$values)
    {
        try {

            if(empty($this->where($columns,$values,'complaints'))){
                //begin the transaction
                $this->db->beginTransaction();
                //insert the complaint
                if ($this->insert($complaint, 'complaints')) {
                    $this->db->rollback();
                    return false;
                }
                //Get the last id
                $id = $this->db->lastInsertId();

                //Insert complaint images
                for ($i = 0; $i < count($imgs); $i++) {
                    $complaint_img = array();
                    $complaint_img['complaints_id'] = $id;
                    $complaint_img['path'] = $imgs[$i];
                    if ($this->insert($complaint_img, 'complaint_imgs')) {
                        $this->db->rollback();
                        return false;
                    }
                }

                //commit the transaction
                $this->db->commit();
                return true;
            }else{
                
                return false;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //upload complaint images
    public function uploadImage($img, $id)
    {
        $imgExt = explode('.', $img);
        $remake_ext = strtolower(end($imgExt));
        $imgName = uniqid('', true) . "." . $remake_ext;
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/SurplusStays/public/assets/complaints/";
        $fileDestination = $target_dir . $imgName;
        $dbFileDestination = $imgName;
        $tmp_name = $_FILES['complaintImg' . $id + 1]['tmp_name'];
        move_uploaded_file($tmp_name, $fileDestination);
        return $dbFileDestination;
    }
    //selecting all the complaints
    public function getAllComplaints()
    {
        $query = "SELECT 
            `complaints`.`id` AS `complaint_id`,
            `order_items_id`,
            `feedback`,
            `order`.`id` AS `order_id`,
            `complaint_status`.`name` AS `complaint_status`,
            `business_id`,
            `complaints`.`dateTime` AS `complaint_date`,
            `description`,
            `business`.`name` AS `business_name`,
            `business`.`phoneNo` AS `business_phone`,
            `fname`,
            `lname`,
            `customer`.`phoneNo` AS `customer_phone`

         FROM `complaints` 
        INNER JOIN `order_items` ON `complaints`.`order_items_id`=`order_items`.`id` 
        INNER JOIN `order` ON `order_items`.`order_id`=`order`.`id`
        INNER JOIN `complaint_status` ON `complaints`.`complaint_status_id`=`complaint_status`.`id`
        INNER JOIN `business` ON `business`.`id`=`complaints`.`business_id`
        INNER JOIN `customer` ON `customer`.`id`=`complaints`.`customer_id`";

        return $this->db->query($query);
    }
    //seleting the details of one complaint
    public function complaintDetails($id)
    {
        $query = "SELECT `complaints`.`id` AS `complaint_id`,
            `order_items_id`,
            `feedback`,
            `products`.`name` AS `product_name`,
            `order`.`id` AS `order_id`,
            `complaint_status`.`name` AS `complaint_status`,
            `complaints`.`business_id` AS `businessID`,
            `complaints`.`complaint_dateTime` AS `complaint_date`,
            `complaints`.`description` AS `complaintDescription`,
            `business`.`name` AS `business_name`,
            `business`.`phoneNo` AS `business_phone`,
            `fname`,
            `lname`,
            `total`,
            `order_items`.`qty` AS `itemQty`,
            `paymentMethod`,
            `user`.`email` AS `customer_email`,
            `customer`.`phoneNo` AS `customer_phone`,
            `expiration_dateTime` AS `product`,
            `discountPrice`
         FROM `complaints` 
        INNER JOIN `order_items` ON `complaints`.`order_items_id`=`order_items`.`id` 
        INNER JOIN `products` ON `products`.`id`=`order_items`.`products_id`
        INNER JOIN `order` ON `order_items`.`order_id`=`order`.`id`
        INNER JOIN `complaint_status` ON `complaints`.`complaint_status_id`=`complaint_status`.`id`
        INNER JOIN `business` ON `business`.`id`=`complaints`.`business_id`
        INNER JOIN `customer` ON `customer`.`id`=`complaints`.`customer_id`
        INNER JOIN `user`  ON `user`.`id`=`customer`.`user_id`
        WHERE `complaints`.`id`= :value";

        return $this->db->query($query, [
            'value' => $id
        ]);
    }

    //get the complaint images
    public function getComplaintImages($id)
    {
        $query = "SELECT * FROM `complaint_imgs` WHERE `complaints_id`=:value";
        return $this->db->query($query, [
            'value' => $id
        ]);
    }

    //get the orders made by a customer
    public function getNoOfOrders($id)
    {
        $query = "SELECT * FROM `order` WHERE `customer_id`=:value";
        return $this->db->query($query, [
            'value' => $id
        ]);
    }

    //get the orders belonging to a one customer
    public function getAllOrders($id)
    {
        $query = "SELECT 
        `products`.`name` AS `product_name`,
        `products`.`id` AS `product_id`,
        `order_id`,
        `order_items`.`id` AS `order_items_id`,
        `business`.`name` AS `business_name`,
        `business`.`id` AS `business_id`
        FROM `order` 
        INNER JOIN `order_items` ON `order`.`id`=`order_items`.`order_id`
        INNER JOIN `products` ON `order_items`.`products_id`=`products`.`id`
        INNER JOIN `business` ON `products`.`business_id`=`business`.`id`
        WHERE `order_id`=:value";
        return $this->db->query($query, [
            'value' => $id
        ]);
    }
}
