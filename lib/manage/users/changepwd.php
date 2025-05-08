<?php
    $database = connectDatabase();
    
    $id = $_POST["id"] ?? "";
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";

    if(empty($id)) {
        $_SESSION["error"] = "User not found";
        header("Location: /manage/users");
        exit;
    } elseif(empty($password) || empty($confirm_password)) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage/users/change-password?id=$id");
        exit;
    } elseif ($password !== $confirm_password) {
        $_SESSION["error"] = "Passwords do not match";
        header("Location: /manage/users/change-password?id=$id");
        exit;
    }

    $sql = "UPDATE users SET password = :password WHERE id = :id";
    $statement = $database->prepare($sql);
    $statement->execute([
        "id" => $id,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

    $_SESSION["success"] = "Password updated successfully";
    header("Location: /manage/users");
    exit;
?>