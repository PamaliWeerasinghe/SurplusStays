<?php

class Admin_Model 
{
     public $table;
     public $errors = array();
     public $data=array();
     public $column;
     public $from_date;
     public $to_date;
     
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
     public function admin_bar($from_date,$to_date){
          
          $query="SELECT SUM(`order_items`.`qty`) AS product_count,`order`.`dateTime` AS date_time FROM `order_items`
                  INNER JOIN `order`
                  ON `order`.`id`=`order_items`.`order_id`
                  WHERE `order`.`dateTime` BETWEEN :from_date AND :to_date
                  GROUP BY `order`.`dateTime` ";

          $data=[
               'from_date'=>$from_date,
               'to_date'=>$to_date
          ];
          
          return $this->db->query($query,$data);
     }
     public function select($table,$limit,$offset,$search = '', $searchBy = '', $sort = '', $order = 'ASC')
     {
          $this->table=$table;
          // intialize the condition string
          $condition = "status_id='1'";
          // check if the search is not empty
          if (!empty($search)) {
               // check if the search by is not empty
               $condition = " `$searchBy` LIKE '%$search%'";
          }

          $sortOption = "";
          // check if the sort is not empty
          if (!empty($sort)) {
               // check if the order is not empty
               $sortOption = " `$sort` $order";
          }

          $query="select * from $this->table where $condition order by $sortOption limit $limit offset $offset";

          return $this->db->query($query);
     }
     
     //get the not attended complaints
     public function selectNotAttended($table,$limit,$offset,$search = '', $searchBy = '', $sort = '', $order = 'ASC')
     {
          $this->table=$table;
          // intialize the condition string
          $condition = "status_id='1' OR status_id='2'";
          // check if the search is not empty
          if (!empty($search)) {
               // check if the search by is not empty
               $condition = " `$searchBy` LIKE '%$search%'";
          }

          $sortOption = "";
          // check if the sort is not empty
          if (!empty($sort)) {
               // check if the order is not empty
               $sortOption = " `$sort` $order";
          }

          $query="select * from $this->table where $condition order by $sortOption limit $limit offset $offset";

          return $this->db->query($query);
     }
     //get the recent complaints
     public function selectRecentComplaints($table,$column,$limit,$offset)
     {
         $this->table=$table;
         $this->column=$column;
         $query="select * from $this->table order by $this->column desc limit $limit offset $offset";
         return $this->db->query($query);
     }
     //count for search and sort
     public function countForSortSearch($table,$columns,$values){
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
          $whereClause =implode('OR',$conditions);
          $query="SELECT count(*) as totalRows FROM `$this->table` WHERE $whereClause";
          $results=$this->db->query($query, $queryParams);
          return isset($results[0]->totalRows) ? $results[0]->totalRows : 0;

     }
     //get the sum of order total
     public function totalRevenue($table){
          $this->table=$table;
          $query="select sum(total) as total_sum from `$this->table`";
          return $this->db->query($query)[0]->total_sum;
     }
     //get the count of items in a column
     public function count($table){
          $this->table=$table;
          $query="select count(*) as totalrows from `$this->table`";
          return $this->db->query($query)[0]->totalrows;
     }
     //get the count with where clause
     public function countWithWhere($table,$columns,$values){
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
          $query="SELECT count(*) as totalRows FROM `$this->table` WHERE $whereClause";
          $results=$this->db->query($query, $queryParams);
          return isset($results[0]->totalRows) ? $results[0]->totalRows : 0;

     }
     //get the details with where and limit
     public function whereWithLimit($table,$columns,$values,$limit){
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
          $query="SELECT * FROM `$this->table` WHERE $whereClause LIMIT $limit ";
          $results=$this->db->query($query, $queryParams);
          return $results;
     }
     //get the sum of values in a column
     public function sum($table){
          $this->table=$table;
          $query="select sum(total) as total FROM `$this->table`";
          return $this->db->query($query)[0]->total;
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

     public function updateUserWhere($id,$data,$table)
     {
          $this->table=$table;
          

          $str = "";
          $data['id']=$id;
          foreach ($data as $key => $value) {
               $str .= $key . "=:" . $key . ",";
          }
     
          $str = trim($str, ",");

         

          $query = "update $this->table set $str where user_id1 = :id";

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
