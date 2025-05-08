<?php
    $database = connectDatabase();
    
    $id = $_POST["id"] ?? "";
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $role = $_POST["role"] ?? "";

    if(empty($id) || empty($name) || empty($email) || empty($role)) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage/users/edit?id=$id");
        exit;
    }

    $sql = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
    $statement = $database->prepare($sql);
    $statement->execute([
        "id" => $id,
        "name" => $name,
        "email" => $email,
        "role" => $role
    ]);

    $_SESSION["success"] = "User updated successfully";
    header("Location: /manage/users");
    exit;
?>