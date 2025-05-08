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

    function getUserById($id) {
        $database = connectDatabase();
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $database->prepare($query);
        $statement->execute(["id" => $id]);
        return $statement->fetch();
    }

    function getPosts($database) {
        $query = "SELECT * FROM posts";
        $statement = $database->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    function getPostById($id) {
        $database = connectDatabase();
        $query = "SELECT * FROM posts WHERE id = :id";
        $statement = $database->prepare($query);
        $statement->execute(["id" => $id]);
        return $statement->fetch();
    }

    function verifyUserLoggedIn() {
        if(!isset($_SESSION["user"])) {
            $_SESSION["error"] = "You must be logged in to access this page";
            header("Location: /login");
            exit;
        }
    }

    function isAdmin() {
        return $_SESSION["user"]["role"] == "admin";
    }

    function isEditor() {
        return $_SESSION["user"]["role"] == "editor" || $_SESSION["user"]["role"] == "admin";
    }

    function userHasHigherRole($role) {
        $userrole = $_SESSION["user"]["role"];

        if($userrole == "admin" && $role != "admin") {
            return true;
        }

        if($userrole == "editor" && $role != "admin" && $role != "editor") {
            return true;
        }

        return false;
    }
?>