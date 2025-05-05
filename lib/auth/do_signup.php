<?php
    $database = connectDatabase();
    
    if(isset($_SESSION["user"])) {
        header("Location: /");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            echo("<p>All fields are required</p>");
            echo "<a href='/signup'>Go back</a>";
            exit();
        }
        
        $user = getUserByEmail($email);

        if ($user) {
            echo("<p>Email is already used</p>");
            echo "<a href='/signup'>Go back</a>";
        } else if ($password != $confirm_password) {
            echo("<p>Passwords do not match</p>");
            echo "<a href='/signup'>Go back</a>";
        } else {
            $recipe = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $statement = $database->prepare($recipe);
            $statement->execute([
                "name" => $name,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT)
            ]);
            header("Location: /login");
        }
    }
?>