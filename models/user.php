<?php

use JetBrains\PhpStorm\NoReturn;

class user
{
    private ?PDO $conn;
    private string $table_name = "user";
    public int $id;
    public string $username;
    public int $city_id;

    public string $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(): bool|PDOStatement
    {

        $query = "SELECT user.id, username, user.name as name, city.name as city FROM user INNER JOIN city ON user.city_id = city.id;";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function create(): bool|PDOStatement
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, city_id=:city_id, username=:username";

        $stmt = $this->conn->prepare($query);


        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));
        $this->username = htmlspecialchars(strip_tags($this->username));


        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);
        $stmt->bindParam(":username", $this->username);

        $stmt->execute();

        return $stmt;
    }

    public function delete(): bool|PDOStatement{
        $query = "DELETE FROM " . $this->table_name ." WHERE id=:id;";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        return $stmt;
    }

    public function update(): bool|PDOStatement{
        $query = "UPDATE " . $this->table_name . " SET name=:name, city_id=:city_id, username=:username WHERE id=:id;";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":city_id", $this->city_id);
        $stmt->bindParam(":name", $this->name);

        $stmt->execute();

        return $stmt;
    }

}

