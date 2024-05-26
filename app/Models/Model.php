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
        return $this->query->fetch_assoc();
    }

    public function get(){
        return $this->query->fetch_all(MYSQLI_ASSOC);
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

        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} ?";

        $this->query($sql, [$value], 's');

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