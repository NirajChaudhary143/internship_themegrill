<?php

class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "todo";

        $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        return $conn;
    }
}

class Query extends Database
{
    public function addData($table, $field)
    {
        $q = "INSERT INTO $table";
        $fields = "";
        $values = "";
        $i = count($field);
        foreach ($field as $key => $value) {
            if ($i > 1) {
                $fields .= "$key,";
                $values .= "'$value',";
                --$i;
            } else {
                $fields .= "$key";
                $values .= "'$value'";
            }
        }
        $q .= " ($fields) VALUES ($values)";
        $stmt = $this->connect()->prepare($q);
        $stmt->execute();
    }
    public function showData($table, $id = "")
    {
        $q = "SELECT * FROM $table";
        if ($id > 0) {
            $q .= " WHERE id=:id";
            $stmt =  $this->connect()->prepare($q);
            $stmt->bindParam(':id', $id);
        } else {
            $stmt =  $this->connect()->prepare($q);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteData($table, $id)
    {
        $q = "DELETE FROM $table WHERE id=:id";
        $stmt = $this->connect()->prepare($q);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function updateData($table, $id, $taskArr)
    {
        $field = "";
        $values = "";
        $i = count($taskArr);
        foreach ($taskArr as $key => $value) {
            if ($i > 1) {
                $field .= "$key,";
                $values .= "$value,";
                --$i;
            } else {
                $field .= "$key";
                $values .= "$value";
            }
        }
        $q = "UPDATE `$table` SET  `$field` = '$value' WHERE `id` = :id";
        // die($q);
        $stmt = $this->connect()->prepare($q);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
