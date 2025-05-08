<!DOCTYPE html>
<html>
<?php require "lib/head.php"; ?>
<?php
    $database = connectDatabase();
    $id = $_GET["id"] ?? "";

    if(empty($id)) {
        $_SESSION["error"] = "Post not found";
        header("Location: /");
        exit;
    }

    $post = getPostById($id);

    if(!$post) {
        $_SESSION["error"] = "Post not found";
        header("Location: /");
        exit;
    }

    $title = $post["title"];
    $content = $post["content"];
    $status = $post["status"];

    if($status == "pending") {
        $_SESSION["error"] = "Post is pending for review";
        header("Location: /");
        exit;
    }
?>
  <body>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?= $title; ?></h1>

      <p>
        <?= $content; ?>
      </p>

      <div class="text-center mt-3">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
