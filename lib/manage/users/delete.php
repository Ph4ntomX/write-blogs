<?php
    $database = connectDatabase();

    $id = $_POST["id"] ?? "";

    if (empty($id)) {
        $_SESSION["error"] = "User ID not found";
        header("Location: /manage/users");
        exit;
    }

    $recipe = "DELETE FROM users WHERE id = :id";
    $statement = $database->prepare($recipe);
    $statement->execute([
        "id" => $id
    ]);
    $_SESSION["success"] = "User has been deleted";
    header("Location: /manage/users");
    exit;
?>