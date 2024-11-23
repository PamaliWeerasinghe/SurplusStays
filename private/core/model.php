<?php

class Model extends Database
{
     public $table;
     public $errors = array();

     public function __construct()
     {
          if (!property_exists($this, 'table')) {
               $this->table = strtolower($this::class);
          }
     }

     public function where($column,$value,$table)
     {
          $this->table=$table;
          //check whether the column exists before executing the query
          $column = addslashes($column);
          $query = "select * from $this->table where $column = :value";
          return $this->query($query, [
               // 'column' => $column,
               'value' => $value
          ]);
     }

     public function findAll($table)
     {    
          $this->table=$table;
          $query = "select * from $this->table";
          return $this->query($query);
     }

     public function insert($data)
     {    
          // $this->table=$table;
          $keys = array_keys($data);
          $columns = implode(',', $keys);
          $values = implode(',:', $keys);

          $query = "insert into $this->table ($columns) values (:$values)";

          return $this->query($query, $data);
     }

     public function update($id, $data)
     {
          $str = "";

          foreach ($data as $key => $value) {
               $str .= $key . "=:" . $key . ",";
          }
          $str = trim($str, ",");

          $data['id'] = $id;
          $query = "update $this->table set $str where id = :id";

          return $this->query($query, $data);
     }

     //Update charity organization except password field
     public function updateExceptPassword($name,$picture,$city,$email,$phoneNo,$description,$username,$date,$id){
          $this->table='organization';
          $query="update $this->table set 
          name = :$name,
          picture =:$picture,
          city=:$city,
          email=:$email,
          phoneNo=:$phoneNo,
          charity_description=:$description,
          username=:$username,
          date=:$date
          where id=:$id";

          return $this->query($query);
     }

     public function delete($id,$table)
     {    
          $this->table=$table;
          $query = "delete from $this->table where id = :id";
          $data['id'] = $id;
          return $this->query($query, $data);
     }

     //select the last inserted id 
     public function selectLastID($table)
     {
          $this->table=$table;
          $query="select MAX(id) AS last_id from $this->table";
          return $this->query($query);
     }
}
