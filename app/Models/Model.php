<?php

namespace App\Models;

use mysqli;

class Model {

    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $conn;
    protected $query;
    protected $table;

    protected $sql;
    protected $data = [];
    protected $params = null;

    public function __construct()
    {
        $this->connection();
    }

    public function connection(){
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if($this->conn->connect_errno)
            die('Connection error: ' . $this->conn->connect_errno);
    }

    public function query($sql, $data = [], $params = null){

        if($data){

            if($params == null){
                $params = str_repeat('s', count($data));    
            }

            $smtp = $this->conn->prepare($sql);
            $smtp->bind_param($params, ...$data);
            $smtp->execute();

            $this->query = $smtp->get_result();
        }
        else
            $this->query = $this->conn->query($sql);

        return $this;
    }

    public function first(){
        if(empty($this->query))
            $this->query($this->sql, $this->data, $this->params);

        return $this->query->fetch_assoc();
    }

    public function get(){
        if(empty($this->query))
            $this->query($this->sql, $this->data, $this->params);

        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    public function paginate($cant = 15){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} LIMIT " . ($page - 1)*$cant . ", {$cant}";

        if($this->sql){
            $sql = $this->sql . " LIMIT " . ($page - 1) * $cant . ", {$cant}";
            $data = $this->query($sql, $this->data, $this->params)->get();
        }
        else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} LIMIT " . ($page - 1)*$cant . ", {$cant}";
            $data = $this->query($sql)->get();
        }

        $total = $this->query("SELECT FOUND_ROWS() as total")->first()['total'];

        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        if(strpos($uri, '?') !== false)
        $uri = substr($uri, 0, strpos($uri, '?'));


        return [
            'total' => $total,
            'from' => ($page - 1)*$cant + 1,
            'to' => ($page - 1)*$cant + count($data),
            'currentPage' => $page,
            'lastPage' => ceil($total / $cant),
            'nextPage' => ($page < ceil($total / $cant)) ? "/" . $uri . "?page=" . ($page + 1) : null,
            'prevPage' => ($page > 1) ? "/" . $uri . "?page=" . ($page - 1) : null,
            'data' => $data,
            
        ];   
    }

    public function all(){
        return $this->query("SELECT * FROM {$this->table}")->get();
    }

    public function find($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i')->first();
    }

    public function where($column, $operator, $value = null){

        if($value == null){
            $value = $operator;
            $operator = "=";
        }

        if(empty($this->sql)){
            $this->sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$column} {$operator} ?";
            $this->data[] = $value;
        }
        else{
            $this->sql .= " AND {$column} {$operator} ?";
            $this->data[] = $value;
        }
        
        return $this;
    }

    public function create(array $data) {
        $columns = array_keys($data);
        $columns = implode(",", $columns);

        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (". str_repeat('?, ', count($data)-1) ." ?)";
        $this->query($sql, $values);

        $id = $this->conn->insert_id;

        return $this->find($id);
    }

    public function update(int $id, array $data){

        $fields = array();
        foreach($data as $column => $value)
            $fields[] = $column . " = ?"; 

        $fields = implode(", ", $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";

        $values = array_values($data);
        $values[] = $id; 

        $this->query($sql, $values);

        return $this->find($id);
    }

    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->query($sql, [$id], 'i');
    }
}