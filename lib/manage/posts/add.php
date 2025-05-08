<?php
    $database = connectDatabase();

    $title = $_POST["post-title"] ?? "";
    $content = $_POST["post-content"] ?? "";

    if(empty($title) || empty($content)) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage/posts/add");
        exit;
    }

    $sql = "INSERT INTO posts (`title`, `content`, `user_id`, `status`) VALUES (:title, :content, :user_id, :status)";
    $statement = $database->prepare($sql);
    $statement->execute([
        "title" => $title,
        "content" => $content,
        "status" => "pending",
        "user_id" => $_SESSION["user"]["id"],
    ]);

    $_SESSION["success"] = "Post added successfully";
    header("Location: /manage/posts");
    exit;
?>