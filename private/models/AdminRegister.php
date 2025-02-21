<?php 
class AdminRegister extends AdminModel{
    public function insertAdmin($user,$admin){
        try {
            $this->db->beginTransaction();
            //insert user
            if($this->insert($user,'user')){
                $this->db->rollback();
                return false;
            }
            //get the last inserted user id
            $id=$this->db->lastInsertId();
            //insert into admin
            $admin['user_id1']=$id;
            if($this->insert($admin,'admin')){
                $this->db->rollback();
                return false;
            }
            //commit the transaction
            $this->db->commit();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
?>