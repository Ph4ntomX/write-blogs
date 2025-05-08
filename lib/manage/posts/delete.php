<?php
    $database = connectDatabase();

    $id = $_POST["id"] ?? "";

    if (empty($id)) {
        $_SESSION["error"] = "Post ID not found";
        header("Location: /manage/posts");
        exit;
    }

    $recipe = "DELETE FROM posts WHERE id = :id";
    $statement = $database->prepare($recipe);
    $statement->execute([
        "id" => $id
    ]);
    $_SESSION["success"] = "Post deleted successfully";
    header("Location: /manage/posts");
    exit;
?>