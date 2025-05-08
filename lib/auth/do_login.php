<?php
    $database = connectDatabase();

    if(isset($_SESSION["user"])) {
        header("Location: /");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (!empty($email) && !empty($password)) {
            $user = getUserByEmail($email);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = $user;
                    $_SESSION["success"] = "Welcome, " . $user["name"];
                    header("Location: /");
                    exit();
                } else {
                    $_SESSION["error"] = "Invalid password";
                    header("Location: /login");
                    exit();
                }
            } else {
                $_SESSION["error"] = "User not found";
                header("Location: /login");
                exit();
            }
        } else {
            $_SESSION["error"] = "Email and password are required";
            header("Location: /login");
            exit();
        }

        
    }
?>