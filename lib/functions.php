<?php
    function connectDatabase() {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database_name = "write_blogs";

        $database = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);

        return $database;
    }

    function getUserByEmail($email) {
        $database = connectDatabase();
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $database->prepare($query);
        $statement->execute(["email" => $email]);
        return $statement->fetch();
    }
?>