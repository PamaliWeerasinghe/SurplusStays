<?php 

class AdminCustomer extends AdminModel
{
    public function insertCustomer(
        $user_columns,$user_values,$customer_columns,
        $customer_values,$user,$add_customer
        )
    {
        try {
            if(!empty($this->where($user_columns,$user_values,'user')) && !empty($this->where($customer_columns,$customer_values,'customer'))){
                //begin the transaction
                $this->db->beginTransaction();
                //insert the user
                if($this->insert($user,'user')){
                    $this->db->rollback();
                    return false;
                }
                //get the last id
                $id=$this->db->lastInsertId();
                //Insert into customer table
                $add_customer['user_id']=$id;
                if($this->insert($add_customer,'customer')){
                    $this->db->rollback();
                    return false;
                }
                //commit the transaction
                $this->db->rollback();
                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //upload customer profile picture
    public function uploadCustomerPic($logo)
    {

        $logoExt = explode('.', $logo);
        $logoActualExt = strtolower(end($logoExt));
        $logoNameNew = uniqid('', true) . "." . $logoActualExt;
        $fileDestination =$_SERVER['DOCUMENT_ROOT'] .'/SurplusStays/public/assets/customerImages/' . $logoNameNew;
        $dbFileDestination = $logoNameNew;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $fileDestination);

        return $dbFileDestination;
    }
}






?>