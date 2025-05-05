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
                    header("Location: /");
                } else {
                    echo("Invalid password");
                    echo "<a href='/login'>Go back</a>";
                }
            } else {
                echo("User not found");
                echo "<a href='/login'>Go back</a>";
            }
        } else {
            echo("Email and password are required");
            echo "<a href='/login'>Go back</a>";
        }

        
    }
?>