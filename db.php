<?php

class Db {
    private $dbHost = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbName = "crudpdo";
    private $conn;

    public function __construct() {
        try {
            $dsn = 'mysql:host=' . $this->dbHost .';dbname=' . $this->dbName;
            $this->conn = new PDO($dsn,$this->user,$this->pass);
        } catch(PDOException $e){ 
            die("DB Connection Failed " . $e);
        }
    }

    public function insertData($name, $email){
        $sql = "INSERT INTO userdetails (name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email]);
        echo "data inserted";
    }

    public function getData() {
        $sql = "SELECT * FROM userdetails";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function deleteData($id){
        $sql = "DELETE FROM userdetails WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        echo $stmt->rowCount() . "rows were affected";
    }

    public function editData($id,$name){
        $sql = "UPDATE userdetails SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name]);
    }

    public function searchData($name) {
        //sql query searchs for matches that terms
        $sql = "SELECT * FROM userdetails WHERE name LIKE :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => '%' . $name . '%']);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}