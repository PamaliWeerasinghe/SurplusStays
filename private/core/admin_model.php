<?php

class Admin_Model 
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
   
     public function where($columns,$values,$table)
     {
          $this->table=$table;

          //Ensure that both columns and values are arrays of same length
          if(!is_array($columns)|| !is_array($values)|| count($columns)!=count($values)){
               throw new Exception("Column and values must be arrays of same length");
          }

          $conditions=[];
          $queryParams=[];

          foreach($columns as $index =>$column){
               $paramName=":value$index";
               $conditions[]="`$column`=$paramName"; // `column1`=value0
               $queryParams[$paramName]=$values[$index]; //value0 = 'testing'
          }

          //Build the query with multiple conditions using AND
          $whereClause =implode('AND',$conditions);
          $query="SELECT * FROM `$this->table` WHERE $whereClause";
          
          return $this->db->query($query, $queryParams);
     }
     public function select($table,$limit,$offset)
     {
          $this->table=$table;
          $query="select * from $this->table order by complaint_id desc limit $limit offset $offset";
          // $countquery="select count(*) from $this->table";
          // $data[
          //      'data' =  $this->db->query($query)
          //      'count' = $this->db->query($countquery)
          // ];
          return $this->db->query($query);
     }
     public function count($table){
          $this->table=$table;
          $query="select count(*) as totalrows from $this->table";
          return $this->db->query($query)[0]->totalrows;
     }
     public function findAll($table)
     {    
          $this->table=$table;
          $query = "select * from $this->table";
          return $this->db->query($query);
     }

     public function insert($data,$table)
     {    
          $this->table=$table;
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
