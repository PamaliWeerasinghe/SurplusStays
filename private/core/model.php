<?php

class Model
{
     public $table;
     public $errors = array();
     public $data=array();
     
     protected $db;

     public function __construct()
     {
          if (!property_exists($this, 'table')) {
               $this->table = strtolower($this::class);
          }
          $this->db=Database::getInstance();

     }

     public function where($column,$value,$table)
     {
          $this->table=$table;
          //check whether the column exists before executing the query
          $column = addslashes($column);
          $query = "select * from $this->table where $column = :value";
          return $this->db->query($query, [
               // 'column' => $column,
               'value' => $value
          ]);
     }
  
     public function findAll($table)
     {    
          $this->table=$table;
          $query = "select * from $this->table";
          return $this->db->query($query);
     }

     public function insert($data)
     {    
          // $this->table=$table;
          $keys = array_keys($data);
          $columns = implode(',', $keys);
          $values = implode(',:', $keys);

          $query = "insert into $this->table ($columns) values (:$values)";

          return $this->db->query($query, $data);
     }

     public function update($id,$data,$table)
     {
          $this->table=$table;
          

          $str = "";
          $data['id']=$id;
          foreach ($data as $key => $value) {
               $str .= $key . "=:" . $key . ",";
          }
     
          $str = trim($str, ",");

         

          $query = "update $this->table set $str where id = :id";

          return $this->db->query($query, $data);
     }

     

     public function delete($id,$table)
     {    
          $this->table=$table;
          $query = "delete from $this->table where id = :id";
          $data['id'] = $id;
          return $this->db->query($query, $data);
     }

     //select the last inserted id 
     public function selectLastID($table)
     {
          $this->table=$table;
          $query="select MAX(id) AS last_id from $this->table";
          return $this->db->query($query);
     }
}