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
            $_SESSION["error"] = "All fields are required";
            header("Location: /signup");
            exit();
        }
        
        $user = getUserByEmail($email);

        if ($user) {
            $_SESSION["error"] = "Email is already used";
            header("Location: /signup");
            exit();
        } else if ($password != $confirm_password) {
            $_SESSION["error"] = "Passwords do not match";
            header("Location: /signup");
            exit();
        } else {
            $recipe = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
            $statement = $database->prepare($recipe);
            $statement->execute([
                "name" => $name,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "role" => "user"
            ]);
            $_SESSION["success"] = "Successfully signed up, please login";
            header("Location: /login");
            exit();
        }
    }
?>