<?php
class Model extends Database
{
    public $errors = array();

    public function __construct()
    {
        if (!property_exists($this, 'table')) {
            $this->table = strtoLower($this::class);
        }
    }
    public function where($column, $value)
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        return $this->query($query, [
            'value' => $value
        ]);
    }

    public function findAll()
    {
        $query = "select * from $this->table";
        return $this->query($query);
    }

    public function insert($data)
    {
        if (property_exists($this, 'beforeInsert')) {
            foreach ($this->beforeInsert as $func) {
                $data = $this->$func($data);
            }
        }
        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = implode(',:', $keys);
        $query = "insert into $this->table ($columns) values (:$values)";

        return $this->query($query, $data);
    }

    public function update($id, $data)
    {
        // Define all required fields with default values (e.g., empty string for text fields, 0 for numbers)
        $fields = [
            'product-name' => '',
            'category' => '',
            'description' => '',
            'quantity' => 0,
            'price-per-unit' => 0.0,
            'expiration' => null,
            'discount' => 0.0,
        ];

        // Merge submitted data with defaults, so all fields are present
        $data = array_merge($fields, $data);

        // Build query string with all fields
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");

        // Include the ID in the data array
        $data['id'] = $id;

        // Build and execute query
        $query = "UPDATE $this->table SET $str WHERE id = :id";
        return $this->query($query, $data);
    }


    public function delete($id)
    {
        $query = "delete from $this->table where id = :id";
        $data['id'] = $id;
        return $this->query($query, $data);
    }
}
